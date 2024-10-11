@extends('../layouts.app')

@section('title','test')

@section('header')
    <img class="img-logo" src="storage/logo.png" alt="Logo">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <form action="/login" class="login-form" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="username">Username:</label>
                    <input type="text" class="form-input" name="username" id="username">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">password:</label>
                    <input type="password" class="form-input" name="password" id="password">
                </div>
                <div class="form-footer">
                    <button class="button w-5 login mb-2 text-center" type="submit">
                        Login
                    </button>
                    <h3>forgot your password? click here to reset your password</h3>
                </div>
            </form>
        </div>
    </div>
@endsection