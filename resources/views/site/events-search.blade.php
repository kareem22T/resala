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
                .event { /* existing styles */ }
        /* Additional styles for form and view type buttons */
        .events_filter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin-top: 40px;
        }
        .events_filter input[type="date"], .events_filter input[type="text"] {
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
        .view_type button, .view_type a {
            border: none;
            background-color: #4b4b4b;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 10px;
            text-decoration: none
        }
        .view_type button.active, .view_type a.active {
            background-color: #1b1b1b;
        }
    </style>
@endsection
@section('content')
    <h1 style="font-size: 24px;font-weight: 700; margin-bottom: 24px" class="title_events">
        @if ($search && $date)
        فعليات مماثلة لبحث: {{ $search }}
         -
        بتاريخ: {{ $days[Carbon\Carbon::parse($date)->dayOfWeek] . ', ' . Carbon\Carbon::parse($date)->day . ' ' . $months[Carbon\Carbon::parse($date)->month - 1] . ', ' . Carbon\Carbon::parse($date)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($date)->format('h:i A')) }}
        @endif
        @if ($search && !$date)
        فعليات مماثلة لبحث: {{ $search }}
        @endif
        @if (!$search && $date)
        فعليات بتاريخ : {{ $days[Carbon\Carbon::parse($date)->dayOfWeek] . ', ' . Carbon\Carbon::parse($date)->day . ' ' . $months[Carbon\Carbon::parse($date)->month - 1] . ', ' . Carbon\Carbon::parse($date)->year . ' ' . str_replace(['AM', 'PM'], ['ص', 'م'], Carbon\Carbon::parse($date)->format('h:i A')) }}
        @endif
    </h1>
    <div class="container">


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
            <div class="pagination_wrapper" style="margin-top: 24px;display: flex; justify-content: center;direction: ltr;">
                {!! $events->links('pagination::bootstrap-4') !!}
            </div>
        @else
            <div class="alert alert-danger text-center mt-5"> لا يوجد أي فاعليات </div>
        @endif
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
