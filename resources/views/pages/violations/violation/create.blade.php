@extends('../../../layouts.violation')

@section('title','Create Violation')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
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
                    {{-- <input type="text" class="form-input" name="category_no" id="category_no"> --}}
                    <select name="category_no" id="category_no" class="input-select">
                        <option value="">Select Category</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="violation-create-form-footer">
                    <button type="submit" class="button w-3 text-center">Submit</button>
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