


jQuery(document).ready(function ($) {

 $( "#from" ).datepicker({
      defaultDate: "+1w",
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
    $("#tripBy").datepicker({
      defaultDate: "+1w",
      numberOfMonths: 1
    });
/***********************
date picker from others
************************/
    var activeDates = ["2012-6-16","2012-6-19","2012-6-29","2012-6-25","2012-7-5","2012-7-10"];
    var daysRange = 5;

    function assignCalendar(id){
    $('<div class="calendar" />')
    .insertAfter( $(id) )
    .multiDatesPicker({ 
    addDates: activeDates,
    dateFormat: 'yy-mm-dd', 
    minDate: new Date(), 
    maxDate: '+1y', 
    altField: id, 
    firstDay: 1,
    showOtherMonths: true 
    }).prev().hide();
    }          

    assignCalendar('#date_departure');

/*******************************************************
email and phone numerb regular expression and validation
And retrieve the information of the chosen cities in the 
customizaiton section
*********************************************************/
var email_reges = '^[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9]@[a-z0-9][a-z0-9_\.-]{0,}[a-z0-9][\.][a-z0-9]{2,4}$';
var phone_reges= "^[01]?[- .]??[2-9]\d{2}?[- .]?\d{3}[- .]?\d{4}$";

$("#informQuote").click(function(){
      
  var wrongSpot=0;

  if (!$("[name=email]").val().match(email_reges)) {
            $("[name=email]").css("border", "solid #d91a2c 1px");
            wrongSpot++;
           
          }
  if ($("[name=contactName]").val().length<2) {
            $("[name=contactName]").css("border", "solid #d91a2c 1px");
            wrongSpot++;
           
          }
  
  if ($("[name=schoolName]").val().length<=2) {
            $("[name=schoolName]").css("border", "solid #d91a2c 1px");
            wrongSpot++;
          }


        var recaptchat = $("[name=recaptcha_response_field]").val();
        var challengeFiled = $("[name=recaptcha_challenge_field]").val();
       
    
        if(wrongSpot==0){

            //get the values of form transport and append it to form inform
              $("#transportForm input").each(function(){
                if($(this).attr("type")=="radio" || $(this).attr("type")=="checkbox"){
                  if($(this).is(":checked")){
                    var name = $(this).attr("name");
                    var value = $(this).val();
                    $("#inform").append("<input type = 'hidden' name='"+name+"' value='"+value+"'/>");
                    //alert(name+value);
                  }
                }else{
                  var name = $(this).attr("name");
                  var value = $(this).val();
                  $("#inform").append("<input type ='hidden' name='"+name+"' value='"+value+"'/>");
                }
              });
           
             var report="";
             //get all the chosen activities
              $("#tab_activity .tabcontent").each(function(){
                var city = $(this).attr('id');
                var activity ="";
                $(this).find('input').each(function(){
                  if($(this).is(":checked")){
                  activity = activity +$(this).val()+",";
                  }
                });
                report = report + city+ ":"+activity+";";
              });           
              $("#inform").append("<input type='hidden' name='report' value='"+report+"'/>");
              $("#inform").append("<input type='hidden' name='recaptcha_response_field' value='"+recaptchat+"'/>");
              $("#inform").append("<input type='hidden' name='recaptcha_challenge_field' value='"+challengeFiled+"'/>");

              $("#inform").submit();
              $("#sucessOrFail").bPopup();
          }else{
            $("#fillForm").bPopup({
               easing: 'easeOutBack', //uses jQuery easing plugin
                speed: 450,
                transition: 'fadeIn'
            });
          }

});


$("[name=email],[name=phone],[name=contactName],[name=school]").click(function () {
        if ($(this).css("border", "solid #d91a2c 1px")) {
            $(this).css("border", "solid #e1e1e1 1px");
        }
    });
/*************
Review page
**************/
$('.tabcontent input').on('change',function(){
        var attr =$(this).attr('name');
        //alert(attr);
        var value=$(this).val();
        $("#"+attr+"R").text(value);         
      });  

    // check i don't know about leaving time
    $("[name=unknown]").click(function(){
        if(!$(this).is(":checked")){
          $("#toR").text($("[name=to]").val());
          $("#fromR").text($("[name=from]").val());
        }else{
          $("#toR").text("Don't know");
          $("#fromR").text("Don't know");
        }
    });
    // for cities and activities
      $("#tab_main .tabs li:eq(3)").click(function(){
        if(!$(this).hasClass("current")){
          $('#serviceToggle input').each(function(){
            
            if($(this).is(":checked")){
              var attr =$(this).attr('name');
            //alert(attr);
              var value=$(this).val();
              $("#"+attr+"R").text(value);
            }
          });
          //update the language
          if($("#oth").is(":checked")){
              $("#othLang").show();
            }else{
              $("#othLang").val("").hide();
            }
          //then update the activity options 
          var count=0;
          $("#des_act").html("");
          $("#tab_activity > .tabs li").each(function(){
           
              var city = $(this).text();
              var activities="<div class='row'> <h6>"+city+"</h6><ul>";
              $("#tab_activity > div:eq("+count+") input").each(function(){
                if($(this).is(":checked")){
                 activities = activities +"<li>"+ $(this).val() + "</li>";
               }
              
              });
              activities = activities + "</ul></div>";
              $("#des_act").append(activities);
              count++;
            });
        }
      });
    // for sorting the activities by their subjects
    $("#arts, #culture, #history, #language, #music, #recreation, #science, #show_all, #selected").click(function(){
      
      //change the color when each subject is selected
      $("#tab_subjects li").css("color","#b3ce00");
      $(this).css("color","#a409ba");

      var attr = $(this).attr('id');
      $("#activity_grid > div").each(function(){
        if($(this).css('display')=='block'){
          if(attr == "show_all"){
            $(this).find(".prod_itemNew").show();
          }else if(attr == "selected"){
            $(this).find(".prod_itemNew").hide();
            $(this).find(".prod_itemNew").each(function(){
              if ($(this).find('input').is(":checked")) {
                $(this).show();
              };
            });
          }else{
            $(this).find(".prod_itemNew").hide();
            $(this).find(".prod_itemNew").each(function(){
              if ($(this).attr(attr)==attr) {
                $(this).show();
              };
            });
          }
        }

      });
    });
      //the meal
        // no meal
      $("#noM").change(function(){
        if($(this).is(":checked")){
          $("#breakfast,#lunch,#dinner").find('input').attr("disabled","disabled");
          $("#breakfast,#lunch,#dinner").fadeOut();
          $("#meals li").hide();
          $("#meals").append("<strong id='no_meals'>No Meals</strong>");
        }else{
          $("#breakfast,#lunch,#dinner").find('input').removeAttr("disabled");
          $("#breakfast,#lunch,#dinner").fadeIn();
          $("#no_meals").remove();
          $("#meals li").show();
        }
      });
      // brk, lun, din
      $("#brk,#lun,#din").change(function(){
        var attr = $(this).attr('id');
        if($(this).is(":checked")){
          $("#"+attr+"b").fadeIn();  
        }else{
          $("#"+attr+"b").fadeOut(); 
        }
      });
      //meal chose
      $("#dth, #dtm").change(function(){
        var attr = $(this).attr("id");
        if($(this).is(":checked")){
          var meal = $(this).val();
          $("#meals").append("<li id='b"+attr+"''>"+meal+": <strong><span>Yes</span></strong></li>");
        }else{
          $("#b"+attr).remove();
        } 
      });  
      // other choices about transportation
      $("[name=otherTrans]").change(function(){
        var attr = $(this).attr("id");
        if($(this).is(":checked")){
            var val = $(this).val();
            $("#otherR").append("<span id='b"+attr+"'> "+val+"</span>");
        }else{
            $("#b"+attr).remove();
        }
      });


/******************
Destination page
*******************/
/*
Form submission
*/
$("div.list_item").click(function(){
  $(this).children('form').submit();
});

/********************************************************************************
ajax post from the filter to get the packages
note: that to get the value of the auto complete and select is not that straigth
*********************************************************************************/

$('#filter').click(function(){
  var city=$('[name=city_auto]').val();
  //alert(city);
  if(city.length>0){
  var country = $('#citiesAuto option').filter(function() {  
        return (this.value == city);
    }).attr('country'); 
  
  //alert(country);  
  // now add the input to the form and submit 
  $("#filter_form").append("<input type='hidden' name='country' value='"+country+"'/>");
  
  //alert($("#filterSearcher").html());
  }
  $("#filter_form").submit();

});
/*************************
Customization Page
**************************/
/*toggle other language*/
$("[name=language]").click(function(){
   if($("#oth").is(":checked")){
      $("#othLang").show();
    }else{
      $("#othLang").val("").hide();
    }
    });

/***************************************************************************************************************
    Ajax posting to get the proper Packages according to the cities choosed
    get the selections from the page and post it to a php and process it and return the value back to the page;
****************************************************************************************************************/
  
$("[name=city] input").change(function(e){

  $("#samplePackage").html('');
  var cities ="";

  $("[name=city] input").each(function(){
    if($(this).is(":checked")){
        cities = cities +$(this).val()+":"+$(this).attr("name")+","; 
    }
  }); 

  if($(this).is(":checked")){
      var label = $("label[for='"+$(this).attr('id')+"']").text();
      var city= $(this).val();
      var country =$(this).attr("name");
      var val =$(this).val();

      /* Ajax update of the activity area*/
          $.ajax({
            url:'http://mpoeduc.com/wp-admin/admin-ajax.php',
            type:'POST',
            data:{
              action:'sampleActivity',
              city:city,
              country:country,
            },
            beforeSend:function(){
              $("#"+val+"_content .inner").html("<img id='loader' src='../wp-content/themes/Travelo/images/loader.gif'/>");
            },
            success:function(data){
              $("#"+val+"_content .inner").prepend(data);
              $("#"+val+"_content .inner #loader").remove();
              //update the color of the subjects after each ajax call, set the arts to be selected
              $("#tab_subjects li").css("color","#b3ce00");
              $("#tab_subjects li[id=show_all]").css("color","#a409ba");
              //alert('activity done'); 
            },
            error:function(){
              alert("activity is wrong");
            }
          });
   
       $("#tab_activity > .tabs li").removeClass('current');
       $("#tab_activity > div").css("display","none");
       $("#tab_activity > .tabs").append("<li class=\"current\" id=\""+$(this).val()+"a\"><a hidefocus=\"true\" style=\"outline: none;\" >"+label+"</a></li>");
       $("#tab_activity").append('<div id="'+$(this).val()+'_content" class="tabcontent" style="display: block;"><div class="inner"></div></div>');
   
    //alert(cities);
   
  }
  else{
    $("#"+$(this).val()+"a").remove();
    $("#"+$(this).val()+"_content").remove();
  }
  
}); //end ajax city calling

/**********************************
package filter in Destination page
***********************************/
$('#filter').click(function(){
    var hidden= $("#cityHidden").html();
    $('#filterForm').append(hidden);
    $("#filterForm").submit();
   });


/***********************************
Package filter widget on every page
************************************/
$("#searcherButton").click(function(){
  var city=$('[name=city_auto]').val();
  if(city.length>0){
  var country = $('#citiesAuto option').filter(function() {  
        return (this.value == city);
    }).attr('country'); 
 
  //alert(country);
  // now add the input to the form and submit 
  $("#filterSearcher").append("<input type='hidden' name='country' value='"+country+"'/>");
 
 
  //alert($("#filterSearcher").html());
 }
 var subjects="";
  $("#subjects input").each(function(){
      if($(this).is(":checked")){
        subjects=subjects+$(this).val()+",";
      }
  });
  //alert(subjects);
  if (subjects.length>0) {
    $("#filterSearcher").prepend("<input type='hidden' name='subjects' value='"+subjects+"'/>");
  }
   
 $("#filterSearcher").submit();
});

/**********************************
for destination temporay and activity ajax page
**********************************/
 $("#s_arts, #s_culture, #s_history, #s_language, #s_music, #s_recreation, #s_science, #s_show_all").click(function(){
          
          // update the color of the choosen subject
          $("#tab_subjects li").css("color","#b3ce00");
          $(this).css("color","#a409ba");
          
          var attr = $(this).attr('id');
          attr = attr.split("_");
          attr = attr[1];
          $("#s_activity").each(function(){
              if(attr == "show"){
                $(this).find(".prod_itemNew").show();
              }else{
                $(this).find(".prod_itemNew").hide();
                $(this).find(".prod_itemNew").each(function(){
                  if ($(this).attr(attr)==attr) {
                    $(this).show();
                  };
                });
              }
          });
        });
  /**for single post page*/
  $("#s_arts, #s_culture, #s_history, #s_language, #s_music, #s_recreation, #s_science, #s_show_all").click(function(){
          
          // update the color of the choosen subject
          $("#tab_subjects li").css("color","#b3ce00");
          $(this).css("color","#a409ba");


          var attr = $(this).attr('id');
          attr = attr.split("_");
          attr = attr[1];
          $("#s_activity").each(function(){
              if(attr == "show"){
                $(this).find(".re-item").show();
              }else{
                $(this).find(".re-item").hide();
                $(this).find(".re-item").each(function(){
                  if ($(this).attr(attr)==attr) {
                    $(this).show();
                  };
                });
              }
          });
        });
/***the closing parenthesis of the entire script**/
//to packages
$('#single_to_package').click(function(e){
  window.location($(this).attr('href'));
});
/** the transportation meal part***/
$("#")

});//end of jQuery

