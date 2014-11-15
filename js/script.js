var slides = null;
var slide_delay = 5000;
jQuery(document).ready(function ($) {

    $("div.slide").hide();
    $("div.slide").eq(0).show();
    if (Modernizr.csstransitions) {
        $("div.slide").eq(0).find(".mainText").addClass("mainText_move");
        $("div.slide").eq(0).find(".price").addClass("price_move");
    } else {
        $("div.slide").eq(0).find(".mainText").animate({
            marginLeft: "0px"
        }, 1000, function () {
            $("div.slide").eq(0).find(".price").animate({
                marginLeft: "0px"
            }, 1000);
        });
    }
    slides = $("div.slide");
    setTimeout(function () {
        if ($('div.slide').children().length > 1) {
            nextSlide();
        }
    }, slide_delay);

    $('a .filterBtn').click(function (e) {
        e.preventDefault();
        $('form .filterForm').submit();
    });
});

function nextSlide(){
	var cur_slide = jQuery("div.slide:visible");
	var next_slide = cur_slide.next();

	if(typeof next_slide.get(0) == "undefined"){
		next_slide = jQuery("div.slide").eq(0);
	}
	next_slide.find(".mainText_move").removeClass("mainText_move");
	next_slide.find(".price_move").removeClass("price_move");
	if(!Modernizr.csstransitions){
		next_slide.find(".mainText").css("margin-left","-800px");
		next_slide.find(".price").css("margin-left","1500px");
	}
	cur_slide.fadeOut("normal",function(){
		next_slide.fadeIn("normal",function(){
			if(Modernizr.csstransitions){
			next_slide.find(".mainText").addClass("mainText_move");
			next_slide.find(".price").addClass("price_move");
			}else{				
				next_slide.find(".price");
				next_slide.find(".mainText").animate({
					marginLeft : "0px"
				},1000,function(){
					next_slide.find(".price").animate({
						marginLeft : "0px"
					},1000);
				});
			}
		});
	});
	
	setTimeout(function(){
		nextSlide();
	},slide_delay);
}

//Control the filter width
jQuery(document).ready(function ($) {
	var w = $('.filterWrap').width();
	if (w > 920) {
		$('.filterWrap').css('width', 'auto');
		$('.filterWrap2').css('width', 'auto');
	}
	else {
		$('.filterWrap').css('width', '920');
		$('.filterWrap2').css('width', '920');
	}
});



        // Date Picker
jQuery(function($) {
        $( ".datepicker" ).datepicker();
    });
	
	// bucket slider, bucket hover
	jQuery(document).ready(function ($) {
	
        $('.bucketWrapper').find('.bucket').hover(
			function () { 				
			 $(this).find('.bucketContent').stop().slideDown(500, 
				function() {
					 $(this).parent().find('h5').stop().fadeIn(200);
				});
		}, function() {
				$(this).parent().find('h5').stop().fadeOut('fast');
				$(this).find('.bucketContent').stop().slideUp(200,
					function() {
						$(this).parent().find('h5').css('display', 'none');
					});
			});
    });
	
	
	// masonry
	jQuery(document).ready(function ($) {
		loadMasonry('.content','.bucketBlog');
		loadMasonry('.bWrapp','.bucketEx');
		loadMasonry('.msnrParagraph','.aboutUsBWrapper');
		loadMasonry('.msnrStaff','.aboutUsSWrapper');
		
		function loadMasonry(container, className) {
			var $container = $(container);
			$container.imagesLoaded( function(){
				$container.masonry({
					itemSelector : className,
					isAnimated: true, 
				});
			});
		}
		
	});
	
	// masonry


	
	// header title
	
	jQuery(document).ready(function ($) {
		var imgLength = $('.sliderBg').find('img').length;
		var ancorLength = $('.sliderBg').find('a').length;
		if( (imgLength <= 0) && (ancorLength >= 1) ) {
			$('.slide-content').css('min-height',  '66px');
			$('.slide-content > a').css({ 
						margin:  '20px 0', 
						left: '0'
					});
		}
	});
	
	// header title
	
	// if has revolution slider (responsive)

	jQuery(document).ready(function ($) {
	 var width = jQuery(window).width();
     var bool =	jQuery('.rev_slider_wrapper').length >= 1;
	 if(bool)
	 {
			switch (true) {
				case (width <= 365):
					jQuery('.widgetFilter').css('top', '-20px');
					jQuery('.latestPost').css('margin', '80px auto 0 auto');
				break;
				case (width >= 366 && width <= 645): 
					jQuery('.widgetFilter').css('top', '-20px');
					jQuery('.latestPost').css('margin', '40px auto 0 auto');
				break;
				
				case (width >= 646 && width <= 979): 
					jQuery('.widgetFilter').css('top', '-20px');
					jQuery('.latestPost').css('margin', '-230px auto 0 auto');
				break;
			}
		}
	});
	// if has revolution slider (responsive)
		
		

