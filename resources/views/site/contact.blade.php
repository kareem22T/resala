@extends('site.layouts.site-layout')

@section('title', 'اتصل بنا')

@section('contact_active', 'active')

@section('styles')
    <style>
        .cards_wrapper {
            display: flex;
            justify-content: space-between;
            margin: 6rem 0 3rem;
        }
        .cards_wrapper > div {
            padding: 3rem 1rem;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 1rem;
            width: 100%;
        }
        .cards_wrapper > div .text {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 22px;
            color: #ffffff;
            font-weight: 700 !important;
        }
        .cards_wrapper > div i {
            font-size: 24px;
            color: #ffffff;
            background-color: #3f51b5;
            margin-right: 20px;
            border-radius: 10px;
            padding: 1rem;
        }
        .cards_wrapper .text span {
            font-size: 15px;
            color: #fff;
            font-weight: 400;
        }
        .more {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .more a {
            text-decoration: none;
            color: #27318b
        }
        @media (max-width: 992.98px) {
            .cards_wrapper {
                flex-direction: column;
            }
        }
        @media (max-width: 767.98px) {
            .cards_wrapper {
                margin: 3rem 0 2rem;
            }
        }
    </style>
@endsection

@section('content')
<section>
    <div class="cards_wrapper">
        <div style="background: #27318b;">
            <i class="fa-regular fa-clock"></i>
            <div class="text">
                ساعات العمل
                <span>طوال الاسبوع  – 10 ص : 8 م</span>
            </div>                        
        </div>
        <div style="background: #3f51b5;">
            <i class="fa-solid fa-location-dot" style="background: #27318b;"></i>
            <div class="text">
                الفرع الرئيسي
                <span>  5 شارع منسى ياسين- فيصل-امام بى تك</span>
            </div>                        
        </div>
        <div style="background: #e53935;">
            <i class="fa-solid fa-phone-flip" style="background: rgba(94,1,1,0.5);"></i>
            <div class="text">
                الخط الساخن
                <span>19450</span>
            </div>                        
        </div>
    </div>
    <div class="more">
        <span>يمكنكم مراسلتنا على: <a href="mailto:contact_us@resala.org">contact_us@resala.org</a></span>
        يسعدنا التواصل معكم ومناقشة مقترحاتكم وآرائكم
    </div>
</section>
@endsection