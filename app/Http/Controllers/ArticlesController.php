<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\DataFormController;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use App\Models\Volunteering_destination;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    use DataFormController;


    public function index() {
        return view('admin.dashboard.article_prev');
    }

    public function getNewsIndex() {
        $articles = Article::where('type', 'post')->orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
        $title = 'اخبار رسالة';
        $active_link = 'news_active';
        Carbon::setLocale('ar');
        return view('site.articles')->with(compact(['articles', 'title', 'active_link']));
    }

    public function getVideosIndex() {
        $articles = Article::where('type', 'vedio')->orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
        $title = 'الفيديوهات';
        $active_link = 'videos_active';
        Carbon::setLocale('ar');
        return view('site.articles')->with(compact(['articles', 'title', 'active_link']));
    }

    public function getImagesIndex() {
        $articles = Article::where('type', 'photos')->orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
        $title = 'صور';
        $active_link = 'images_active';
        Carbon::setLocale('ar');
        return view('site.articles')->with(compact(['articles', 'title', 'active_link']));
    }

    public function getArticles() {
        $Articles = Article::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
        
        return $this->jsonData(true, '', [], $Articles);
    }

    public function search(Request $request) {
        $byTitles = Article::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->where('title', 'like', '%' . $request->search_words . '%')->paginate(10);

        $byTypes = Article::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->where('type', 'like', '%'.$request->search_words.'%')->paginate(10);

        $contents = Article::orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->where('content', 'like', '%'.$request->search_words.'%')->paginate(10);
        
        return $this->jsonData(true, '', [], !$byTitles->isEmpty() ? $byTitles : (!$byTypes->isEmpty() ? $byTypes : $contents));

    }

    public function addIndex() {
        return view('admin.dashboard.article_add');
    }


    public function put(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'content' => ['required'],
            'thumbnail_path' => ['required'],
            'url' => ['required', 'regex:/^[^\s]+$/'],
            'type' => ['required'],
            'created_at' => ['required'],
        ], [
            'title.required' => 'عنوان المقالة مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'thumbnail_path.required' => 'قم باختيار صورة مصغرة',
            'created_at.required' => 'قم باختيار تاريخ نشر المقالة',
            'type.required' => 'اختر نوع المقالة',
            'url.required' => 'الرابط مطلوب',
            'url.regex' => 'يجب الا يحتوي الرابط على مسافات',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'Add failed', [$validator->errors()->first()], []);
        }

        $articleUrl = Article::where('url', $request->url)->get();
        if ($articleUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destinationsUrl = Volunteering_destination::where('url', $request->url)->get();
        if ($destinationsUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $createArticle = Article::create([
            'author_id' => Auth::guard('admin')->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail_path' => $request->thumbnail_path,
            'type' => $request->type,
            'url' => $request->url,
            'created_at' => $request->created_at,
        ]);

        if ($createArticle)
            return $this->jsonData(true, 'تم اضافة المقالة بنجاح', [], []);
    }


    public function edit($id) {
        $article = Article::find($id);
        return view('admin.dashboard.article_edit')->with(compact('article'));
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'thumbnail_path' => ['required'],
            'url' => ['required', 'regex:/^[^\s]+$/'],
            'type' => ['required'],
            'created_at' => ['required'],
        ], [
            'id.required' => 'رقم التعريف للمقالة مفقود',
            'title.required' => 'عنوان المقالة مطلوب',
            'content.required' => 'المحتوى مطلوب',
            'thumbnail_path.required' => 'قم باختيار صورة مصغرة',
            'created_at.required' => 'قم باختيار تاريخ نشر المقالة',
            'type.required' => 'اختر نوع المقالة',
            'url.required' => 'الرابط مطلوب',
            'url.regex' => 'يجب الا يحتوي الرابط على مسافات',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, 'update failed', [$validator->errors()->first()], []);
        }

        $articleUrl = Article::where('url', $request->url)->where('id', '!', $request->id)->get();
        if ($articleUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $destinationsUrl = Volunteering_destination::where('url', $request->url)->get();
        if ($destinationsUrl->count() > 0) {
            return $this->jsondata(false, 'Add failed', ['هذا الرابط موجود بالفعل'], []);
        }

        $article = Article::find($request->id); 
        $article->title = $request->title;
        $article->content = $request->content;
        $article->thumbnail_path = $request->thumbnail_path;
        $article->type = $request->type;
        $article->url = $request->url;
        $article->created_at = $request->created_at;

        $article->save();

        if ($article)
            return $this->jsonData(true, 'تم تعديل المقالة بنجاح', [], []);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'article_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->jsondata(false, true, 'Edit failed', [$validator->errors()->first()], []);
        }

        $Article = Article::find($request->article_id);
        $Article->delete();

        if ($Article)
            return $this->jsonData(true, $request->file_name . 'تم حف المقالة بنجاح', [], []);
    }

}
