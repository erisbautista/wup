@extends('../../layouts.violation')

@section('title','test')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="register-violation">
        <h1 class="d-block">REGISTER VIOLATION</h1>

        <form class="violation-register-form">
            <div class="form-group">
                <label for="id_number" class="form-label">ID Number:</label>
                <input type="text" class="form-input">
            </div>
            <div class="form-group">
                <label for="violation" class="form-label">Violation:</label>
                <input type="text" class="form-input">
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Category No.:</label>
                <input type="text" class="form-input">
            </div>
            <div class="form-footer">
                <a href="#" class="button w-5 text-center">Enter</a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
<button class="button w-5 text-center">
    back
</button>
@endsection