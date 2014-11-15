<?php
global $wpdb;
//disable for now original quote_submit
if($_POST["recaptcha_response_field"]){
             mail("wanjiangmaoniu@gmail.com","test","test","test");
             
            $publickey = "6Ley2PQSAAAAAE9J8askDZ3n5irIasP1seynGn3W";
            $privatekey = "6Ley2PQSAAAAALskwW69F20hwE9Pxxb39CqplOtT";
            $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

            if ($resp->is_valid) {
                    $recaptcha_valid = true;
                    if(isset($_POST['quote_submit'])){
   
                      $tour_id=$_POST['tour_id'];
                      $tour_name = get_the_title($tour_id);
                      $tour_link = get_permalink($tour_id);

                      $mailTo1=get_option('admin_email');
                      $mailTo="info@mpoeduc.com";
                      $subject=$_POST['tripName']."-by".$_POST['school'];
                      $header="From:".strip_tags($_POST['email'])."\r\n";
                      $header.="To:".strip_tags($mailTo)."\r\n";
                      $header.="Content-Type: text/html; charset=ISO8859-1\r\n";

                      $mailBody="<html><head><style type='text/css' media='all'>table th td {border: 1px solid black;}</style></head></head><body>";
                      $mailBody.="<h1>Voila an new quote is here!</h1>";
                      $mailBody.="<table rule='all' style='border-color:purple;border: 1px solid black;' cellpadding=10>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Tour Name:</strong></td><td>".$tour_name."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>School Name:</strong></td><td>".strip_tags($_POST['school'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Contact Name:</strong></td><td>".strip_tags($_POST['contactName'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Email:</strong></td><td>".strip_tags($_POST['email'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Phone:</strong></td><td>".strip_tags($_POST['phone'])."</td></tr>";
                      $address = strip_tags($_POST['street'])." ".strip_tags($_POST['city'])." ".strip_tags($_POST['province'])." ".strip_tags($_POST['country'])." ".strip_tags($_POST['post']);
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Address:</strong></td><td>".$address."</td></tr>";
                      if($_POST['unknown']!=="on"){
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Leaving:</strong>".strip_tags($_POST['from'])."</td><td><strong>Returning:</strong>".strip_tags($_POST['to'])."</td></tr>";
                        }
                        else{
                            $mailBody.="<tr style='background-color:#eee;'><td>Leaving Date</td><td><strong>TBA</strong</td></tr>";
                        }
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Time of Year:</strong></td><td>".strip_tags($_POST['time'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Number of children:</strong></td><td>".strip_tags($_POST['children'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Number of Adults:</strong></td><td>".strip_tags($_POST['adult'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Average Age:</strong></td><td>".strip_tags($_POST['age'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Grade Level:</strong></td><td>".strip_tags($_POST['grade'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Best Contact Time:</strong></td><td>".strip_tags($_POST['contact'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Quote deadline:</strong></td><td>".strip_tags($_POST['by'])."</td></tr>";

                      //city and Acitivity...
                      $mailBody.="<tr style='background-color:#eee;'><th>City</th><th>Acitivities</th></tr>";
                      if(isset($_POST['report']) && !empty($_POST['report'])){
                         $reports=$_POST['report'];
                         $reports=explode(';', $reports);
                         $count=0;
                         foreach ($reports as $report) {
                            ++$count;
                            if($count>0){
                               $report=explode(':', $report);
                               $city=$report[0];
                               $city=explode("_", $city);
                               $city=$city[0];
                               $city=explode("-", $city);
                               $city=implode(" ", $city);
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

                      
                      /********
                      Transportation and loding
                      *********/
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Lodging:</strong></td><td><table><tr><td><b>Hotel</b><td>".strip_tags($_POST['hotel'])."</td></tr><tr><td><b>Student Rooms</b></td><td>".strip_tags($_POST['student_rooms'])."</td></tr><tr><td><b>Adult Rooms</b</td><td>".strip_tags($_POST["adults_rooms"])."</td></tr></table></td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><th>Transportation</th></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Air:</strong></td><td>".strip_tags($_POST['air'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Bus:</strong></td><td>".strip_tags($_POST['bus'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Other:</strong></td><td>".strip_tags($_POST['otherTrans'])."</td></tr>";
                      
                      //meals
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Meals:</strong></td><td>";
                      $mailBody.="<table>";
                      if(isset($_POST["meal"])&&!empty($_POST["meal"])){
                        echo "No meal selected";
                      }else{
                        $mailBody.="<tr><td>BreakFast:".strip_tags($_POST['brkM'])."</td>Number: ".strip_tags($_POST['brk_number'])."</td></tr>";
                        $mailBody.="<tr><td>Lunch:".strip_tags($_POST['lunM'])."</td><td>Number: ".strip_tags($_POST['lunch_number'])."</td></tr>";
                        $mailBody.="<tr><td>Dinner:".strip_tags($_POST['dinM']);
                         if(isset($_POST['dinT'])){
                          $mailBody.=" ".strip_tags($_POST["dinT"]);
                        }
                        if(isset($_POST['dinTh'])){
                          $mailBody.=" ".strip_tags($_POST['dinTh']);
                        }
                        $mailBody.="</td><td>Number: ".strip_tags($_POST['dinner_number'])."</td></tr>";
                      }
                      $mailBody.="</table></td></tr>";
                      
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Tour Guide:</strong></td><td>".strip_tags($_POST['guide'])."</td></tr>";
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Night security:</strong></td><td>".strip_tags($_POST['secure'])."</td></tr>";
                      if(isset($_POST['otherLanguage'])&&!empty($_POST['otherLanguage'])){
                        $mailBody.="<tr style='background-color:#eee;'><td><strong>Language:</strong></td><td>".strip_tags($_POST['otherLanguage'])."</td></tr>";
                      }else{
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Language:</strong></td><td>".strip_tags($_POST['language'])."</td></tr>";
                      }
                      $mailBody.="<tr style='background-color:#eee;'><td><strong>Insurance:</strong></td><td>".strip_tags($_POST['insurance'])."</td></tr>";
                      $mailBody.="</table>";
                      $mailBody.="</body></html>";

                      //mail the form
                      mail($mailTo,$subject,$mailBody,$header);
                      mail($mailTo1,$subject,$mailBody,$header);
                      mail("mpoeduc@gmail.com",$subject,$mailBody,$header);
                      mail("wanjiangmaoniu@gmail.com",$subject,$mailBody,$header);
                      //$monica=get_userdate("2");
                      //echo "sent! <a onclick='history.go(-1)'><p style='cursor: hand; cursor: pointer;'> <-Back </p></a>";
                      $quoted=true;
                    }
                
                } else {
                        # set the error code so that we can display it
                        $recaptcha_valid = false;

                }
  }

 ?>