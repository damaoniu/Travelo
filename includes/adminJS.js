jQuery(document).ready(function ($) {
    $('.checkAll').click(function () {
        if ($('.checkAll').prop('checked')) {
            $('.checkBook').prop('checked', true);
        }
        else {
            $('.checkBook').prop('checked', false);
        }
    });
});


