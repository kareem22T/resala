@extends('site.layouts.site-layout')

@section('title', 'اوجه التبرع')

@section('styles')
    <style>
        section {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(430px, 1fr));
            gap: 1.5rem;
            padding: 2rem 0;
        }
        section a {
            padding: 25px 30px;
            border-style: solid;
            border-width: 1px;
            border-color: #c6c6c6;
            border-radius: 20px;
            font-size: 24px;
            font-weight: 700;
            color: #000;
            text-decoration: none;
            transition: all .2s ease-in-out;
            display: flex;
            align-items: center;
            white-space: nowrap;
            gap: 20px;
            flex-wrap: wrap;
            background: #ffffff48;
            backdrop-filter: blur(5px)
        }
        section a:hover {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            color: black
        }
        @media (max-width: 575.98px) {
            section {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1.5rem;
                padding: 0;
            }
            section a {
                font-size: 20px;
                padding: 18px 24px;
            }
        }
    </style>
@endsection

@section('content')
    <section>
        <a href="https://resala.org/donations/">
            <img src="{{asset('/assets/img/donate-1.jpg')}}" alt="">
            <span>التبرع من خلال VISA</span>
        </a>
        <a href="{{ route('resala.bank_transfer') }}">
            <img src="{{asset('/assets/img/donate-2.jpg')}}" alt="">
            <span>التحويل البنكي</span>
        </a>
        <a href="{{ route('donate.representative') }}">
            <img src="{{asset('/assets/img/donate-3.jpg')}}" alt="">
            <span>التبرع من خلال مندوب</span>
        </a>
        <a href="{{ route('resala.other_donation') }}">
            <img src="{{asset('/assets/img/donate-4.jpg')}}" alt="">
            <span>طرق تبرع آخرى</span>
        </a>
    </section>
@endsection
