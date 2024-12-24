@extends('../../layouts.violation')

@section('title','Violation Analysis')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="violation-analysis">
        <h1 class="d-block">VIOLATION ANALYSIS</h1>
        <div class="violation-chart">
            {!! $chart->render() !!}
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('logout')}}">
    Log Out
</a>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#analysis-violation-menu').css('background-color', '#62B485');
    });
</script>
@endsection