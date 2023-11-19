<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/custome.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/service_box.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/service_box_rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/button_rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/js_composer.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/swiper.css') }}?v={{ time() }}" />
    @yield('styles')
    <title>@yield('title') - رسالة</title>
    <style>
        .loader {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            justify-content: center;
            align-items: center;
            z-index: 99999999;
            background: #000000a1 !important;
            backdrop-filter: blur(1px);
            display: none;
        }
        .custom-loader {
            --d:22px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            color: #ff3100;
            box-shadow: 
                calc(1*var(--d))      calc(0*var(--d))     0 0,
                calc(0.707*var(--d))  calc(0.707*var(--d)) 0 1px,
                calc(0*var(--d))      calc(1*var(--d))     0 2px,
                calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
                calc(-1*var(--d))     calc(0*var(--d))     0 4px,
                calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
                calc(0*var(--d))      calc(-1*var(--d))    0 6px;
            animation: s7 1s infinite steps(8);
        }

        @keyframes s7 {
            100% {transform: rotate(1turn)}
        }

        #errors {
            position: fixed;
            top: 1.25rem;
            right: 1.25rem;
            display: flex;
            flex-direction: column;
            max-width: calc(100% - 1.25rem * 2);
            gap: 1rem;
            z-index: 99999999999999999999;
        }

        #errors >* {
            width: 100%;
            color: #fff;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        #errors .error {
            background: #e41749;
        }
        #errors .success {
            background: #12c99b;
        }
    </style>
</head>
<body>
    <div class="loader" style="background-color: #fff;">
        <div class="custom-loader"></div>
    </div>
    <div id="errors"></div>
    @include('site.includes.header')
    <div class="container" dir="rtl">
        @yield('content')
    </div>
    @include('site.includes.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="{{ asset('/libs/swiper.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('/libs/jquery.js') }}"></script>
    @yield('scripts')
</body>
</html>