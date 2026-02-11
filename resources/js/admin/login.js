import $ from "jquery";

$('.toggle-password').on('click', function () {
    if ($('.password').attr('type') == 'password') {
        $('.password').attr('type', 'text');
    } else {
        $('.password').attr('type', 'password');
    }
});

$('.toggle-confirm-password').on('click', function () {
    if ($('.confirm-password').attr('type') == 'password') {
        $('.confirm-password').attr('type', 'text');
    } else {
        $('.confirm-password').attr('type', 'password');
    }
});
