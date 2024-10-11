@extends('../../../layouts.admin')

@section('title','Create Violation')

@section('admin-content')
    <div class="violation-create">
        <div class="violation-create-header">
            <h1 class="text-uppercase">Create new Violation</h1>
        </div>
        <div class="violation-create-body">
            <form action="{{route('create_violation')}}" method="POST" class="violation-create-form">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Violation Name</label>
                    <input type="text" class="form-input" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="category_no" class="form-label">Category No</label>
                    <input type="text" class="form-input" name="category_no" id="category_no">
                </div>
                <div class="violation-create-form-footer">
                    <button type="submit" class="button w-3 text-center">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
