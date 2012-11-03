<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if(isset($_GET["cid"]))
    {
            $cid=$_GET["cid"];
	    $query = sprintf("SELECT * FROM `checkin` WHERE cid='%s'",mysql_real_escape_string($cid));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
	    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
	    else 
	    {
		$row=mysql_fetch_array($result);echo json_encode(array('checkin' => $row));
	    }//successfully get checkin information
    }
    break;
    case 'POST':
    if(isset($_POST["bid"]))
    {
            $bid=$_POST["bid"];
	    $query = sprintf("SELECT * FROM `book` WHERE bid='%s'",mysql_real_escape_string($bid));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo($message);
	    }else if(mysql_num_rows($result)<=0)
	    { 
		    $query = sprintf("SELECT * FROM `record` WHERE rid='%s'",mysql_real_escape_string($bid));
		    $result2 = mysql_query($query);
		    if (!$result2) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result2)<=0){echo "No Such record";}
		    else 
		    {
			$row=mysql_fetch_array($result2);echo json_encode(array('record' => $row));
		    }//successfully get record information
	    }
	    else 
	    {
		$row=mysql_fetch_array($result);echo json_encode(array('checkin' => $row));
	    }//successfully get checkin information
    }
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
