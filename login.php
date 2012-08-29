<?php
if(isset($_POST["email"])&&isset($_POST["password"]))
{
	include_once("api/connection.php"); 
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
             if(mysql_num_rows($result)==0) header("Location: login.php?error=no such admin");
             else
             {   if (!isset($_SESSION)) { session_start();}
                 $row=mysql_fetch_array($result);
                 $_SESSION["email"]=$row["email"];
                 if($row["uid"]==1) $_SESSION["role"]="admin";
		 if((isset($_POST["uri"]))&&($_POST["uri"]!="")) header("Location: ".$_POST["uri"]);
                 else header("Location: mine.php");
             }
        }
}
?>
<html>
<body>
<div><?php if(isset($_REQUEST["error"])) echo $_REQUEST["error"];?></div>
<form action="login.php" method="post"
enctype="multipart/form-data">
<label for="email">Email:</label>
<input type="text" name="email" <?php if(isset($_REQUEST["email"])) echo 'value="'.$_REQUEST["email"].'"';?> /> 
<br />
<label for="password">password:</label>
<input type="password" name="password" /> 
<input type="hidden" name="uri" value="<?php if(isset($_REQUEST['uri'])) echo $_REQUEST['uri'];?>"/>
<br />
<input type="submit" name="submit" value="Submit" />
</form>
<div> <a href="register.php">register</a></div>
</body>
</html>
