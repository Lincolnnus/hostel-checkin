<?php
if(isset($_POST["email"])&&isset($_POST["password"]))
{
        //login
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
             if(mysql_num_rows($result)==0)
             { echo "No Such User";}
             else
             {   
                 $row=mysql_fetch_array($result);
                 $access_token=generateAccess_token($uid);
                 if($access_token!=0) echo json_encode($access_token);
                 else echo "Error Generating Access Token";
             }
        }
}
function generateAccess_token($uid)
{
   for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 16; $x = rand(0,$z), $s .= $a{$x}, $i++); 
   $query = sprintf("INSERT INTO `user` (access_token) VALUES '%s' WHERE uid='%s'",
		mysql_real_escape_string($s),
		mysql_real_escape_string($uid)
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
