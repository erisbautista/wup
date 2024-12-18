@extends('../../layouts.admin')

@section('title','Create User')

@section('admin-content')
    <div class="create-user">
        <div class="create-user-header">
            <h1 class="text-uppercase">Create new User</h1>
        </div>
        <form action="/user" method="POST" class="user-create-form">
            <div class="create-user-body">
                <h1>User Information</h1>
                <div class="user-details">
                    @csrf
                    <div class="form-group">
                        <label for="first_name" class="form-label required">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-input" placeholder="Enter first name">
                    </div>
                    <div class="form-group margin-top-3">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-input" placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label required">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-input" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="level" class="form-label required">Level</label>
                        <input type="text" id="level" name="level" class="form-input" placeholder="Enter level">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label required">Username</label>
                        <input type="text" id="username" name="username" class="form-input" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label required">Role</label>
                        <select name="role_id" id="role" class="input-select">
                            <option value="1">Admin</option>
                            <option value="2">Student</option>
                            <option value="3">Teacher</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="button w-2 text-center create-user-button" type="submit">Submit</button>
        </form>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('logout')}}">
        Log out
    </a>
@endsection

@section('scripts')
    <script>
        var parent_details_fields = `<div class="parent-details">
                    <h1>Parent Information</h1>
                    <div class="form-group">
                        <label for="first_name" class="form-label required">First Name</label>
                        <input type="text" id="parent_first_name" name="parent_first_name" class="form-input" placeholder="Enter first name">
                    </div>
                    <div class="form-group margin-top-3">
                        <label for="parent_middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="parent_middle_name" name="parent_middle_name" class="form-input" placeholder="Enter middle name">
                    </div>
                    <div class="form-group">
                        <label for="parent_last_name" class="form-label required">Last Name</label>
                        <input type="text" id="parent_last_name" name="parent_last_name" class="form-input" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="parent_email" class="form-label required">Email</label>
                        <input type="email" id="parent_email" name="parent_email" class="form-input" placeholder="Enter email">
                    </div>
                </div>`;
        $(document).ready(function() {
            $('#user-menu-item').css('background-color', '#62B485');
            $('#role').on('change', function() {
                let role = $('#role').val();
                if( role !== '2') {
                    $('.parent-details').remove();
                    return 0;
                }
                $('.create-user-body').append(parent_details_fields);
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
                    if((!$(this).val() || $(this).val() === null) && (($(this).attr('name') === 'middle_name' || $(this).attr('name') === 'parent_middle_name') === false)) {
                        $(this).addClass('warning');
                        errors++;
                    } else if ($(this).val()) {
                        $(this).removeClass('warning');
                    }   
                });
                if(errors > 0){
                    event.preventDefault();
                    swal('All fields is required', '', 'error');
                }
            })
        })
    </script>
@endsection