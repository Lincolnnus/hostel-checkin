<?php
require_once("includes/connection.php");//Connect to the Database
require_once("settings.php");//Input Settings
require_once("user.php");//Include User Functions
require_once("hotel.php");
require_once('email.php');
getPreferences();//Initialize Settings

function sendhotelEmail($email,$hotelname,$hoteladdr,$hotelmanager,$hotelphone,$hotelzip){
	 $emails=getEmails();
	 $from=$emails[0]["from"].'<norepy@asplan.com>';
     $subject=$emails[0]["subject"];
     $message=$emails[0]["message"];
	 $html1=$message;
	 $html1=str_ireplace("%%managername%%",$hotelmanager,$html1);
     $html1=str_ireplace("%%hotelname%%",$hotelname,$html1);
	 $html1=str_ireplace("%%hoteladdr%%",$hoteladdr,$html1);
	 $html1=str_ireplace("%%hotelzip%%",$hotelzip,$html1);
	 $html1=str_ireplace("%%hotelphone%%",$hotelphone,$html1);
	return sendHTMLEmail($from,$email,$subject,$html1);
}

function sendVerificationEmail($email,$hotelname,$hotelmanager){
	 $emails=getEmails();
		    $from=$emails[1]["from"].'<norepy@asplan.com>';
            $subject=$emails[1]["subject"];
		    $message=$emails[1]["message"];
			$html1=$message;
			 $html1=str_ireplace("%%managername%%",$hotelmanager,$html1);
     $html1=str_ireplace("%%hotelname%%",$hotelname,$html1);
	$to=$email;

	return sendHTMLEmail($from,$to,$subject,$html1);
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
?>