<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="header mb-4">
                @yield('header')
            </div>
            <div class="main">
                <div class="side-nav">
                    <a href="{{route('calendar_view')}}" class="btn-menu text-center">CALENDAR</a>
                    <a href="{{route('calendar_activity')}}" class="btn-menu text-center">ACTIVITY</a>
                    <a href="{{route('calendar_feedback')}}" class="btn-menu text-center">FEEDBACK</a>
                </div>
                <div class="content height-47">
                    <div class="card">
                        @yield('calendar-content')
                    </div>
                </div>
                <div class="footer">
                    @yield('footer')
                </div>
            </div>
        </div>
    </body>
</html>
