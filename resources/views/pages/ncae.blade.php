@extends('../layouts.ncae')

@section('title','test')

@section('header')
    <h1>NCAE PRE-TEST</h1>
    <h2>Navigate your dream strand and future courses.</h2>
@endsection

@section('ncae-menu')
    <div class="side-nav">
        <p class="fs-1 text-uppercase text-center">Main Menu</p>
        <a href="{{route('ncae_test')}}" class="btn-menu text-center">TAKE PRE-TEST</a>
        <a href="{{route('ncae_strand')}}" class="btn-menu text-center">BROWSE STRANDS</a>
        <a href="{{route('ncae_career')}}" class="btn-menu text-center">RELATED CAREERS</a>
    </div>
@endsection

@section('ncae-content')
    <div class="ncae-menu-content">
        <p class="quote">
            <span>"A career choice is an</span>
            <span>expression of personality"</span>
            <span>- Dr. John Holland</span>
        </p>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('logout')}}">
    Log out
</a>
@endsection