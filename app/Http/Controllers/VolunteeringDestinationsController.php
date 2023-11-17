<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteering_destination;
use App\Models\Admin;
use App\Http\Traits\SendEmail;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;

class VolunteeringDestinationsController extends Controller
{
    use DataFormController;

    public function index() {
        return view('admin.dashboard.destinationes_prev');
    }

    public function addIndex() {
        return view('admin.dashboard.destinationes_add');
    }
    
    public function editIndex($id) {
        $destination = Volunteering_destination::find($id);
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
            'image_id' => ['required'],
        ], [
            'title.required' => 'العنوان مطلوب',
            'image_id.required' => 'الصورة المصغرة مطلوبة',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل الاضافة', [$validator->errors()->first()], []);
        }

        $destination = Volunteering_destination::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_id' => $request->image_id,
        ]);

        if ($destination)
            return $this->jsonData(true, 'تم اضافة الجهة بنجاح', [], []);

    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
            'image_id' => $request->image_id,
        ], [
            'title.required' => 'العنوان مطلوب',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'فشل التعديل', [$validator->errors()->first()], []);
        }

        $destination = Volunteering_destination::find($request->id);

        $destination->title = $request->title;
        $destination->description = $request->description;
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
            return $this->jsonData(true, ' تم حذف الفرع بنجاح', [], []);

    }

}
