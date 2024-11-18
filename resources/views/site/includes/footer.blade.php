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
    <div class="copy-right">
        جميع الحقوق محفوظة لجمعية رسالة للاعمال الخيرية
    </div>
</footer>
