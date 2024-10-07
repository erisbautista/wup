@extends('../../layouts.calendar')

@section('title','test')

@section('header')
    <h1>SCHOOL CALENDAR</h1>
@endsection

@section('calendar-content')
    <div class="calendar-feedback">
        <form class="calendar-feedback-form">
            <div class="calendar-feedback-header text-center">
                <span>Let us know what to improve! Put your feedback and recommendations below!</span>
            </div>
            <div class="calendar-feedback-body">
                <textarea name="feedback-input" class="feedback-input"></textarea>
            </div>
            <div class="calendar-feedback-footer">
                <button class="feedback-submit">
                    submit
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('calendar')}}">
    back
</a>
@endsection