<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Result</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="header mb-4">
                <h1>RESULTS OF PRE-TEST</h1>
            </div>
            <div class="ncae-result">
                <div class="result card">
                    <div class="result-body">
                        <div class="chart-wrapper">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="result-footer">
                        <a class="w-3 exit" href="{{ route('ncae')}}">
                            EXIT
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
    </body>
</html>


<script>

    var data = {!! json_encode($data) !!};
    document.addEventListener("DOMContentLoaded", function () {
        $('#ncae-stats-menu').css('background-color', '#62B485');
        const ctx = document.getElementById('myChart');
        let labels = data.labels;
        let score = data.score;

        new Chart(ctx, {
        type: 'line',
        data: {
        labels: labels,
        datasets: [{
            label: 'Score',
            backgroundColor: '#df8d39',
            borderColor: '#df8d39',
            pointBorderColor: '#df8d39',
            pointBackgroundColor: '#df8d39',
            pointHoverBackgroundColor: '#fff',
            data: score,
            borderWidth: 1,
            tension: .3
        }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 30,
                },
                x: {
                    display: false
                }
            }
        }
    });
    });
</script>