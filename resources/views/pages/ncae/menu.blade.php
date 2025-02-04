@extends('../../layouts.ncae')

@section('title','Strands')

@section('header')
    <h1>BROWSE STRANDS</h1>
    <h2>Review your willingness or eagerness to select a strand description.</h2>
@endsection

@section('ncae-menu')
    <div class="side-nav" id="menu">
        <p class="fs-2 text-uppercase text-center">SELECT STRAND</p>
        @foreach($strands as $strand)
            <button type="button" onclick="fillStrandInfo({{ $strand }})" id="{{$strand->name}}" class="btn-menu text-center m-5">{{$strand->name}}</button>
        @endforeach
    </div>
@endsection

@section('ncae-content')
    <div class="ncae-strand">
        <a class="button w-3 button-new text-center text-uppercase" href="#" id="pre-test" data-id="1" onclick="redirectToTest()">
            Take Pre-Test
        </a>
        <div class="strand-info">
            <div class="description">
                <h1 class="description-header">Description</h1>
                <p id="description">{{$strands[0]->description}}</p>
            </div>
            <div class="expectation">
                <h1 class="expectation-header">Expectation</h1>
                <p id="expectation">{{$strands[0]->expectation}}</p>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center text-uppercase" href="{{ route('ncae')}}">
    Main Menu
</a>
@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#stem').css('background-color', '#62B485');
    });

    function fillStrandInfo(strand) {
        $('#menu :button').css('background-color', '#247547');
        $('#' + strand.name).css('background-color', '#62B485');
        $('#description').html(strand.description);
        $('#expectation').html(strand.expectation);
        $('#pre-test').data('id', strand.id);
    }

    function redirectToTest() {
        const id = $('#pre-test').data('id');
        window.location.href = `/ncae/test/${id}`;
    }
</script>
@endsection