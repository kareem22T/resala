@extends('site.layouts.site-layout')

@section('title', 'مستشفى بهية')

@section('baheya_active', 'active')

@section('styles')
<style>
    .baheya {
        display: flex;
        justify-content: space-between;
        gap: 2rem;
        margin: 5rem 0 3rem;
    }
    .baheya > * {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: right !important;
    }
    .baheya h1 {
        width: 100%;
        text-align: right;
        font-family: inherit;
        color: #d75e81;
        font-size: clamp(1.375rem, calc(1.2829rem + 0.4211vw), 1.625rem);
        font-weight: 700;
        margin-bottom: 2rem;
    }
    .baheya p {
        font-size: clamp(0.875rem, calc(0.7829rem + 0.4211vw), 1.125rem);
        line-height: clamp(1.625rem, calc(1.4868rem + 0.6316vw), 2rem);
    }
    .baheya img {
        width: 100%;
        max-width: 400px;
    }
    @media (max-width: 767.98px) {
        .baheya {
            flex-direction: column;
            gap: 1rem
        }
        .baheya > * {
            width: 100%;
            text-align: center !important;
        }
        .baheya h1 {
            text-align: center;
        }
    }
    @media (max-width: 767.98px) {
        .baheya {
            margin: 3rem 0 2rem;
        }
    }

</style>
@endsection

@section('content')
@php
    $page = App\Models\Page::where('url', 'baheya')->first();
@endphp
{!! $page->content !!}
@endsection
