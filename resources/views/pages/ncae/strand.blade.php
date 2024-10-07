@extends('../../layouts.ncae')

@section('title','test')

@section('header')
    <h1>BROWSE STRANDS</h1>
    <h2>Review your willingness or eagerness to select a strand description.</h2>
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
    <div class="ncae-strand">
        <ul>
            <li>DESCRIPTION ABOUT THE STRAND</li>
            <li>SUMMARY OF WHAT THE STUDENTS SHOULD EXPECT ON THE COURSE</li>
        </ul>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center text-uppercase" href="{{ route('ncae')}}">
    Main Menu
</a>
@endsection