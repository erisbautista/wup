@extends('../../../layouts.admin')

@section('title','Activity')

@section('admin-content')
    <div class="user">
        <div class="user-header">
            <a href="{{ route('create_activity_view')}}" class="button w-2 text-center button-new">New</a>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="display" id="admin-table">
                    @csrf
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created by</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <a class="button w-5 text-center" href="{{ route('logout')}}">
        Log out
    </a>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
        $('#activity-menu-item').css('background-color', '#62B485');
        $("#admin-table").DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollY: '30rem',
            ajax: "{{ route('admin_activity') }}",
            columns: [
                { data: 'DT_RowIndex', "searchable":false },
                { data: "description", name: "description" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "user_id", name: "user_id" },
                { data: "created_at", name: "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        $('#admin-table').on('click', '#updateActivity', function () {
            let id = $(this).data('id');
            window.location.href = "/activity/" + id
        });
    });
    function deleteActivity(id)
        {
            var url = "{{ route('delete_activity', 'id') }}";
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
                    swal('Success', 'Successfully deleted', 'sucess')
                    window.location.reload()
                }
            });
        }
    </script>
@endsection
