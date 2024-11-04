@extends('site.layouts.site-layout')

@section('title', 'الرئسية')

@section('styles')
    <style>
        swiper-slide img {
            width: 100%;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        }

        section .head {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 3rem auto 2rem;
            gap: 1.5rem;
            width: fit-content;
            border-bottom: 1px solid #d0d0d0;
        }

        section .head .text {
            text-align: center;
        }

        section .head .text h2 {
            font-size: 24px;
            font-weight: 700;
        }

        section .head .text h2 span {
            color: #e31b24;
        }

        section .head .text p {
            color: #666666;
            font-size: 16px;
        }

        section .head i {
            font-size: 2.5em;
            margin: 0;
            text-align: center;
            display: inline-block;
            vertical-align: sub;
            transition: all .2s ease-in-out;
        }

        .articles_wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px
        }

        article {
            width: 100%;
            text-align: center;
        }

        article>div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        article .img {
            width: 100%;
            display: block;
            overflow: hidden;
            height: 260px;
            border-radius: .5rem;
            border: 1px solid #d0d0d0;
            transition: all .3s ease-in;
            position: relative;
        }

        article .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        article .title {
            font-size: 17px;
            color: #141414;
            background-color: #ffffff;
            padding: 30px 25px;
            margin: 0px 15px -50px;
            box-shadow: 0px 10px 60px -10px rgba(0, 0, 0, 0.2);
            bottom: 70px;
            position: relative !important;
            width: 90%;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: all .3s ease-in;
            z-index: 2;
        }

        article>div:hover .img {
            width: 96%;
            height: clamp(13.125rem, calc(-14.375rem + 40vw), 18.125rem);
        }

        article>div:hover .title {
            bottom: 80px;
            background: #e31b24;
            color: #fff
        }

        .donate {
            display: grid;
            grid-template-columns: 1fr 1fr;
            margin: clamp(2rem, calc(1.0667rem + 4.2667vw), 4rem) 0 2rem;
            gap: 1rem;
        }

        .donate>div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            padding: clamp(1rem, calc(0.5333rem + 2.1333vw), 2rem) 1rem;
            border-radius: 1rem;
        }

        .donate h2 {
            font-size: clamp(0.8125rem, calc(0.4625rem + 1.6vw), 1.5625rem);
            font-weight: 700;
        }

        .donate>div a {
            background: white;
            padding: .7rem clamp(1rem, calc(0.5333rem + 2.1333vw), 2rem);
            border-radius: .7rem;
            color: #e31b24;
            text-decoration: none;
            border: 2px solid white;
            transition: all .3s ease-in
        }

        .donate>div:first-child {
            background: #e31b24;
            color: white;
        }

        .donate>div:last-child {
            background: #27318b;
            color: white;
        }

        .donate>div:last-child a {
            color: #27318b;
            background: white;
        }

        .donate>div a:hover {
            background: transparent;
            color: #fff
        }

        .after {
            background-color: rgba(39, 49, 139, 0.6);
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            opacity: 0;
            z-index: 1;
            font-size: 2rem;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all .3s ease-in;
        }

        article>div:hover .after {
            opacity: 1;
        }

        .events_wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 1rem;
        }

        .events_wrapper .img {
            border-radius: .7rem;
            border: 1px solid #cbcbcb;
            overflow: hidden;
        }

        .events_wrapper .img img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .videos_wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1rem;
        }

        .videos_wrapper .video {
            max-width: 100%;
            overflow: hidden;
            height:  250px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            position: relative;
            color: #fff;
            text-decoration: none;
            border: 6px solid #27318b;
            border-radius: 1rem;
        }

        .videos_wrapper .video img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            position: absolute;
            top: 0;
            left: 0;
        }

        .video .title {
            width: 90%;
            font-size: 16px;
            line-height: 26px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px;
            display: block;
            z-index: 2;
            font-weight: 700;
            text-align: center;
            transition: all .3s ease-in
        }

        .video .bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            border-radius: inherit;
            background: rgba(0, 0, 0, .4);
            border: 0;
        }

        .video .date {
            font-size: .7em;
            color: #fff;
            z-index: 2;
        }

        .video:hover .title {
            transform: scale(1.1);
            box-shadow: rgba(255, 255, 255, 0.2) 0px 8px 24px;
            color: white
        }

        .events_wrapper .img {
            border-radius: .7rem;
            border: 1px solid #cbcbcb;
            overflow: hidden;
            width: 100%;
            height: 250px;
        }

        @media (max-width: 1099px) {

            article .img {
                height: clamp(13.75rem, calc(1.5625rem + 25vw), 18.75rem);
            }

            article>div:hover .img {
                height: clamp(13.125rem, calc(0.9375rem + 25vw), 18.125rem);
            }
        }


        @media (max-width: 767.98px) {
            .events_wrapper {
                margin-top: 1.2rem;
                grid-template-columns: 1fr 1fr;
            }

            .videos_wrapper {
                grid-template-columns: 1fr 1fr;
            }

            .articles_wrapper {
                grid-template-columns: 1fr 1fr;
                padding: 1rem 1.5rem;
            }

            section .head i {
                font-size: 2em;
            }

            section .head .text h2 {
                font-size: 18px;
            }

            section .head .text p {
                font-size: 11px;
            }

            section .head {
                margin: 1rem auto 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .articles_wrapper {
                grid-template-columns: 1fr;
            }
            .events_wrapper {
                grid-template-columns: 1fr;
            }
            .videos_wrapper {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content_home')
    <swiper-container class="mySwiper" style="  margin-top: -80px;" pagination="true" pagination-clickable="true"
        space-between="30" centered-slides="true" autoplay-delay="4000" autoplay-disable-on-interaction="false" effect="fade">
        @if ($slider_imgs)
            @foreach ($slider_imgs as $slide)
                <swiper-slide>
                    <img src="{{ $slide->slide_path }}" alt="">
                </swiper-slide>
            @endforeach
        @endif
    </swiper-container>
    <div class="container">
        <section class="latest">
            <div class="head">
                <i class="fa-regular fa-newspaper"></i>
                <div class="text">
                    <h2>أخر <span>اخبارنا</span></h2>
                    <p>تعرف على كل جديد أخبار الجمعية</p>
                </div>
            </div>
            <div class="articles_wrapper">
                @php
                    $articles = App\Models\Article::where('type', 'post')->latest()->take(6)->get();
                @endphp
                @if ($articles->count() > 0)
                    @foreach ($articles as $article)
                        @php
                            $created_at = $article->created_at;
                            // Assuming $article->created_at is a timestamp or date string
                            $date = Carbon\Carbon::parse($article->created_at);

                            $months = [
                                'يناير',
                                'فبراير',
                                'مارس',
                                'إبريل',
                                'مايو',
                                'يونيو',
                                'يوليو',
                                'أغسطس',
                                'سبتمبر',
                                'أكتوبر',
                                'نوفمبر',
                                'ديسمبر',
                            ];

                            $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];

                            $formattedDate =
                                $days[$date->dayOfWeek] .
                                ', ' .
                                $date->day .
                                ' ' .
                                $months[$date->month] .
                                ', ' .
                                $date->year;
                        @endphp
                        <article>
                            <div>
                                <a href="/{{ $article->url }}" target="_blanck" class="img">
                                    <img src="{{ $article->thumbnail_path }}" alt="{{ $article->title }}">
                                    <div class="after">
                                        <i class="fa-solid fa-link"></i>
                                    </div>
                                </a>
                                <a href="" class="title">{{ $article->title }}</a>
                            </div>
                            <span>{{ $formattedDate }}</span>
                        </article>
                    @endforeach
                @endif
            </div>
        </section>

        <section class="donate">
            <div>
                <h2>اتبرع لجمعية رسالة</h2>
                <a href="{{ route('donate.main') }}"><i class="fa-solid fa-sack-dollar"></i> تبرع الان</a>
            </div>
            <div>
                <h2>تطوع بجمعية رسالة</h2>
                <a href="{{ route('site.volunteering') }}"><i class="fa-solid fa-child-reaching"></i> طلب التطوع</a>
            </div>
        </section>


        <section class="events">
            <div class="head">
                <i class="fa-regular fa-image"></i>
                <div class="text">
                    <h2>الفعاليات فى صور</h2>
                    <p>البوم صور لأهم فاعليات جمعية رسالة</p>
                </div>
            </div>
            <div class="events_wrapper" dir="ltr">
                @if ($events_imgs)
                    @foreach ($events_imgs as $img)
                        <div class="img">
                            <img src="{{ $img->slide_path }}" alt="">
                        </div>
                    @endforeach
                @endif
            </div>
        </section>


        <section class="videos">
            <div class="head">
                <i class="fa-brands fa-youtube"></i>
                <div class="text">
                    <h2>فيديوهات رسالة</h2>
                    <p>أهم فيديوهات رسالة</p>
                </div>
            </div>
            <div class="videos_wrapper">
                @php
                    $articles = App\Models\Article::where('type', 'video')->latest()->take(3)->get();
                @endphp
                @if ($articles->count() > 0)
                    @foreach ($articles as $article)
                        @php
                            $created_at = $article->created_at;
                            // Assuming $article->created_at is a timestamp or date string
                            $date = Carbon\Carbon::parse($article->created_at);

                            $months = [
                                'يناير',
                                'فبراير',
                                'مارس',
                                'إبريل',
                                'مايو',
                                'يونيو',
                                'يوليو',
                                'أغسطس',
                                'سبتمبر',
                                'أكتوبر',
                                'نوفمبر',
                                'ديسمبر',
                            ];

                            $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];

                            $formattedDate =
                                $days[$date->dayOfWeek] .
                                ', ' .
                                $date->day .
                                ' ' .
                                $months[$date->month] .
                                ', ' .
                                $date->year;
                        @endphp
                        <a href="/{{ $article->url }}" target="_blanck" class="video">
                            <img src="{{ $article->thumbnail_path }}" alt="{{ $article->title }}">
                            <span class="title">{{ $article->title }}</span>
                            <span class="bg"></span>
                            <span class="date">{{ $formattedDate }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        function addAttributeBasedOnWidth() {
            var screenWidth = $(window).width();
            var responsiveElement = $('swiper-container');

            if (screenWidth > 767) {
                responsiveElement.attr('navigation', 'true');
            } else {
                responsiveElement.attr('navigation', 'false');
            }
        }
        // On window load
        $(document).ready(function() {
            addAttributeBasedOnWidth();
        });

        // On window resize
        $(window).resize(function() {
            addAttributeBasedOnWidth();
        });
    </script>
@endsection
