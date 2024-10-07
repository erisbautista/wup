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
            <div class="ncae-test">
                <div class="question card">
                    <span class="question-title">EX: QUESTION 1:</span>
                    <span class="question-content">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
                        dolore magna aliqua. Amet aliquam id diam maecenas ultricies mi.</span>
                    <span class="question-choices">
                        <span>A. Lorem ipsum</span>
                        <span>B. Lorem ipsum</span>
                        <span>C. Lorem ipsum</span>
                        <span>D. Lorem ipsum</span>
                    </span>
                    <div class="footer">
                        <button class="btn-menu mr-2">Previous QUESTION</button>
                        <button class="btn-menu mr-2">NEXT QUESTION</button>
                        <a class="button result text-center" href="{{ route('ncae_result')}}">
                            CHECK RESULTS
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
