<?php
require_once("connection.php");//Connect to the Database
require_once("settings2.php");//Input Settings
getPreferences();//Initialize Settings
switch ($_SERVER['REQUEST_METHOD']) 
{
case 'GET':
if(isset($_GET["uid"])&&isset($_GET["token"]))
{
	$uid=$_GET["uid"];
	$token=$_GET["token"];
	
		switch ($_GET["action"])
		{
			case 'getNewHotels':
			echo json_encode(getNewHotels());
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
			break;
            case 'deleteHotel':
            $hid=$_POST["hid"];
            echo json_encode(deleteHotel($hid));
			break;
			case 'verifyHotel':
			$hid=$_POST["hid"];
			
			if(verifyHotel($hid))
			{	                           
            $to = $_POST["to"];                             
			$hotelname=$_POST["hname"];
			$hotelmanager=$_POST["hmanager"];
			if(sendVerificationEmail($to,$hotelname,$hotelmanager)) echo json_encode("success");
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
				if(sendHTMLEmail($from,$to,$subject)) echo json_encode("success");
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
?>
