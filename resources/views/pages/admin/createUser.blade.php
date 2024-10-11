@extends('../../layouts.admin')

@section('title','Users')

@section('admin-content')
    <div class="create-user">
        <div class="create-user-header">
            <h1>Create new User</h1>
        </div>
        <div class="create-user-body">
            <form action="/user" method="POST" class="user-create-form">
                @csrf
                <div class="user-details">
                    <h1>User Information</h1>
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="middle_name" name="middle_name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="level" class="form-label">Level</label>
                        <input type="text" id="level" name="level" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-input">
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
                        <input type="text" id="parent_first_name" name="parent_first_name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="parent_middle_name" class="form-label">Middle Name</label>
                        <input type="text" id="parent_middle_name" name="parent_middle_name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="parent_last_name" class="form-label">Last Name</label>
                        <input type="text" id="parent_last_name" name="parent_last_name" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="parent_email" class="form-label">Email</label>
                        <input type="email" id="parent_email" name="parent_email" class="form-input">
                    </div>
                </div>
                <button class="button w-2 text-center create-user-button" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection