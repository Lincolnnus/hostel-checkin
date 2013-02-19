<?php
    if(isset($_REQUEST["email"]))
    {
        $email=$_REQUEST["email"];
        define("PEAR_PATH","/usr/local/share/pear");
        ini_set('include_path', PEAR_PATH);
        require_once "Mail.php";
        $subject = "Welcome to Mobile Checkin";
        $from = "Mobile Checkin<noreply@checkin.com>";
        $to = $email;
        $signature="Mobile Checkin Team";
        $token=md5($email);
        $url="http://192.168.0.12/check/api/verify.php?email=".$email."&token=".$token;
        $message = "Please confirm your email using the following link:\n\n".$url."\n\nBest Regards,\n".$signature."\n";
        $host = "ssl://smtp.gmail.com";
        $port = "465";
        $username = "lincolnnus@gmail.com";
        $password = "33455432";
        $headers = array ('From' => $from,
                          'To' => $to,
                          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
                              array ('host' => $host,
                                     'port' => $port,
                                     'auth' => true,
                                     'username' => $username,
                                     'password' => $password));
        $mail = $smtp->send($to, $headers, $message);
        if (PEAR::isError($mail)) {
            echo  $mail->getMessage();
        } else {
            echo json_encode("Email sent for ".$email);
        }
    }
    ?>