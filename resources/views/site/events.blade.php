@extends('site.layouts.site-layout')

@section('title', isset($events) ? 'الفاعليات' : '404 not found')
@section('events_active', 'active')
@php
    $months = [
        'يناير',
        'فبراير',
        'مارس',
        'إبريل',
        'مايو',
        'يونيو',
        'يوليو',
        'أغسطس',
        'سبتمبر',
        'أكتوبر',
        'نوفمبر',
        'ديسمبر',
    ];

    $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];

    $current_month = Carbon\Carbon::now()->month;
    $current_year = Carbon\Carbon::now()->year;

    $prev_month = $month > 1 ? $month - 1 : 12;
    $prev_year = $month > 1 ? $year : $year - 1;

    $next_month = $month < 12 ? $month + 1 : 1;
    $next_year = $month < 12 ? $year : $year + 1;

@endphp
@section('styles')
    <style>
        .event {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 32px 0;
            max-width: 800px;
            margin: auto;
        }

        .event:not(:last-child) {
            border-bottom: 1px solid #0000005e;
        }

        .event .thumbnail {
            width: 240px;
            min-width: 240px;
            height: 220px;
            border-radius: 8px;
            overflow: hidden;
        }

        .event .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .event h2 {
            font-weight: 700;
            font-size: 24px;
            line-height: 33px;
        }

        .event h3 {
            font-size: 15px;
            font-weight: 500;
            line-height: 26px;
            margin-bottom: 12px;
        }

        .event h3 span {
            font-weight: 700;
        }

        .event p {
            font-weight: 500;
        }

        .event a {
            text-decoration: none;
            color: #27318b;
            font-weight: 700;
            font-size: 18px;
        }

        .title_events {
            margin-bottom: 40px
        }

        @media (max-width: 767.98px) {
            .title_events {
                margin-bottom: 20px;
            }

            .event {
                gap: 20px;
                padding: 24px 0;
                max-width: 800px;
                margin: auto;
                flex-direction: column-reverse;
            }

            .event h2 {
                font-weight: 700;
                font-size: 18px;
                line-height: 28px;
            }

            .event h3 {
                font-size: 14px;
                font-weight: 500;
                line-height: 24px;
                margin-bottom: 12px;
            }

            .event p {
                font-weight: 500;
                font-size: 15px;
            }

            .event .thumbnail {
                width: 100%;
                min-width: 240px;
                height: 220px;
                border-radius: 5px;
                overflow: hidden;
            }
        }

        /* Styles for the events and form */
        .event {
            /* existing styles */
        }

        /* Additional styles for form and view type buttons */
        .events_filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 40px;
        }

        .events_filter input[type="date"],
        .events_filter input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .events_filter form {
            display: flex;
            gap: 12px
        }

        .view_type {
            display: flex;
            gap: 10px;
        }

        .view_type button,
        .view_type a {
            border: none;
            background-color: #4b4b4b;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 10px;
            text-decoration: none
        }

        .view_type button.active,
        .view_type a.active {
            background-color: #1b1b1b;
        }

        @media(max-width: 767.98px) {
            .events_filter {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                margin-top: 24px;
                flex-direction: column;
                gap: 20px;
            }

            .events_filter form {
                display: flex;
                gap: 8px;
                flex-direction: column;
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .events_filter input[type="date"],
            .events_filter input[type="text"] {
                padding: 8px;
                font-size: 16px;
                border-radius: 5px;
                border: 1px solid #ccc;
                width: 100%;
            }

            .events_filter button {
                grid-column: span 2;
            }

            .calendar-header {
                font-size: 18px;
            }

            .calendar-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px;
                background-color: #27318b;
                color: white;
                border-radius: 10px 10px 0 0;
            }

            .event-dot {
                padding: 2px 4px;
                font-size: 11px;
                width: 60px;
            }

            .calendar-grid {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                gap: 1px;
                background-color: #eee;
                border: 1px solid #ddd;
                overflow: auto;
            }

            .calendar-day-header {
                padding: 10px;
                text-align: center;
                background-color: #f8f9fa;
                font-weight: bold;
                font-size: 9px;
            }
        }
    </style>
