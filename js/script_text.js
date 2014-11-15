jQuery(document).ready(function ($) {


    // animates (slides down) in Travels and Search
        if ($("div#SlideDown").length) {
            $('html, body').animate({
                scrollTop: $("div#SlideDown").offset().top - 120
            }, 1000);
        }

    $('.latestPost p').hide();
    $('.latestPost p').eq(0).fadeIn(2000);

    $('.latestOffers p').hide();
    $('.latestOffers p').eq(0).fadeIn(2000);

    jQuery.fn.timer = function () {
        if (!$(this).children("p:last-child").is(":visible")) {
            $(this).children("p:visible")
				.css("display", "none")
				.next("p").fadeIn(2000);
        }
        else {
            $(this).children("p:visible")
				.css("display", "none")
			.end().children("p:first")
				.fadeIn(2000);
        }
    }

    window.setInterval(function () {
        $(".latestPost").timer();
        $(".latestOffers").timer();
    }, 5000);
});