<?php
// Download/Install the PHP helper library from twilio.com/docs/libraries.
// This line loads the library
require('/usr/share/php/Services/Twilio.php');
 
// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC63985e80a93ed2e7618a8f2411f20b0f";
$token = "71d429744b688dbeea2417ee28cf9c8e"; 
$client = new Services_Twilio($sid, $token);
 
$message = $client->account->sms_messages->create('+15614027021', '+6584127233', "Jenny please?! I love you <3");
print $message->sid;
?>
