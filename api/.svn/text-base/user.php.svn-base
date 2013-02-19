<?php
function userLogin($email,$password)
{
	$query = sprintf("SELECT * FROM `admin` WHERE email='%s' AND password='%s'",
		mysql_real_escape_string($email),
		mysql_real_escape_string($password)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else {    
             if(mysql_num_rows($result)==0)
             { return false;}
             else
             {  
                 $row=mysql_fetch_array($result);
                 return $row;
             }
        }
}
function updateToken($uid)
{
	$token=md5(time());
	$query = sprintf("UPDATE `access` SET token='%s' WHERE uid='%s'",
		mysql_real_escape_string($token),
		mysql_real_escape_string($uid)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else {    
           return $token;
        }
}
function verifyToken($uid,$token)
{
	$query = sprintf("SELECT * FROM `access` WHERE uid='%s' AND token='%s'",
		mysql_real_escape_string($uid),
		mysql_real_escape_string($token)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else {    
           $row=mysql_fetch_array($result);
           return $row;
    }
}
