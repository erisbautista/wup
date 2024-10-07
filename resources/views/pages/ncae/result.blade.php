<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pre-test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="header mb-4">
                <h1>NCAE PRE-TEST</h1>
            </div>
            <div class="ncae-result">
                <div class="result card">
                    <div class="result-header p-2">
                        <span>STEM</span>
                        <span>ABM</span>
                        <span>HUMSS</span>
                        <span>TVL</span>
                    </div>
                    <h1 class="result-header-text">RESULTS OF PRE-TEST</h1>
                    <div class="result-body">
                        ANALYTICS OF THE RESULTS BASED ON THE PRE-TEST.
                    </div>
                    <div class="result-footer">
                        <a class="w-3 exit" href="{{ route('ncae')}}">
                            EXIT
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
