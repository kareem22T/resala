@extends('site.layouts.site-layout')

@section('title', 'عن رسالة')

@section('about_active', 'active')

@section('styles')
<style>
    p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        line-height: 35px
    }

    p.shaded {
        padding: 1rem;
        border-radius: .5rem;
        background: #f6f6f6;
    }
    p span {
        color: #e31b24;
    }
    p a {
        color: #27318b;
        text-decoration: none
    }
    @media (max-width: 575px) {
        p {
            font-size: 14px;
            color: #000;
            font-weight: 500;
            line-height: 25px;
            text-align: center;
        }
        p.shaded {
            padding: .7rem;
            border-radius: .5rem;
            background: #f6f6f6;
        }
    }
</style>
@endsection

@section('content')
@php
    $about = App\Models\Page::where('url', 'about')->first();
@endphp
{!! $about->content !!}
@endsection
