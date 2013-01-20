<?php
require_once('includes/pear.email.php');
function sendhotelEmail($email,$hotelname,$hoteladdr,$hotelmanager,$hotelphone,$hotelzip){
	$message="Dear ".$hotelmanager.",\n\nThank you for your interests in the mobile checkin system developed by Asplan Service.\n\n".
	"Below is your hotel information:\n\n"."Hotel Name:".$hotelname."\nHotel Address:".$hoteladdr."\nZip Code:".$hotelzip."\nYour Phone Number:".$hotelphone."\n\n".
	"Please confirm the above information is correct by replying this email and attach your company logo.\n\nBest Regards,\nAsplan Service Team";
	$to=$email;
	$subject="Thank you for contacting Asplan";
	return sendEmail($to,$subject,$message);
}
function sendVerificationEmail($email,$hotelname,$hotelmanager,$hotelURL){
	$message="Dear ".$hotelmanager.",\n\nYour request has been approved by Asplan Service.\n".
	"You are now the default system admin for ".$hotelname.":\n\nEmail Address: ".$email."\nPassword: test\n\n".
	"Please verify your email via the following link: ".$hotelURL."\n\nBest Regards,\nAsplan Service Team";
	$to=$email;
	$subject="Verfied By Asplan";
	return sendEmail($to,$subject,$message);
}
function sendConfirmation($email,$name,$confirmation){
	$message="Dear ".$name.",\n\nThank you for booking with ".HOTEL_NAME."\n".
	"You can access your mobile booking via: ".HOTEL_URL."/guest\n\nEmail Address: ".$email."\nConfirmation ID: ".$confirmation."\n\nBest Regards,\nAsplan Service Team";
	$to='lishaohuan@hotmail.com';
	$subject="Booking Confirmation from ".$hotelname;
	return sendEmail($to,$subject,$message);
}
function sendStuffEmail($email,$name,$password){
	$message="Dear ".$name.",\n\nYou are assigned as a stuff of ".HOTEL_NAME."\n\nEmail Address: ".$email."\nPassword: ".$password."\n\n".
	"Please login your stuff account via ".HOTEL_URL."/demo/stuff\n\nBest Regards,\n".HOTEL_NAME." Team";
	$to=$email;
	$subject="Please Verify Your Stuff Email";
	return sendEmail($to,$subject,$message);
}
function sendEmail($to,$subject,$message){
	ini_set('include_path', PEAR_PATH);
	require_once "Mail.php";
	$from = HOTEL_NAME."<noreply@checkin.com>";
	$headers = array ('From' => $from,
                  'To' => $to,
                  'Subject' => $subject);
	$smtp = Mail::factory('smtp',
                      array ('host' => GMAIL_HOST,
                             'port' => GMAIL_PORT,
                             'auth' => true,
                             'username' => GMAIL_UNAME,
                             'password' => GMAIL_PASSWORD));
	$mail = $smtp->send($to, $headers, $message);
	if (PEAR::isError($mail)) {
    return false;
	} else {
    return true;
	}
}
?>
