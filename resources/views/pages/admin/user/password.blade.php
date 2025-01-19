@extends('../../layouts.admin')

@section('title','Update user password')

@section('admin-content')
    <div class="change-password">
        <div class="change-password-header">
            <h1>Update Password</h1>
        </div>
        <div class="change-password-body">
            <form action="{{route('update_password', $id)}}" method="POST" class="change-password-form">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id" value="{{$id}}">
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" id="password" name="password" class="form-input">
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="" class="form-input">
                </div>
                <div class="change-password-form-footer">
                    <button class="button w-5 text-center" type="submit">Update Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('logout')}}">
        Log out
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#user-menu-item').css('background-color', '#62B485');
            $('#confirm_password').focusout(function() {
                var confirm_password = $(this).val();
                var password = $('#password').val();
                if(checkLength(confirm_password) === false) {
                    swal('Password should have more than 12 characters', '', 'error');
                    return 0;
                }
                if(password === '' || password === null || $(this).val() === null || $(this).val() === '') {
                    return 0;
                }

                if(password === confirm_password) {
                    return 0;
                }
                if(checkIfMatch(password, confirm_password)) {
                    swal('Password Mismatch', '', 'error');
                }
                swal('Password Mismatch', '', 'error');
                $(this).val('');
            })
            $('#password').focusout(function() {
                var password = $(this).val();
                var confirm_password = $('#confirm_password').val();
                if(checkLength(password) === false) {
                    swal('Password should have more than 12 characters', '', 'error');
                    return 0;
                }
                if(confirm_password === '' || confirm_password === null || $(this).val() === null || $(this).val() === '') {
                    return 0;
                }
                if(password === confirm_password) {
                    return 0;
                }
                if(checkIfMatch(password, confirm_password)) {
                    swal('Password Mismatch', '', 'error');
                }
                $(this).val('');
            })
        })
        function checkLength(str) {
            if(str.length < 12) {
                return false;
            }

            return true
        }

        function checkIfMatch(str1, str2) {
            if(str1 === str2) {
                return true;
            }

            return false;
        }
    </script>
@endsection