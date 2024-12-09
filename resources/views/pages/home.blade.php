@extends('../layouts.app')

@section('title','Main Menu')

@section('header')
    <img class="img-logo" src="storage/logo.png" alt="Logo">
@endsection

@section('content')
    <div class="menu">
        <a href="{{route('calendar')}}" class="btn-menu text-center">School calendar</a>
        <a href="{{route('ncae')}}" class="btn-menu text-center">ncae pre-test</a>
        @if(auth()->user()->role_id === 3)
        <a href="{{route('user_violation')}}" class="btn-menu text-center">Student Violation tracker</a>
        @endif
        <a  class="button text-center" href="{{ route('logout')}}">Log out</a>
    </div>
@endsection