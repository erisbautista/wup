<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="calendar">
            <div class="calendar-header">
                <a class="calendar-header-back button w-5 text-center" href="{{ route('calendar')}}">
                    back
                </a>
                <h1 class="calendar-header-title">SCHOOL CALENDAR</h1>
                @if(auth()->user()->role_id === 3)
                <a href="{{ route('calendar_activity')}}" class="button w-5 text-center calendar-header-new">New</a>
                @endif
            </div>
            <div class="card calendar-wrapper">
                <div id="calendar"></div>
            </div>
        </div>
        @include('sweetalert::alert')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                $('#activity-menu-calender').css('background-color', '#62B485');
                var holidays_philippines = hd.getHolidays(moment().year());
                holidays_philippines.map(function (h) {
                    h.title = h.name;
                    h.allDay = true;
                });
                var activities = {!! json_encode($activities) !!};
                var events = $.merge(activities, holidays_philippines);
                const calendarEl = document.getElementById("calendar");
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    contentHeight: 700,
                    dayMaxEvents: true,
                    headerToolbar: {
                        left: "prev,next today",
                        center: "title",
                        right: "dayGridMonth,timeGridWeek,timeGridDay",
                    },
                    selectable: true,
                    eventClick: function (event) {
                        moment(event.event.end).format('MMMM DD, YYYY HH:mm') === 'Invalid date' ? swal(event.event.title, moment(event.event.start).format('MMMM DD, YYYY HH:mm'), 'info') : swal(event.event.title, moment(event.event.start).format('MMMM DD, YYYY HH:mm') + ' to ' + moment(event.event.end).format('MMMM DD, YYYY HH:mm'), 'info');
                    },
                });
                calendar.addEventSource(events);
                calendar.render();
            });
        </script>        
    </body>
</html>
