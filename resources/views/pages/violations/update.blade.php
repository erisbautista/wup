@extends('../../layouts.violation')

@section('title','Update Violation')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="register-violation">
        <h1 class="d-block">REGISTER VIOLATION</h1>

        <form action="{{route('user_violation_update', $data['userViolations']->id)}}" method="POST" class="violation-register-form" id="register-user-violation-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_number" class="form-label">Student:</label>
                <input readonly disabled="disabled" type="text" value="{{ $data['userViolations']->user->first_name . ' ' . $data['userViolations']->user->middle_name .' ' . $data['userViolations']->user->last_name }}" class="form-input">
            </div>
            <div class="form-group">
                <label for="violation" class="form-label">Violation:</label>
                <select name="violation_id" id="violation_id" class="input-select color-black">
                    <option value="">Select violation</option>
                    @foreach($data['violations'] as $violation)
                        <option value="{!! $violation->id !!}" {{$data['userViolations']->violation_id === $violation->id ? 'selected="selected"' : null}}>{{ $violation->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Category No.:</label>
                <input readonly disabled="disabled" type="text" value="{{$data['userViolations']->violation->category_no}}" id="category_no" class="form-input">
            </div>
            <div class="form-footer">
                <button onclick="submitForm()" type="button" class="button w-5 text-center">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('user_violation_record')}}">
    back
</a>
@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var data = {!!json_encode($data['violations'])!!}
        $('#record-violation-menu').css('background-color', '#62B485');
        $('#user_id').select2();
        $('#violation_id').select2();

        $('#violation_id').on('select2:select', function (e) {
            var selectedId = parseInt(e.params.data.id);
            if (!selectedId) {
                $('#category_no').val('')
            }

            data.map(function (d) {
                if (d.id === selectedId) {
                    $('#category_no').val(d.category_no)
                }
            })
        });
    });

    function submitForm() {
        $('#activity-submit').attr('disabled', 'disabled');
        setTimeout(function() {
            $('#activity-submit').removeAttr('disabled');
        }, 1000);
        if($('#violation_id').val().length === 0) {
            swal('Please select violation!', '', 'info');
            return 0;
        }

        $('#register-user-violation-form').submit();
    }
</script>
@endsection