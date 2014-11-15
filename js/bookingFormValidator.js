jQuery(document).ready(function ($) {
    /*   
    if ($('.bWrapp').length == 1) {
    if ($('.bucketEx').length == 0) {
    $('.bWrapp').append('<div><p>sorry there were no posts</p></div>');

    }
    }
    */

    var email_reges = '^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$';


    //contact form validation
    $("#submitContactBtn").click(function () {
        var fieldsMissing = 0;
        if ($('#um_contactName').val().length <= 2) {
            $("#um_contactName").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            //console.log('Name not good!');
        }
        if ($('#um_company_name').val().length <= 2) {
            $("#um_company_name").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            //console.log('Name not good!');
        }
        if (!$("#um_contactEmail").val().match(email_reges)) {
            $("#um_contactEmail").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            //console.log('Email not good!');
        }
        if ($("#um_contactPhone").val().length == 0) {
            $("#um_contactPhone").css("border", "solid #d91a2c 1px");
            fieldsMissing++;
            //console.log('Comment not good!');
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
    $("#um_company_name").click(function () {
        if ($("#um_company_name").css("border", "solid #d91a2c 1px")) {
            $("#um_company_name").css("border", "solid #e1e1e1 1px");
        }
    });
    $("#um_contactName").click(function () {
        if ($("#um_contactName").css("border", "solid #d91a2c 1px")) {
            $("#um_contactName").css("border", "solid #e1e1e1 1px");
        }
    });
    $("#um_contactPhone").click(function () {
        if ($("#um_contactPhone").css("border", "solid #d91a2c 1px")) {
            $("#um_contactPhone").css("border", "solid #e1e1e1 1px");
        }
    });

    $(".reviewResetBtn").click(function () {
		$(".contact").find("input").each(function () {
			$(this).css("border", "solid #e1e1e1 1px");
			if ($(this).attr("type") == "reset") {
				$(this).css("border", "none");
			}
			if ($(this).attr("type") == "button") {
				$(this).css("border", "none");
			}
		});
		$(".contact").find("textarea").css("border", "solid #e1e1e1 1px");
    });
	
    //booking form validation
	
    if (typeof array === 'undefined') return false;
    jQuery.each(array, function (index, item) {
        var currentItem = $('#' + item);
        
		currentItem.click(function () {

            if ((currentItem.parent().css('border') == '1px solid rgb(217, 26, 44)') && (currentItem.attr('Type') == 'num')) {
          
                currentItem.parent().css("border", "solid #e1e1e1 1px")
            }
            else {

                if(currentItem.attr('Type') != 'num')
                currentItem.css("border", "solid #e1e1e1 1px");
                else
                 currentItem.parent().css("border", "solid #e1e1e1 1px");
            }
        });
    });
    //booking form validation
	
    $('#sendQuote').click(function () {
        var count = array.length;
        jQuery.each(array, function (index, item) {
            var currentItem = $("#" + item);
			
            if (currentItem.val().length == 0) {
                currentItem.css("border", "solid #d91a2c 1px");
            }
            else {
                if (currentItem.attr('Type') == 'text' && currentItem.val().length <= 2) {
                    currentItem.css("border", "solid #d91a2c 1px").addClass("error");
                    //console.log('text must be more than two values long!');
                }
                else if (currentItem.attr('Type') == 'num' && currentItem.val() == 0) {
                    currentItem.parent().css("border", "solid #d91a2c 1px").addClass("error");
                    //console.log('number must be more than 0!');
                }
                else if (currentItem.attr('Type') == 'datePick' && !(currentItem.val().length == 10)) {
                    currentItem.css("border", "solid #d91a2c 1px").addClass("error");
                    //console.log('date not good!');
                }
                else if ((currentItem.attr('Type') == 'tel') && (currentItem.val().length < 6)) {
                    currentItem.css("border", "solid #d91a2c 1px").addClass("error");
                    //console.log('Tel not good!');
                }
                else if (currentItem.attr('Type') == 'email' && !(currentItem.val().match(email_reges))) {
                    currentItem.css("border", "solid #d91a2c 1px").addClass("error");
                    //console.log('Email not good!');
                }
                else {
                    count--;
                    if (count == 0) {
                      
						
							if ($("#um_checkTerms").attr('checked') || $("#um_checkTerms").attr('Type') == 'hidden' ) {
								jQuery('#quoteForm').submit();
                                jQuery('#quotePop').fadeOut();
                                
								return false;
							}
							else {
								$("#terms").css("color", "#d91a2c");
							}
							
                    }
                }
            }

        });
    });
   // terms and condition
    $('#um_checkTerms').click(function () {
        if($(this).is(":checked")){
        $("#terms").css("color", "#565656");
         }
    });
    // reset all fields
    $(".link-reset").click(function () {
        $(".ajax_form :input").each(function () {
            if ($(this).attr('Type') == 'num') {
                $(this).parent().css("border", "solid #e1e1e1 1px");
            }
            else {
                $(this).css("border", "solid #e1e1e1 1px");
            }
            $("#terms").css("color", "#565656");
        });
    });
    
});
// to be known
jQuery(document).ready(function ($) {

    if ($('.bookingContent').length == 1) {
        jQuery('.resultWrapper').css('display', 'none');
    }

    if (typeof booked === 'undefined') return false;
    if (booked) {
        if ($('.bookingContent').length == 1) {
            if ($('.resultWrapper').length == 1) {
                jQuery('.resultWrapper').css(
                {
                    'width': '30%',
                    'border-radius': '2px'
                });
                jQuery('.resultWrapper').bPopup();
                booked = false;
                $('.bookFormBtnReset').trigger('click');
            }
        }
    }
});