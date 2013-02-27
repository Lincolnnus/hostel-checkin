<?php
if((isset($_POST["uid"]))&&(isset($_POST["token"])))
{
	 include_once('connection.php');
	    $result = mysql_query("SELECT * FROM `staff`");
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo($message);
	    }else 
	    {
			while($row=mysql_fetch_array($result)){$staff[]=$row;}
			echo json_encode($staff);
	    }//successfully get checkin information
}
?>
