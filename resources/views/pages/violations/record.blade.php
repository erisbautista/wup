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
                    <table class="dispplay" id="admin-table">
                        <thead>
                            <tr>
                                <th>Violation</th>
                                <th>Status</th>
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
<a class="button w-5 text-center" href="{{ route('logout')}}">
    Log Out
</a>
@endsection

@section('script')
<script>
    var token = document.getElementsByName("_token")[0].value;
    var datatables = $("#admin-table").DataTable();
    document.addEventListener("DOMContentLoaded", function () {
        $('#record-violation-menu').css('background-color', '#62B485');
        $('#user_id').select2();

        $('#admin-table').on('click', '#updateViolation', function () {
            let id = $(this).data('id');
            window.location.href = "/user/violation/update/" + id
        });

        $('#admin-table').on('click', '#completeViolation', function () {
            let id = $(this).data('id');
            completeViolation(id);
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
                    scrollCollapse: true,
                    scrollY: '30rem',
                    data: data.data,
                    columns: [
                        { data: "violation", name: "violation" },
                        { data: 'status', name: 'status'},
                        { data: 'created_at', name: 'created_at'},
                        { data: 'action', name: 'action', "searchable":false}
                    ],
                });
            }
        });
    }

    function completeViolation(id)
        {
            var url = "{{ route('user_violation_complete', 'id') }}";
            var token = document.getElementsByName("_token")[0].value;
            url = url.replace('id', id);
            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                        "id": id,
                        "_method": 'PUT',
                        "_token": token,
                },
                dataType: 'JSON',
                success: function (data)
                {
                    if(data.status === false) {
                        swal('Error', data.message, 'error')
                    }
                    submitForm();
                }
            });
        }
</script>
@endsection