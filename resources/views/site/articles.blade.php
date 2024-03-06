@extends('site.layouts.site-layout')

@section('title', isset($title) ? $title : '' )
@section(isset($active_link) ? $active_link : '', 'active')

@section('styles')
<style>
    .pagination {
        margin: 2rem auto;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        direction: ltr !important
    }
    .page-link {
        border-radius: 10px !important;
        width: 40px;
        height: 40px;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #27318b !important;
    }
    .page-item.active .page-link {
        background: #e31b24;
        color: #fff !important;
        border-color: #e31b24 !important;
    }
    .articles_wrapper {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }
    .articles_wrapper .article {
        width: 100%;
        overflow: hidden;
        padding: 1rem;
        border: 1px solid #f0efea;
        border-radius: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        background: #ffffff40;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        text-decoration: none;
        cursor: pointer;
        transition: all .3s ease-in-out;
        border: 2px solid #27318b;
    }
    .articles_wrapper .article:hover {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }
    .articles_wrapper .article .thumbnail {
        width: 100%;
        height: auto !important;
        border-radius: .5rem;
        height: 180px !important;
        overflow: hidden;
    }
    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }
    .article h1 {
        font-size: 18px !important;
        line-height: 30px !important;
        font-weight: 600;
        color: #27318b;
    }
    .article span {
        font-size: 11px;
        color: rgb(118, 118, 118)
    }
    @media (max-width: 1199.99px) {
        .articles_wrapper {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
    }
    @media (max-width: 992.99px) {
        .articles_wrapper .article .thumbnail {
            height: 140px;
        }
    }
    @media (max-width: 767.99px) {
        .articles_wrapper {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }
    @media (max-width: 575.99px) {
        .articles_wrapper {
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }
        .articles_wrapper .article .thumbnail {
            height: auto;
        }
    }
</style>
@endsection

@section('content')
    @if($articles && $articles->count() > 0)
        <div class="articles_wrapper">
            @foreach ($articles as $article)
                @php
                    $created_at = $article->created_at;
                    // Assuming $article->created_at is a timestamp or date string
                    $date = Carbon\Carbon::parse($article->created_at);

                    $months = array(
                        "يناير", "فبراير", "مارس", "إبريل", "مايو", "يونيو",
                        "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"
                    );

                    $days = array(
                        "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة", "السبت"
                    );

                    $formattedDate = $days[$date->dayOfWeek] . ', ' . $date->day . ' ' . $months[$date->month] . ', ' . $date->year;
                @endphp
                <a href="/{{ $article->url }}" target="_blanck" class="article">
                    <div class="thumbnail">
                        <img src="{{$article->thumbnail_path}}" alt="{{ $article->title }}">
                    </div>
                    <h1>{{ $article->title }}</h1>
                    <span>{{ $formattedDate }}</span>
                </a>
            @endforeach
        </div>

        <div class="pagination_wrapper">
            {!! $articles->links('pagination::bootstrap-4') !!}
        </div>
    @else
    <h1 style="margin: 5rem 0">
        لا توجد منشورات
    </h1>
    @endif
@endsection
