@extends('../../layouts.calendar')

@section('title','test')

@section('header')
    <h1>SCHOOL CALENDAR</h1>
@endsection

@section('calendar-content')
    <div id="calendar"></div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('calendar')}}">
    back
</a>
@endsection