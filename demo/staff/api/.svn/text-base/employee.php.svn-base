<?php
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            if(isset($_GET["admin"])&&isset($_GET["token"]))
            {
                //login
                include_once("connection.php");
                $admin=$_GET["admin"];
                $token=$_GET["token"];
                $query = sprintf("SELECT * FROM `user` WHERE email='%s' AND token='%s' AND type='%s'",
                                 mysql_real_escape_string($admin),
                                 mysql_real_escape_string($token),
                                 mysql_real_escape_string(3)
                                 );
                $result = mysql_query($query);
                if (!$result) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    echo ($message);
                }
                else {
                    if(mysql_num_rows($result)==0)
                    { echo "Not Authorized";}
                    else
                    {   
                        $query = sprintf("SELECT * FROM `user` WHERE type='%s' ",
                                         mysql_real_escape_string(2)
                                         );
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysql_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            echo ($message);
                        }
                        else if(mysql_num_rows($result)<=0){echo "No Such record";}
                        else
                        {
                            while($row=mysql_fetch_array($result))
                                $user[]=$row;
                            echo json_encode($user);
                        }
                    }
                }
            }
            break;
        case 'POST':
            if(isset($_POST["admin"])&&isset($_POST["token"])&&isset($_POST["email"]))
            {
                //login
                include_once("connection.php");
                $admin=$_POST["admin"];
                $token=$_POST["token"];
                $email=$_POST["email"];
                $query = sprintf("SELECT * FROM `user` WHERE email='%s' AND token='%s' AND type='%s'",
                                 mysql_real_escape_string($admin),
                                 mysql_real_escape_string($token),
                                 mysql_real_escape_string(3)
                                 );
                $result = mysql_query($query);
                if (!$result) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    echo ($message);
                }
                else {
                    if(mysql_num_rows($result)==0)
                    { echo "Not Authorized";}
                    else
                    {
                        $row=mysql_fetch_array($result);
                        $query = sprintf("SELECT * FROM `user` WHERE email='%s'",
                                         mysql_real_escape_string($email) 
                                         );
                        $result = mysql_query($query);
                        if (!$result) {echo "Error getting user";}
                        else if(mysql_num_rows($result)<=0){echo "No Such User";}
                        else
                        {
                            $query = sprintf("UPDATE `user` SET type=2 WHERE email='%s' ",
                                           mysql_real_escape_string($email)
                                           );
                            $result = mysql_query($query);
                            if (!$result) {
                                $message  = 'Invalid query: ' . mysql_error() . "\n";
                                $message .= 'Whole query: ' . $query;
                                echo ($message);
                            }
                            else {echo json_encode("successful");}
                        }
                    }
                }
            }
            break;
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
   $query = sprintf("UPDATE access_token SET token='%s' WHERE uid='%s'",
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
