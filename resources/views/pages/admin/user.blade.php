@extends('../../layouts.admin')

@section('title','Users')

@section('admin-content')
    <div class="user">
        <div class="user-header">
            <a href="{{ route('create_user')}}" class="button w-3 text-center">New</a>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="table cell-border compact stripe" id="user-admin-table">
                    @csrf
                    <thead>
                        <tr class="table-header">
                            <th>#</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#user-menu-item').css('background-color', '#62B485');
        $("#user-admin-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_user') }}",
            columns: [
                { data: 'id', "searchable":false },
                { data: "first_name", name: "first_name" },
                { data: "middle_name", name: "middle_name" },
                { data: "last_name", name: "last_name" },
                { data: "email", name: "email" },
                { data: "username", name: "username" },
                { data: "created_at", name: "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        $('#user-admin-table').on('click', '#updateUser', function () {
            let id = $(this).data('id');
            window.location.href = "/user/" + id
        });

        
    });
    function deleteUser(id)
    {
        var url = "{{ route('delete_user', 'id') }}";
        var token = document.getElementsByName("_token")[0].value;
        url = url.replace('id', id);
        $.ajax({
            url: url,
            method: 'DELETE',
            data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
            },
            dataType: 'JSON',
            success: function ()
            {
                Swal.fire('Success', 'Successfully deleted', 'sucess')
                window.location.reload()
            }
        });
    }
</script>
@endsection