@extends('../../../layouts.admin')

@section('title','Exam')

@section('admin-content')
    <div class="user">
        <div class="user-header">
            <a href="{{ route('exam')}}" class="button w-2 text-center button-new">New</a>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="table cell-border compact stripe" id="admin-table">
                    @csrf
                    <thead>
                        <tr class="table-header">
                            <th>#</th>
                            <th>Exam Name</th>
                            <th>Strand</th>
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
        $('#exam-menu-item').css('background-color', '#62B485');
        $("#admin-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_exam') }}",
            columns: [
                { data: 'DT_RowIndex', "searchable":false },
                { data: "name", name: "name" },
                { data: "strand", name: "strand" },
                { data: "created_at", name: "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],            
        });

        $('#admin-table').on('click', '#updateExam', function () {
            let id = $(this).data('id');
            window.location.href = "/exam/" + id
        });

        $('#admin-table').on('click', '#viewExam', function () {
            let id = $(this).data('id');
            window.location.href = "/exam/preview/" + id
        });
    });

    function deleteExam(id) {
        var url = "{{ route('delete_exam', 'id') }}";
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
