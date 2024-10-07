@extends('../layouts.app')

@section('title','test')

@section('header')
    <img class="img-logo" src="storage/logo.png" alt="Logo">
@endsection

@section('content')
    <div class="menu">
        <a href="{{route('calendar')}}" class="btn-menu text-center">School calendar</a>
        <a href="{{route('ncae')}}" class="btn-menu text-center">ncae pre-test</a>
        <a href="{{route('violation')}}" class="btn-menu text-center">Student Violation tracker</a>
    </div>
@endsection