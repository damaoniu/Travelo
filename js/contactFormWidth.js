
//Control the contactform width
jQuery(document).ready(function ($) {


    //home
    if ($('.filterForm').length == 0) {
        $('.latestPost').css('margin', '7px auto 0 auto');
    }
    //home
    var mapExist = $('.mapView').length;

    if (mapExist == 0) {
        $('.contactForm').css({
            "width": "100%",
            "float": "none",
            "margin-top": "0"
        });

        $('.contactInputFields').css("width", "200px");
        $('.contactText').css({
            "min-width": "910px",
            "max-width": "910px"
        });

        $('.firstContactinfo').css("width", "420px");
        $('.secondContactinfo').css("width", "420px");

    }

    var SideBar = $('.tags').length;
    if (SideBar == 0) {

        if ($('.contentDefault').length == 1) {
            $('.contentDefault').removeClass().addClass('mainContent');
        }

        if ($('.singleCommentHeader').width() == 620) {
            $('.singlepostContent').css("width", '100%');
            $('.singlepostContent').css('margin', '0 0 0 0');
            $('.singleCommentHeader').css("width", '100%');
            $('.singleCommentBody').css("width", '100%');
            $('.reviewForm').css("width", '100%');
            $('.writeCommentSingle').css('max-width', '875px');
            $('.writeCommentSingle').css('min-width', '875px');
        }
        if ($('.content').width() == 630) {
            $('.content').css('margin', '0 0 0 0');
            $('.content').css("width", '960px');
            $('.contentPages').css("width", '945px');
            $('.pageNrBtn').css('margin-right', '32px');
        }
    }

    //tabs on tour
    if ($('.tabHolder').length == 1) {
        $('.tabs').css('width', '940px');
    }
});
