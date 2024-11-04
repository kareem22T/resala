@extends('site.layouts.site-layout')

@section('title', 'اتصل بنا')

@section('contact_active', 'active')

@section('styles')
    <style>
        .cards_wrapper {
            display: flex;
            justify-content: space-between;
            margin: 6rem 0 3rem;
        }
        .cards_wrapper > div {
            padding: 3rem 1rem;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 1rem;
            width: 100%;
        }
        .cards_wrapper > div .text {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 22px;
            color: #ffffff;
            font-weight: 700 !important;
        }
        .cards_wrapper > div i {
            font-size: 24px;
            color: #ffffff;
            background-color: #3f51b5;
            margin-right: 20px;
            border-radius: 10px;
            padding: 1rem;
        }
        .cards_wrapper .text span {
            font-size: 15px;
            color: #fff;
            font-weight: 400;
        }
        .more {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .more a {
            text-decoration: none;
            color: #27318b
        }
        @media (max-width: 767.98px) {
            .cards_wrapper {
                margin: 3rem 0 2rem;
                flex-direction: column;
            }
            .cards_wrapper > div {
                padding: 3rem 0
            }
        }
    </style>
@endsection

@section('content')
@php
    $page = App\Models\Page::where('url', 'contact-us')->first();
@endphp
{!! $page->content !!}

@endsection
