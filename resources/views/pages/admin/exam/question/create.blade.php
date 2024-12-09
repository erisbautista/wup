@extends('../../../../layouts.admin')

@section('title','Create Question')

@section('admin-content')
    <div class="question">
        <div class="question-header">
            <h1 class="text-uppercase">Create new Question</h1>
        </div>
        <div class="question-body">
            <form action="{{route('create_question', $id)}}" method="POST" class="question-form">
                @csrf
                <label for="question">Question</label>
                <textarea name="question" id="question" class="textarea-input"></textarea>
                <div class="question-form-footer content-center">
                    <button class="button w-2 text-center" type="submit">Save</button>
                </div>
            </form>
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
        $('.question-form').submit(function(event) {
            if($('#question').val() === ''|| $('#question').val() === null){
                $('#question').addClass('warning');
                swal('Question field is required', '', 'error');
                event.preventDefault();
            } else {
                $('#question').removeClass('warning');
            }
        })
    });
    </script>
@endsection
