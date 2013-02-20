<?php
if(isset($_POST["uid"])&&isset($_["token"]))
{
        //login
	$email=$_POST["email"];
	$password=md5($_POST["password"]);
	include_once("user.php");
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
