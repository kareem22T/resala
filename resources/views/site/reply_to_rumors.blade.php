
@extends('site.layouts.site-layout')

@section('title', 'الرد علي الشائعات')

@section('styles')
    <style>
        main {
            display: flex;
            gap: 2rem;
            margin-top: 1rem
        }
        .question >*, .answer >* {
            max-width: 100%;
        }
        p {
            white-space: normal !important;
            max-width: 90% !important;
        }
        main section {
            width: 100%
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
            transition: all .2s ease-in;
            gap: 1rem
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
            display: none
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
            <h2><i class="fa-regular fa-comments"></i> الرد على الشائعات</h2>
        </div>
        <div class="question_wrapper">
            <div class="question">
                الإشاعة : جمعية رسالة تقوم بإلقاء صور بطاقات المحتاجين في القمامة بعد جمعها عن طريق الفروع في مبادرة تحدي الخير <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                <p><b>&nbsp;الحقيقة :&nbsp; أكد الدكتور شريف عبد العظيم رئيس مجلس إدارة جمعية رسالة أن الجمعية منذ مشائخها لن تتلقي اي طلبات من أي شخص محتاج من خلال فروع أي فرع من فروع الجمعية. وقال عبد العظيم خلال مداخلة هاتفية مع الاعلامي عمرو أديب أن منذ بداية بدء تحدي الخير والجمعية أعلنت علي جميع حساباتها الرسمية وموقعها الرسمي أن التقديم يكون من خلال تلك المنصات أو من خلال رقمها الساخن مع تخصيص رقم واتس اب لتلقي استقبال طلبات الراغبين علي دعم تحدي الخير وأن التجمهر علي احدي الفروع مكيدة مدبرة للتصوير فقط.&nbsp;</b></p>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/bFWfyVrb_B8?si=HwOr-TM3Z8UPuQI9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                الإشاعة: جمعية رسالة لن تقوم بالرد علي إستقبال الحالات التي تتواصل معاها عبر أرقامها <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                <p><b>الحقيقة : جمعية رسالة تلقت آلاف الطلبات الخاصة بالمستحقات عبر أرقامها الرسمية ولا ليس لها علاقة بأرقام كاذبة حاولت تضليل المحتاجين والصيد في الماء العكر واستغلال تريند تحدي الخير . كما أكدت وزيرة التضامن الإجتماعي أن جمعية رسالة غطت آلاف الحالات المستحقة والأكثر تضررا من فيروس كورونا وجميع تبرعات تحدي الخير تم صرفها في محلها.&nbsp;</b></p>
                <p><b>المزيد في السياق التالي:- <span style="color: #ffff00;"><a style="color: #ffff00;" href="https://www.youm7.com/story/2020/4/1/%D8%A7%D9%84%D8%AA%D8%B6%D8%A7%D9%85%D9%86-%D8%AC%D9%85%D8%B9%D9%8A%D8%A9-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D9%8A%D8%B3%D8%AA%D9%81%D9%8A%D8%AF-%D9%85%D9%86%D9%87%D8%A7-%D8%A2%D9%84%D8%A7%D9%81-%D8%A7%D9%84%D8%A3%D8%B3%D8%B1-%D9%88%D9%88%D8%B2%D8%B9%D8%AA-%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A7%D8%AA-%D8%A8%D9%80/4700991" target="_blank" rel="noopener noreferrer">اليوم السابع</a> , <a style="color: #ffff00;" href="https://www.dostor.org/3048410" target="_blank" rel="noopener noreferrer">الدستور</a> , <a style="color: #ffff00;" href="https://m.facebook.com/story.php?story_fbid=3224877767595040&amp;id=128198120596369" target="_blank" rel="noopener noreferrer">شبكة تليفزيون النهار</a></span></b></p>
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                الإشاعة : إنتماء فتاة إخوانية تدعي آية كمال الي جمعية رسالة <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                <div class="wpb_wrapper">
                <p><b>الحقيقة : أن جمعية رسالة ليست تلك الفتاة المدعوة علي قوتها ولا عملت بها يوم من الأيام ولكنها لفترة قصيرة كانت من ضمن آلاف المتطوعين فقط لاغير. وهذا ما أكدته ريهام محيسن المتحدث الرسمي باسم جمعية رسالة موضحةً أن الجمعية غير مسؤلة علي إنتماء متطوعيها، وأن دور المتطوعين فقط هو المساعدة في توزيع المساعدات ولا لهم شأن في التدخل بجميع الأمور المتعلقة بالجمعية.&nbsp;</b></p>
                <p><b>المزيد في سياق الفيديو التالي</b></p>
                <p><iframe src="https://www.youtube.com/embed/j05o-6CvQuk" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="560" height="315" frameborder="0"></iframe></p>
                </div>
            </div>
        </div>
        <div class="question_wrapper">
            <div class="question">
                الإشاعة : هجوم بعض اللجان الإلكترونية علي جمعية رسالة وإدعائهم كذب الجمعية بتوصيل التبرعات <i class="fa-solid fa-bars"></i>
            </div>
            <div class="answer">
                <div class="wpb_wrapper">
                    <p><b>الحقيقة : قال الإعلامي محمد الدسوقي رشدي أن جمعية رسالة تتعرض لحملات مناهضة لها علي مواقع التواصل الإجتماعي السبب فيها هم جماعة الإخوان الإرهابية التي لا تريد وقوف مؤسسات المجتمع المدني بجانب الدولة في ظل الأزمات المستجدة كأزمة فيروس كورونا لمشاهدة فيديو محمد الدسوقي رشدي عن جمعية رسالة&nbsp;</b></p>
                    <p><iframe src="https://www.youtube.com/embed/4mGhR0M6Oh4" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" width="560" height="315" frameborder="0"></iframe></p>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الإشاعة : جمعية رسالة أعطت تبرعات تحدي الخير الي جماعة الإخوان</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <p><b>الحقيقة :&nbsp; جمعية رسالة تحظي علي هجوم واضح وملحوظ من جماعة الإخوان الإرهابية وهذا أكبر
                                دليل علي عدم انتمائها لهم بأي صلة كما أن الجماعة الإرهابية تشن هجوم علي جمعية رسالة عبر
                                قنواتها كما حدث منذ عدة أيام علي قناة الشرق الإخوانية بمهاجمة الجمعية ومهاجمة مبادرة تحدي
                                الخير . لمشاهدة مهاجمة قناة الشرق جمعية رسالة <span style="background-color: #ffff00;"><a
                                        style="background-color: #ffff00;"
                                        href="https://www.youm7.com/story/2020/3/31/%D9%82%D9%86%D8%A7%D8%A9-%D8%A7%D9%84%D8%B4%D8%B1%D9%82-%D8%A7%D9%84%D8%A5%D8%AE%D9%88%D8%A7%D9%86%D9%8A%D8%A9-%D8%AA%D9%87%D8%A7%D8%AC%D9%85-%D8%AC%D9%85%D8%B9%D9%8A%D8%A9-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D9%81%D9%8A%D8%AF%D9%8A%D9%88/4697909">اضغط
                                        هنا</a></span></b></p>
                        <p>&nbsp;<br>
                            <iframe src="https://www.youtube.com/embed/QT8W4kqbvwY"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" width="560" height="315" frameborder="0"></iframe>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الإشاعة : جمعية رسالة بها قيادات إخوانية ومبادرة تحدي الخير مجرد شو إعلامي</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <p><b>الحقيقة : جمعية رسالة جمعية مسجلة بوزارة التضامن الإجتماعي تخضع لكافة الشروط واللوائح المقدمة
                                لها من قبل الوزارة..والجمعية لا تنتمي لأي فصيل سياسي أو ديني ولا بها أي شخص يتبع جماعة
                                الإخوان الإرهابية بل بالعكس الجمعية تتعرض لحملات ممنهجة من جماعة الإخوان وقنواتها،كما أن
                                الجمعية تقف مع الدولة في جميع قراراتها وأزمتها كما قالت وزيرة التضامن الإجتماعي أن رسالة
                                جمعية نشطة منذ سنوات عديدة لها دور هادف وفعال في خدمة المجتمع ومساعدة المحتاجين وأنها تخضع
                                للمراقبة الدولة المصرية ولا يوجد بها أي شبهات ولا إنتماء. وأكدت وزيرة التضامن الإجتماعي نڤين
                                القباچ خلال مداخلة هاتفية مع الإعلامي وائل الإبراشي علي التلفزيون المصري أن جمعية رسالة صرفت
                                جميع تبرعات تحدي الخير على الحالات المستحقة والأكثر احتياجًا كمان أنها صرفت ما يقارب ال
                                ٥ملايين جنيه في حين أن تبرعات تحدي الخير بلغت مليون جنية فقط والجمعية صرفت باقي المبلغ من
                                حساباتها الخاصة.&nbsp; وقالت القباچ علي المواطنين تحري الحقائق قبل الهجوم على أي مؤسسة لها
                                دور فعال وهادف ولا يجب أن ننساق وراء شائعات مغرضة هدفها عرقلة الدولة ومؤسساتها من المجتمع
                                المدني التي تساهم بجزء كبير مع تنمية الدولة مساعدة ملايين الأسر الفقيرة. لمشاهدة مداخلة
                                وزيرة التضامن الإجتماعي </b><b><br>
                            </b><b>من هنا :-<br>
                            </b><br>
                            <iframe src="https://www.youtube.com/embed/Yw_G1Kka56Y" allowfullscreen="allowfullscreen"
                                width="560" height="315" frameborder="0"></iframe>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الإشاعة : جمعية رسالة تخترع مبادرة تحدي الخير ولا تساعد أحد</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <p><b>الحقيقة :&nbsp; جمعية رسالة تساعد ملايين المحتاجين سنوياً تحت إشراف وزارة الإجتماعي وتصل إلى
                                قرى تحت خط الفقر لا يوجد بها خدمات صحية ولا وسائل آدمية للمعيشة، مبادرة تحدي الخير هدفها
                                مساعدة الأكثر احتجاجيًا تضررا من فيروس كورونا وهذا ما أكدة الدكتور محمد العقبي المستشار
                                الإعلامي لوزيرة التضامن الإجتماعي أن الوزارة تراقب جميع تبرعات جمعية رسالة من قبل تحدي وجميع
                                التبرعات يتم صرفها بعلم وإشراف وزارة التضامن . وأكد العقبي خلال مداخلة هاتفية ببرنامج الحياة
                                اليوم المذاع على فضائية الحياة أن جمعية رسالة صرفت تبرعات تحدي الخير في أماكنها الصحيحة وعلى
                                الأكثر تضررًا احتياجا. لمشاهدة حديث مستشار وزيرة التضامن الإجتماعي</b></p>
                        <p><b>&nbsp;من هنا:&nbsp;</b></p>
                        <p><iframe src="https://www.youtube.com/embed/-CAk1ziEbmg"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="" width="560" height="315" frameborder="0"></iframe></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الإشاعة: جمعية رسالة لن تنفق تبرعات تحدي الخير الخاصة بـ الفنانين ولاعبي كرة القدم علي مستحقيها</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <p><b>الحقيقة: جمعية رسالة أرسلت مساعدات إلى القرى الفقيرة والأكثر احتجاجيًا والأكثر تضررا من فيروس
                                كورونا بقيمة&nbsp; ٥ملاببن جنية متمثلة في كراتين غذائية وإعانات نقدية في حين أن قيمة تبرعات
                                تحدي الخير مليون جنيه فقط لا غير مما يدل على أن الجمعية تحملت وساهمت ب ٤ملايين جنية تمت
                                نفقاتها ضمن مبادرة تحدي الخير . كما أكد الدكتور محمد العقبي المستشار الإعلامي لوزيرة التضامن
                                الإجتماعي أن جمعية رسالة تخضع لمراقبة من وزارة التضامن فيما يخص التبرعات وأن الوزارة شكلت
                                لجنة محاسبة خاصة قامت بفحص موقف جميع تبرعات تحدي الخير وتم تأكيد أن جمعية رسالة أنفقت ٥
                                ملايين جنية من حساباتها الخاصة علاوة على مليون جنية خاص بتبرعات الفنانين ولاعبي كورة القدم.
                                وقال العقبي في مداخلة خاصة ببرنامج من مصر المذاع على فضائية Cbc إن جمعية رسالة من أهم وأقدم
                                الجمعيات النشطة التي لها دور فعال منذ ٢٠عام في العمل الخيري وإعالة عدد كبير من الأسر
                                المحتاجة والأكثر فقرًا&nbsp; للإستماع ومشاهدة مداخلة المستشار الإعلامي لوزيرة التضامن
                                الإجتماعي </b><b><br>
                            </b><b>من هنا :-&nbsp; https://youtu.be/-yXH_g2MVNc&nbsp;</b></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>ما الإجراءات التى إتخذتها جمعية رسالة تجاه الإشاعات المترددة حول الجمعية ؟</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-1 views-row-odd views-row-first">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-2"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-1" aria-hidden="false">
                                    <p dir="rtl"><strong><span dir="rtl" lang="ar">قدمت الجمعية بلاغات بمكتب النائب العام و
                                                مكتب السيد اللواء مدير مباحث مكافحه جرائم الحاسبات وشبكه المعلومات ضد عدد من
                                                الصفحات التي يديرها مجموعة من الأشخاص المجهولين والتي قامت في الفترة الاخيرة
                                                بعمل حملة لتشوية صورة الجمعية و بث اكاذيب من شانها الحاق الضرر البالغ
                                                بملايين المستفيدين من خدمات الجمعية</span></strong></p>
                                    <p dir="rtl"><strong><span dir="rtl" lang="ar">و تؤكد جمعية رسالة انه لا علاقة لها مطلقا
                                                بالاخوان و لا اي تنظيم ارهابي او سياسي او ديني من اي نوع</span></strong></p>
                                    <p dir="rtl"><strong><span dir="rtl" lang="ar">الجمعية تخدم اكثر من 4 مليون مصري محتاج
                                                سنويا في جميع محافظات مصر و لها فروع في 60 مدينة مصرية و يتطوع بها مئات
                                                الالوف من محبي الخير في مصر منذ 18 عاما<br>
                                                و تعمل الجمعية تحت اشراف كامل من الدولة و من خلال تنسيق و تعاون مع جميع
                                                اجهزة الدولة<br>
                                                و لا صحة مطلقا لما تروجه هذه الصفحات الساقطة اخلاقيا من اكاذيب و
                                                افتراءات</span></strong></p>
                                    <p dir="rtl"><strong><span dir="rtl" lang="ar">وقد قامت عدد من الصفحات بموقع التواصل
                                                الاجتماعى “فيس بوك”، اعتذارا لجمعية رسالة للأعمال الخيرية، بعد أن نقلت عن
                                                مصادر مجهولة انتماء الجمعية للجماعات الإرهابية</span></strong></p>
                                    <p><span dir="rtl" lang="ar">وقد نشرة بوابة اليوم السابع –&nbsp;3يونيو 2018</span></p>
                                    <p dir="rtl"><strong>صفحات فيس بوك المهاجمة لـ”رسالة” تتراجع وتعتذر عن اتهامها بالانتماء
                                            للإخوان : شاهد<span style="color: #ffff99;">&nbsp;<a style="color: #ffff99;"
                                                    href="https://www.youm7.com/story/2018/6/3/%D8%B5%D9%81%D8%AD%D8%A7%D8%AA-%D9%81%D9%8A%D8%B3-%D8%A8%D9%88%D9%83-%D8%A7%D9%84%D9%85%D9%87%D8%A7%D8%AC%D9%85%D8%A9-%D9%84%D9%80-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D8%AA%D8%AA%D8%B1%D8%A7%D8%AC%D8%B9-%D9%88%D8%AA%D8%B9%D8%AA%D8%B0%D8%B1-%D8%B9%D9%86-%D8%A7%D8%AA%D9%87%D8%A7%D9%85%D9%87%D8%A7/3819557">من
                                                    هنا</a>&nbsp;</span></strong></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : جمعية رسالة تنتمي لجماعة الإخوان المسلمين</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <p dir="rtl"><strong>الحقيقة:</strong></p>
                        <p dir="rtl">أولاً:جمعية رسالة مشهره من وزارة التضامن الاجتماعي برقم 444 لسنه 2000.</p>
                        <p dir="rtl">ثانياً: أكد الدكتور أحمد البرعي، وزير التضامن الاجتماعي الأسبق، أن الوزارة أرسلت لجنة
                            تفتيش علي جمعية رسالة للأعمال الخيرية، بناء علي طلب منها وكانت نتيجة هذه الجمعية سليمة ولم يكن
                            لديها مخالفات أو علاقة بجماعة الإخوان المسلمين. ( منشور فى الموقع الرسمي لبوابة الأهرام بتاريخ 3
                            سبتمبر 2013 ).</p>
                        <p dir="rtl">
                        </p>
                        <p dir="RTL"><strong>بوابة الأهرام (3-9-2013) :</strong><strong>&nbsp;<a
                                    href="http://gate.ahram.org.eg/News/391089.aspx">شاهد من هنا</a>&nbsp;</strong></p>
                        <p dir="RTL"><strong>الأهرام (23 يوليو 2013) :&nbsp;<a
                                    href="http://gate.ahram.org.eg/News/391089.aspx">شاهد من هنا</a>&nbsp;&nbsp;</strong>
                        </p>
                        <p dir="RTL"><strong>جريد أخبار اليوم (الثلاثاء 23 يوليو 2013):&nbsp;<a
                                    href="https://akhbarelyom.com/news/newdetails/247251/1/%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D8%AA%D8%B7%D9%84%D8%A8-%D8%A7%D9%84%D8%AA%D9%81%D8%AA%D9%8A%D8%B4-%D8%B9%D9%84%D9%8A-%D8%A3%D9%86%D8%B4%D8%B7%D8%AA%D9%87%D8%A7-%D9%88%D9%85%D9%8A%D8%B2%D8%A7%D9%86%D9%8A%D8%AA%D9%87%D8%A7-%D8%A8%D8%B9%D8%AF-%D8%AA%D8%B6%D8%B1%D8%B1%D9%87%D8%A7-%D9%85%D9%86-%D8%A7%D9%84%D8%B4%D8%A7">شاهد
                                    من هنا</a>&nbsp;&nbsp;</strong></p>
                        <p dir="RTL"><strong>جريدة الشروق ( 23 يوليو 2013):&nbsp;<a
                                    href="https://www3.shorouknews.com/news/view.aspx?cdate=23072013&amp;id=f6f732c1-b199-456c-9049-9084663ee416">شاهد
                                    من هنا</a>&nbsp;&nbsp;</strong></p>
                        <p dir="RTL">
                        </p>
                        <p dir="rtl">ثالثًا: دعي المستشار “عزت خميس” رئيس لجنة حصر اموال الاخوان جميع المصريين بالتبرع
                            لجميعة رسالة، مؤكداً إنها ليس لها اى صلة أو علاقة من قريب أو بعيد بالاخوان. ( منشور فى بوابة
                            الشروق بتاريخ 26 فبراير 2016 ).</p>
                        <p><strong>صدي البلد (الثلاثاء 23 يونيو 2015) :&nbsp;<a href="https://www.elbalad.news/1592189">شاهد
                                    من هنا</a>&nbsp;&nbsp;</strong></p>
                        <p dir="rtl"><strong>جريدة اليوم السابع (25 فبراير 2016) :&nbsp;<a
                                    href="https://www.youm7.com/story/2016/2/25/%D8%AC%D9%85%D8%B9%D9%8A%D8%A9-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D9%84%D9%8A%D8%B3-%D9%84%D9%86%D8%A7-%D8%B9%D9%84%D8%A7%D9%82%D8%A9-%D8%A8%D8%AC%D9%85%D8%B9%D9%8A%D8%A9-%D8%AF%D9%85%D9%8A%D8%A7%D8%B7-%D8%A7%D9%84%D9%85%D8%AA%D8%AD%D9%81%D8%B8-%D8%B9%D9%84%D9%8A%D9%87%D8%A7/2601877">شاهد
                                    من هنا</a>&nbsp;</strong><strong>&nbsp;</strong></p>
                        <p dir="RTL"><strong>جريدة الشروق (الجمعة 26 فبراير 2016) :<a
                                    href="https://www3.shorouknews.com/news/view.aspx?cdate=26022016&amp;id=b6120ce2-de4c-4775-8491-981b13632b9c">&nbsp;شاهد
                                    من هنا</a>&nbsp;&nbsp;</strong></p>
                        <p dir="RTL"><strong>جريدة الدستور (14 يوليو 2016) :&nbsp;<a
                                    href="https://www.dostor.org/1118703">شاهد من هنا</a>&nbsp;&nbsp;</strong></p>
                        <p dir="RTL"><strong>جريدة الوفد (13 يوليو 2015) :&nbsp;<a
                                    href="https://alwafd.news/%D8%A3%D8%AE%D8%A8%D8%A7%D8%B1-%D9%88%D8%AA%D9%82%D8%A7%D8%B1%D9%8A%D8%B1/878786-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D8%AA%D9%83%D8%B4%D9%81-%D8%AD%D9%82%D9%8A%D9%82%D8%A9-%D8%B9%D9%84%D8%A7%D9%82%D8%AA%D9%87%D8%A7-%D8%A8%D8%AC%D9%85%D8%A7%D8%B9%D8%A9-%D8%A7%D9%84%D8%A5%D8%AE%D9%88%D8%A7%D9%86">شاهد
                                    من هنا</a>&nbsp;&nbsp;</strong></p>
                        <p dir="RTL">
                        </p>
                        <p dir="rtl">رابعاً: تقوم جهات مختلفة من الدولة (الجهاز المركزي للمحاسبات ووزارة التضامن ووزارة
                            المالية والرقابة الادارية) بالرقابة والمتابعة الصارمة لكافة الأعمال المالية بالجمعية بصورة
                            مستمرة ودورية.</p>
                        <p dir="rtl">خامسآ :&nbsp;أن جمعية رسالة جمعية مشهرة من وزارة التضامن الاجتماعي برقم 444 لسنة
                            2000<br>
                            ولا ولن تنتمي لأي تيار ديني أو سياسي<br>
                            و قد نشرت ذلك بوابة اليوم السابع “موسم الهجوم علي رسالة .. فتش عن المستفيد” يوم 29 أبريل 2019
                            ..&nbsp;<a
                                href="https://www.youm7.com/story/2019/4/29/%D9%85%D9%88%D8%B3%D9%85-%D8%A7%D9%84%D9%87%D8%AC%D9%88%D9%85-%D8%B9%D9%84%D9%89-%D8%AC%D9%85%D8%B9%D9%8A%D8%A9-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D9%81%D8%AA%D8%B4-%D8%B9%D9%86-%D8%A7%D9%84%D9%85%D8%B3%D8%AA%D9%81%D9%8A%D8%AF/4224974">شاهد
                                من هنا</a></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : صور للأستاذ رئيس مجلس إدارة جعية رسالة مع ``البلتاجي، وايضا صورة له مع ضابط سوري</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <p><strong>الحقيقة:</strong></p>
                                    <p>الصورة المتداولة لشخص مع البلتاجي علي إنه رئيس&nbsp;مجلس إدارة رسالة،ليست لرئيس مجلس
                                        إدارة الجمعية، فرئيس رسالة هو دكتور شريف عبد العظيم ، ، دكتور بكلية الهندسة بالجامعة
                                        الأمريكية</p>
                                    <p>والصورة أدناه له “دكتور/ شريف عبد العظيم” مؤسس الجمعية ورئيسها</p>
                                    <p><img class="alignnone size-medium wp-image-913 lazyDone"
                                            src="http://resala.org/wp-content/uploads/2019/12/رئيس-مجلس-ادارة-جمعية-رسالة-300x244.jpg"
                                            data-src="" alt="شريف عبد العظيم"
                                            srcset="https://resala.org/wp-content/uploads/2019/12/رئيس-مجلس-ادارة-جمعية-رسالة-300x244.jpg 300w, https://resala.org/wp-content/uploads/2019/12/رئيس-مجلس-ادارة-جمعية-رسالة.jpg 443w"
                                            sizes="(max-width: 300px) 100vw, 300px" width="300" height="244"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : فيديو قديم للدكتور ``شريف عبد العظيم`` رئيس مجلس إدارة جمعية رسالة يتحدث فيه عن تأييده الشخصي
                    لأبوالفتوح خلال فترة مضت</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p><strong>الحقيقة:</strong></p>
                                                    <p>د.”شريف عبدالعظيم” أستاذ دكتور بكلية الهندسة
                                                        بالجامعة&nbsp;الامريكية&nbsp;، له ارائه وأفكاره الخاصة كشخصية عامة
                                                        لها خصوصيتها فى التعبير عن رأيها الشخصي، فهو هنا لا يتحدث باسم
                                                        الجمعية بل يعبر عن رأيه الشخصي فقط.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : جمعية رسالة تقوم بتوزيع وجبات غذائية في رابعة</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p><strong>الحقيقة:</strong></p>
                                                    <p>كل ما قيل مجرد أكاذيب وافتراءات لا تمت للواقع بصلة، و الا لو كان هناك
                                                        دليل واحد لظهر ونشر على العلن، فكل ما يقال مجرد ادعاءات مشبوهة لا
                                                        يوجد بها أى دليل أو برهان، ولها غرضها التشويهي ليس أكثر، ونتحدي من
                                                        يدعي انه يمتلك أى دليل على ذلك ان يقوم باظهاره أمام الجميع.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : جمعية رسالة لا تخضع للرقابة</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p><strong>الحقيقة:</strong></p>
                                                    <p>كافة أجهزة الدولة المعنية والمختصة تقوم بمتابعة الجمعية والرقابة
                                                        الصارمة على الأمور المالية بها بصورة مستمرة، وجميع مصاريف “رسالة”
                                                        مكشوفة بصورة شفافة أمام جميع أجهزة الدولة منذ بداية نشاط الجمعية حتي
                                                        الآن، فالقانون المختص يلزمنا بالكشف عن ميزانيتنا ونشرها على الملأ في
                                                        مقراتنا قبل الجمعية العمومية كل عام.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" ><span class="question">
                <div>جمعية رسالة تدعم صندوق تحيا مصر</div>
                <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p><strong>الحقيقة:</strong></p>
                                                    <p>قامت الجمعية بالتبرع بالفعل بمبلغ 5 مليون جنيه لعلاج فيروس سي ضمن
                                                        حملة الصندوق الخاصة فى ذلك الإطار، وتم ذلك من خلال المتبرعين
                                                        الراغبين فى التبرع للصندوق فقط، وليس من أموال التبرعات العامة التي
                                                        تصل رسالة، فتلك الأموال جاءت خصيصا من المتبرعين لذلك الغرض الموجهة
                                                        إليه، أى ان المتبرعين قد تبرعوا وهو يعلمون ان تلك التبرعات موجهة
                                                        لعلاج فيروس سي ضمن حملة صندوق تحيا مصر.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" ><span class="question">
                <div>رغم الأكاذيب والإشاعات هناك العديد من الصفحات والمبادرات الكبيرة تدعم جمعية رسالة</div>
                <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p dir="RTL"><strong>&nbsp;صفحة عمار يا مصر :<a
                                                                href="https://www.facebook.com/3mar.ymasr/posts/2035256333154293">&nbsp;<span
                                                                    style="color: #ffffff;">شاهد من هنا</span></a><span
                                                                style="color: #ffffff;">&nbsp;</span></strong></p>
                                                    <p dir="RTL"><strong>صفحة تعيشي يا مصر : شاهد<span
                                                                style="color: #ffffff;">&nbsp;<a style="color: #ffffff;"
                                                                    href="https://www.facebook.com/livemisr1/posts/1868254073211027">من
                                                                    هنا</a>&nbsp;</span></strong><span
                                                            style="color: #ffffff;">&nbsp;</span></p>
                                                    <p dir="RTL"><strong>صفحة مصر 30 يونيو : شاهد&nbsp;<span
                                                                style="color: #ffffff;"><a style="color: #ffffff;"
                                                                    href="https://www.facebook.com/egypt30.20/posts/2141217822572186">من
                                                                    هنا</a>&nbsp;</span></strong></p>
                                                    <p dir="RTL"><strong>صفحة هنبني بلدنا :</strong>&nbsp;شاهد&nbsp;<span
                                                            style="color: #ffffff;"><a style="color: #ffffff;"
                                                                href="https://www.facebook.com/hnbny.baldna/posts/1743282649112395">من
                                                                هنا</a></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : إحدى المدعين يتهم كذباً وتضليلاً جمعية رسالة بالإنتماء للإخوان علي قناة TEN في برنامج مساء
                    القاهرة</div>
                    <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p dir="rtl"><strong>الحقيقة:</strong></p>
                                                    <p dir="rtl">الحقيقة:إحدى متحدثي بأسم جمعية رسالة ترد علي هجوم إحدى
                                                        المدعين&nbsp;بنفس البرنامج علي قناة TEN في برنامج مساء القاهرة
                                                        بالأدلة :&nbsp;<span style="color: #ffff99;"><a
                                                                style="color: #ffff99;"
                                                                href="https://www.youtube.com/watch?v=KAlDvHy0SL0">الفيديو
                                                                من هنا</a></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>جمعية رسالة تكشف تفاصيل إجمالي التبرعات الواردة للمؤسسة، وتعلن عن تفاصيل الخدمات المقدمة بها، من خلال
                    مؤتمر صحفي.</div>
                <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p><strong>جريدة الأهرام الإقتصادي (11-1-2017) :&nbsp;<span
                                                                style="color: #ffff99;"><a style="color: #ffff99;"
                                                                    href="http://ik.ahram.org.eg/News/22063.aspx">&nbsp;شاهد
                                                                    من هنا</a>&nbsp;</span></strong></p>
                                                    <p><strong>اليوم السابع (10 يناير 2017) :<span
                                                                style="color: #ffff99;">&nbsp;<a style="color: #ffff99;"
                                                                    href="https://www.youm7.com/story/2017/1/10/%D8%A8%D8%A7%D9%84%D8%B5%D9%88%D8%B1-%D8%B1%D8%B3%D8%A7%D9%84%D8%A9-%D9%86%D8%AA%D9%84%D9%82%D9%89-%D8%AA%D8%A8%D8%B1%D8%B9%D8%A7%D8%AA-200-%D9%85%D9%84%D9%8A%D9%88%D9%86-%D8%AC%D9%86%D9%8A%D9%87-%D8%B3%D9%86%D9%88%D9%8A%D8%A7-%D9%84%D9%85%D8%B3%D8%A7%D8%B9%D8%AF%D8%A9-%D8%A7%D9%84%D9%81%D9%82%D8%B1%D8%A7%D8%A1/3048509">شاهد
                                                                    من هنا</a>&nbsp;&nbsp;</span></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="question_wrapper" >
            <span class="question">
                <div>الأشاعة : معتز محمد المتحدث الرسمي لرسالة في صورة له مع البلتاجي.. مما يدل ان جمعية رسالة إخوان</div>
                <i class="fa-solid fa-bars"></i>
            </span>
            <div class="answer clr">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="views-row views-row-3 views-row-odd">
                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                <div id="ui-id-6"
                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                    role="tabpanel" aria-labelledby="ui-id-5" aria-hidden="false">
                                    <div class="container faq-questions">
                                        <div class="views-row views-row-4 views-row-even views-row-last">
                                            <div class="accordion ui-accordion ui-widget ui-helper-reset" role="tablist">
                                                <div id="ui-id-8"
                                                    class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active"
                                                    role="tabpanel" aria-labelledby="ui-id-7" aria-hidden="false">
                                                    <p dir="rtl"><strong>الحقيقة:&nbsp;</strong></p>
                                                    <p dir="rtl"><strong>أولاً: معتز محمد بيشتغل في مجال الإعلام من زمان
                                                            وليه صور مع مشاهير كتير</strong></p>
                                                    <p dir="rtl"><strong>ثانياً: جمعية رسالة فيها متطوعين من كل الإتجاهات
                                                            ورأي أي شخص فيهم لا يمثل رأي الجمعية نفسها&nbsp;</strong></p>
                                                    <p dir="rtl"><strong>ثالثاً : وزير التضامن الإجتماعي بعد التفتيش عليها
                                                            صرح انه لا يوجد بها أي مخالفات</strong></p>
                                                    <p dir="rtl"><strong>وهذا ما ذكرته صفحة
                                                            “</strong><strong>متصدقش</strong><strong>” التي تهتم بتوضيح
                                                            وتصحيح الإشاعات للجمهور : شاهد&nbsp;<span
                                                                style="color: #ffff99;"><a style="color: #ffff99;"
                                                                    href="https://www.facebook.com/matsda2sh/photos/a.187277281895324.1073741829.185343588755360/220312645258454/?type=3&amp;theater&amp;ifg=1">من
                                                                    هنا</a>&nbsp;</span></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</main>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.question').on('click', function () {
                $(this).next('.answer').slideToggle()
                $(this).toggleClass('active')
                $(this).find('i').toggleClass('fa-bars fa-angles-down')
            }) 
        })
  </script>
@endsection