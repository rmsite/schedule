$(document).ready(function () {
    $('.timepicker').timepicker({
        timeFormat: 'HH:mm',
        interval: 60,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        startTime: '08:00',
    });
});