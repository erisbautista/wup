@extends('../layouts.calendar')

@section('title','test')

@section('header')
    <h1>SCHOOL CALENDAR</h1>
@endsection

@section('calendar-content')
    <div class="calendar-home">
        <div class="section mb-2">
            <span class="heading text-center">Current Day</span>
            <div class="activity-wrapper">
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
            </div>
        </div>
        <div class="section">
            <span class="heading text-center">upcoming</span>
            <div class="activity-wrapper">
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
                <div class="activity">
                    <div class="activity-date">xxxxxxxx</div>
                    <div class="activity-title">xxxxxxxx</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
<a class="button w-5 text-center" href="{{ route('logout')}}">
    Log out
</a>
@endsection