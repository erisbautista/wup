@extends('../../layouts.violation')

@section('title','test')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="violation-analysis">
        <h1 class="d-block">VIOLATION ANALYSIS</h1>
        <div class="violation-chart">
            <x-chartjs-component :chart="$chart" />
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('violation')}}">
    back
</a>
@endsection