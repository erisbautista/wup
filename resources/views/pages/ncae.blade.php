@extends('../layouts.ncae')

@section('title','NCAE')

@section('header')
    <h1>NCAE PRE-TEST</h1>
    <h2>Navigate your dream strand and future courses.</h2>
@endsection

@section('ncae-menu')
    <div class="side-nav">
        <p class="fs-1 text-uppercase text-center">Main Menu</p>
        <a id="ncae-test-menu" class="btn-menu text-center">TAKE PRE-TEST</a>
        <a href="{{route('ncae_strand')}}" id="ncae-strand-menu" class="btn-menu text-center">BROWSE STRANDS</a>
        <a href="{{route('ncae_career')}}" id="ncae-career-menu" class="btn-menu text-center">RELATED CAREERS</a>
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

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('.side-nav').on('click', '#ncae-test-menu', function (e) {
            e.preventDefault();
            swal({
                text: 'Welcome to the NCAE Pre-Test! Before starting, please ensure you are in a quiet space with a stable internet connection and have all necessary materials on hand. Read each question carefully, manage your time wisely, and avoid distractions during the exam. Cheating or opening unauthorized websites is strictly prohibited and will lead to disqualification. Take a deep breath, stay calm, and do your best. Good luck on this important step towards discovering your future career path!',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirm) => {
                if(confirm) {
                    window.location.href = "/ncae/test"
                }
            })
        });
    });
</script>
@endsection