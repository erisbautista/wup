@extends('../../../layouts.admin')

@section('title','Update Violation')

@section('admin-content')
    <div class="violation-create">
        <div class="violation-create-header">
            <h1 class="text-uppercase">Update Violation</h1>
        </div>
        <div class="violation-create-body">
            <form action="" class="violation-create-form">
                <div class="form-group">
                    <label for="name" class="form-label">Violation Name</label>
                    <input type="text" class="form-input" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="name" class="form-label">Category No</label>
                    <input type="text" class="form-input" name="name" id="name">
                </div>
                <div class="violation-create-form-footer">
                    <button class="button w-3 text-center">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
