@extends('../../../layouts.admin')

@section('title','Violations')

@section('admin-content')
    <div class="user">
        <div class="user-header">
            <a href="{{ route('create_violation_view')}}" class="button w-2 text-center button-new">New</a>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="display" id="admin-table">
                    @csrf
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Violation Name</th>
                            <th>Category No</th>
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
        $('#violation-menu-item').css('background-color', '#62B485');
        $("#admin-table").DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollY: '30rem',
            ajax: "{{ route('admin_violation') }}",
            columns: [
                { data: 'DT_RowIndex', "searchable":false },
                { data: "name", name: "name" },
                { data: "category_no", name: "category_no" },
                { data: "created_at", name: "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        $('#admin-table').on('click', '#updateViolation', function () {
            let id = $(this).data('id');
            window.location.href = "/violation/" + id
        });
    });
    function deleteViolation(id)
        {
            var url = "{{ route('delete_violation', 'id') }}";
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
