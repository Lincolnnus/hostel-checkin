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
		$row=mysql_fetch_array($result) json_encode(array('checkin' => $row));
	    }//successfully get checkin information
    }
    break;
    case 'POST':
    break;
}
function authentication($uid)
{
   return true;
}
?>
