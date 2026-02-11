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

$(".login_btn").on('click', function() {
  $(".login_btn").addClass("d-none");
  $(".loading_btn").removeClass("d-none");

});

$("#email, #password").on('input', function() {
    $(".login_btn").removeClass("d-none");
    $(".loading_btn").addClass("d-none");

});

