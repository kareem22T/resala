@extends('site.layouts.site-layout')

@section('title', 'الانشطة' )
@section('destinations_active', 'active')

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
        justify-content: center;
        align-items: center;
        gap: 1rem;
        background: #ffffff40;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        text-decoration: none;
        transition: all .3s ease-in-out;
        border: 2px solid #27318b;
        text-align: center
    }
    .articles_wrapper .article a:hover {
        background: #27318b !important;
        color: #fff
    }
    .articles_wrapper .article .thumbnail {
        width: 170px;
        height: 170px !important;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #f0efea;
    }
    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .article h1 {
        font-size: 30px !important;
        line-height: 30px !important;
        font-weight: 600;
        color: #e31b24;
    }
    .article span {
        font-size: 11px;
        color: rgb(118, 118, 118)
    }
    .article a {
        padding: .5rem 1rem;
        border: 1px solid #27318b;
        border-radius: 10px;
        background: transparent;
        color: #27318b;
        text-decoration: none;
        transition: all .3s ease-in-out
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
    ul {
        padding-right: 2.2rem;
    }
</style>
@endsection

@section('content')
    @if($activities && $activities->count() > 0)
        <div class="articles_wrapper">
            @foreach ($activities as $activity)
                <div class="article">
                    <div class="thumbnail">
                        <img src="/dashboard/images/uploads/{{ $activity->thumbnail->path }}" alt="{{ $activity->title }}">
                    </div>
                    <h1 style="font-size: 1.5rem !important">{{ $activity->title }}</h1>
                    <p>
                        {{ $activity->brief }}
                    </p>
                    <a href="/{{ $activity->url }}" target="_blanck" >تفاصيل النشاط <i class="fa-solid fa-arrow-left-long"></i></a>
                </div>
            @endforeach
        </div>

        <div class="pagination_wrapper">
            {!! $activities->links('pagination::bootstrap-4') !!}
        </div>
    @else
    <h1 style="margin: 5rem 0">
        لا توجد انشطة
    </h1>
    @endif
@endsection
