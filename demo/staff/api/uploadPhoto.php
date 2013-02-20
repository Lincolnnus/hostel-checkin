<?php

include_once("connection.php");
    function base64_encode_image ($imagefile) {
        $imgtype = array('jpg', 'gif', 'png');
        $filename = file_exists($imagefile) ? htmlentities($imagefile) : die('Image file name does not exist');
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($filetype, $imgtype)){
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        } else {
            die ('Invalid image type, jpg, gif, and png is only allowed');
        }
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
    $path="../upload/";
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'POST':
            $uid=$_POST["uid"];
            $token=$_POST["token"];
            if (authentication($uid,$token))
            {
                $allowedExts = array("jpg","png","jpeg");
                $extension = end(explode(".", $_FILES["file"]["name"]));
                if (($_FILES["file"]["size"] < 4000000)&& in_array($extension, $allowedExts))
                {
                    if ($_FILES["file"]["error"] > 0)
                    {
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    }
                    else
                    {
                        if (file_exists($path. $_FILES["file"]["name"]))
                        { echo $_FILES["file"]["name"] . " already exists. ";}
                        else
                        {
                            move_uploaded_file($_FILES["file"]["tmp_name"], $path . $_FILES["file"]["name"]);
                            $fname=$path . $_FILES["file"]["name"];
                            $img=base64_encode_image($fname);
                            include_once("connection.php");
                            $email=$_POST["email"];
                            unlink($fname);
                            $query = sprintf("UPDATE `user` SET idPhoto='%s' WHERE email='%s'",
                                             mysql_real_escape_string($img),
                                             mysql_real_escape_string($email));
                            $result = mysql_query($query);
                            if (!$result) {
                                echo "fail";
                            }
                            else {
                                echo '<html><body><img width="30px" src="'.$img.'"/></body></html>';
                            }
                        }
                    }
                }else { echo "Invalid file"; }
            }
            else echo "Authentication Failed";
            break;
    }
   function authentication($uid,$token)
{
    $query = sprintf("SELECT * FROM `staff` WHERE uid='%s' AND token='%s'",
        mysql_real_escape_string($uid),
        mysql_real_escape_string($token)
     );
    $result = mysql_query($query);
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        return false;
    }
   else if(mysql_num_rows($result) == 0)
        { return false;}
    return true;
}
    ?>
