<?php
session_start();
require_once 'connection.php';
$rcode=$_POST["rcode"];
$query = sprintf("SELECT email FROM `record` WHERE rid='%s' ",
		mysql_real_escape_string($rcode)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}
	else {   
           if(mysql_num_rows($result)==0) header("Location:../checkin.php?error=not found");
           else {
                    $row=mysql_fetch_array($result);
                    if($_SESSION["email"]==$row["email"]) 
                    header("Location: ../confirmation.php?rid=".$rcode);
                    else header("Location:../login.php?email=".$row["email"]);
                }
        }
?>
