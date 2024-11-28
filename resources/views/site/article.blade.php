@extends('site.layouts.site-layout')

@section('title', isset($article) ? $article->title : '404 not found')
@section(isset($active_link) ? $active_link : '', 'active')

@section('styles')
    <style>
        main {
            display: flex;
            gap: 2rem;
            margin-top: 1rem
        }

        main article {
            width: 70%
        }
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
            width: 100%;
            max-width: 400px;
        }
        img {
            max-width: 100%;
        }
        aside iframe {
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
            .thumbnail img {
                width: 100% !important
            }
        }
        .images-album {
            padding: 32px 0;
        }
        .images-album .img_wrapper {
            height: 220px !important;
        }
        @media (max-width: 7697.98px) {
            .images-album .img_wrapper {
                height: 90px !important;
            }
            .images-album {
                gap: 10px !important;
            }
        }
    </style>
@endsection

@if ($article)
@section('content')
<main>
<article>
    <h1 style="display: flex;justify-content: space-between;flex-direction: column;gap: 16px;padding-bottom: 16px !important">
        {{ $article->title }}
        <div class="thumbnail">
            <img style="  width: 300px;height: 180px;object-fit: cover;" src="{{$article->thumbnail_path}}" alt="{{ $article->title }}">
        </div>
    </h1>
    <div class="content" style="margin-top: -24px">
        {!! $article->content !!}
    </div>
    <span class="date">
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
        {{$formattedDate}}
    </span>
</article>
<aside>
    <div class="facebook-card">
        <span>تابعونا على فيس بوك</span>
        <div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/Resala.org" data-small-header="1" data-adapt-container-width="true" data-hide-cover="" data-hide-cta="false" data-show-facepile="1" data-show-posts="" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=376512092550885&amp;container_width=287&amp;hide_cover=false&amp;hide_cta=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FResala.org&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=true"><span style="vertical-align: bottom; width: 287px; height: 70px;"><iframe name="f3a4574b8b32ad6" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" style="border: medium none; visibility: visible; width: 287px; height: 70px;" src="https://www.facebook.com/v2.5/plugins/page.php?adapt_container_width=true&amp;app_id=376512092550885&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df60d9007ed600a%26domain%3Dresala.org%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fresala.org%252Ff723e7ee241cbc%26relation%3Dparent.parent&amp;container_width=287&amp;hide_cover=false&amp;hide_cta=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FResala.org&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;show_posts=false&amp;small_header=true" class="" width="1000px" height="1000px" frameborder="0"></iframe></span></div>
    </div>
    <div class="help-card">
        <img src="{{ asset('/assets/img/help.png') }}" alt="">
        انا وابن عمي بنساعد الغريب
    </div>
</aside>
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
