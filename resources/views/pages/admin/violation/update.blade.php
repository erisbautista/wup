@extends('../../../layouts.admin')

@section('title','Update Violation')

@section('admin-content')
    <div class="violation-create">
        <div class="violation-create-header">
            <h1 class="text-uppercase">Update Violation</h1>
        </div>
        <div class="violation-create-body">
            <form action="{{route('update_violation', $violation->id)}}" method="POST" class="violation-create-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="form-label">Violation Name</label>
                    <input type="text" class="form-input" value="{{$violation->name}}" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="category_no" class="form-label">Category No</label>
                    <input type="text" class="form-input" value="{{$violation->category_no}}" name="category_no" id="category_no">
                </div>
                <div class="violation-create-form-footer">
                    <button class="button w-3 text-center">Edit</button>
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