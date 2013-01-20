<?php
    if(isset($_REQUEST["email"])&&isset($_REQUEST["token"]))
    {
        $email=$_REQUEST["email"];
        $token=$_REQUEST["token"];
        if(md5($email)==$token)
        {
            include_once("connection.php");
            $queryInsertUser = sprintf("INSERT user(email,token) VALUES('%s','%s')",mysql_real_escape_string($email),mysql_real_escape_string($token));
            $resultI1= mysql_query($queryInsertUser);
            if($resultI1)
            {
                $uid=mysql_insert_id();
                $expire=360000;
                $path="/check";
                $domain="";
                setcookie('uid', $uid,time()+$expire,$path, $domain,0,0);
                setcookie('email',$email,time()+$expire, $path, $domain, 0,0);
                setcookie('token',$token,time()+$expire, $path, $domain, 0,0);
                header("Location:../account.php");
            }
        }
        else echo "Invalid";
       
    }
    ?>