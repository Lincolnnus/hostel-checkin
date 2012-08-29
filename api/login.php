<?php
if(isset($_POST["email"])&&isset($_POST["password"]))
{
	include_once("connection.php"); 
	$email=$_POST["email"];
	$password=$_POST["password"];
	$query = sprintf("SELECT * FROM `user` WHERE email='%s' AND password='%s'",
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
             if(mysql_num_rows($result)==0) header("Location: ../login.php?error=no such user");
             else
             {   if (!isset($_SESSION)) { session_start();}
                 $row=mysql_fetch_array($result);
                 $_SESSION["email"]=$row["email"];
                 if($row["uid"]==1)$_SESSION["role"]="admin";
		 header("Location: ../mine.php");
             }
        }
}
?>
