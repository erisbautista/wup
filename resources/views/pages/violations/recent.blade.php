@extends('../../layouts.violation')

@section('title','Recent Violation')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="violation-recent">
        <h1 class="d-block">RECENT VIOLATIONS</h1>
        <div class="violation-content">
            <div class="recent-table-wrapper">
                <table class="display" id="admin-table">
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>Violation</th>
                            <th>Violation Date</th>
                        </tr>
                    </thead>
                </table>
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
    document.addEventListener("DOMContentLoaded", function () {
        $('#recent-violation-menu').css('background-color', '#62B485');
        $("#admin-table").DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            scrollY: '25rem',
            ajax: "{{ route('user_violation_recent') }}",
            columns: [
                { data: "username", name: "username" },
                { data: "violation", name: "violation" },
                { data: 'created_at', name: 'created_at'}
            ],
            
        });
    });
</script>
@endsection