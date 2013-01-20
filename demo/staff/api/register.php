<?php
include_once("connection.php"); 
if(isset($_POST["code"]))
{changePassword();}
else registerNew();

function changePassword()
{ 
        $code=$_POST["code"];
	$email=$_POST["email"];//Some Other field will need to be filled later.
	$query = sprintf("SELECT * FROM `user` WHERE email='%s' AND access_token='%s'",
		mysql_real_escape_string($email),
		mysql_real_escape_string($code)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}
	else if (mysql_num_rows($result)<=0){ echo "Error Verifying"  }
        else if(isset($_POST["password"])) 
        {
                $password=$_POST["password"];
	        $query = sprintf("INSERT INTO `user`(password) VALUES('%s') WHERE email='%s'",
			mysql_real_escape_string($password),
			mysql_real_escape_string($email)
		 );
		$result = mysql_query($query);
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
		}else echo json_encode("successful changed password");
           
        }
}
function registerNew()
{
	$email=$_POST["email"];//Some Other field will need to be filled later.
	$query = sprintf("INSERT INTO `user` (email) values ('%s')",
		mysql_real_escape_string($email)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}
	else {    
	   $code=generateAccess_token($email);
	   if ($code!=0) { if (sendEmail($email)) echo json_encode("Please Verify Your email address");else echo "error sending email";}
	   else echo "error generating access token";
	}
}
function sendEmail($email)
{
 return true;
}
function generateAccess_token($email)
{
   for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 16; $x = rand(0,$z), $s .= $a{$x}, $i++); 
   $query = sprintf("INSERT INTO `user` (access_token) VALUES '%s' WHERE email='%s'",
		mysql_real_escape_string($s),
		mysql_real_escape_string($email)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return 0;
	}
        else
        {
           return $s;
        }
}
?>
