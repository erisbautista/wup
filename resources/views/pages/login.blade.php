@extends('../layouts.app')

@section('title','Login')

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
                    <a href="{{route('password.request')}}"><h3>forgot your password? click here to reset your password</h3></a>
                </div>
            </form>
        </div>
    </div>
    <div class="about-us">
        <button id="openDialog">About Us</button>
    </div>

    <div id="dialog" title="ABOUT EDUGUARD" class="about">
        <p class="about-description"><strong>EduGuard</strong> is an all-in-one student support system that combines career guidance, a school activity calendar, and a violation tracker with automated parental alerts—designed to improve communication, accountability, and student decision-making.</p>
        <p class="about-credits">Developed by Lynel Jose Buan, Mark Anthony Franco, and Vincent Cuaresma.</p>
        <p class="about-copyright">© 2025 EduGuard. All rights reserved.</p>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
            // Initialize the dialog but keep it closed
            $("#dialog").dialog({
                draggable: false,
                resizable: false,
                height: 300,
                width: 700,
                autoOpen: false,
            });

            // Open the dialog on button click
            $("#openDialog").click(function () {
                console.log("I'm clicked");
                $("#dialog").dialog("open");
            });
        });
</script>
@endsection