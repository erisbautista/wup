@extends('../layouts.app')

@section('title','Main Menu')

@section('header')
    <img class="img-logo" src="storage/logo.png" alt="Logo">
@endsection

@section('content')
    <div class="menu">
        <a href="{{route('calendar')}}" class="btn-menu text-center">School calendar</a>
        @if(Auth::user()->role_id === 2)
        <a href="{{route('ncae')}}" class="btn-menu text-center">ncae pre-test</a>
        @endIf
        <a  class="button text-center" href="{{ route('logout')}}">Log out</a>
    </div>
@endsection