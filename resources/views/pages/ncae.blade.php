@extends('../layouts.ncae')

@section('title','NCAE')

@section('header')
    <h1>NCAE PRE-TEST</h1>
    <h2>Navigate your dream strand and future courses.</h2>
@endsection

@section('ncae-menu')
    <div class="side-nav">
        <p class="fs-1 text-uppercase text-center">Main Menu</p>
        <a href="{{route('ncae_strand_selection')}}" id="ncae-test-menu" class="btn-menu text-center">TAKE PRE-TEST</a>
        <a href="{{route('ncae_strand')}}" id="ncae-strand-menu" class="btn-menu text-center">BROWSE STRANDS</a>
        <a href="{{route('ncae_career')}}" id="ncae-career-menu" class="btn-menu text-center">RELATED CAREERS</a>
        <a href="{{route('ncae_result')}}" id="ncae-stats-menu" class="btn-menu text-center">CHECK STATISTICS</a>
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
<a class="button w-5 text-center" href="{{ route('home')}}">
    Main Menu
</a>
@endsection