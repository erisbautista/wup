@extends('../../layouts.calendar')

@section('title','test')

@section('header')
    <h1>SCHOOL CALENDAR</h1>
@endsection

@section('calendar-content')
    <div class="calendar-wrapper">
        @if(auth()->user()->role_id === 3)
        <a href="{{ route('calendar_activity')}}" class="button w-2 text-center button-new mb-4">New</a>
        @endif
        <div id="calendar"></div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('calendar')}}">
    back
</a>
@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#activity-menu-calender').css('background-color', '#62B485');
        var activities = {!! json_encode($activities) !!};
        console.log(activities)
        const calendarEl = document.getElementById("calendar");
        const calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            selectable: true,
            eventClick: function (event) {
                moment(event.event.end).format('MMMM DD, YYYY HH:mm') === 'Invalid date' ? swal(moment(event.event.start).format('MMMM DD, YYYY HH:mm'), event.event.title, 'info') : swal(moment(event.event.start).format('MMMM DD, YYYY HH:mm') + ' to ' + moment(event.event.end).format('MMMM DD, YYYY HH:mm'), event.event.title, 'info');
            },
        });
        calendar.addEventSource(activities);
        calendar.render();
    });
</script>
@endsection