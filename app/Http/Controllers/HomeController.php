<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Page;
use App\Models\Volunteering_destination;

class HomeController extends Controller
{
    public function urlPerIndex ($url) {
        $article  = Article::where('url', $url)->first();
        $active_link = isset($article) && $article ? ($article->type == 'post' ? 'news_active' : ($article->type ==  'vedio' ? "videos_active" : 'images_active')) : '';
        if ($article)
            return view('site.article')->with(compact(['article', 'active_link']));

        $destination  = Volunteering_destination::with('thumbnail')->where('url', $url)->first();
        $active_link = isset($destination) && $destination ? "destinations_active" : '';
        if ($destination)
            return view('site.destination')->with(compact(['destination', 'active_link']));

        $page  = Page::where('url', $url)->first();
        if ($page)
            return view('site.page')->with(compact(['page']));

        return view('site.article')->with(compact(['article', 'active_link']));
    }
}
