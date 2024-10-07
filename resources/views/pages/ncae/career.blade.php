@extends('../../layouts.ncae')

@section('title','test')

@section('header')
    <h1>RELATED CAREERS</h1>
    <h2>Discover your future course within the strand you select.</h2>
@endsection

@section('ncae-menu')
    <div class="side-nav">
        <p class="fs-2 text-uppercase text-center">SELECT STRAND</p>
        <a href="{{route('violation_register')}}" class="btn-menu text-center">STEM</a>
        <a href="{{route('violation_record')}}" class="btn-menu text-center">ABM</a>
        <a href="{{route('violation_analysis')}}" class="btn-menu text-center">HUMSS</a>
        <a href="{{route('violation_analysis')}}" class="btn-menu text-center">TVL</a>
    </div>
@endsection

@section('ncae-content')
    <div class="ncae-career">
        <ul>
            <li>SHOW COLLEGE COURSES THAT ARE RELATED TO THE STRAND SELECTED.</li>
            <li>SHORT DESCRIPTION ABOUT THE COURSE AND SALARY</li>
            <li>WHAT TO EXPECT FROM THE CAREER</li>
        </ul>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center text-uppercase" href="{{ route('ncae')}}">
    Main Menu
</a>
@endsection