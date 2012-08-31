<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    $uid=$_GET["uid"];
    if(isset($_GET["field"]))
    {
	  switch ($_GET["field"]) 
          {
            case 'upload':
		    $query = sprintf("SELECT * FROM `upload` WHERE uid='%s'",mysql_real_escape_string($uid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
		    else 
		    {
			while($row=mysql_fetch_array($result)) $upload[]=$row;
			echo json_encode(array('upload' => $upload));
		    }//successfully get upload information
            break;
            case 'record':
		    $query = sprintf("SELECT * FROM `record` WHERE lastadminID='%s'",mysql_real_escape_string($uid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
		    else 
		    {
			while($row=mysql_fetch_array($result)) $record[]=$row;
			echo json_encode(array('record' => $record));
		    }//successfully get record information
            break;
           }
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
