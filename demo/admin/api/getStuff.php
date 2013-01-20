<?php
if((isset($_POST["uid"]))&&(isset($_POST["token"])))
{
	 include_once('connection.php');
	    $result = mysql_query("SELECT * FROM `stuff`");
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo($message);
	    }else 
	    {
			while($row=mysql_fetch_array($result)){$stuff[]=$row;}
			echo json_encode($stuff);
	    }//successfully get checkin information
}
?>
