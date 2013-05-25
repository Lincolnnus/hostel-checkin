<?php
// Download/Install the PHP helper library from twilio.com/docs/libraries.
// This line loads the library
//include_once("../connection.php"); 
require('/usr/share/php/Services/Twilio.php');
//require("../settings2.php");
//getPreferences(); 
 
// Your Account Sid and Auth Token from twilio.com/user/account
 //if(isset($_POST["uid"])&&isset($_POST["email"])){
	 
	 
function sendCheckinSMS($phone,$Customer,$email){
$hname=HOTEL_NAME;
$sms="Dear ".$Customer.",\nThanks for booking with ".$hname.".Your check-in has been approved.Please go to your email account(".$email.") to check.\n";	
sendSMS($phone,$sms);
	
	}

function sendFreshCustomerSMS(){
$sid =SMS_SID;
$token = SMS_TOKEN; 
$smsNumber=SMS_NUMBER; 



$client = new Services_Twilio($sid, $token);
 
$message = $client->account->sms_messages->create($smsNumber, '+6597515526', "Jenny please?! I love you <3");



echo json_encode("sdfs");
}

function sendSMS($phone,$sms){ 
			
$sid =SMS_SID;
$token = SMS_TOKEN; 
$smsNumber=SMS_NUMBER;
if($sid==null ||$token==null ||$smsNumber==null){
	
	
	}else{
		$client = new Services_Twilio($sid, $token);

        $message = $client->account->sms_messages->create($smsNumber,$phone,$sms);}


}



?>
