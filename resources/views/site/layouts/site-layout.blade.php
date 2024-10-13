<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <link rel="stylesheet" href="{{ asset('/assets/css/header.css') }}?v={{time()}}">
    <link rel="stylesheet" href="{{ asset('/assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('/libs/swiper.css') }}?v={{ time() }}" />
    @yield('styles')
    <title>@yield('title') - رسالة</title>
    <style>
        .page-loader {
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
        .img {
            position: relative;
        }

        .img:hover .zoom_wrapper {
            opacity: 1;
        }
        .zoom_wrapper {
            position: absolute;
            width: 100%;
            transition: .3s ease-in all;
            height: 100%;
            background: rgba(0, 0, 0, 0.295);
            display: flex;
            top: 0;
            left: 0;
            z-index: 9;
            justify-content: center;
            align-items: center;
            opacity: 0;
        }
        .zoom_wrapper svg {
            width: 60px;
            height: 60px;
            stroke: white
        }
        .zoomed_image_wrapper {
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            padding: 1rem;
            justify-content: center;
            align-items: center;
            display: none;
            z-index: 999999999999;
        }
        .zoomed_image_wrapper img {
            width: 100%;
            max-width: 600px;
            max-height: 100%;
            object-fit: contain
        }
        .zoomed_image_wrapper .icon-tabler-square-rounded-x {
            stroke: white;
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 60px;
            height: 60px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="page-loader" style="background-color: #fff;">
        <div class="custom-loader"></div>
    </div>
    <div class="zoomed_image_wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#5f6264" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M10 10l4 4m0 -4l-4 4" />
            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
        </svg>
        <div class="img_wrapper"></div>
    </div>
    <div id="errors"></div>
    @include('site.includes.header')
    <div class="container" dir="rtl">
        @yield('content')
    </div>
    @yield('content_home')
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
    <script>
        $(".img").each(function() {
            $(this).append('<div class="zoom_wrapper"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-search" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#5f6264" fill="none" stroke-linecap="round" stroke-linejoin="round">\
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>\
            <path d="M15 8h.01" />\
            <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5.5" />\
            <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />\
            <path d="M20.2 20.2l1.8 1.8" />\
            <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l2 2" />\
            </svg></div>')
        })
        $(document).on("click", ".img", function() {
            let ele = $(this).find("img")
            $(".zoomed_image_wrapper").find("img").remove()
            $(".zoomed_image_wrapper").append(ele.clone()).css("display", "flex")
        })
        $(".icon-tabler-square-rounded-x").on("click", function () {
            $(".zoomed_image_wrapper").fadeOut()
        })
    </script>
</body>
</html>
