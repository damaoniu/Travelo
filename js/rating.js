jQuery(document).ready(function ($) {

    if (typeof tourRate === 'undefined') return false;

    $('.ratingStars').raty({ readOnly: true, score: tourRate });
    $(".stars").raty();
    $('.starsRated').raty({ readOnly: true, score: function () {
        return $(this).attr('data-score');
    }
    });

    //reviewes
    $('.reviewsBody').hide();

    var opend = false;

    $('.reviewIcon').click(function () {

        if (opend) {
            $('.reviewsBody').slideUp();
            opend = false;
        }
        else {
            $('.reviewsBody').slideDown();
            opend = true;
        }
    });


});


