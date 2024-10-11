@extends('../layouts.violation')

@section('title','test')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
    <h2>MAIN MENU</h2>
@endsection

@section('violation-content')
    
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('logout')}}">
    Log out
</a>
@endsection