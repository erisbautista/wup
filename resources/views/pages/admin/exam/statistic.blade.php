@extends('../../layouts.admin')

@section('title','Pre Test Statistics')

@section('admin-content')
    <div class="statistics">
        <div class="statistics-header">

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
                type: 'bar',
                data: {
                labels: labels,
                datasets: [{
                    label: '# of users that took the pre-test',
                    backgroundColor: '#df8d39',
                    borderColor: '#df8d39',
                    pointBorderColor: '#df8d39',
                    pointBackgroundColor: '#df8d39',
                    pointHoverBackgroundColor: '#fff',
                    data: data,
                    borderWidth: 1,
                    tension: .3
                }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 30,
                        }
                    }
                }
            });
        });
    </script>
@endsection
