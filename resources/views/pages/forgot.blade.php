@extends('../layouts.app')

@section('title','Forgot Password')

@section('header')
    <img class="img-logo" src="../storage/logo.png" alt="Logo">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('password.email')}}" class="reset-form" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" class="form-input" name="email" id="email">
                </div>
                <button class="button w-5 login mb-2 text-center">Reset</button>
                <a href="{{route('login')}}"><h3>go back to login?</h3></a>
            </form>
        </div>
    </div>
@endsection