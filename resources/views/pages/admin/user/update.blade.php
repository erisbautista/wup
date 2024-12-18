@extends('../../layouts.admin')

@section('title','Update user')

@section('admin-content')
    <div class="create-user">
        <div class="create-user-header">
            <h1>Update User Information</h1>
        </div>
        <form action="{{route('update_user', $user->id)}}" method="POST" class="user-create-form">
            <div class="create-user-body">
                <h1>User Information</h1>
                <div class="user-details">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="first_name" class="form-label required">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{$user->first_name}}" class="form-input">
                    </div>
                    <div class="form-group margin-top-3">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" value="{{$user->middle_name}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label required">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{$user->last_name}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="level" class="form-label required">Level</label>
                        <input type="text" id="level" name="level" value="{{$user->level}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label required">Email</label>
                        <input type="email" id="email" name="email" value="{{$user->email}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" readonly disabled value="{{$user->username}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label required">Role</label>
                        <select name="role_id" id="role" value="{{$user->role_id}}" class="input-select">
                            <option value="1" {{$user->role_id === 1 ? 'selected="selected"' : ''}}>Admin</option>
                            <option value="2" {{$user->role_id === 2 ? 'selected="selected"' : ''}}>Student</option>
                            <option value="3" {{$user->role_id === 3 ? 'selected="selected"' : ''}}>Teacher</option>
                        </select>
                    </div>
                </div>
                @if ($user->role_id === 2)
                <div class="parent-details">
                    <h1>Parent Information</h1>
                    <div class="form-group">
                        <label for="first_name" class="form-label required">First Name</label>
                        <input type="text" id="parent_first_name" name="parent_first_name" value="{{$user->parent === null ? '' : $user->parent->first_name}}" class="form-input">
                    </div>
                    <div class="form-group margin-top-3">
                        <label for="parent_middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="parent_middle_name" name="parent_middle_name" value="{{$user->parent === null ? '' : $user->parent->middle_name}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="parent_last_name" class="form-label required">Last Name</label>
                        <input type="text" id="parent_last_name" name="parent_last_name" value="{{$user->parent === null ? '' : $user->parent->last_name}}" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="parent_email" class="form-label required">Email</label>
                        <input type="email" id="parent_email" name="parent_email" value="{{$user->parent === null ? '' : $user->parent->email}}" class="form-input">
                    </div>
                </div>
                @endif
            </div>
            <button class="button w-2 text-center create-user-button" type="submit">Edit</button>
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
                console.log(errors);
                if(errors > 0){
                    swal('All fields is required', '', 'error');
                    event.preventDefault();
                }
            })
        })
    </script>
@endsection