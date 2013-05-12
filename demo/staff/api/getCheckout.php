<?php
if((isset($_POST["uid"]))&&(isset($_POST["token"])))
{
	 include_once('connection.php');
	   $query = sprintf("SELECT * FROM `booking` WHERE step='%s'",
		mysql_real_escape_string(2)
		 );
		$result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo($message);
	    }else 
	    {
			while($row=mysql_fetch_array($result)){$booking[]=$row;}
			echo json_encode($booking);
	    }//successfully get checkin information
}
?>
