<?php
if((isset($_POST["stuffEmail"]))&&(isset($_POST["stuffFirstname"]))&&(isset($_POST["stuffLastname"])))
{
	$stuffEmail=$_POST["stuffEmail"];
	$stuffFirstname=$_POST["stuffFirstname"];
	$stuffLastname=$_POST["stuffLastname"];
	include_once("connection.php"); 
	 $password=md5(time());
	 $token=md5(time());
	 $query = sprintf("INSERT INTO `stuff`(email,fname,lname,password,token) VALUES('%s','%s','%s','%s','%s')",
			mysql_real_escape_string($stuffEmail),
			mysql_real_escape_string($stuffFirstname),
			mysql_real_escape_string($stuffLastname),
			mysql_real_escape_string($password),
			mysql_real_escape_string($token)
		 );
		$result = mysql_query($query);
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo $message;
		}else{
			include_once("email.php");
			if(sendStuffEmail($stuffEmail,$stuffFirstname,$password)){
				echo json_encode("success");
			}
			else{
				echo "fail";
			}
		}
}
?>
