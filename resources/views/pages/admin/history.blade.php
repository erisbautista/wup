@extends('../../layouts.admin')

@section('title','History')

@section('admin-content')
    <div class="user">
        <div class="violation-header">
            <h1>Record History</h1>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="display" id="admin-table">
                    @csrf
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Table Name</th>
                            <th>Record Updated</th>
                            <th>Field Update</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Updated By</th>
                            <th>Created Date</th>
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
            $('#history-menu-item').css('background-color', '#62B485');
            $("#admin-table").DataTable({
                processing: true,
                serverSide: true,
                scrollCollapse: true,
                scrollY: '30rem',
                ajax: "{{ route('admin_history') }}",
                columns: [
                    { data: 'DT_RowIndex', "searchable":false },
                    { data: "table_name", name: "table_name" },
                    { data: "record", name: "record" },
                    { data: "field", name: "field" },
                    { data: "from", name: "from" },
                    { data: "to", name: "to" },
                    { data: "user_id", name: "user_id" },
                    { data: "created_at", name: "created_at" },
                ],
                
            });

            $('#admin-table').on('click', '#updateViolation', function () {
                let id = $(this).data('id');
                window.location.href = "/violation/" + id
            });
        });
    </script>
@endsection
