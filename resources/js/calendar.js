import { Calendar } from "fullcalendar";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    const calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        selectable: true,
        events: [
            {
                title: "event1",
                start: "2024-10-01",
            },
            {
                title: "event2",
                start: "2024-10-05",
                end: "2024-10-07",
            },
            {
                title: "event3",
                start: "2024-10-09T12:30:00",
                allDay: false, // will make the time show
            },
        ],
        eventClick: function (event) {
            alert("event:" + event.event.title);
        },
    });
    calendar.render();
});
