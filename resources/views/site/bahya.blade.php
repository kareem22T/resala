@extends('site.layouts.site-layout')

@section('title', 'مستشفى بهية')

@section('baheya_active', 'active')

@section('styles')
<style>
    .baheya {
        display: flex;
        justify-content: space-between;
        gap: 2rem;
        margin: 5rem 0 3rem;
    }
    .baheya > * {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: right !important;
    }
    .baheya h1 {
        width: 100%;
        text-align: right;
        font-family: inherit;
        color: #d75e81;
        font-size: clamp(1.375rem, calc(1.2829rem + 0.4211vw), 1.625rem);
        font-weight: 700;
        margin-bottom: 2rem;
    }
    .baheya p {
        font-size: clamp(0.875rem, calc(0.7829rem + 0.4211vw), 1.125rem);
        line-height: clamp(1.625rem, calc(1.4868rem + 0.6316vw), 2rem);
    }
    .baheya img {
        width: 100%;
        max-width: 400px;
    }
    @media (max-width: 767.98px) {
        .baheya {
            flex-direction: column;
            gap: 1rem
        }
        .baheya > * {
            width: 100%;
            text-align: center !important;
        }
        .baheya h1 {
            text-align: center;
        }
    }
    @media (max-width: 767.98px) {
        .baheya {
            margin: 3rem 0 2rem;
        }
    }

</style>    
@endsection

@section('content')
    <section class="baheya">
        <div class="text">
            <h1>مستشفى بهية</h1>
            <p>
                بدأت قصة بهية عندما أصيبت السيدة بهية وهبي حرم المهندس/ حسين أحمد عثمان بالسرطان، وهي سيدة مصرية من عائلة عريقة. و في أثناء تلقيها العلاج لاحظت اسرتها مدى معاناة السيدات من الأسر الفقيرة فى تحمل نفقات العلاج الباهظة. فقاموا بتحويل منزلها إلى مركز متخصص فى علاج سرطان الثدي دون مقابل أو تفرقة. مبنى مركز بهية مكون من 6 أدوار باجمالي مساحة 10,000 متر مربع مزودة بأحدث الأجهزة التي تبلغ قيمتها 150 مليون جنيهًاً
                <br>
                لزيارة الموقع الرسمي لمستشفى بهية : <a href="http://www.baheya.org/">http://www.baheya.org/</a>
            </p>
        </div>
        <div class="img">
            <img src="{{ asset('/assets/img/bahyia.jpg') }}" alt="bayia logo">
        </div>
    </section>
@endsection