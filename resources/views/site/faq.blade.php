
@extends('site.layouts.site-layout')

@section('title', 'اسئلة متكررة')

@section('styles')
    <style>
        main {
            display: flex;
            gap: 2rem;
            margin-top: 1rem
        }
        strong {
            font-weight: 600
        }
        main section {
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
            width: 100%
        }
        iframe {
            width: 100% !important
        }
        main .head h2{
            font-size: 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            margin: 2rem 1rem;
        }
        main .head i {
            font-size: 28px;
            color: #ffffff;
            background-color: #27318b;
            padding: 10px;
            margin-right: 0px;
            margin-left: 12px;
            border-radius: 10px;
            width: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .question_wrapper {
            margin: 10px 0;
            cursor: pointer;
        }
        .question {
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            align-items: center;
            border: 1px solid rgba(167, 167, 167, .2);
            font-weight: 700;
            transition: all .2s ease-in
        }
        .question.active {
            font-size: 22px;
            color: #ffffff;
            background-color: #27318b;
        }
        .answer {
            border: 1px solid rgba(167, 167, 167, .2);
            font-size: 20px;
            color: #ffffff;
            background-color: #27318b;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            align-items: center;
            font-weight: 600;
            display: none;
            line-height: 27px
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

@section('content')
<main>
    <section>
        <div class="head">
            <h2><i class="fa-regular fa-square-check"></i> معلومات عن المؤسسة</h2>
        </div>
        <div class="question_wrapper">
            <div class="question">
                ما شروط قبول دور المسنين لديكم ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                شروط قبول المسنين فى رساله ان تكون  غير قادرة صحيا وماديا ان تكون ليس للحالة ابناء واذا كان لها ابناء يشترط اهمالهم لها و وجود مشكلة حقيقية ألا تكون الحالة مريضة باى مرض نفسى(مع العلم ان الأقامة فى دار المسنين مجانية تماماً)
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                هل يمكنى انشاء فرع باسم جمعية رسالة خارج القاهرة ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يمكنكم معرفة كافة الإجراءات والتفاصيل المرجوة عبر الإتصال بـ 19450  أو التواصل عبرالايميل  : mohfzat@resala.org
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                كيف يمكن التطوع معاكم ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يسعدنا إنضمامكم إلينا يمكنك التطوع الانعن طريق التوجه لأقرب فرع لكم وملأ إستمارة التطوع بالمقر او الموقعالتى من خلالها تختار النشاط المناسب لكم فى المواعيد التى تناسبكم ولمعرفة أقرب فرع او ارقام الفروع 
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                الرد على الاشاعات <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                <strong>لمتابعة الاشاعات الصادرة بحق جمعية رسالة والاجابات عليها. الرجاء<a href="https://resala.org/ar/branches">&nbsp;</a><span style="color: #ffff00;"><a style="color: #ffff00;" href="{{ route('resala.reply_to_rumors') }}">الضغط هنا</a></span></strong>
            </div>
        </div>

        <div class="head">
            <h2><i class="fa-solid fa-dollar-sign"></i> قطاع الاستثمار</h2>
        </div>
        <div class="question_wrapper">
            <div class="question">
                هل تقومة بتوفير دورات تدربية ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يمكنك التوجه الى اقرب فرع من فروع رساله والاستفسار في مركز رساله التدريبي  وانوار رسالة عن الدورات المتاحه للحجز جميع الكورسات مجانا
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                كيف يمكنى تقديم طلب وظيفة لديكم ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يمكنكم ارسال السيرة الذاتيه الخاصه بك : career@resala.org
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                ما هى طرق التبرع لديكم ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                <p dir="RTL"><strong>يمكنك التبرع ( المالى ، العينى ) من داخل مصر من خلال :</strong></p>
                <p dir="rtl"><strong>– الاتصال على رقم 19450 &nbsp;وسيصلك مندوبنا ومعه ايصال رسمي معتمد لاستلام التبرع<br>
                – يمكنك التبرع معنا عن طريق رقم حسابنا الموحد في جميع البنوك المصرية على 19450<br>
                – يمكنك التبرع عن طريق اقرب منفذ فوري ليك<br>
                – يمكنك التبرع لمستشفى بهيه عن طريق ارسال رسالة فاضيه على الرقم 9598 التبرعات لصالح مستشفى بهيه لعلاج اورام السيدات بالمجان</strong></p>
            </div>
        </div>
        
        <div class="head">
            <h2><i class="fa-solid fa-heart-pulse"></i> قطاع الصحة</h2>
        </div>
        <div class="question_wrapper">
            <div class="question">
                كيف يمكنكم مساعدتى ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يسعدنا مساعدتكم يرجي التوجه لأقرب فرع من فروع جمعية رسالة للأعمال الخيرية او الاتصال  بــ 19450 والتوجه لقسم المساعدات وعرض تفاصيل الحالة حتي يتمكن فريق البحث من إستكشاف حالتكم وتقديم المساعدة علي أفضل وجه ممكن.
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                هل يمكنكم توفير اكياس دم لحاله طارئة لدى ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يمكنك الاتصال على الرقم 01110019450 رقم طوارئ الدم التابع لرسالة وباذن الله يوفروا الكمية المطلوبة وشفاه الله وعافاه.
            </div>
        </div>

        <div class="head">
            <h2><i class="fa-solid fa-earth-africa"></i> خارج مصر</h2>
        </div>
        <div class="question_wrapper">
            <div class="question">
                هل يمكنكم مساعدتى خارج مصر ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                نعتذر منكم علي أنه ليس بمقدورنا تقديم المساعدة لكم حيث أنه ليس من أنشطتنا تقديم المساعدة خارج مصرونتمني من الله عزوجل التوفيق والسداد كي نستطيع الإنتشار والتوسع عبر العالم أجمع لخدمة ومساعدة كل من يحتاج لذلك .
            </div>
        </div>

        <div class="head">
            <h2><i class="fa-regular fa-comments"></i> ابن السبيل والمساعدات الانسانية</h2>
        </div>
        <div class="question_wrapper">
            <div class="question">
                هل يمكنكم مساعدتى فى سداد القروض والديون ؟ <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                يرجى منكم التوجه لاقرب فرع رسالة ليك والتواصل مع مسئول نشاط بنك الفقراء
            </div>
        </div>
    </section>
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

@section('scripts')
    <script>
        $(function() {
            $('.question').on('click', function () {
                $(this).next('.answer').slideToggle('fast')
                $(this).toggleClass('active')
                $(this).find('i').toggleClass('fa-bars fa-angles-down')
            }) 
        })
  </script>
@endsection