jQuery(document).ready(function ($) {
    $('.commentsBody').hide();
    $('.commentsBody').eq(0).show();

    $(".commentBtn").click(function () {
        var indexi = $(this).index();
        $('.commentsBody:visible').fadeOut("normal", function () {
            $('.commentsBody').eq(indexi).fadeIn("normal");
        });
    });



    $('.travelInformationBody p').hide();
    $('.travelInformationBody p').eq(0).show();
    $(".travelInformationBar span").eq(0).addClass("travelInformationBarClicked");

    $(".travelInformationBar span").click(function () {

        $(".travelInformationBar span").removeClass();
        $(this).addClass('travelInformationBarClicked');

        var indexi = $(this).index();
        $('.travelInformationBody p').hide();
        $('.travelInformationBody p').eq(indexi).fadeIn("normal");

    });

});