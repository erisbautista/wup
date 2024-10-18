@extends('../../../layouts.admin')

@section('title','Create Activity')

@section('style')
    
@endsection

@section('admin-content')
    <div class="violation-create">
        <div class="violation-create-header">
            <h1 class="text-uppercase">Create new Activity</h1>
        </div>
        <div class="violation-create-body">
            <form action="{{ route('create_activity') }}" method="POST" id="history-form" class="violation-create-form">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Start Date</label>
                    <input class="form-input" type="date" name="start_date" id="start_date" placeholder="Select Start Date">
                    {{-- <x-flatpickr id="laravel-flatpickr-start-time" show-time clearable onChange="handleStartDateChange"/> --}}
                </div>
                <div class="form-group" id="date_picker">
                    <label for="" class="form-label">End Date</label>
                    <input class="form-input" type="date" name="end_date" id="end_date" placeholder="Select End Date">
                    {{-- <x-flatpickr id="laravel-flatpickr-end-time" show-time clearable onChange="handleEndDateChange"/> --}}
                </div>
                <div class="form-group">
                    <label for="category_no" class="form-label">Description</label>
                    <textarea class="textarea-input" id="description" name="description" cols="30" rows="10"></textarea>
                </div>
                <div class="violation-create-form-footer">
                    <button onclick="submitForm()" type="button" id='activity-submit' class="button w-3 text-center">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('document').ready(function() {
            var startPicker = flatpickr('input[type="date"]',{
                altInput: true,
                enableTime: true,
                altFormat: "F j, Y H:i K",
                dateFormat: "Y-m-d H:i",
            });
        },);

        function checkDateValid(startDate, endDate) {
            if (startDate > endDate) {
                swal('Invalid Input', 'End date cannot be less than the start date.', 'error');
                return false;
            }
            return true;
        }

        function checkIfFieldEmpty(data, field) {
            if(data === '' || data === null) {
                swal('Invalid Input', field + ' cannot be empty.', 'error');
                return false;
            }
            return true;
        }

        function submitForm() {
            $('#activity-submit').attr('disabled', 'disabled');
            setTimeout(function() {
                $('#activity-submit').removeAttr('disabled');
            }, 1000);
            var endDate = $('#end_date').val();
            var startDate = $('#start_date').val();
            var description = $('#description').val();
            var startDateIsNotEmpty = checkIfFieldEmpty(startDate, 'Start Date');
            var endDateIsNotEmpty = checkIfFieldEmpty(endDate, 'End Date');
            var descriptionIsNotEmpty = checkIfFieldEmpty(description, 'Description');
            var validDate = checkDateValid(startDate, endDate);
            if(startDateIsNotEmpty === false || endDateIsNotEmpty === false || descriptionIsNotEmpty === false || validDate === false) {
                console.log('invalid form');
                return 0;
            }
            $('#history-form').submit();
        }
    </script>
@endsection