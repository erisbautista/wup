@extends('../layouts.calendar')

@section('title','Calendar')

@section('header')
    <h1>SCHOOL CALENDAR</h1>
@endsection

@section('calendar-content')
    <div class="calendar-home">
        <div class="section mb-2">
            <span class="heading text-center">Current Day</span>
            <div class="activity-wrapper">
                @foreach ($data['current'] as $current)
                    <div class="activity">
                        <div class="activity-date">{{ $current->start_date . ' to ' . $current->end_date }}</div>
                        <div class="activity-title">{{ $current->description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="section">
            <span class="heading text-center">upcoming</span>
            <div class="activity-wrapper">
                @foreach ($data['upcomming'] as $upcomming)
                    <div class="activity">
                        <div class="activity-date">{{ $upcomming->start_date . ' to ' . $upcomming->end_date }}</div>
                        <div class="activity-title">{{ $upcomming->description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('home')}}">
    Main Menu
</a>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#activity-menu-activity').css('background-color', '#62B485');
    });
</script>
@endsection