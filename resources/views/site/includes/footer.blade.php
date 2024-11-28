<footer dir="rtl">
    <div class="container">
        <div>
            <img src="{{ asset('/assets/img/Resala-logo.png') }}" alt="logo">
            <p>
                نرحب بتواصلكم معنا
                <br>
                تليفون : <b>19450</b>
                <br>
                contact_us@resala.org
            </p>
        </div>

        <div>
            <ul>
                {{-- <a href="">
                    <li>فاعليات رسالة</li>
                </a> --}}
                <a href="{{ route('news.show') }}">
                    <li>أخبار رسالة</li>
                </a>
                <a href="{{ route('site.blood_donations') }}">
                    <li>بنك الدم</li>
                </a>
                <a href="{{ route('resala.privacy_policy') }}">
                    <li>سياسة الخصوصية</li>
                </a>
                <a href="{{ route('resala.faq') }}">
                    <li>الاسئلة المتكررة</li>
                </a>
                <a href="https://resala.org/whs/">
                    <li>انا وابن عمي بنساعد الغريب</li>
                </a>
            </ul>
        </div>
        <div>
            <div class="btns">
                <a href="{{ route('donate.main') }}"><i class="fa-solid fa-sack-dollar"></i> تبرع</a>
                <a href="{{ route('site.volunteering') }}"><i class="fa-solid fa-child-reaching"></i> تطوع</a>
            </div>
        </div>
    </div>
    <ul class="social" style="padding: 0;color: #000;">
        <li class="mobile">
            <ul style="padding: 0;display: flex;justify-content: center;align-items: center;list-style: none;gap: 24px;padding: 24px 0px 6px;">
                <li><a href="https://www.facebook.com/Resala.org" target="_blanck"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="https://twitter.com/Resalaeg" target="_blanck"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/resala.charity.organization?utm_source=ig_profile_share&amp;igshid=i663pmdktl4z" target="_blanck"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="https://www.youtube.com/user/resala" target="_blanck"><i class="fa-brands fa-youtube"></i></a></li>
                <li><a href="https://www.tiktok.com/@resala_charity" target="_blanck"><i class="fa-brands fa-tiktok"></i></a></li>
                <li><a href="https://www.threads.net/@resala.charity.organization" target="_blanck"><i class="fa-brands fa-threads"></i></a></li>
            </ul>
        </li>
    </ul>
    <div class="copy-right">
        جميع الحقوق محفوظة لجمعية رسالة للاعمال الخيرية
    </div>
</footer>
