@extends('../../../layouts.admin')

@section('title','Create Activity')

@section('style')
    
@endsection

@section('admin-content')
    @include('components.activity');
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

@section('footer')
    <a class="button w-5 text-center" href="{{ route('logout')}}">
        Log out
    </a>
@endsection