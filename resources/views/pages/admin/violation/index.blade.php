@extends('../../../layouts.admin')

@section('title','Violations')

@section('admin-content')
    <div class="user">
        <div class="user-header">
            <a href="{{ route('create_violation_view')}}" class="button w-3 text-center">New</a>
        </div>
        <div class="user-body">
            <div class="user-table-wrapper">
                <table class="table cell-border compact stripe" id="violation-admin-table">
                    @csrf
                    <thead>
                        <tr class="table-header">
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

@section('scripts')
    <script>
        $(document).ready(function () {
        $('#violation-menu-item').css('background-color', '#62B485');
        $("#violation-admin-table").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin_violation') }}",
            columns: [
                { data: 'id', "searchable":false },
                { data: "name", name: "name" },
                { data: "category_no", name: "category_no" },
                { data: "created_at", name: "created_at" },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        
    });
    </script>
@endsection
