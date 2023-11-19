
<header dir="rtl">
    <div class="container">

        <div class="head">
            <img src="{{ asset('/assets/img/Resala-logo.png') }}" alt="logo" class="logo">
            <div class="controls">
                <form action="">
                    <input type="text" class="form-control" name="search" placeholder="البحث في الموقع">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="btns">
                    <a href="" class="menu"><i class="fa-solid fa-bars"></i></a>
                    <a href="{{ route('donate.main') }}"><i class="fa-solid fa-sack-dollar"></i> تبرع</a>
                    <a href="{{ route('site.volunteering') }}"><i class="fa-solid fa-child-reaching"></i> تطوع</a>
                </div>
            </div>
        </div>
        <nav>
            <i class="fa-solid fa-x close"></i>
            <ul class="pages">
                <a href="{{ route('resala.about') }}" class="@yield('about_active')">
                    <li>عن رسالة</li>
                </a>
                <a href="{{ route('news.show') }}" class="@yield('news_active')">
                    <li>الأخبار</li>
                </a>
                <a href="">
                    <li>الفعاليات</li>
                </a>
                <a href="" class="@yield('destinations_active')">
                    <li>الانشطة</li>
                </a>
                <a href="">
                    <li>الفروع</li>
                </a>
                <a href="">
                    <li>يوم التحدي</li>
                </a>
                <a href="{{ route('videos.show') }}" class="@yield('videos_active')">
                    <li>الفيديوهات</li>
                </a>
                <a href="{{ route('photos.show') }}" class="@yield('images_active')">
                    <li>صور</li>
                </a>
                <a href="{{ route('resala.baheya') }}" class="@yield('baheya_active')">
                    <li>بهية</li>
                </a>
                <a href="{{ route('resala.contact') }}" class="@yield('contact_active')">
                    <li>اتصل بنا</li>
                </a>

                <li class="more">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                    <ul>
                        <a href="{{ route('resala.about') }}" class="@yield('about_active')">
                            <li>عن رسالة</li>
                        </a>
                        <a href="{{ route('news.show') }}" class="@yield('news_active')">
                            <li>الأخبار</li>
                        </a>
                        <a href="">
                            <li>الفعاليات</li>
                        </a><a href=""  class="@yield('destinations_active')">
                            <li>الانشطة</li>
                        </a><a href="">
                            <li>الفروع</li>
                        </a>
                        <a href="">
                            <li>يوم التحدي</li>
                        </a>
                        <a href="{{ route('videos.show') }}" class="@yield('videos_active')">
                            <li>الفيديوهات</li>
                        </a>
                        <a href="{{ route('photos.show') }}" class="@yield('images_active')">
                            <li>صور</li>
                        </a>
                        <a href="{{ route('resala.baheya') }}" class="@yield('baheya_active')">
                            <li>بهية</li>
                        </a>
                        <a href="{{ route('resala.contact') }}" class="@yield('contact_active')">
                            <li>اتصل بنا</li>
                        </a>
                    </ul>
                </li>
            </ul>

            <ul class="social">
                <li class="mobile">
                    <ul>
                        <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </li>
            </ul>
        </nav>

    </div>
</header>
