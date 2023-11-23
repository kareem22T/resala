@extends('site.layouts.site-layout')

@section('title', isset($page) ? $page->title : '404 not found')
@section(isset($active_link) ? $active_link : '', 'active')

@section('styles')
    <style>
        main aside {
            width: 30%
        }
        main article h1 {
            font-size: clamp(1.3rem, calc(1.0421rem + 1.1789vw), 2rem) !important;
            font-weight: 600 !important;
            color: #e31b24 !important;
            text-align: right !important;
            margin-bottom: 25px !important;
        }
        main article h2 {
            font-size: clamp(1.2rem, calc(0.9789rem + 1.0105vw), 1.8rem) !important;
            font-weight: 600 !important;
            color: #27318b;
            text-align: right !important;
            margin-bottom: 10px;
        }
        main article h3 {
            font-size: clamp(1.1rem, calc(0.9158rem + 0.8421vw), 1.6rem) !important;
            font-weight: 600 !important;
            color: #27318b;
            text-align: right !important;
            margin-bottom: 10px;
        }
        main article h4 {
            font-size: clamp(1rem, calc(0.8158rem + 0.8421vw), 1.5rem) !important;
            font-weight: 600 !important;
            color: #27318b;
            text-align: right !important;
            margin-bottom: 10px;
        }
        main article h5 {
            font-size: clamp(1rem, calc(0.8526rem + 0.6737vw), 1.4rem) !important;
            font-weight: 600 !important;
            color: #27318b;
            text-align: right !important;
            margin-bottom: 10px;
        }
        main article h6 {
            font-size: clamp(1rem, calc(0.8895rem + 0.5053vw), 1.3rem) !important;
            font-weight: 600 !important;
            color: #27318b;
            text-align: right !important;
            margin-bottom: 10px;
        }
        main article p {
            font-size: clamp(0.9rem, calc(0.8079rem + 0.4211vw), 1.15rem) !important;
            font-weight: 500 !important;
            color: rgb(57, 57, 57);
        }
        main swiper-container {
            direction: ltr;
            padding: 0 1.5rem
        }
        main swiper-slide {
            margin: 0 8px !important
        }
        main swiper-slide:first-child {
            margin-left: 0 !important
        }
        main swiper-slide:last-child {
            margin-right: 0 !important
        }
        main swiper-slide img {
            object-fit: fill !important;
            height: max-content !important;
        }
        .date {
            color: #e31b24;
            font-size: 14px
        }
        .help-card, .facebook-card {
            padding: 1.25rem;
            font-size: 21px;
            text-align: center;
            font-weight: 700;
            color: #e31b24;
            border: 2px solid #27318b;
            border-radius: 20px;
            background: #fff;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1rem;
            max-width: 300px;
            margin: 1rem auto;
        }
        .help-card img {
            width: 100%
        }
        iframe {
            width: 100% !important
        }
        @media (max-width: 767.99px) {
            main {
                flex-direction: column;
                align-items: center
            }
            main article {
                width: 100%
            }
            main aside {
                width: 100%
            }
        }
    </style>
@endsection

@if ($page)
@section('content')
<main>
    {!! $page->content !!}
</main>
@endsection
@else
@section('content')
    <h1>404 | غير متوفرة</h1>
@endsection
@endif

@section('scripts')
    <script>
        $(function () {
            setTimeout(() => {
                $('.mySwiper').attr('navigation', 'true');
            }, 500);
        })
    </script>
    <script>
        const swiperEl = document.querySelector('swiper-container')
        Object.assign(swiperEl, {
        slidesPerView: 1,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            575: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
        },
        });
        swiperEl.initialize();
  </script>
@endsection