@endsection
@section('content')
    <h1 class="title_events">فعاليات شهر {{ $months[$month - 1] }} - {{ $year }}</h1>
    <div class="container">
        <!-- Filter Form -->
        <div class="events_filter">
            <form action="{{ route('search.events') }}" method="GET">
                <input type="date" name="date" value="{{ request('date') }}" placeholder="اختر تاريخ">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث عن الفاعليات...">
                <button type="submit"
                    style="
                    border: none;
                    color: white;
                    background-color: #27318b;
                    padding: 11px 16px;
                    display: flex;
                    align-items: center;
                    font-size: 16px;
                    gap: 10px;
                    border-radius: 10px;
                    transition: 0.2s all ease-out;
                    text-decoration: none;
                ">بحث</button>
            </form>
            <div class="view_type">
                <a href="{{ route('all.events') }}" class="active">عرض شهر بشهر</a>
                <a href="{{ route('events.calendar') }}">عرض كنتيجة</a>
            </div>
        </div>


        @if ($events->count())
            <div class="events_wrapper">
                @foreach ($events as $event)
                    <div class="event">
                        <div class="text">
                            <h2>{{ $event->title }}</h2>
                            <h3>
                                من
                                <span>
                                    {{ $days[Carbon\Carbon::parse($event->date_from)->dayOfWeek] . ', ' . Carbon\Carbon::parse($event->date_from)->day . ' ' . $months[Carbon\Carbon::parse($event->date_from)->month - 1] . ', ' . Carbon\Carbon::parse($event->date_from)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($event->date_from)->format('h:i A')) }}
                                    <br>
                                </span>
                                الي
                                <span>
                                    {{ $days[Carbon\Carbon::parse($event->date_to)->dayOfWeek] . ', ' . Carbon\Carbon::parse($event->date_to)->day . ' ' . $months[Carbon\Carbon::parse($event->date_to)->month - 1] . ', ' . Carbon\Carbon::parse($event->date_to)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($event->date_to)->format('h:i A')) }}
                                </span>
                            </h3>
                            <p>
                                {{ $event->intro }}
                            </p>
                            <a href="{{ route('event.index', $event->id) }}">
                                عرض المزيد >>
                            </a>
                        </div>
                        <div class="thumbnail">
                            <img src="{{ $event->thumbnail_path }}" alt="{{ $event->title }}">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger text-center mt-5"> لا يوجد أي فاعليات في هذا الشهر</div>
        @endif
    </div>
    <div class="events_btns" style="display: flex;justify-content: space-between;align-items: center;margin-top: 32px;">
        @if ($month < $current_month || $year < $current_year)
            <a href="{{ route('all.events', ['month' => $next_month, 'year' => $next_year]) }}"
                style="
                border: none;
                color: white;
                background-color: #27318b;
                padding: 11px 16px;
                display: flex;
                align-items: center;
                font-size: 16px;
                gap: 10px;
                border-radius: 13px;
                transition: 0.2s all ease-out;
                text-decoration: none;
            ">
                << التالي</a>
                @else
                    <span></span>
        @endif
        <a href="{{ route('all.events', ['month' => $prev_month, 'year' => $prev_year]) }}"
            style="
        border: none;
        color: white;
        background-color: #27318b;
        padding: 11px 16px;
        display: flex;
        align-items: center;
        font-size: 16px;
        gap: 10px;
        border-radius: 13px;
        transition: 0.2s all ease-out;
        text-decoration: none;
    ">السابق
            >></a>
    </div>
@endsection

@section('scripts')
    <script>
        function changeView(viewType) {
            const url = new URL(window.location);
            url.searchParams.set('view_type', viewType);
            window.location = url.toString();
        }
    </script>
@endsection
