@extends('../../../layouts.admin')

@section('title','Preview Exam')

@section('admin-content')
    <div class="exam-preview">
        <div class="exam-preview-header">
            <h1>Preview: {{$data['exam']->name}}</h1>
        </div>
        <div class="exam-preview-body">
            <!-- Slider main container -->
            <form action="" id="exam-preview" class="height-100">
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                    <!-- Slides -->
                        @foreach($data['questions'] as $key => $question)
                            <div class="swiper-slide">
                                <div class="slider-content">
                                    <h1>{{$key + 1 . '. '. $question->question}}</h1>
                                    @foreach($question->choices as $choice)
                                    <label class="radio">
                                        <span class="radio-input">
                                        <input type="radio" value="{{$choice->id}}" onclick="markAsAnswered(this)" name="{{$question->id}}">
                                        <span class="radio-control"></span>
                                        </span>
                                        <span class="radio-label">{{$choice->label}}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </form>
        </div>
        <!-- If we need navigation buttons -->
        <div class="navigation">
            <button class="button-previous w-2 text-center m-5">Previous</button>
            <button class="button-next w-2 text-center m-5">Next</button>
            {{-- <button onclick="submitForm()" class="button-submit w-2 text-center m-5">Check Result</button> --}}
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ url()->previous() }}">
        back
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#exam-menu-item').css('background-color', '#62B485');
            const swiper = new Swiper('.swiper', {
                // Optional parameters

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                
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
        });

        function markAsAnswered(el) {
            $('.swiper-pagination-bullet-active').addClass('swiper-answered');
        }

        function submitForm() {
            var count = 0;
            var inputNames = getNames();
            var data = [];
            inputNames.map(function($name) {
                var choiceCount = 0;
                $('input[name="' + $name + '"]').map(function () {
                    if($(this).is(':checked') === false) {
                        choiceCount++;
                    } else {
                        data.push({'name': parseInt($name), 'choice_id': parseInt($(this).val())});
                    }
                })

                if(choiceCount === 4) {
                    count++;
                }
            });

            if( count > 0 ) {
                swal(
                    {
                        text: 'There are '+ count + ' more questions to answer! You you sure you want to submit the form?',
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }
                ).then((confirm) => {
                    if (confirm) {
                        swal("form submitted!", {
                        icon: "success",
                        });
                    }
                });
            }
        }

        function getNames() {
            var inputNames = [];
            $(".exam-preview input").map(function(){
                // console.log($(this)[0].name);
                if($.inArray($(this)[0].name, inputNames) < 0) {
                    inputNames.push($(this)[0].name);
                }
            });
            return inputNames;
        }
    </script>
@endsection
