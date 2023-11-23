@extends('site.layouts.site-layout')

@section('title', 'طرق تبرع اخري ')

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
        font-weight: 700
    }
    td, th {
        padding: 1rem;
    }
    table img {
        max-height: 50px;
        display: inline-block;
        margin: 10px
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
<section>
    <h1>طرق تبرع اخري </h1>
    <br>

    <table>
        <tbody>
            <tr>
                <td>التبرع من خلال SMS</td>
                <td>ابعت رسالة علي 9598 سعر الرسالة 5 ج م <img src="{{ asset('/assets/img/other-1.png') }}" alt="التبرع من خلال SMS"></td>
            </tr>
            <tr>
                <td>التبرع من خلال الـ ATM</td>
                <td>
                    <img src="{{ asset('/assets/img/other-2.png') }}" alt="التبرع من خلال الـ ATM"><br>
                    <img src="{{ asset('/assets/img/other-3.png') }}" alt="التبرع من خلال الـ ATM"><br>
                    <img src="{{ asset('/assets/img/other-4.png') }}" alt="التبرع من خلال الـ ATM">
                </td>
            </tr>
            <tr>
                <td>التبرع من خلال تطبيقات الهواتف</td>
                <td>
                    <img src="{{ asset('/assets/img/other-5.png') }}" alt="التبرع من خلال تطبيقات الهواتف"><br>
                    <img src="{{ asset('/assets/img/other-6.png') }}" alt="التبرع من خلال تطبيقات الهواتف">
                </td>
            </tr>
            <tr>
                <td>موقع الصدقة الجارية للمتوفين</td>
                <td>
                    <img src="{{ asset('/assets/img/other-7.jpg') }}" alt="التبرع من خلال تطبيقات الهواتف">
                </td>
            </tr>
            <tr>
                <td>التبرع من خلال البريد المصري</td>
                <td>
                    يمكنك التبرع من خلال البريد على حساب 0250613000162818
                </td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
