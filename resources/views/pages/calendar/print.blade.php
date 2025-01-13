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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="calendar-print">
            @csrf
            <div class="calendar-print-header mb-2">
                <h1 class="calendar-print-header-title">Yearly Schedule of Events</h1>
                <select name="year" id="year" class="input-select">
                    <option value="">Select Year</option>
                    @foreach($years as $year)
                        <option value="{!!$year!!}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card">
                <div class="calendar-print-wrapper">
                    <div id="calendar"></div>
                    <div class="events">
                        <div class="details">
                            <h1 class="details-month">January</h1>
                            <div class="details-event">
                                <span class="details-event-date">01/01/13 (Tue)</span>
                                <span class="details-event-title">New Year's Day</span>
                                <span class="details-event-type">Holiday</span>
                            </div>
                            <div class="details-event">
                                <span class="details-event-date">01/21/13 (Mon)</span>
                                <span class="details-event-title">Martin Luther King Jr. Day</span>
                                <span class="details-event-type">Holiday</span>
                            </div>
                            <div class="details-event">
                                <span class="details-event-date">01/02/13 (We)</span>
                                <span class="details-event-title">Birthday</span>
                                <span class="details-event-type">Note</span>
                            </div>
                            <div class="details-event">
                                <span class="details-event-date">01/01/13 (Tue)</span>
                                <span class="details-event-title">New Year's Day</span>
                                <span class="details-event-type">Holiday</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        <script>
            var token = document.getElementsByName("_token")[0].value;
            var calendar;
            document.addEventListener("DOMContentLoaded", function () {
                $('#year').select2();
                $('#year').on('change', function(e){
                    getAllActivities(e.target.value);
                });
                var calendarEl = document.getElementById("calendar");
                calendar = new FullCalendar.Calendar(calendarEl, {
                    contentHeight: 690,
                    dayMaxEvents: true,
                    initialView: 'multiMonthYear',
                    headerToolbar: false,
                    multiMonthTitleFormat : { year: 'numeric', month: 'long' },
                    multiMonthMaxColumns: 1,
                    eventClick: function (event) {
                        moment(event.event.end).format('MMMM DD, YYYY HH:mm') === 'Invalid date' ? swal(event.event.title, moment(event.event.start).format('MMMM DD, YYYY HH:mm'), 'info') : swal(event.event.title, moment(event.event.start).format('MMMM DD, YYYY HH:mm') + ' to ' + moment(event.event.end).format('MMMM DD, YYYY HH:mm'), 'info');
                    },
                });
            });

            function getAllActivities(year){
                var activities = [];
                var events;
                if(year === '' || year === null) {
                    return 0;
                }
                let holidays = getHolidays(year);
                $.ajax({
                    url: "{{ route('calendar_all_events') }}",
                    method: 'POST',
                    data: {
                            "_method": 'POST',
                            'year': year,
                            "_token": token,
                    },
                    dataType: 'JSON',
                    success: function (data)
                    {
                        activities = data;
                        events = $.merge(activities, holidays);
                        renderCalendar(events, year);
                    }
                });
            }

            function renderCalendar(events, year) {
                calendar.destroy();
                calendar.gotoDate(new Date(year, 0 , 1));
                calendar.addEventSource(events);
                calendar.render();
            }

            function getHolidays(year){
                var holidays_philippines = hd.getHolidays(year);
                holidays_philippines.map(function (h) {
                    h.title = h.name;
                    h.allDay = true;
                    h.display = 'background';
                });
                return holidays_philippines;
            }
        </script>        
    </body>
</html>
