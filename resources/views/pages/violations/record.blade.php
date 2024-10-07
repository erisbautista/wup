@extends('../../layouts.violation')

@section('title','test')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="violation-record">
        <h1 class="d-block">STUDENT RECORDS</h1>

        <form class="violation-record-form">
            <div class="form-group mr-2 center-self">
                <label for="id_number" class="form-label">ID Number:</label>
                <input type="text" class="form-input">
            </div>
            <div class="form-footer">
                <button class="button">Enter</button>
            </div>
        </form>
        
        <div class="violation-content">
            <div class="name">
                <span>Name: </span> <span>Pilo Batumbakal</span>
            </div>
            <div class="level">
                <span>Level: </span> <span>Highschool</span>
            </div>
            <div class="remarks">
                <span>Remarks: </span> <span>For Suspension</span>
            </div>
            <div class="violations">
                <span>Violations:</span>
                <div class="table-wrapper">
                    <table class="table">
                        <thead class="table-header">
                            <tr>
                                <th>Violation</th>
                                <th>Violation Date</th>
                            </tr>
                        </thead>
                    <tbody class="table-body">
                        <tr>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 2:07 pm</td>
                        </tr>
                        <tr>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 2:07 pm</td>
                        </tr>
                        <tr>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 2:07 pm</td>
                        </tr>
                        <tr>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 2:07 pm</td>
                        </tr>
                        <tr>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 2:07 pm</td>
                        </tr>
                        <tr>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 2:07 pm</td>
                        </tr>
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('violation')}}">
    back
</a>
@endsection