<?php
/*function sendhotelEmail($email,$hotelname,$hoteladdr,$hotelmanager,$hotelphone,$hotelzip){
	$message="Dear ".$hotelmanager.",\n\nThank you for your interests in the mobile checkin system developed by Asplan Service.\n\n".
	"Below is your hotel information:\n\n"."Hotel Name:".$hotelname."\nHotel Address:".$hoteladdr."\nZip Code:".$hotelzip."\nYour Phone Number:".$hotelphone."\n\n".
	"Please confirm the above information is correct by replying this email and attach your company logo.\n\nBest Regards,\nAsplan Service Team";
	$to=$email;
	$subject="Thank you for contacting Asplan";
	return sendEmail($to,$subject,$message);
}*/

function sendVerificationEmail($email,$hotelname,$hotelmanager,$hotelURL){
	$message="Dear ".$hotelmanager.",\n\nYour request has been approved by Asplan Service.\n".
	"You are now the default system admin for ".$hotelname.":\n\nEmail Address: ".$email."\nPassword: default\n\n".
	"Please access your admin account via ".$hotelURL."/demo/admin\n\nBest Regards,\nAsplan Service Team";
	$to=$email;
	$subject="Verfied By Asplan";
	return sendEmail($to,$subject,$message);
}
function sendEmail($to,$subject,$message){
	ini_set('include_path', PEAR_PATH);
	require_once "Mail.php";
	$from = COMPANY_NAME;
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
function sendHTMLEmail($from,$to,$subject,$message){
	ini_set('include_path', PEAR_PATH);
	require_once "Mail.php";
	require_once "Mail/mime.php";  
	 $mime = new Mail_mime();
     $mime->setHTMLBody($message);
     $message = $mime->get();
	$headers = array ('From' => $from,
                  'To' => $to,
                  'Subject' => $subject,
                  'Content-Type'=>'text/html;charset=UTF-8',
                  'Content-Transfer-Encoding'=>'8bit');
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
