<?php
include_once("../connection.php"); 
require_once("../settings2.php");
getPreferences();
$initialData = file_get_contents('php://input');
$GLOBALS['HTTP_RAW_POST_DATA']=$initialData;
$filteredData=substr($GLOBALS['HTTP_RAW_POST_DATA'], strpos($GLOBALS['HTTP_RAW_POST_DATA'], ",")+1);

// Need to decode before saving since the data we received is already base64 encoded
$decodedData=base64_decode($filteredData);

$fp = fopen( 'test.png', 'wb' );
fwrite( $fp, $decodedData);
fclose( $fp );
$imagedata = file_get_contents("test.png");
             // alternatively specify an URL, if PHP settings allow
$base64 = base64_encode($imagedata);
$img='data:image/jpeg;base64,'.$base64;
$content='<html><body> <img alt="" src="%%img%%" /></body></html>';
$content2=str_ireplace("%%img%%",$img,$content);
//$content2='<html><body>test PengLin</body></html>';
//$content="test.png";
file_put_contents('tmp.html',$content2);
$destFile=md5(time()).'.pdf';
exec('xvfb-run -a -s "-screen 0 640x480x16" wkhtmltopdf tmp.html '.$destFile);
echo $destFile;
            $hname=HOTEL_NAME;
            $emails=getEmails();
		    $from=$emails[4]["from"].'<norepy@asplan.com>';
            $subject=$emails[4]["subject"];
		    $message=$emails[4]["message"];
			$html1=$message;
			$name="Peng Lin";
	 $html1=str_ireplace("%%customername%%",$name,$html1);
	 $html1=str_ireplace("%%hname%%",$hname,$html1);
     $html1=str_ireplace("%%hotelname%%",$hotelname,$html1);
	

	$to='vspenglin@gmail.com';
	

sendHTMLEmail($from,$to,$subject,$html1,$destFile);
unlink ($destFile);
$email='vspenglin@gmail.com';
$query = sprintf("UPDATE `booking` SET step='%s' WHERE email='%s'",
	mysql_real_escape_string(1),
	mysql_real_escape_string($email));
	$result = mysql_query($query);

function sendHTMLEmail($from,$to,$subject,$html1,$destFile){
	ini_set('include_path', PEAR_PATH);
	require_once "Mail.php";
	require_once "Mail/mime.php";

 
  $text = 'This is a text message.';  
	 

  $crlf = "\n";
 $message = new Mail_mime($crlf);
$message->setHTMLBody($html1);
$tempLocation=$destFile;

$message->addAttachment($tempLocation);

 
     
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


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>