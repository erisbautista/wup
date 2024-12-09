<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pre-test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container">
            <div class="header mb-4">
                <h1>NCAE PRE-TEST</h1>
            </div>
            <div class="ncae-test">
                <div class="question card">
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            @csrf
                            @php($count = 1)
                        <!-- Slides -->
                            @foreach($exams as $exam)
                                @foreach($exam->questions as $key => $question)
                                    <div class="swiper-slide">
                                        <div class="slider-content">
                                            <span class="question-title">{{$exam->name}}</span>
                                            <h1>{{ $count . '. '. $question->question}}</h1>
                                            @foreach($question->choices as $choice)
                                            <label class="radio">
                                                <span class="radio-input">
                                                <input data-exam="{{$exam->id}}" data-question="{{$question->id}}" onclick="setAnswer({{$exam->id}}, {{$question->id}}, {{$choice->id}})" type="radio" value="{{$choice->id}}" name="{{$question->id}}">
                                                <span class="radio-control"></span>
                                                </span>
                                                <span class="radio-label">{{$choice->label}}</span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @php($count++)
                                @endforeach
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <!-- If we need scrollbar -->
                        <div class="swiper-scrollbar"></div>
                    </div>
                    
                    <div class="navigation">
                        <button class="button-previous w-3 text-center m-5">Previous</button>
                        <button onclick="checkStatus()" class="button-go w-3 text-center m-5">Go to</button>
                        <button class="button-next w-3 text-center m-5">Next</button>
                        <button onclick="submitForm()" class="button-submit w-3 text-center m-5">Check Result</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var swiper;
            var question_length;
            var exam_data = {!! json_encode($exams) !!};
            var data = [];
            var token = document.getElementsByName("_token")[0].value;
            $(document).ready(function () {
                // $('#exam-menu-item').css('background-color', '#62B485');
                swiper = new Swiper('.swiper', {
                    // Optional parameters
                    hashNavigation: true,
    
                    // If we need pagination
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        dynamicBullets: true,
                        type: "fraction"
                    },
    
                    // Navigation arrows
                    navigation: {
                        nextEl: '.button-next',
                        prevEl: '.button-previous',
                    },
    
                    // And if we need scrollbar
                    scrollbar: {
                        el: '.swiper-scrollbar',
                    },
                });

                question_length = swiper.slides.length;
                prepareData();
            });

            function checkStatus() {
                var unansweredEl = document.createElement('div');
                $(unansweredEl).addClass('question-list-unfinished');
                $.each(data, function(key, value) {
                    $(unansweredEl).append(`<span onclick="swiperNavigate(`+ key +`)">` + (key + 1) + `</span>`);
                })
                swal("Select from the following questions:", {
                    content: unansweredEl,
                    buttons: false
                })
            }

            function swiperNavigate(key) {
                swiper.slideTo(key);
                swal.close();
            }

            function setAnswer(exam_id, question_id, choice_id) {
                $.each(data, function(key, value) {
                    if(value.exam_id === exam_id && value.question_id === question_id) {
                        data[key].answer = choice_id;
                    }
                });
            }

            function prepareData() {
                $.each(exam_data, function(key, question) {
                    $.each(question.questions, function(key, value) {
                        data.push({
                            exam_id: value.exam_id,
                            question_id: value.id,
                            answer: null
                        })
                    })
                })
            }

            function submitForm() {
                var count = 0;
                $.each(data, function(key, value) {
                    if(value.answer ===null) {
                        count++;
                    }
                })

                if( count > 0 ) {
                    swal(
                        {
                            text: 'There are '+ count + ' more questions to answer! Are you sure you want to submit the form?',
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }
                    ).then((confirm) => {
                        if (confirm) {
                            $.ajax({
                                url: "{{ route('ncae_test_submit') }}",
                                method: 'POST',
                                data: {
                                        "data": data,
                                        "_token": token,
                                },
                                dataType: 'JSON',
                                success: function (data)
                                {
                                    if(data['status'] === true) {
                                        swal('successfully submitted to exam!', {
                                            icon: 'success',
                                            buttons: false
                                        });
                                        window.location.href = '/ncae/result'
                                    }
                                }
                            });
                        }
                    });
                }
            }
        </script>
        @include('../../components/ncaeModal')
    </body>
</html>