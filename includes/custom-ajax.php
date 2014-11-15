<?php

/**********************************************
  To check if the recaptcha is valid
***********************************************/


function checkRecaptha(){

	$publickey = "6Ley2PQSAAAAAE9J8askDZ3n5irIasP1seynGn3W";
	$privatekey = "6Ley2PQSAAAAALskwW69F20hwE9Pxxb39CqplOtT";

  	if(isset($_POST['challenge'])&&isset($_POST['answer'])){

  		 $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["challenge"],
                                $_POST["answer"]);

		  		if ($resp->is_valid) {

		  			echo "true";
		  		}else{
		  			echo "false";
		  		}

 		}
 	die();
 }

add_action( 'wp_ajax_nopriv_checkRecaptha', 'checkRecaptha' );  
add_action( 'wp_ajax_checkRecaptha', 'checkRecaptha' );