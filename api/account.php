<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if((isset($_GET["uid"]))&&(isset($_GET["token"])))
    {
	$uid=$_GET["uid"];$token=$_GET["token"];
	if (authentication($uid,$token))
        {
		$query = sprintf("SELECT * FROM `user` WHERE uid='%s'",
		mysql_real_escape_string($uid)
		 );
		$result = mysql_query($query);
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo $message;
		}
		else{    
		     if(mysql_num_rows($result)==0)
		     { echo "No Such User";}
		     else
		     {  
		         $row=mysql_fetch_array($result);
			 $uid=$row["uid"];
			 $fname=$row["fname"];
			 $lname=$row["lname"];
			 $title=$row["title"];
			 $address=$row["uaddress"];
			 $user = array(
			    "uid" => $uid,
			    "fname"=>$fname,
			    "lname"=>$lname,
			    "address"=>$address,
			    "title"=>$title,
			 );
			 echo json_encode($user);
		     }
		}
	}
	else echo "Invalid Access Token";
    }
    else echo "Invalid Token or User ID";
    break;
    case 'POST':
    if((isset($_POST["uid"]))&&(isset($_POST["token"]))&&(isset($_POST["task"])))
    {
	$task=$_POST["task"];
        switch ($task)
        {
           case 'changeprofile':
		if((isset($_POST["fname"]))&&(isset($_POST["lname"]))&&(isset($_POST["title"])))
		{
			$uid=$_POST["uid"];$token=$_POST["token"];$fname=$_POST["fname"];$lname=$_POST["lname"];$title=$_POST["title"];
			if (authentication($uid,$token))
			{
				$query = sprintf("UPDATE `user` SET fname='%s',lname='%s',title='%s' WHERE uid='%s'",
				mysql_real_escape_string($fname),
				mysql_real_escape_string($lname),
				mysql_real_escape_string($title),
				mysql_real_escape_string($uid)
				 );
				$result = mysql_query($query);
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				 echo json_encode("success");
				}
			}
			else echo "Invalid Access Token";
		}else echo "parameters missing for changeprofile";
	        break;
           case 'changepass':
		if((isset($_POST["oldpass"]))&&(isset($_POST["password"]))&&(isset($_POST["confirmpass"])))
		{
			$uid=$_POST["uid"];$token=$_POST["token"];$oldpass=$_POST["oldpass"];$password=$_POST["password"];$confirmpass=$_POST["confirmpass"];
			if ($password!=$confirmpass){echo "New Password Doesn't Match";exit;}
			if (!validateoldpass($uid,$oldpass)){echo "Old password Not Correct!";exit;}
			if (authentication($uid,$token))
			{
				$query = sprintf("UPDATE `user` SET password='%s' WHERE uid='%s'",
				mysql_real_escape_string($password),
				mysql_real_escape_string($uid)
				 );
				$result = mysql_query($query);
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				 echo json_encode("success");
				}
			}
			else echo "Invalid Access Token";
		}else echo "parameters missing for changepass";
		break;
	}
    }
    else echo "Invalid Token or User ID";
    break;
}
function authentication($uid,$token)
{
	$query = sprintf("SELECT * FROM `user` WHERE uid='%s' AND token='%s'",
		mysql_real_escape_string($uid),
		mysql_real_escape_string($token)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return false;
	}
	else if(mysql_num_rows($result) == 0)
        {return false;}
	return true;
}
function validateoldpass($uid,$oldpass)
{
	$query = sprintf("SELECT * FROM `user` WHERE uid='%s' AND password='%s'",
		mysql_real_escape_string($uid),
		mysql_real_escape_string($oldpass)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return false;
	}
	else if(mysql_num_rows($result) == 0)
        {return false;}
	return true;
}
?>
