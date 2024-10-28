@extends('site.layouts.site-layout')

@section('title', 'تحدي الخير')

@section('challange_day_active', 'active')

@section('styles')
    <style>
        * {
            max-width: 100%;
            object-fit: contain;
            height: fit-content;
        }
    </style>
@endsection

@section('content')
@php
    $page = App\Models\Page::where('url', 'تحدي-الخير')->first();
@endphp
{!! $page->content !!}
@endsection
