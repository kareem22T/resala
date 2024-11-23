@extends('site.layouts.site-layout')

@section('title', 'التحويل البنكي')

@section('styles')
<style>
    table {
        width: 100%;
        border: 1px solid rgba(167, 167, 167, .2) !important;
        background: #ffffff87;
        text-align: center;
    }
    td:first-child {
        border-left: 1px solid rgba(167, 167, 167, .2) !important;
    }
    td, th {
        padding: 1rem;
    }
    tr {
         border-bottom: 1px solid rgba(167, 167, 167, .2) !important;
    }
            section .switch {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
        section .switch label {
            padding: 1rem 2rem;
            border-style: solid;
            border-width: 1px;
            border-color: #c6c6c6;
            border-radius: 1rem;
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.25rem 0 .7rem;
            translate: all .3s ease-in-out;
            cursor: pointer;
        }
        input[type="radio"] {
            display: none;
        }
        input[type="radio"]:checked +label {
            background: rgb(44,54,142);
            background: linear-gradient(0deg, rgba(44,54,142,1) 0%, rgba(82,90,162,1) 100%);
            color: #fff;
            border: none
        }
                form .form-group {
            display: flex;
            flex-direction: column;
            gap: .7rem;
            margin-top: 1rem;
            font-weight: 600;
        }
        section form button {
            background: rgb(44,54,142);
            padding: .7rem 2rem;
            border-radius: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1rem 0;
            border: none;
            color: #fff;
            widows: 150px
        }
        input, textarea {
            background: #ffffff8b !important;
            backdrop-filter: blur(10px) !important
        }
        @media (max-width: 575px) {
            section {
                padding: 0 0;
            }
            section .switch label {
                padding: .7rem 1.25rem;
                font-size: 1.1rem;
            }
        }

</style>
@endsection

@section('content')
<section id="banck_transfer">
    <h1>التحويل البنكي</h1>
    <div class="switch">
        <div class="form-group">
            <input type="radio" name="type" id="type_2" class="form-control" value="1" checked v-model="type">
            <label for="type_2">
                <i class="bx bx-pyramid"></i>
                <span>للتبرع من داخل مصر</span>
            </label>
        </div>
        <div class="form-group">
            <input type="radio" name="type" id="type_1" class="form-control" value="2" v-model="type">
            <label for="type_1">
                <i class="bx bx-globe"></i>
                <span>للتبرع من خارج مصر</span>
            </label>
        </div>
    </div>
    <br>

    <table dir="RTL" v-if="type == 1">
        <tbody>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong><span style="color: #e31b23;">اسم البنك</span></strong>
                </td>
                <td dir="RTL" style="text-align: center;"><strong><span style="color: #e31b23;">البنك الأهلى
                            المصرى</span></strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>اسم فرع البنك</strong></td>
                <td dir="RTL" style="text-align: center;"><strong>فرع سوريا بالمهندسين</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>رقم الحساب الحالي</strong></td>
                <td dir="LTR" style="text-align: center;"><strong>1623060320945400012</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>رقم IBAN</strong></td>
                <td dir="LTR" style="text-align: center;"><strong>EG660003016230603209454000120</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong><span style="color: #e31b23;">اسم البنك</span></strong>
                </td>
                <td dir="RTL" style="text-align: center;"><strong><span style="color: #e31b23;">بنك مصر</span></strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>اسم فرع البنك</strong></td>
                <td dir="RTL" style="text-align: center;"><strong>فرع احمد فؤاد</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>رقم الحساب الحالي</strong></td>
                <td dir="LTR" style="text-align: center;"><strong>3920001000019450</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>رقم IBAN</strong></td>
                <td dir="LTR" style="text-align: center;"><strong>EG420002039203920001000019450</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong><span style="color: #e31b23;">اسم البنك</span></strong>
                </td>
                <td dir="RTL" style="text-align: center;"><strong><span style="color: #e31b23;">البنك التجارى
                            الدولى</span></strong></td>
            </tr>
            <tr>
                <td dir="RTL"><strong>اسم فرع البنك</strong></td>
                <td dir="RTL"><strong>فرع جراند مول ( المعادي الجديدة )</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>رقم الحساب الحالي</strong></td>
                <td dir="LTR" style="text-align: center;"><strong>100009213842</strong></td>
            </tr>
            <tr>
                <td dir="RTL" style="text-align: center;"><strong>رقم IBAN</strong></td>
                <td dir="LTR" style="text-align: center;"><strong>EG780010001800000100009213842</strong></td>
            </tr>
            <tr style="background: #dfdfdf;">
                <td dir="RTL" style="text-align: center;" colspan="2"><span
                        style="color: #e31b23; font-size: 18px;"><strong>للتبرع بالدولار الأمريكي</strong></span></td>
            </tr>
            <tr>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>اسم البنك</strong></span></td>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>&nbsp;بنك مصر (Banque
                            Misr)</strong></span></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>اسم الفرع</strong></td>
                <td style="text-align: center;"><strong>احمد فؤاد</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>&nbsp;عنوان البنك</strong></td>
                <td style="text-align: center;"><strong>38 عباس العقاد، المنطقة الأولى، مدينة نصر،&nbsp; القاهرة</strong>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong> رقم الحساب</strong></td>
                <td style="text-align: center;"><strong>3920120000000288</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم السويفت كود</strong></td>
                <td style="text-align: center;"><strong>BMISEGCXXXX&nbsp;</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>العملة</strong></td>
                <td style="text-align: center;"><strong>دولار امريكى</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>اسم الحساب</strong></td>
                <td style="text-align: center;"><strong> جمعية رسالة للاعمال الخيرية</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم المصرف الدولى</strong></td>
                <td style="text-align: center;"><strong>EG950002039203920120000000288</strong></td>
            </tr>
        </tbody>
    </table>

    <table v-if="type == 2">
        <tbody>
            <tr>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>اسم البنك</strong></span></td>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>&nbsp;بنك مصر (Banque
                            Misr)</strong></span></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>اسم فرع البنك</strong></td>
                <td style="text-align: center;"><strong>فرع أحمد فؤاد</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>سويفت كود</strong></td>
                <td style="text-align: center;"><strong>BMISEGCX140</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم الحساب</strong></td>
                <td style="text-align: center;"><strong>39200100011214 – دار أيتام رسالة</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم&nbsp;IBAN</strong></td>
                <td style="text-align: center;"><strong>EG900002039203920001000011214</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>اسم البنك</strong></span></td>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>البنك التجاري الدولي
                            (CIB)</strong></span></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>اسم فرع البنك</strong></td>
                <td style="text-align: center;"><strong>فرع عباس العقاد</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>للتبرع
                            بالدولار&nbsp;</strong></span><span style="color: #e31b23;"><b>الأمريكي</b></span></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم الحساب</strong></td>
                <td style="text-align: center;"><strong>100031279307</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم السويفت كود</strong></td>
                <td style="text-align: center;"><strong>CIBEEGCX014</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم&nbsp;IBAN</strong></td>
                <td style="text-align: center;"><strong>EG540010001400000100031279307</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"><span style="color: #e31b23;"><strong>للتبرع بالجنيه المصري</strong></span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم الحساب</strong></td>
                <td style="text-align: center;"><strong>100023248187</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم السويفت كود</strong></td>
                <td style="text-align: center;"><strong>CIBEEGCX014</strong></td>
            </tr>
            <tr>
                <td style="text-align: center;"><strong>رقم&nbsp;IBAN</strong></td>
                <td style="text-align: center;"><strong>EG920010001400000100023248187</strong></td>
            </tr>
        </tbody>
    </table>
</section>
@endsection


@section('scripts')
    <script src="{{ asset('/libs/axios.js') }}"></script>
    <script src="{{ asset('/libs/vue.js') }}"></script>

    <script>
    const { createApp, ref } = Vue;

    createApp({
    data() {
        return {
            type: 1,
        }
    },
    methods: {
    },
    }).mount('#banck_transfer')
    </script>
@endsection
