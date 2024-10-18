@extends('../../layouts.admin')

@section('title','History')

@section('admin-content')
    <div class="user">
        <div class="violation-header">
            <h1>Record History</h1>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="table cell-border compact stripe" id="admin-table">
                    @csrf
                    <thead>
                        <tr class="table-header">
                            <th>#</th>
                            <th>Table Name</th>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#history-menu-item').css('background-color', '#62B485');
            $("#admin-table").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin_history') }}",
                columns: [
                    { data: 'id', "searchable":false },
                    { data: "table_name", name: "table_name" },
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
