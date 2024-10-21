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
        <div class="container">
            <div class="header mb-4">
                @yield('header')
            </div>
            <div class="main">
                <div class="side-nav">
                    <a href="{{route('calendar')}}" id="activity-menu-activity" class="btn-menu text-center">ACTIVITY</a>
                    <a href="{{route('calendar_view')}}" id="activity-menu-calender" class="btn-menu text-center">CALENDAR</a>
                    <a href="{{route('calendar_feedback')}}" id="activity-menu-feedback" class="btn-menu text-center">FEEDBACK</a>
                </div>
                <div class="content">
                    <div class="card">
                        @yield('calendar-content')
                    </div>
                </div>
                <div class="footer">
                    @yield('footer')
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        @yield('script')
    </body>
</html>
