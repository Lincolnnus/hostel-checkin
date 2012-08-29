<?php
include_once("connection.php"); 
	$email=$_POST["email"];
	$password=$_POST["password"];
	$query = sprintf("INSERT INTO `user` (email,password) values ('%s','%s')",
		mysql_real_escape_string($email),
		mysql_real_escape_string($password)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}
	else {    
            header("Location: ../login.php?email=".$email."&error=register successful");
        }
?>
