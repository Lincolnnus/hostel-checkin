<?php
require_once("includes/connection.php");//Connect to the Database
require_once("settings.php");//Input Settings
//getPreferences();//Initialize Settings
//include_once("hotel.php");
require_once("record.php");
require_once("email.php");
switch ($_SERVER['REQUEST_METHOD']) 
{
case 'GET':
if(isset($_GET["uid"])&&isset($_GET["token"]))
{
	$uid=$_GET["uid"];
	$token=$_GET["token"];
	if(verifyToken($uid,$token))//verify user token
	{
		switch ($_GET["action"])
		{
			case 'getStaff':
			$result = mysql_query("SELECT * FROM `stuff`");
	    	if (!$result) {
		  		  $message  = 'Invalid query: ' . mysql_error() . "\n";
		  		  $message .= 'Whole query: ' . $query;
		   		 echo($message);
	  		  }else 
	   		 {
				while($row=mysql_fetch_array($result)){$stuff[]=$row;}
				echo json_encode($stuff);
	   		 }//successfully get checkin information
			break;
			case 'getPreferences':
			echo json_encode(getPreferences());
			break;
			case 'getAuthorizedHotels':
			echo json_encode(getAuthorizedHotels());
			break;
			case 'getHotel':
			$hid=$_GET["hid"];
			echo json_encode(getHotel($hid));
			break;
			case 'getBrowsers':
			echo json_encode(getBrowsers());
			break;
			case 'getEmails':
			echo json_encode(getEmails());
			break;
			case 'getRecord':
			$rid=$_GET["rid"];
			echo json_encode(getRecord($rid));
			break;
		}
	}
}
break;
case'POST':
if(isset($_POST["uid"])&&isset($_POST["token"]))
{
        //login
	$uid=$_POST["uid"];
	$token=$_POST["token"];
	if(verifyToken($uid,$token))
	{
		switch ($_POST["action"])
		{
			case 'saveHotel':
			$hotel=$_POST["hotel"];
			echo json_encode(saveHotel($hotel));
			buildApp();
			
			break;
            case 'deleteHotel':
            $hid=$_POST["hid"];
            echo json_encode(deleteHotel($hid));
			break;
			case 'verifyHotel':
			$hid=$_POST["hid"];
			$email=$_POST["email"];
			if(verifyHotel($hid))
			{
				$from=$email["from"].'<noreply@asplan.com>';
				$to=$email["to"];
				$subject=$email["subject"];
				$message=$email["message"];
				if(sendHTMLEmail($from,$to,$subject,$message)) echo json_encode("success");
				else echo "Error Sending Email";
			}else echo "Error Verifying";
			break;
			case 'unverifyHotel':
			$hid=$_POST["hid"];
			$email=$_POST["email"];
			if(unverifyHotel($hid))
			{
				$from=$email["from"];
				$to=$email["to"];
				$subject=$email["subject"];
				$message=$email["message"];
				if(sendHTMLEmail($from,$to,$subject,$message)) echo json_encode("success");
				else echo "Error Sending Email";
			}else echo "Error Unverifying";
			break;
			case 'buildApp':
			$hid=$_POST["hid"];
			$hotel=getHotel($hid);
			echo json_encode(buildApp($hotel));
			break;
			case 'uploadLogo':
			$hid=$_POST["hid"];
			$allowedExts = array("jpg","png","jpeg");
	   		$extension = end(explode(".", $_FILES["file"]["name"]));
	 	    if (($_FILES["file"]["size"] < 4000000)&& in_array($extension, $allowedExts))
	 	   	{
		  		if ($_FILES["file"]["error"] > 0){
		     		echo "Error With File";
		 		}else{
					define("BUILD_DIR","../upload/");
               		move_uploaded_file($_FILES["file"]["tmp_name"], BUILD_DIR .$_FILES["file"]["name"]);
					$fname=BUILD_DIR . $_FILES["file"]["name"];
               		$img=base64_encode_image($fname);
					$logo=updateLogo($hid,$img);
					if($logo) echo $logo;
					else echo "Error";
					unlink($fname);
		 		 }
	     	 }else { echo "Invalid file"; }
			break;
			case 'updatePreferences':
			$settings=$_POST["settings"];
			echo json_encode(updatePreferences($settings));
			break;
			case 'startAll':
			echo json_encode(startAll());
			break;
			case 'backupAll':
			echo json_encode(backupAll());
			break;
			case 'shutdownAll':
			echo json_encode(shutdownAll());
			break;
			case 'setOffline':
			echo json_encode(setOffline());
			break;
			case 'updateBrowsers':
			$bid=$_POST["bid"];
			$supported=$_POST["supported"];
			echo json_encode(updateBrowsers($bid,$supported));
			break;
			case 'updateEmails':
			$eid=$_POST["eid"];



			$from=$_POST["from"];
			$subject=$_POST["subject"];
			$message=trim($_POST["message"]);
			echo json_encode(updateEmails($eid,$subject,$from,$message));
			break;
			case 'checkRecord':
			$booking=$_POST["booking"];
			if(checkRecord($booking))
				echo json_encode("Have record in table");
			else echo "Fail";
			break;
			case 'saveRecord':
			$booking=$_POST["booking"];
			if(saveRecord($booking))
				echo json_encode("Success");
			else echo "Fail";
			break;
		}
	}
}else if(isset($_POST["email"])&&isset($_POST["password"]))//user login
{
        //login
	$email=$_POST["email"];
	$password=$_POST["password"];
	$user=userLogin($email,$password);
	if($user){
		$uid=$user["uid"];
		$email=$user["email"];
		$uname=$user["uname"];
		$token=updateToken($uid);
		if ($token){
		$response=array('email'=>$email,'uname'=>$uname,'uid'=>$uid,'token'=>$token);
  		echo json_encode($response);
  		}else echo "Error updating token";
	}else echo "Error getting user";
}
break;
}
function verifyToken($uid,$token)
{
	$query = sprintf("SELECT * FROM `admin` WHERE uid='%s' AND token='%s'",
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
function updateLogo($hid,$img)
{
                 $query = sprintf("UPDATE `hotel` SET hlogo='%s' WHERE hid='%s'",
                                  mysql_real_escape_string($img),
                                  mysql_real_escape_string(1));
                 $result = mysql_query($query);
                 if (!$result) {
                     return false;
                 }
                 else {
                     return'<img width="100px" src="'.$img.'"/>';
                 }
}
	

function saveHotel($hotel)
{
	$hid=$hotel["hid"];
	$hname=$hotel["hname"];
	$haddress=$hotel["haddress"];
	$hzip=$hotel["hzip"];
	$hmanager=$hotel["hmanager"];
	$hphone=$hotel["hphone"];
	$hURL=$hotel["hURL"];
	$hemail=$hotel["hemail"];

	$query = sprintf("UPDATE `hotel` SET hname='%s',hemail='%s',haddress='%s',zip='%s',contact='%s',hmanager='%s',hURL='%s' WHERE hid='%s'",
		mysql_real_escape_string($hname),
		mysql_real_escape_string($hemail),
		mysql_real_escape_string($haddress),
		mysql_real_escape_string($hzip),
		mysql_real_escape_string($hphone),
		mysql_real_escape_string($hmanager),
		mysql_real_escape_string($hURL),
		mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		return true;
	}
}
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
	
	function buildApp()
{
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
							$hotel=$row;
                           $hotel='<?xml version="1.0" encoding="utf-8"?><hotel>'.
	 '<name>'.$hotel["hname"].'</name><address>'.$hotel["haddress"].'</address><manager>'.$hotel["hmanager"].'</manager><email>'.$hotel["hemail"].'</email><url>'.$hotel["hURL"].'</url><logo>'.
     $hotel["hlogo"].'</logo><zip>'.$hotel["zip"].'</zip>
     <contact>'.$hotel["contact"].'</contact><tac>Terms and Conditions</tac></hotel>';
                            $file="../../hotel.xml";
                            // Open file to write
                             if(!file_exists($file)){
  		return "File not found";
     }else{
 	  $fh = fopen($file, 'r+');
                            fwrite($fh, $hotel);
                            fclose($fh);

    
  	 }
                            
                            
                        }

}
function getHotel($hid)
{
		$query = sprintf("SELECT * FROM `hotel` WHERE hid='%s'",
		mysql_real_escape_string($hid));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		$hotel=mysql_fetch_array($result);
		return $hotel;
	}
}
?>

