<?php
    include_once("connection.php");
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
                $hid=1;
                $query = sprintf("SELECT * FROM `hotel` WHERE hid='%s'",mysql_real_escape_string($hid));
                $result = mysql_query($query);
                if (!$result) {
                    $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    die($message);
                }else if(mysql_num_rows($result)<=0){echo "No Such Hotel";}
                else
                {
                    $row=mysql_fetch_array($result);
                    $hotel=array('name'=>$row["hname"],'address'=>$row["haddress"],'step'=>$row["step"],'logo'=>$row["imageUrl"],'zip'=>$row["zip"],'contact'=>$row["contact"],'tac'=>$row["tac"]);
                    echo json_encode($hotel);
                }
            break;
        case 'POST':
            if(isset($_POST["step"]))
            {
                switch ($_POST["step"])
                {
                    case '1':
                        $name=$_POST["name"];$address=$_POST["address"];
                        $zip=$_POST["zip"];$contact=$_POST["contact"];
                        $query = sprintf("UPDATE `hotel` SET hname='%s', haddress='%s', step='%s',zip='%s',contact='%s' WHERE hid='%s'",mysql_real_escape_string($name),mysql_real_escape_string($address),mysql_real_escape_string(2),mysql_real_escape_string($zip),mysql_real_escape_string($contact),mysql_real_escape_string(1));
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysql_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            die($message);
                        }
                        else
                        {
                            echo json_encode("successfully updated");
                        }
                        break;
                    case '2':
                        $logo=$_POST["logo"];
                        $query = sprintf("UPDATE `hotel` SET imageUrl='%s', step='%s' WHERE hid='%s'",mysql_real_escape_string($logo),mysql_real_escape_string(3),mysql_real_escape_string(1));
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysql_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            die($message);
                        }
                        else
                        {
                            echo json_encode("successfully updated");
                        }
                        break;
                    case '3':
                        $tac=$_POST["tac"];
                        $query = sprintf("UPDATE `hotel` SET tac='%s', step='%s' WHERE hid='%s'",mysql_real_escape_string($tac),mysql_real_escape_string(4),mysql_real_escape_string(1));
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysql_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            die($message);
                        }
                        else
                        {
                            echo json_encode("successfully updated");
                        }
                        break;
                    case '4':
                        $hid=1;
                        $query = sprintf("SELECT * FROM `hotel` WHERE hid='%s'",mysql_real_escape_string($hid));
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysql_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            die($message);
                        }else if(mysql_num_rows($result)<=0){echo "No Such Hotel";}
                        else
                        {
                            $row=mysql_fetch_array($result);
                            $hotel='<?xml version="1.0" encoding="utf-8"?><hotel>';
                            $hotel.="<name>".$row["hname"]."</name><address>".$row["haddress"]."</address><step>".$row["step"]."</step><logo>".$row["imageUrl"]."</logo><zip>".$row["zip"]."</zip><contact>".$row["contact"]."</contact><tac>".$row["tac"]."</tac>";
                            $hotel.="</hotel>";
                            $file=SERVER_DIR."/hotel.xml";
                            // Open file to write
                            $fh = fopen($file, 'r+');
                            fwrite($fh, $hotel);
                            fclose($fh);
                            echo json_encode("successfully built");
                        }
                }
            }
            break;
    }
?>
