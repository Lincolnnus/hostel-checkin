<?php
    include_once("connection.php");
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            if((isset($_GET["email"]))&&(isset($_GET["confirmation"])))
            {
                $email=$_GET["email"];
                $confirmation=$_GET["confirmation"];
                $query = sprintf("SELECT * FROM `record` WHERE email='%s' AND rid='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
                $result = mysql_query($query);
                if (!$result) {
                    $message = 'Invalid query:'.mysql_error();
                }else if(mysql_num_rows($result)<=0)
                {
                     $message = 'Invalid Record';
                }
                else
                {
                    $record=mysql_fetch_array($result);
                    $query = sprintf("SELECT * FROM `user` WHERE email='%s'",mysql_real_escape_string($email));
                    $result = mysql_query($query);
                    if (!$result) {
                        $message  = 'Invalid query:'.mysql_error();
                    }else if(mysql_num_rows($result)<=0)
                    {
                        //No Such User,create one
                        $email=$record["email"];
                        $name=$record["name"];
                        $password=md5($email);
                        $row=mysql_fetch_array($result);
                        $query = sprintf("INSERT INTO `user`(name,email,password) VALUES('%s','%s','%s')",
                                         mysql_real_escape_string($name),mysql_real_escape_string($email),mysql_real_escape_string($password));
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query:'.mysql_error();
                        }else
                        {
                           echo json_encode(array('status'=>'sent','email' => $email,'confirmation'=>$confirmation));
                        }

                    }
                    else
                    {
                        echo json_encode(array('status'=>'login','email' => $email,'confirmation'=>$confirmation));
                    }
                }
            }
            else echo "Invalid Email or Confirmation Code";
            break;
        case 'POST':
            break;
    }
?>
