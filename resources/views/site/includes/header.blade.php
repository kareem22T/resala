
<header dir="rtl" style=";z-index: 999;position: relative;margin-bottom: 0">
    <div class="container">

        <div class="head">
            <a href="/"><img src="{{ asset('/assets/img/Resala-logo.png') }}" alt="logo" class="logo"></a>
            <div class="controls">
                <form action="">
                    <input type="text" class="form-control" name="search" id="search_input" placeholder="البحث في الموقع">
                    <button type="submit" class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <div class="btns">
                    <a href="" class="menu"><i class="fa-solid fa-bars"></i></a>
                    <a href="{{ route('donate.main') }}" style="border-radius: 0 14px 14px 0;"><i class="fa-solid fa-sack-dollar"></i> تبرع</a>
                    <a href="{{ route('site.volunteering') }}" style="background: #27318b;border-radius: 14px 0 0 14px;"><i class="fa-solid fa-child-reaching"></i> تطوع</a>
                    <a href="tel:١٩٤٥٠" style="padding: 0;background: 0;color: #353535;font-size: 30px;box-shadow:  none !important;transform: none !important;margin-right: 10px;"><i class="fa-solid fa-phone" style="font-size: 30px;color: #ffffff;background-color: #353535;padding: 10px 12px;margin-right: 5px;border-radius: 10px;"></i> ١٩٤٥٠</a>
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
                <a href="{{ route('all.events') }}" class="@yield('events_active')">
                    <li>الفعاليات</li>
                </a>
                <a href="{{ route('activities.show') }}" class="@yield('destinations_active')">
                    <li>الانشطة</li>
                </a>
                <a href="{{ route('branches.show') }}" class="@yield('branches_active')">
                    <li>الفروع</li>
                </a>
                <a href="{{ route('site.blood_donations') }}" class="@yield('blood_donations')">
                    <li>التبرع بالدم</li>
                </a>
                <a href="{{ route('resala.challange_day') }}" class="@yield('challange_day_active')">
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
                        <a href="{{ route('all.events') }}" class="@yield('events_active')">
                            <li>الفعاليات</li>
                        </a>
                        <a href="{{ route('activities.show') }}"  class="@yield('destinations_active')">
                            <li>الانشطة</li>
                        </a><a  href="{{ route('branches.show') }}" class="@yield('branches_active')">
                            <li>الفروع</li>
                        </a>
                        <a href="{{ route('site.blood_donations') }}" class="@yield('blood_donations')">
                            <li>التبرع بالدم</li>
                        </a>

                        <a  href="{{ route('resala.challange_day') }}" class="@yield('challange_day_active')">
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
                        <li><a href="https://www.facebook.com/Resala.org" target="_blanck"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com/Resalaeg"  target="_blanck"><i class="fa-brands fa-x-twitter"></i></a></li>
                        <li><a href="https://www.instagram.com/resala.charity.organization?utm_source=ig_profile_share&igshid=i663pmdktl4z"  target="_blanck"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com/user/resala" target="_blanck"><i class="fa-brands fa-youtube"></i></a></li>
                        <li><a href="https://www.tiktok.com/@resala_charity" target="_blanck"><i class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </li>
            </ul>
        </nav>

    </div>
</header>
