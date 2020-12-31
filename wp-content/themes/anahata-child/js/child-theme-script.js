jQuery(document).ready(function ($) {
    $('#course_request').on('click', function () {
        $('body').addClass('no-scroll');
        $('.overlay').fadeIn();
        $('.form-request-container').fadeIn();
    });
    $('.close').on('click', function () {
        $('body').removeClass('no-scroll');
        $('.overlay').fadeOut();
        $('.form-request-container').fadeOut();
    });

    $(document).click(function (e) {
        var $tgt = $(e.target);
        if (!$tgt.closest(".form-request-container").length && !$tgt.closest("#course_request").length) {
            $('body').removeClass('no-scroll');
            $('.overlay').fadeOut();
            $('.form-request-container').fadeOut();
        }

    });

});

//tabs script


jQuery(document).ready(function ($) {

    $('section.days h4').click(function (event) {
        event.preventDefault();
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
    });


    $(window).resize(function () {
        tabParentHeight();
    });

    $(document).resize(function () {
        tabParentHeight();
    });
    tabParentHeight();


});
