jQuery(document).ready(function ($) {

// tabs  
	$(".tabs li").live("click",function (e) {
	  var indexi = $(this).index();

	   var ID = $(this).parent().parent().attr('id');
		
		$('#' + ID).children('ul').children('li').removeClass('current');
        $('#' + ID).children('ul').children().eq(indexi).addClass('current');
        $('#' + ID).children('div.tabcontent').hide();
        $('#' + ID).children('div.tabcontent').eq(indexi).show();
    
    });


//the button that tunrs to the next page in the  tabsBody
 
    $("button#nextButton").click(function(){
        var index3=$('#tab_main').children('ul').find('.current').index();
      $("#tab_main").children('ul').children().eq(index3+1).trigger('click');
    });

    $("button#prevButton").click(function(){
        var index3=$('#tab_main').children('ul').find('.current').index();
        $("#tab_main").children('ul').children().eq(index3-1).trigger('click');
    });

// the edit button that brings to respective tabs
    $("#quote_review .btn_big").click(function(){
        var id = $(this).attr('id');
        //alert(id);
        var strs = id.split("_");
        var number = strs[1];
        $("#tab_main").children('ul').children().eq(number-1).trigger('click');

    });

// toggle the choices in the transportation section of customization
    //option 1
    $("#serviceToggle .col_1_3 h3").click(function(){
       
       if($(this).hasClass("active")){
        $(this).removeClass("active");
        $("#serviceToggle .col_1_2 .row").hide();
       }else{
        $("#serviceToggle .col_1_3 h3").removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("#serviceToggle .col_1_2 .row").hide();
        $("#serviceToggle .col_1_2 .row").eq(index).show();
       }
    });

    //option two
    /*$("#serviceToggle .col_1_3 h3").click(function(){
       $(this).toggleClass("active");
       var index = $(this).index();
        if($(this).hasClass("active")){
           $("#serviceToggle .col_1_2 .row").eq(index).show();
        }else{
           $("#serviceToggle .col_1_2 .row").eq(index).hide();
        }
    });*/
/*
  prevent form submitting by enter key
*/
    /*$(window).keydown(function(event){
    if(event.keyCode == 13) {

      event.preventDefault();
      //$(this).closest("form").submit();
      return false;
    }
  });*/



});// end Jquery
