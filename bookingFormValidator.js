jQuery(document).ready(function ($) {




    var email_reges = '^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$';


    //contact form validation
    $(".contactSendBtn").click(function () {

        var fieldsMissing = 0;

        if ($('#um_contactName').val().length <= 2) {
            $("#um_contactName").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            console.log('Name not good!');
        }
        if (!$("#um_contactEmail").val().match(email_reges)) {
            $("#um_contactEmail").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            console.log('Email not good!');
        }
        if ($("#um_contactComment").val().length == 0) {
            $("#um_contactComment").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            console.log('Comment not good!');
        }
        if (fieldsMissing == 0) {
            $(this).closest('form').submit();
        }
    });

    $("#um_contactEmail").click(function () {
        if ($("#um_contactEmail").css("border", "solid #d91a2c 1px")) {
            $("#um_contactEmail").css("border", "solid #e1e1e1 1px");
        }
    });
    $("#um_contactName").click(function () {
        if ($("#um_contactName").css("border", "solid #d91a2c 1px")) {
            $("#um_contactName").css("border", "solid #e1e1e1 1px");
        }
    });
    $("#um_contactComment").click(function () {
        if ($("#um_contactComment").css("border", "solid #d91a2c 1px")) {
            $("#um_contactComment").css("border", "solid #e1e1e1 1px");
        }
    });

    $(".reviewResetBtn").click(function() {
        $(".contact input").css("border", "solid #e1e1e1 1px");
    });

    //booking form validation

    if (typeof array === 'undefined') return false;

    jQuery.each(array, function (index, item) {
        var currentItem = $('#' + item);
        currentItem.click(function () {
            if (currentItem.css('background', 'red')) {
                currentItem.css('background', '#f7f7f7');
            }
        });
    });
    //booking form validation
    $('.bookFormBtnSubmit').click(function () {
        var count = array.length;
        jQuery.each(array, function (index, item) {
            var currentItem = $('#' + item);
            if (currentItem.val().length == 0) {
                currentItem.css("background", "red");
            }
            else {
                if (currentItem.attr('Type') == 'text' && currentItem.val().length <= 2) {
                    currentItem.css("background", "red");
                    console.log('text must be more than two values long!');
                }
                else if (currentItem.attr('Type') == 'num' && currentItem.val() == 0) {
                    currentItem.css("background", "red");
                    console.log('number must be more than 0!');
                }
                else if (currentItem.attr('Type') == 'datePick' && !(currentItem.val().length == 10)) {
                    currentItem.css("background", "red");
                    console.log('date not good!');
                }
                else if ((currentItem.attr('Type') == 'tel') && (currentItem.val().length < 6)) {
                    currentItem.css("background", "red");
                    console.log('Tel not good!');
                }
                else if (currentItem.attr('Type') == 'email' && !(currentItem.val().match(email_reges))) {
                    currentItem.css("background", "red");
                    console.log('Email not good!');
                }
                else {
                    count--;
                    if (count == 0) {
                        if ($("#um_checkTerms").attr('checked')) {
                            jQuery('#submitFBooking').submit();
                        }
                        else {
                            console.log("Please check the terms and condicions")
                        }
                    }
                }
            }

        });

    });


    // 	TERMS AND CONDITIONS POPUP
    jQuery('#terms').click(function () {
        jQuery('.termsAndConditions').bPopup(
        /*{
        easing: 'easeOutBack', //uses jQuery easing plugin
        speed: 450,
        transition: 'slideDown'
        }*/
    );
    });






});