@extends('../../layouts.violation')

@section('title','test')

@section('header')
    <h1>STUDENT VIOLATION TRACKER</h1>
@endsection

@section('violation-content')
    <div class="violation-recent">
        <h1 class="d-block">RECENT VIOLATIONS</h1>
        <div class="violation-content">
            <div class="recent-table-wrapper">
                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <th>ID Number</th>
                            <th>Violation</th>
                            <th>Violation Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-123</td>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-345</td>
                            <td>Category 3, Sexual Offense </td>
                            <td>Oct 1, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-123</td>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-345</td>
                            <td>Category 3, Sexual Offense </td>
                            <td>Oct 1, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-123</td>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-345</td>
                            <td>Category 3, Sexual Offense </td>
                            <td>Oct 1, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-123</td>
                            <td>Category 2, Violence</td>
                            <td>Oct 3, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-345</td>
                            <td>Category 3, Sexual Offense </td>
                            <td>Oct 1, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                        <tr>
                            <td>21-2121-212</td>
                            <td>Category 1, No ID</td>
                            <td>Oct 4, 2024 10:22 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<button class="button w-5 text-center">
    back
</button>
@endsection