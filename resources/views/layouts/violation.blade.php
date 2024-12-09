<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="header mb-4">
                @yield('header')
            </div>
            <div class="main">
                <div class="side-nav">
                    <a href="{{route('user_violation_register_view')}}" id="register-violation-menu" class="btn-menu text-center">REGISTER VIOLATION</a>
                    <a href="{{route('user_violation_record')}}" id="record-violation-menu" class="btn-menu text-center">STUDENT RECORDS</a>
                    <a href="{{route('user_violation_analysis')}}" id="analysis-violation-menu" class="btn-menu text-center">VIOLATION ANALYSIS</a>
                    <a href="{{route('user_violation_recent')}}" id="recent-violation-menu" class="btn-menu text-center">RECENT VIOLATIONS</a>
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
        @include('sweetalert::alert')
        @yield('script')
    </body>
</html>
