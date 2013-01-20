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
	    echo ($message);
	}
	else {    
             if(mysql_num_rows($result)==0)
             { echo "No Such User";}
             else
             {  
                 $row=mysql_fetch_array($result);
		 $uid=$row["uid"];
		 $fname=$row["fname"];
 		 $email=$row["email"];
                 $type=$row["type"];
                 if ($row["numlogin"]==0)
		 $nextlocation="account.php";
                 else $nextlocation="mine.php";
                 $access_token=$row["token"];
		 $query = sprintf("UPDATE `user` SET numlogin=numlogin+1,lastlogin=CURRENT_TIMESTAMP WHERE email='%s' AND password='%s'",
			mysql_real_escape_string($email),
			mysql_real_escape_string($password)
		 );
		$result = mysql_query($query);
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo ($message);exit;
		}
		 $user = array(
		    "token" => $access_token,
		    "uid" => $uid,
		    "fname"=>$fname,
		    "email"=>$email,
		    "nextlocation"=>$nextlocation,
            "type"=>$type
		 );
		 echo json_encode($user);
             }
        }
}
function update_token($uid)
{
   $tokenLen = 16;
   if (file_exists('/dev/urandom')) { // Get 100 bytes of random data
		$randomData = file_get_contents('/dev/urandom', false, null, 0, 100) . uniqid(mt_rand(), true);
   } else {
		$randomData = mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true);
   }
   $token= substr(hash('sha512', $randomData), 0, $tokenLen);
   $query = sprintf("UPDATE user SET token='%s' WHERE uid='%s'",
		mysql_real_escape_string($token),
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
           return $token;
        }
}
?>
