<?php
define("PEAR_PATH",'/usr/local/share/pear');
define("GMAIL_HOST",'ssl://smtp.gmail.com');
define("GMAIL_PORT","465");
define("GMAIL_UNAME","asplanservices@gmail.com");
define("GMAIL_PASSWORD","2013@asplan");

	/*	ini_set('include_path','/usr/local/share/pear');
        include('Mail.php');
        include('Mail/mime.php');

        // Constructing the email
        $from = "Leigh <leigh@no_spam.net>";                              // Your name and email address
        $to = "Leigh <lishaohuan@hotmail.com>";                           // The Recipients name and email address
        $subject = "Test Email";                                            // Subject for the email
       // $text = 'This is a text message.';                                  // Text version of the email
        $message = '<html><body><p>This is a html message</p></body></html>';  // HTML version of the email
      $mime = new Mail_mime();
     $mime->setHTMLBody($message);
     $message = $mime->get();
	$headers = array ('From' => $from,
                  'To' => $to,
                  'Subject' => $subject,
                  'Content-Type'=>'text/html;charset=UTF-8',
                  'Content-Transfer-Encoding'=>'8bit');
	$smtp = Mail::factory('smtp',
                      array ('host' => 'ssl://smtp.gmail.com
',
                             'port' => '465',
                             'auth' => true,
                             'username' => 'asplanservices@gmail.com',
                             'password' => '2013@asplan'));
	$mail = $smtp->send($to, $headers, $message);
  $headers = array('From' => $from, 'Subject' => $subject, 'To' => $to);

$crlf = "\n";

$mime = new Mail_mime($crlf);
$mime->setTXTBody($plainText);
$mime->setHTMLBody($htmlText);

$body = $mime->get();
$headers = $mime->headers($headers);

$mail = Mail::factory("mail");
$send = $mail->send($to, $headers, $body);
if (PEAR::isError($send)) {
    //$mail_sent = 0;

   echo("<p>" . $mail->getMessage() . "</p>");
}else {
    $mail_sent = 1;
} 

	if (PEAR::isError($mail)) {
    
   echo("<p>" . $mail->getMessage() . "</p>");
	} else {
    echo "success";
	}*/
  ini_set('include_path', PEAR_PATH);
  require_once "Mail.php";
  require_once "Mail/mime.php";

        $from = "Asplan Services <leigh@no_spam.net>";                              // Your name and email address
        $to = "Leigh <lishaohuan@hotmail.com>";                           // The Recipients name and email address
        $subject = "Test Email";     

   // $html = "<html><body><h1>haha</h1></body></html>";
    $html=file_get_contents("amd.html");
    $crlf = "\n";
    $message = new Mail_mime($crlf);
    $message->setHTMLBody($html);
    $message->addAttachment("download.png");
    $body=$message->get();
  $headers = array ('From' => $from,
                  'To' => $to,
                  'Subject' => $subject,
                  'MIME-Version'=> '1.0',
                  'Content-Type'=>'text/html; charset=ISO-8859-1',
                  //'Content-Transfer-Encoding'=>'base64'
                  );
  $hdrs=$message->headers($headers);
  $smtp = Mail::factory('smtp',
                      array ('host' => GMAIL_HOST,
                             'port' => GMAIL_PORT,
                             'auth' => true,
                             'username' => GMAIL_UNAME,
                             'password' => GMAIL_PASSWORD));
  $mail = $smtp->send($to, $hdrs, $body);
  if (PEAR::isError($mail)) {
    return false;
  } else {
    return true;
  }
?>
