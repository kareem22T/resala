<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteering_destination;
use App\Models\Admin;
use App\Models\Article;
use App\Http\Traits\SendEmail;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;

class VolunteeringDestinationsController extends Controller
{
    use DataFormController;

    public function getActivitiesIndex() {
        $activities = Volunteering_destination::paginate(10);
        return view('site.activities')->with(compact(['activities']));
    }

    public function index() {
        return view('admin.dashboard.destinationes_prev');
    }

    public function addIndex() {
        return view('admin.dashboard.destinationes_add');
    }
    
    public function editIndex($id) {
        $destination = Volunteering_destination::with('thumbnail')->find($id);
        return view('admin.dashboard.destinationes_edit')->with(compact('destination'));
    }

    public function search(Request $request) {
        $titles = Volunteering_destination::where('title', 'like', '%' . $request->search_words . '%')
                                ->paginate(15);

        $descriptions = Volunteering_destination::where('description', 'like', '%' . $request->search_words . '%')
                                ->paginate(15);
        
        return $this->jsonData(true, '', [], !$descriptions->isEmpty() ? $descriptions : $titles);

    }

    public function get() {
        $destinationes = Volunteering_destination::paginate(15);
        return $this->jsonData(true, '', [], $destinationes);
    }

    public function getAll() {
        $destinationes = Volunteering_destination::all();
        return $this->jsonData(true, '', [], $destinationes);
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'brief' => ['required', 'max:50'],
            'descrption' => ['required'],
            'url' => ['required', 'regex:/^[^\s]+$/'],
            'image_id' => ['required'],
        ], [
            'title.required' => 'العنوان مطلوب',
            'image_id.required' => 'الصورة المصغرة مطلوبة',
            'brief.required' => 'الوصف المختصر مطلوب',
            'brief.max' => 'لا يجب ان يزيد الوصف المختصر عن 50 حرف',
            'description.required' => 'الوصف مطلوب',
            'url.required' => 'الرابط مطلوب',
            'url.regex' => 'يجب الا يحتوي الرابط على مسافات',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل الاضافة', [$validator->errors()->first()], []);
        }

        $articleUrl = Article::where('url', $request->url)->get();
        if ($articleUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destinationsUrl = Volunteering_destination::where('url', $request->url)->get();
        if ($destinationsUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destination = Volunteering_destination::create([
            'title' => $request->title,
            'brief' => $request->brief,
            'description' => $request->description,
            'url' => $request->url,
            'image_id' => $request->image_id,
        ]);

        if ($destination)
            return $this->jsonData(true, 'تم اضافة الجهة بنجاح', [], []);

    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'brief' => ['required', 'max:50'],
            'description' => ['required'],
            'title' => ['required'],
            'image_id' => ['required'],
            'url' => ['required', 'regex:/^[^\s]+$/'],
        ], [
            'title.required' => 'العنوان مطلوب',
            'image_id.required' => 'الصورة المصغرة مطلوبة',
            'brief.required' => 'الوصف المختصر مطلوب',
            'brief.max' => 'لا يجب ان يزيد الوصف المختصر عن 50 حرف',
            'description.required' => 'الوصف مطلوب',
            'url.required' => 'الرابط مطلوب',
            'url.regex' => 'يجب الا يحتوي الرابط على مسافات',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل التعديل', [$validator->errors()->first()], []);
        }

        $articleUrl = Article::where('url', $request->url)->get();
        if ($articleUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destinationsUrl = Volunteering_destination::where('url', $request->url)->where('id', '!', $request->id)->get();
        if ($destinationsUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destination = Volunteering_destination::find($request->id);

        $destination->title = $request->title;
        $destination->description = $request->description;
        $destination->brief = $request->brief;
        $destination->url = $request->url;
        $destination->image_id = $request->image_id;

        $destination->save();

        if ($destination)
            return $this->jsonData(true, 'تم تعديل الجهة بنجاح', [], []);

    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'destination_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $destination = Volunteering_destination::find($request->destination_id);
        $destination->delete();

        if ($destination)
            return $this->jsonData(true, ' تم حذف الجهة بنجاح', [], []);

    }

}
