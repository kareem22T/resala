@extends('site.layouts.site-layout')

@section('title', 'سياسة الخصوصية')

@section('styles')
    <style>
        h2 {
            font-size: 36px;
        }
        h1, h2, h3, h4, h5, h6 {
            line-height: 1.4;
            font-weight: bold;
            margin: 0 0 10px 0;
            box-decoration-break: clone;
            -webkit-box-decoration-break: clone;
        }
        p {
            font-size: 18px;
            line-height: 30px
        }
    </style>
@endsection

@section('content')
@php
    $page = App\Models\Page::where('url', 'privacy-policy')->first();
@endphp
{!! $page->content !!}

@endsection
