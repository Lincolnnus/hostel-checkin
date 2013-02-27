<?php
require_once("settings.php");
getPreferences();
function sendhotelEmail($email,$hotelname,$hoteladdr,$hotelmanager,$hotelphone,$hotelzip){
	$message="Dear ".$hotelmanager.",\n\nThank you for your interests in the mobile checkin system developed by Asplan Service.\n\n".
	"Below is your hotel information:\n\n"."Hotel Name:".$hotelname."\nHotel Address:".$hoteladdr."\nZip Code:".$hotelzip."\nYour Phone Number:".$hotelphone."\n\n".
	"Please confirm the above information is correct by replying this email and attach your company logo.\n\nBest Regards,\nAsplan Service Team";
	$to=$email;
	$subject="Thank you for contacting Asplan";
	$from=HOTEL_NAME."<noreply@gmail.com>";
	return sendEmail($from,$to,$subject,$message);
}
function sendVerificationEmail($email,$hotelname,$hotelmanager,$hotelURL){
	$message="Dear ".$hotelmanager.",\n\nYour request has been approved by Asplan Service.\n".
	"You are now the default system admin for ".$hotelname.":\n\nEmail Address: ".$email."\nPassword: test\n\n".
	"Please verify your email via the following link: ".$hotelURL."\n\nBest Regards,\nAsplan Service Team";
	$to=$email;
	$subject="Verfied By Asplan";
	$from=HOTEL_NAME."<noreply@gmail.com>";
	return sendEmail($from,$to,$subject,$message);
}
function sendConfirmation($email,$name,$confirmation){
	$hURL=HOTEL_URL;
	$hname=HOTEL_NAME;

	$emails=getEmails();
	$subject=$emails[2]["subject"];
    $message=$emails[2]["message"];	
	$from=$emails[2]["from"].'<norepy@asplan.com>';
	$to='vspenglin@gmail.com';
	$html1=$message;
	 $html1=str_ireplace("%%customername%%",$name,$html1);
     $html1=str_ireplace("%%hURL%%",$hURL,$html1);
	$html1=str_ireplace("%%hname%%",$hname,$html1);
	 $html1=str_ireplace("%%hemail%%",$email,$html1);
	 $html1=str_ireplace("%%confirmation%%",$confirmation,$html1);
	return sendHTMLEmail($from,$to,$subject,$html1);
	
}
function sendStuffEmail($email,$name,$password){
	$message="Dear ".$name.",\n\nYou are assigned as a staff of ".HOTEL_NAME."\n\nEmail Address: ".$email."\nPassword: ".$password."\n\n".
	"Please login your stuff account via ".HOTEL_URL."/staff\n\nBest Regards,\n".HOTEL_NAME." Team";
	$to=$email;
	$from=HOTEL_NAME."<noreply@gmail.com>";
	$subject="Please Verify Your Stuff Email";
	return sendEmail($from,$to,$subject,$message);
}
function sendEmail($from,$to,$subject,$message){
	ini_set('include_path', PEAR_PATH);
	require_once "Mail.php";
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
  		 false;
	} else {
   		return true;
	}
}
function sendHTMLEmail($from,$to,$subject,$html1){
	ini_set('include_path', PEAR_PATH);
	require_once "Mail.php";
	require_once "Mail/mime.php";

 
  $text = 'This is a text message.';  
	 

  $crlf = "\n";
 $message = new Mail_mime($crlf);
$message->setHTMLBody($html1);

 
     
 $body=$message->get();
 	$headers = array ('From' => $from,
                  'To' => $to,
                  'Subject' => $subject,
                     'MIME-Version'=> '1.0',
                  'Content-Type'=>'text/html;charset=ISO-8859-1',                  );
 $hdrs=$message->headers($headers);
	$smtp = Mail::factory('smtp',
                      array ('host' => GMAIL_HOST,
                             'port' => GMAIL_PORT,
                             'auth' => true,
                             'username' => GMAIL_UNAME,
                             'password' => GMAIL_PASSWORD));
       
	$mail = $smtp->send($to, $hdrs, $body);


	if (PEAR::isError($mail)) {
    return $mail->getMessage();
	} else {
    return true;
	}
}
function getEmails(){
	$query = sprintf("SELECT * FROM `email`");
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while ($row=mysql_fetch_array($result))
		{
			$row["message"]=fixtags($row["message"]);
			$email[]=$row;
		}
		return $email;
	}
}
function fixtags($text){
/*$text = htmlspecialchars($text);
$text = preg_replace("/=/", "=\"\"", $text);
$text = preg_replace("/&quot;/", "&quot;\"", $text);
$tags = "/&lt;(\/|)(\w*)(\ |)(\w*)([\\\=]*)(?|(\")\"&quot;\"|)(?|(.*)?&quot;(\")|)([\ ]?)(\/|)&gt;/i";
$replacement = "<$1$2$3$4$5$6$7$8$9$10>";
$text = preg_replace($tags, $replacement, $text);
$text = preg_replace("/=\"\"/", "=", $text);*/
$text = preg_replace("/\\\\/", "", $text);
return $text;
}
function updateEmails($eid,$subject,$from,$message)
{
	$query = sprintf("UPDATE `email` SET subject='%s',`from`='%s',message='%s' WHERE eid='%s'",
	mysql_real_escape_string($subject),
	mysql_real_escape_string($from),
	mysql_real_escape_string($message),
	mysql_real_escape_string($eid)
	);
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		return true;
	}
}
