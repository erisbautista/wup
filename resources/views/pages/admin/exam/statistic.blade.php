@extends('../../layouts.admin')

@section('title','Pre Test Statistics')

@section('admin-content')
    <div class="statistics">
        <div class="statistics-header">
            <h1>Year selection:</h1>

        </div>
        <div class="statistics-body">
            <div class="chart-wrapper">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('logout')}}">
        Log out
    </a>
@endsection

@section('scripts')
    <script>
        var exams = {!! json_encode($exams) !!};
        $(document).ready(function () {
            $('#exam-statistic-menu-item').css('background-color', '#62B485');
            const ctx = document.getElementById('myChart');
            let labels = exams.labels;
            let data = exams.data;

            new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: data
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    x: {
                        display: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: '# of users that took an exam per month depending on year'
                    }
                },
            }});
        });
    </script>
@endsection
