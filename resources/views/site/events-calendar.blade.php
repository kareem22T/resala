@extends('site.layouts.site-layout')

@section('title', isset($events) ? 'الفاعليات' : '404 not found')
@section('events_active', 'active')

@section('styles')
<style>
    .calendar {
        width: 100%;
        max-width: 1200px;
        margin: 2rem auto;
        font-family: inherit;
        direction: rtl;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: #27318b;
        color: white;
        border-radius: 10px 10px 0 0;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 1px;
        background-color: #eee;
        border: 1px solid #ddd;
    }

    .calendar-day-header {
        padding: 10px;
        text-align: center;
        background-color: #f8f9fa;
        font-weight: bold;
    }

    .calendar-day {
        min-height: 120px;
        padding: 10px;
        background-color: white;
        border: 1px solid #eee;
        position: relative;
    }

    .calendar-day.today {
        background-color: #f0f4ff;
    }

    .calendar-day.other-month {
        background-color: #f9f9f9;
        color: #999;
    }

    .day-number {
        position: absolute;
        top: 5px;
        right: 5px;
        font-weight: bold;
    }

    .event-dot {
        width: 100%;
        padding: 4px 8px;
        margin: 2px 0;
        background-color: #27318b;
        color: white;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .event-container {
        margin-top: 20px;
    }

    .nav-button {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 1.2rem;
        padding: 0.5rem 1rem;
    }

    .event-dot.start-date {
        border-right: 3px solid #1a1f5c;
    }

    .event-dot.end-date {
        border-left: 3px solid #1a1f5c;
    }

    .event-dot:nth-child(even).start-date {
        border-right: 3px solid #7e090f;
    }

    .event-dot:nth-child(even).end-date {
        border-left: 3px solid #7e090f;
    }

    .event-dot:nth-child(even) {
        background-color: #e41b24;
    }

    @media (max-width: 768px) {
        .calendar-day {
            min-height: 80px;
            font-size: 0.8rem;
        }

        .event-dot {
            padding: 2px 4px;
            font-size: 10px;
        }
    }
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
<h1 class="title_events">كل الفاعليات</h1>

<div class="container">
                <!-- Filter Form -->
                <div class="events_filter">
                    <form action="{{ route('search.events') }}" method="GET">
                        <input type="date" name="date" value="{{ request('date') }}" placeholder="اختر تاريخ">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث عن الفاعليات...">
                        <button type="submit" style="
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
                        <a href="{{ route('all.events') }}">عرض شهر بشهر</a>
                        <a href="{{ route('events.calendar') }}" class="active">عرض كنتيجة</a>
                    </div>
                </div>

    <div class="calendar">
        <div class="calendar-header" dir="ltr">
            <button class="nav-button" onclick="previousMonth()">&lt;</button>
            <h2 id="currentMonthYear"></h2>
            <button class="nav-button" onclick="nextMonth()">&gt;</button>
        </div>
        <div class="calendar-grid" id="calendarGrid"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const months = ['يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونيو',
                'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
const days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];

let currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

// Convert PHP events to JavaScript
const events = @json($events);

function initCalendar() {
    showCalendar(currentMonth, currentYear);

    // Add event listeners for navigation
    document.querySelector('.prev-month').addEventListener('click', previousMonth);
    document.querySelector('.next-month').addEventListener('click', nextMonth);
}

function isSameDay(date1, date2) {
    return date1.getDate() === date2.getDate() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getFullYear() === date2.getFullYear();
}

function showCalendar(month, year) {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const startingDay = firstDay.getDay();
    const monthLength = lastDay.getDate();

    // Update header
    document.getElementById('currentMonthYear').textContent = `${months[month]} ${year}`;

    const calendar = document.getElementById('calendarGrid');
    calendar.innerHTML = '';

    // Add day headers
    days.forEach(day => {
        const dayHeader = document.createElement('div');
        dayHeader.className = 'calendar-day-header';
        dayHeader.textContent = day;
        calendar.appendChild(dayHeader);
    });

    // Create calendar days
    let date = 1;
    for (let i = 0; i < 6; i++) {
        for (let j = 0; j < 7; j++) {
            const dayCell = document.createElement('div');
            dayCell.className = 'calendar-day';

            if (i === 0 && j < startingDay) {
                // Previous month days
                const prevMonthDay = new Date(year, month, 0).getDate() - (startingDay - j - 1);
                dayCell.innerHTML = `<div class="day-number">${prevMonthDay}</div>`;
                dayCell.classList.add('other-month');
            } else if (date > monthLength) {
                // Next month days
                const nextMonthDay = date - monthLength;
                dayCell.innerHTML = `<div class="day-number">${nextMonthDay}</div>`;
                dayCell.classList.add('other-month');
                date++;
            } else {
                // Current month days
                const currentDate = new Date(year, month, date);
                dayCell.innerHTML = `<div class="day-number">${date}</div>`;

                // Check if it's today
                if (date === new Date().getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear()) {
                    dayCell.classList.add('today');
                }

                // Add events for this day
                const eventContainer = document.createElement('div');
                eventContainer.className = 'event-container';

                // Filter events that include this day
                const dayEvents = events.filter(event => {
                    const eventStartDate = new Date(event.date_from);
                    const eventEndDate = new Date(event.date_to);
                    return currentDate >= eventStartDate && currentDate <= eventEndDate;
                });

                dayEvents.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.className = 'event-dot';

                    // Add special styling for start and end dates
                    if (isSameDay(new Date(event.date_from), currentDate)) {
                        eventEl.classList.add('start-date');
                    }
                    if (isSameDay(new Date(event.date_to), currentDate)) {
                        eventEl.classList.add('end-date');
                    }

                    eventEl.textContent = event.title;
                    eventEl.title = `${event.title} (${new Date(event.date_from).toLocaleDateString()} - ${new Date(event.date_to).toLocaleDateString()})`;
                    eventEl.onclick = () => window.location.href = `/event/${event.id}`;
                    eventContainer.appendChild(eventEl);
                });

                dayCell.appendChild(eventContainer);
                date++;
            }

            calendar.appendChild(dayCell);
        }
    }
}

function previousMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    showCalendar(currentMonth, currentYear);
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    showCalendar(currentMonth, currentYear);
}

// Initialize calendar when page loads
document.addEventListener('DOMContentLoaded', initCalendar);
</script>
<script>
    function changeView(viewType) {
        const url = new URL(window.location);
        url.searchParams.set('view_type', viewType);
        window.location = url.toString();
    }
</script>

@endsection
