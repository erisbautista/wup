@extends('../../layouts.violation')

@section('title','Violation Record')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="violation-record">
        <h1 class="d-block">STUDENT RECORDS</h1>

        <form class="violation-record-form">
            @csrf
            <div class="form-group mr-2 violation-record-form-input">
                <label for="id_number" class="form-label">Student:</label>
                <select name="user_id" id="user_id" class="input-select">
                    <option value="">Select user</option>
                    @foreach($users as $user)
                        <option value="{!!$user->id!!}">{{ $user->first_name . ' ' . $user->middle_name .' ' . $user->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-footer">
                <button onclick="submitForm()" type="button" class="button">Enter</button>
            </div>
        </form>
        
        <div class="violation-content">
            <div class="name">
                <span>Name: </span> <span id="student-name"></span>
            </div>
            <div class="level">
                <span>Level: </span> <span id="student-level"></span>
            </div>
            <div class="remarks">
                <span>Remarks: </span> <span id="student-remarks"></span>
            </div>
            <div class="violations">
                <span>Violations:</span>
                <div class="table-wrapper">
                    <table class="table" id="admin-table">
                        <thead class="table-header">
                            <tr>
                                <th>Violation</th>
                                <th>Violation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('user_violation')}}">
    back
</a>
@endsection

@section('script')
<script>
    var datatables = $("#admin-table").DataTable();
    document.addEventListener("DOMContentLoaded", function () {
        $('#record-violation-menu').css('background-color', '#62B485');
        $('#user_id').select2();

        $('#admin-table').on('click', '#updateViolation', function () {
            let id = $(this).data('id');
            window.location.href = "/user/violation/update/" + id
        });
    });
    function submitForm(){
        var id = $('#user_id').val();
        if(id.length === 0)
        {
            swal('Please select a user first', '', 'info');
            return 0;
        }
        var url = "{{ route('user_violation_record_search') }}";
        var token = document.getElementsByName("_token")[0].value;
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                    "user_id": id,
                    "_method": 'post',
                    "_token": token,
            },
            dataType: 'JSON',
            success: function (data)
            {
                if (data.data.length > 0) {
                    let user = data.data[0]['user']
                    $('#student-name').html(user['first_name'] + ' ' + user['middle_name'] + ' ' + user['last_name'])  
                    $('#student-level').html(user['level'])
                    data.data.length >= 3 ? $('#student-remarks').html('For Suspension') : $('#student-remarks').html('N/A')
                }
                $("#admin-table").DataTable({
                    destroy: true,
                    data: data.data,
                    columns: [
                        { data: "violation", name: "violation" },
                        { data: 'created_at', name: 'created_at'},
                        { data: 'action', name: 'action', "searchable":false}
                    ],
                });
            }
        });
    }
</script>
@endsection