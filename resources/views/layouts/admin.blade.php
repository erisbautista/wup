<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @yield('style')
        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="header mb-4">
                <img class="img-logo" src="../../storage/logo.png" alt="Logo">
            </div>
            <div class="admin-main">
                <div class="side-nav">
                    <a href="{{route('admin_user')}}" id="user-menu-item" class="btn-menu text-center">Users</a>
                    <a href="{{route('admin_activity')}}" id="activity-menu-item" class="btn-menu text-center">Activities</a>
                    <a href="{{route('admin_history')}}"id="history-menu-item" class="btn-menu text-center">History</a>
                    <a href="{{route('admin_exam')}}"id="exam-menu-item" class="btn-menu text-center">NCAE Exam</a>
                    <a href="{{route('admin_exam_statistics')}}"id="exam-statistic-menu-item" class="btn-menu text-center">Exam Statistics</a>
                    <div class="footer">
                        @yield('footer')
                    </div>
                </div>
                <div class="content">
                    <div class="card">
                        @yield('admin-content')
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        @yield('scripts')
        @yield('modal')
    </body>
</html>
