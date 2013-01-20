<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if((isset($_GET["email"]))&&(isset($_GET["token"])))
    {
        $email=$_GET["email"];
	    $confirmation=$_GET["token"];
	    $query = sprintf("SELECT * FROM `book` WHERE email='%s'",mysql_real_escape_string($email));
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
		while($row=mysql_fetch_array($result)){$book[]=$row;}
		echo json_encode($book);
	    }//successfully get checkin information
    }
    else echo "Invalid Email or token";
    break;
    case 'POST':
    break;
}
function authentication($email,$token)
{
	$query = sprintf("SELECT * FROM `access_token` WHERE email='%s' AND token='%s'",
		mysql_real_escape_string($email),
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
