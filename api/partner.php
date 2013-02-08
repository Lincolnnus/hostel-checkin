<?
//Continue the session
session_start();

//Make sure that the input come from a posted form. Otherwise quit immediately
if ($_SERVER["REQUEST_METHOD"] <> "POST") 
 die("You can only reach this page by posting from the html form");

//Check if the securidy code and the session value are not blank 
//and if the input text matches the stored text
if ( ($_REQUEST["txtCaptcha"] == $_SESSION["security_code"]) && 
    (!empty($_REQUEST["txtCaptcha"]) && !empty($_SESSION["security_code"])) ) {
  if(!empty($_REQUEST["signupemail"])&&!empty($_REQUEST["hotelname"])&&!empty($_REQUEST["hoteladdr"])&&!empty($_REQUEST["hotelzip"])&&!empty($_REQUEST["hotelmanager"])&&!empty($_REQUEST["hotelphone"]))
  {
  		$email=$_REQUEST["signupemail"];
  		$hotelname=$_REQUEST["hotelname"];
  		$hoteladdr=$_REQUEST["hoteladdr"];
  		$hotelzip=$_REQUEST["hotelzip"];
  		$hotelmanager=$_REQUEST["hotelmanager"];
  		$hotelphone=$_REQUEST["hotelphone"];
  		if(checkEmail( $email )){
        require_once("includes/connection.php");//Connect to the Database
        require_once("settings.php");//Input Settings
        if(getPreferences())
        //Initialize Settings
        {
        include_once("hotel.php");
  			include_once("email.php");
        $emails=getEmails();
        $from=$emails[0]["from"].'<norepy@asplan.com>';
        $subject=$emails[0]["subject"];
        $body2="Hotel Name:".$hotelname."\nHotel Address:".$hoteladdr."\nZip Code:".$hotelzip."\nPhone Number:".$hotelphone."\n\n";
        $message="Dear ".$hotelmanager."\n\n".$emails[0]["body1"]."\n".$body2."\n".$emails[0]["body2"]."\n";
        sendEmail($from,$email,$subject,$message);
  			echo "success";
        }
  		}
  		else {
  			echo "Invalid Email";
  		}
  }
  else{
  	echo "Form Not Complete";
  }
} else {
  echo "Invalid Verification Code";
}

function checkEmail( $email ){
    return filter_var( $email, FILTER_VALIDATE_EMAIL );
}
?>