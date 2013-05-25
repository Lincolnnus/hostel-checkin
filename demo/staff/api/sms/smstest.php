<?php
// Download/Install the PHP helper library from twilio.com/docs/libraries.
// This line loads the library
require('/usr/share/php/Services/Twilio.php');
//require("../settings.php");//Input Settings
//getPreferences(); 
// Your Account Sid and Auth Token from twilio.com/user/account

function sendFreshCustomerSMS($phone,$Customer,$email){
$hname="jjhkhkj";
$sms="Dear ".$Customer.",\nThanks for booking with ".$hname.".Please go to your email account(".$email.") to check.\n";	
sendSMS($phone,$sms);
	
	}
	
function sendConfirmationSMS($phone,$Customer,$email){
$hname='ssss';
$sms="Dear ".$Customer.",\n\nThanks for booking with ".$hname.".Please go to your email account(".$email.") to check.\n";	
sendSMS($phone,$sms);
	
	}
	

function sendSMS($phone,$sms){ 
			
$sid = "AC63985e80a93ed2e7618a8f2411f20b0f";
$token = "71d429744b688dbeea2417ee28cf9c8e"; 
$smsNumber='+15614027021';
if($sid==null ||$token==null ||$smsNumber==null){
	
	
	}else{
		$client = new Services_Twilio($sid, $token);

        $message = $client->account->sms_messages->create($smsNumber,$phone,$sms);}


}
?>
