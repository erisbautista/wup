@extends('../../../layouts.violation')

@section('title','Update Violation')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
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
                    {{-- <input type="text" class="form-input" value="{{$violation->category_no}}" name="category_no" id="category_no"> --}}
                    <select name="category_no" id="category_no" value="{{$violation->category_no}}" class="input-select">
                        <option value="">Select Category</option>
                        <option value="1" selected="{{ $violation->category_no === "1" ? 'selected' : '' }}">1</option>
                        <option value="2" selected="{{ $violation->category_no === "2" ? 'selected' : '' }}">2</option>
                        <option value="3" selected="{{ $violation->category_no === "3" ? 'selected' : '' }}">3</option>
                    </select>
                </div>
                <div class="violation-create-form-footer">
                    <button class="button w-3 text-center">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('violation_index')}}">
        Back
    </a>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#category_no').select2({
            minimumResultsForSearch: Infinity
        });
    });
</script>
@endsection