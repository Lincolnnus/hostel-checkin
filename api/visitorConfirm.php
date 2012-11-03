<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if((isset($_GET["email"]))&&(isset($_GET["confirmation"])))
    {
            $email=$_GET["email"];
	    $confirmation=$_GET["confirmation"];
	    $query = sprintf("SELECT * FROM `book` WHERE email='%s' AND confirmation='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
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
		$row=mysql_fetch_array($result);
		$email=$row["email"];
		$confirmation=$row["confirmation"];
		$status=$row["status"];
		$hid=$row["hid"];
		$checkindate=$row["checkindate"];
		$query = sprintf("SELECT * FROM `hotel` WHERE hid='%s'",mysql_real_escape_string($hid));
		$result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    echo($message);
		    }else if(mysql_num_rows($result)<=0)
		    { 
			echo "Invalid Hotel";
		    }
		    else 
		    {
			$hotel=mysql_fetch_array($result);
		    }//successfully get hotel information
		echo json_encode(array('email' => $email,'confirmation'=>$confirmation,'status'=>$status,'hotel'=>$hotel,'checkindate'=>$checkindate));
	    }//successfully get checkin information
    }
    else echo "Invalid Email or Confirmation Code";
    break;
    case 'POST':
	if((isset($_POST["email"]))&&(isset($_POST["confirmation"])))
	    {
		    $email=$_POST["email"];
		    $confirmation=$_POST["confirmation"];
		    $query = sprintf("SELECT * FROM `book` WHERE email='%s' AND confirmation='%s' AND status='2'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
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
			$query = sprintf("UPDATE `book` SET status='3' WHERE email='%s' AND confirmation='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
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
	$query = sprintf("SELECT * FROM `access_token` WHERE uid='%s' AND token='%s'",
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
