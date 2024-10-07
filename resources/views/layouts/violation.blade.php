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
                    <a href="{{route('violation_register')}}" class="btn-menu text-center">REGISTER VIOLATION</a>
                    <a href="{{route('violation_record')}}" class="btn-menu text-center">STUDENT RECORDS</a>
                    <a href="{{route('violation_analysis')}}" class="btn-menu text-center">VIOLATION ANALYSIS</a>
                    <a href="{{route('violation_recent')}}" class="btn-menu text-center">RECENT VIOLATIONS</a>
                </div>
                <div class="content">
                    <div class="card">
                        @yield('violation-content')
                    </div>
                </div>
                <div class="footer">
                    @yield('footer')
                </div>
            </div>
        </div>
    </body>
</html>
