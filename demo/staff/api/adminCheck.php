<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
        if((isset($_GET["uid"]))&&(isset($_GET["email"]))&&(isset($_GET["token"]))&&(isset($_GET["confirmation"])))
    {
        $email=$_GET["email"];
        $uid=$_GET["uid"];
        $token=$_GET["token"];
        if(authentication($uid,$token))
        {
       // $uid=$_GET["uid"];
        $query = sprintf("SELECT * FROM `user` WHERE email='%s'",mysql_real_escape_string($email));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo($message);
	    }else if(mysql_num_rows($result)<=0)
	    {
            echo "Not Authorized";
	    }
	    else
	    {
            $user=mysql_fetch_array($result);
            $confirmation=$_GET["confirmation"];
            $query = sprintf("SELECT * FROM `booking` WHERE email='%s' AND rid='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
            $result = mysql_query($query);
            if (!$result) {
                $message  = 'Invalid query: ' . mysql_error() . "\n";
                $message .= 'Whole query: ' . $query;
                echo($message);
            }else if(mysql_num_rows($result)<=0)
            {
                echo "Invalid Record";
            }
            else
            {
                $booking=mysql_fetch_array($result);
                $step=$booking["step"];
                echo json_encode(array('booking' => $booking,'step'=>$step,'user'=>$user));
            }//successfully get checkin information
        }
    }else echo "Not Authorized";
    }
    else echo "Invalid user or booking";
    break;
    case 'POST':
	if((isset($_POST["email"]))&&(isset($_POST["confirmation"])))
	    {
		    $email=$_POST["email"];
		    $confirmation=$_POST["confirmation"];
		    $query = sprintf("SELECT * FROM `booking` WHERE email='%s' AND rid='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    echo($message);
		    }else if(mysql_num_rows($result)<=0)
		    { 
			echo "Invalid Booking";
		    }
		    else 
		    {
			$query = sprintf("UPDATE `booking` SET step='1' WHERE email='%s' AND rid='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
			$result = mysql_query($query);
			    if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo($message);
			    }else {echo json_encode("successful");}
		    }//successfully get checkin information
	    }
	    else echo "Invalid Email or Confirmation Code";
    break;
}
function authentication($uid,$token)
{
	$query = sprintf("SELECT * FROM `admin` WHERE uid='%s' AND token='%s'",
		mysql_real_escape_string($uid),
		mysql_real_escape_string($token)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return false;
	}else{return true;}
}
?>
