@extends('../../../layouts.admin')

@section('title','Create Activity')

@section('style')
@endsection

@section('admin-content')
    <div class="violation-create">
        <div class="violation-create-header">
            <h1 class="text-uppercase">Update Activity</h1>
        </div>
        <div class="violation-create-body">
            <form action="{{ route('update_activity', $activities->id) }}" method="POST" id="history-form" class="violation-create-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="username" class="form-label">Start Date</label>
                    <input class="form-input" type="date" name="start_date" id="start_date" value="{{$activities->start_date}}" placeholder="Select Start Date">
                </div>
                <div class="form-group" id="date_picker">
                    <label for="" class="form-label">End Date</label>
                    <input class="form-input" type="date" name="end_date" id="end_date" value="{{$activities->end_date}}" placeholder="Select End Date">
                </div>
                <div class="form-group">
                    <label for="category_no" class="form-label">Description</label>
                    <textarea class="textarea-input" id="description" name="description" cols="30" rows="10">{{$activities->description}}</textarea>
                </div>
                <div class="violation-create-form-footer">
                    <button onclick="submitForm()" type="button" id='activity-submit' class="button w-3 text-center">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('document').ready(function() {
            flatpickr('input[type="date"]',{
                altInput: true,
                enableTime: true,
                altFormat: "F j, Y H:i K",
                dateFormat: "Y-m-d H:i",
            });
        },);

        function checkDateValid(startDate, endDate) {
            var endDate = new Date(startDate);
            var startDate = new Date(endDate);
            if (startDate > endDate) {
                swal('Invalid Input', 'End date cannot be less than the start date.', 'error');
                instance.clear();
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