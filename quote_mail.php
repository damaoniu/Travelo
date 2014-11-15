<?php
global $wpdb;
function sendQuote(){
  $mailTo=get_option('admin_email');
  $subject=$_POST['tripName']."-Customized quote number: ".$number;
  $header="From:".strip_tags($_POST['email'])."\r\n";
  $header.="To:".strip_tags($mailTo)."\r\n";
  $header.="Content-Type: text/html; charset=ISO8859-1\r\n";

  $mailBody="<html><head><style type='text/css' media='all'>table th td {border: 1px solid black;}</style></head></head><body>";
  $mailBody.="<h1>Voila an new quote is here!</h1>";
  $mailBody.="<table rule='all' style='border-color:purple;border: 1px solid black;' cellpadding=10>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Tour Name:</strong></td><td>".strip_tags($_POST['tripName'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>School Name:</strong></td><td>".strip_tags($_POST['school'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Contact Name:</strong></td><td>".strip_tags($_POST['contact'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Email:</strong></td><td>".strip_tags($_POST['email'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Phone:</strong></td><td>".strip_tags($_POST['phone'])."</td></tr>";
  if($_POST['unknown']!=="on"){
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Leaving:</strong>".strip_tags($_POST['from'])."</td><td><strong>Returning:</strong>".strip_tags($_POST['to'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Total:</strong>".$days." days</td></tr>"; // need a function to caculate days
    }
    else{
        $mailBody.="<tr style='background-color:#eee;'><td>Leaving Dates</td><td><strong>Don't know</strong</td>></tr>";
    }
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Time of Year:</strong></td><td>".strip_tags($_POST['season'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Number of children:</strong></td><td>".strip_tags($_POST['children'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Number of Adults:</strong></td><td>".strip_tags($_POST['adult'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Average Age:</strong></td><td>".strip_tags($_POST['age'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Grade Level:</strong></td><td>".strip_tags($_POST['grade'])."</td></tr>";
  //missi city and Acitivity...
  if(isset($_POST['report']) && !empty($_POST['report'])){
     $reports=$_POST['report'];
     $reports=explode(';', $reports);
     $count=0;
     foreach ($reports as $report) {
        ++$count;
        if($count>0){
           $report=explode(':', $report);
           $city=$report[0];
           $mailBody.="<tr style='background-color:#eee;'><td><strong>".strip_tags($city)."</strong></td><td><table>";
           $activities=$report[1];
           $activities=explode(',', $activities);
           if(!empty($activities)){
             foreach($activities as $activity) {
              $mailBody.="<tr><td>".strip_tags($activity)."</td></tr>";
             }
           }
           $mailBody.="</table></td></tr>";
        }
      }
  }

  $mailBody.="<tr style='background-color:#eee;'><th>City</th><th></th></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Acitivities:</strong></td><td><table>";
  
  /********
  Transportation and loding
  *********/
  $mailBody.="<tr style='background-color:#eee;'><th>Transportation and Lodging</th></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Lodging:</strong></td><td><table><tr><td><b>Hotel</b><td>".strip_tags($_POST['hotel'])."</td></tr><tr><td><b>Student Rooms</b></td><td>".strip_tags($_POST['student_rooms'])."</td></tr><tr><td><b>Adult Rooms</b</td><td>".strip_tags($_POST["adults_rooms"])."</td></tr></table></td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><th>Transportation</th></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Air:</strong></td><td>".strip_tags($_POST['air'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Bus:</strong></td><td>".strip_tags($_POST['bus'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Other:</strong></td><td>".strip_tags($_POST['otherTrans'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Meals:</strong></td><td>";
  if ($_POST['meals']=="Buffet") {
     
    $mailBody.="Buffet: ".strip_tags($_POST['buffet'])."</td></tr>";
  }else{
    $mailBody.= strip_tags($_POST['meals'])."</td></tr>";
  }
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Tour Guide:</strong></td><td>".strip_tags($_POST['guide'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Night security:</strong></td><td>".strip_tags($_POST['secure'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Language:</strong></td><td>".strip_tags($_POST['language'])."</td></tr>";
  $mailBody.="<tr style='background-color:#eee;'><td><strong>Insurance:</strong></td><td>".strip_tags($_POST['insurance'])."</td></tr>";
  $mailBody.="</table>";
  $mailBody.="</body></html>";
  
  function ContactError($fieldName)
{
    wp_die(__('Error: please fill the Field "'.$fieldName.'"!','um_lang' ) .
    __('<a onclick="history.go(-1)"><p style="cursor: hand; cursor: pointer;">Back</p></a>'));
}

if(isset($_POST["um_submitted"]) && $_POST["um_submitted"])
 {
    if(!(isset($_POST["school"]) && $_POST["school"]))
    {
        ContactError('school');
    }
    else if(!(isset($_POST["email"]) && $_POST["email"]))
    {
        ContactError('Email');
    }
    else if(!(isset($_POST["phone"]) && $_POST["phone"]))
    {
      ContactError('phone');  
    }
    else
    {
            mail($mailTo,$subject,$mailBody,$header);
            //$monica=get_userdate("2");
            //$moinica_mail=$monica->user_email;
            mail($moinica_mail,$subject,$mailBody,$header);
            
    }
 }
}
 ?>