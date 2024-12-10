@extends('../../layouts.admin')

@section('title','Create User')

@section('admin-content')
    <div class="create-user">
        <div class="create-user-header">
            <h1 class="text-uppercase">Create new User</h1>
        </div>
        <div class="create-user-body">
            <form action="/user" method="POST" class="user-create-form">
                @csrf
                <div class="user-details">
                    <h1>User Information</h1>
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" :onfocusout="trimInput()" name="first_name" class="form-input" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-input" placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" id="level" name="level" class="form-input" placeholder="Enter level">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-input" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Role</label>
                        <select name="role_id" id="role" class="input-select">
                            <option value="1">Admin</option>
                            <option value="2">Student</option>
                            <option value="3">Teacher</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-input">
                    </div>
                </div>
                <div class="parent-details">
                    <h1>Parent Information</h1>
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="parent_first_name" name="parent_first_name" class="form-input" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="parent_middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="parent_middle_name" name="parent_middle_name" class="form-input" placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                        <label for="parent_last_name" class="form-label">Last Name</label>
                        <input type="text" id="parent_last_name" name="parent_last_name" class="form-input" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="parent_email" class="form-label">Email</label>
                        <input type="email" id="parent_email" name="parent_email" class="form-input" placeholder="Enter email">
                    </div>
                </div>
                <button class="button w-2 text-center create-user-button" type="submit">Submit</button>
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
            $('#confirm_password').focusout(function() {
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
                var password = $(this).val();
                var confirm_password = $('#confirm_password').val();
                if(confirm_password === '' || confirm_password === null || $(this).val() === null || $(this).val() === '') {
                    return 0;
                }
                if(password === confirm_password) {
                    return 0;
                }
                swal('Password Mismatch', '', 'error');
                $(this).val('');
            });

            $('#role').on('change', function() {
                console.log('role changed');
            })

            $('#username').focusout(function() {
                $(this).val($(this).val().trim());
                if($(this).val() === null) {
                    return 0;
                }
                var username = $(this).val();
                var url = "{{ route('check_username') }}";
                var token = document.getElementsByName("_token")[0].value;
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                            "_method": 'POST',
                            "username": username,
                            "_token": token,
                    },
                    dataType: 'JSON',
                    success: function (data)
                    {
                        if (data['success'] !== true) {
                            swal(data['message'], '', 'error');
                            $('#username').val('')
                        }
                    }
                });
            });

            $('.user-create-form').submit(function(event) {
                var errors = 0;
                $(".user-create-form input").map(function(){
                    $(this).val($(this).val().trim());
                    if( !$(this).val() || $(this).val() === null) {
                        $(this).addClass('warning');
                        errors++;
                    } else if ($(this).val()) {
                        $(this).removeClass('warning');
                    }   
                });
                if(errors > 0){
                    swal('All fields is required', '', 'error');
                    event.preventDefault();
                }
            })
        })
    </script>
@endsection