<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use App\Models\Volunteering_destination;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    use DataFormController;


    public function index() {
        return view('admin.dashboard.page_prev');
    }

    public function getPages() {
        $Pages = Page::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
        
        return $this->jsonData(true, '', [], $Pages);
    }

    public function search(Request $request) {
        $byTitles = Page::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->where('title', 'like', '%' . $request->search_words . '%')->paginate(10);

        $byTypes = Page::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->where('url', 'like', '%'.$request->search_words.'%')->paginate(10);

        $contents = Page::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->where('content', 'like', '%'.$request->search_words.'%')->paginate(10);
        
        return $this->jsonData(true, '', [], !$byTitles->isEmpty() ? $byTitles : (!$byTypes->isEmpty() ? $byTypes : $contents));

    }

    public function addIndex() {
        return view('admin.dashboard.page_add');
    }


    public function put(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
            'url' => ['required', 'regex:/^[^\s]+$/'],
        ], [
            'title.required' => 'عنوان الصفحة مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'url.required' => 'الرابط مطلوب',
            'url.regex' => 'يجب الا يحتوي الرابط على مسافات',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $articleUrl = Article::where('url', $request->url)->get();
        if ($PageUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destinationsUrl = Volunteering_destination::where('url', $request->url)->get();
        if ($destinationsUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $pagesUrl = Page::where('url', $request->url)->get();
        if ($pagesUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $createPage = Page::create([
            'title' => $request->title,
            'content' => $request->content,
            'url' => $request->url,
        ]);

        if ($createPage)
            return $this->jsonData(true, 'تم اضافة الصفحة بنجاح', [], []);
    }


    public function edit($id) {
        $page = Page::find($id);
        return view('admin.dashboard.page_edit')->with(compact('page'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'url' => ['required', 'regex:/^[^\s]+$/'],
        ], [
            'id.required' => 'رقم التعريف للمقالة مفقود',
            'title.required' => 'عنوان الصفحة مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'url.required' => 'الرابط مطلوب',
            'url.regex' => 'يجب الا يحتوي الرابط على مسافات',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'update failed', [$validator->errors()->first()], []);
        }

        $PageUrl = Page::where('url', $request->url)->where('id', '!', $request->id)->get();
        if ($PageUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destinationsUrl = Volunteering_destination::where('url', $request->url)->get();
        if ($destinationsUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }
        $articleUrl = Article::where('url', $request->url)->get();
        if ($pagesUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $Page = Page::find($request->id); 
        $Page->title = $request->title;
        $Page->content = $request->content;
        $Page->url = $request->url;

        $Page->save();

        if ($Page)
            return $this->jsonData(true, 'تم تعديل الصفحة بنجاح', [], []);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'page_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'delete failed', [$validator->errors()->first()], []);
        }

        $Page = Page::find($request->page_id);
        $Page->delete();

        if ($Page)
            return $this->jsonData(true, $request->file_name . 'تم حف الصفحة بنجاح', [], []);
    }

}
