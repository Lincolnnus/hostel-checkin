<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if(isset($_GET["bid"]))
    {
            $cid=$_GET["bid"];
	    $query = sprintf("SELECT * FROM `book` WHERE bid='%s'",mysql_real_escape_string($bid));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
	    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
	    else 
	    {
		$row=mysql_fetch_array($result);echo json_encode(array('book' => $row));
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
