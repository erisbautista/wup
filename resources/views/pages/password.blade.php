@extends('../layouts.app')

@section('title','First Time Login Password Reset')

@section('header')
    <img class="img-logo" src="../../storage/logo.png" alt="Logo">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('password.first.login.update')}}" class="reset-form" method="post">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="username">Email</label>
                    <input type="text" class="form-input" name="email" value="{{  $email ?? old('email') }}" readonly>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">password</label>
                    <input type="password" class="form-input" name="password" id="password">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Confirm password</label>
                    <input type="password" class="form-input" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="form-footer">
                    <button class="button w-5 login mb-2 text-center" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#password_confirmation').focusout(function() {
            $(this).val($(this).val().trim());
            var confirm_password = $(this).val();
            var password = $('#password').val();
            if(password === '' || password === null || $(this).val() === null || $(this).val() === '') {
                return 0;
            }

            if(password === confirm_password) {
                return 0;
            }
            swal('Password Mismatch', '', 'error');
            $(this).val('');
        })
        $('#password').focusout(function() {
            $(this).val($(this).val().trim());
            var password = $(this).val();
            var confirm_password = $('#password_confirmation').val();
            if(confirm_password === '' || confirm_password === null || $(this).val() === null || $(this).val() === '') {
                return 0;
            }
            if(password === confirm_password) {
                return 0;
            }
            swal('Password Mismatch', '', 'error');
            $(this).val('');
        })  
    })
</script>
@endsection