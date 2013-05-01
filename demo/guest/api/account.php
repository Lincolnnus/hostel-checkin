<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if((isset($_GET["uid"]))&&(isset($_GET["token"])))
    {
	$uid=$_GET["uid"];$token=$_GET["token"];$email=$_GET["email"];
	if (authentication($uid,$token))
        {
		$query = sprintf("SELECT * FROM `user` WHERE email='%s'",
		mysql_real_escape_string($email)
		 );
		$result = mysql_query($query);
		if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo $message;
		}
		else{    
		     if(mysql_num_rows($result)==0)
		     { echo "No Such user";}
		     else
		     {  
		          $row=mysql_fetch_array($result);
                 $uid=$row["uid"];
                 $fname=$row["fname"];
                 $lname=$row["lname"];
                 $title=$row["title"];
				  $sex=$row["sex"];
                 $uaddress=$row["uaddress"];
				 $passport=$row["passport"];
                 $birth=$row["birth"];
				  $issueDate=$row["issueDate"];
                 $expireDate=$row["expireDate"];
				    $issueCountry=$row["issueCountry"];
					 $nationality=$row["nationality"];
					$birthPlace=$row["birthPlace"];
					 $issueCity=$row["issueCity"];
					  $phone=$row["phone"];
					  $sex=$row["sex"];
					  
                 $user = array(
                               "uid" => $uid,
                               "fname"=>$fname,
                               "lname"=>$lname,
							    "sex"=>$sex,
                               "uaddress"=>$uaddress,
                               "title"=>$title,
							   "passport"=>$passport,
							   "birth"=>$birth,
							   "issueDate"=>$issueDate,
                               "expireDate"=>$expireDate,
							   "issueCountry"=>$issueCountry,
							     "nationality"=>$nationality,
								  "issueCity"=>$issueCity,
								     "birthPlace"=>$birthPlace,
									 "phone"=>$phone,
									 "sex"=>$sex
									
							  
                               );
                 echo json_encode($user);
          	}
		}
	}
	else echo "Invalid Access Token";
    }
    else echo "Invalid Token or User ID";
    break;
    case 'POST':
    if((isset($_POST["uid"]))&&(isset($_POST["token"]))&&(isset($_POST["task"])))
    {
    	$uid=$_POST["uid"];$token=$_POST["token"];
    	if(authentication($uid,$token))
    	{
		$task=$_POST["task"];
        switch ($task)
        {
           case 'changeProfile':
		if((isset($_POST["lname"]))&&(isset($_POST["fname"])))
		{
			$email=$_POST["email"];$fname=$_POST["fname"];$lname=$_POST["lname"];$title=$_POST["title"];$phone=$_POST["phone"];$sex=$_POST["sex"];$birth=$_POST["birth"];
			if (authentication($uid,$token))
			{
				$query = sprintf("UPDATE `user` SET fname='%s',lname='%s',title='%s',birth='%s',phone='%s',sex='%s',email='%s' WHERE uid='%s'",
				mysql_real_escape_string($fname),
				mysql_real_escape_string($lname),
				mysql_real_escape_string($title),
				mysql_real_escape_string($birth),
				mysql_real_escape_string($phone),
				mysql_real_escape_string($sex),
				mysql_real_escape_string($email),
				mysql_real_escape_string($uid)
				 );
				$result = mysql_query($query);
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				 echo json_encode("success");
				}
			}
			else echo "Invalid Access Token";
		}else echo "parameters missing for changeprofile";
	        break;
			 case 'changePassport':
                if((isset($_POST["email"]))&&(isset($_POST["passport"]))&&(isset($_POST["issueDate"]))&&(isset($_POST["expireDate"])))
                {
                    $email=$_POST["email"];
                    $passport=$_POST["passport"];
                    $issueDate=$_POST["issueDate"];
                    $expireDate=$_POST["expireDate"];
                    $issueCountry=$_POST["issueCountry"];
					$issueCity=$_POST["issueCity"];                   
					$sex=$_POST["sex"];
					$address=$_POST["address"];
					$birthPlace=$_POST["birthPlace"];
					$birth=$_POST["birth"];
					$nationality=$_POST["nationality"];






                    if (authentication($uid,$token))
                    {
                        $query = sprintf("UPDATE `user` SET passport='%s',issueDate='%s',expireDate='%s',issueCountry='%s',issueCity='%s',sex='%s',uaddress='%s',birthPlace='%s',birth='%s',nationality='%s' WHERE email='%s'",
                                         mysql_real_escape_string($passport),
                                         mysql_real_escape_string($issueDate),
                                         mysql_real_escape_string($expireDate),
                                         mysql_real_escape_string($issueCountry),
                                         mysql_real_escape_string($issueCity),
										 mysql_real_escape_string($sex),
										  mysql_real_escape_string($address),
										    mysql_real_escape_string($birthPlace),
											 mysql_real_escape_string($birth),
											 mysql_real_escape_string($nationality),
                                         mysql_real_escape_string($email)
                                         );
                        $result = mysql_query($query);
                        if (!$result) {
                            $message  = 'Invalid query: ' . mysql_error() . "\n";
                            $message .= 'Whole query: ' . $query;
                            echo $message;
                        }
                        else{    
                            echo json_encode("success");
                        }
                    }
                    else echo "Invalid Access Token";
                }else echo "parameters missing for changeprofile";
                break;
			case 'changePreference':
		if((isset($_POST["select1"])))
		{
			$eMotel=$_POST["eMotel"];$eBinn=$_POST["eBinn"];$eBhotel=$_POST["eBhotel"];$eSchain=$_POST["eSchain"];
			$mBinn=$_POST["mBinn"];$mIbhotel=$_POST["mIbhotel"];$mSchain=$_POST["mSchain"];$mBchain=$_POST["mBchain"];
			$uIbhotel=$_POST["uIbhotel"];$uSchain=$_POST["uSchain"];$uBchain=$_POST["uBchain"];$uChotel=$_POST["uChotel"];
			
			$select1=$_POST["select1"]; $select2=$_POST["select2"];$select3=$_POST["select3"];$select4=$_POST["select4"];
			
			$select5=$_POST["select5"];$select6=$_POST["select6"];$select7=$_POST["select7"]; $select8=$_POST["select8"];
			$select9=$_POST["select9"];$select10=$_POST["select10"];$select11=$_POST["select11"];
			
			if (authentication($uid,$token))
			{
		$query = sprintf("UPDATE `preference` SET eMotel='%s',eBinn='%s',eBhotel='%s',eSchain='%s',mBinn='%s',mIbhotel='%s',mSchain='%s',mBchain='%s',uIbhotel='%s',uSchain='%s',uBchain='%s',uChotel='%s',select1='%s',select2='%s' ,select3='%s',select4='%s',select5='%s',select6='%s',select7='%s',select8='%s',select9='%s',select10='%s',select11='%s' WHERE uid='%s'",
				mysql_real_escape_string($eMotel),
				mysql_real_escape_string($eBinn),
				mysql_real_escape_string($eBhotel),
				mysql_real_escape_string($eSchain),	
				mysql_real_escape_string($mBinn),
				mysql_real_escape_string($mIbhotel),
				mysql_real_escape_string($mSchain),
				mysql_real_escape_string($mBchain),	
				mysql_real_escape_string($uIbhotel),
				mysql_real_escape_string($uSchain),
				mysql_real_escape_string($uBchain),
			    mysql_real_escape_string($uChotel),
				mysql_real_escape_string($select1),
				mysql_real_escape_string($select2),
				mysql_real_escape_string($select3),
				mysql_real_escape_string($select4),
			   
				mysql_real_escape_string($select5),
				mysql_real_escape_string($select6),
					mysql_real_escape_string($select7),
					mysql_real_escape_string($select8),
					mysql_real_escape_string($select9),
						mysql_real_escape_string($select10),
						mysql_real_escape_string($select11),
				mysql_real_escape_string($uid)
				 );
				$result = mysql_query($query);
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				 echo json_encode("success");
				}
			}
			else echo "Invalid Access Token";
		}else echo "parameters missing for changeprofile";
	        break;


	case 'getPreference':
			echo json_encode(getPre($uid));
			break;
			




           case 'changePass':
		if((isset($_POST["oldpass"]))&&(isset($_POST["password"]))&&(isset($_POST["confirmpass"])))
		{
			$uid=$_POST["uid"];$oldpass=$_POST["oldpass"];$password=$_POST["password"];$confirmpass=$_POST["confirmpass"];
			if ($password!=$confirmpass){echo "New Password Doesn't Match";exit;}
			if (!validateoldpass($uid,$oldpass)){echo "Old password Not Correct!";exit;}
			if (authentication($uid,$token))
			{
				$query = sprintf("UPDATE `user` SET password='%s' WHERE uid='%s'",
				mysql_real_escape_string($password),
				mysql_real_escape_string($uid)
				 );
				$result = mysql_query($query);
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				 echo json_encode("success");
				}
			}
			else echo "Invalid Access Token";
		}else echo "parameters missing for changepass";
		break;
	}
	}
    }
    else echo "Invalid Token or User ID";
    break;
}
function authentication($uid,$token)
{
	$query = sprintf("SELECT * FROM `user` WHERE uid='%s' AND token='%s'",
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
        {return false;}
	return true;
}
function validateoldpass($uid,$oldpass)
{
	$query = sprintf("SELECT * FROM `user` WHERE uid='%s' AND password='%s'",
		mysql_real_escape_string($uid),
		mysql_real_escape_string($oldpass)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return false;
	}
	else if(mysql_num_rows($result) == 0)
        {return false;}
	return true;
}

function getPre($uid)
{
					$query = sprintf("SELECT * FROM `preference` WHERE uid='%s'",
		mysql_real_escape_string($uid));
	$result = mysql_query($query);
				
				
				if (!$result) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    echo $message;
				}
				else{    
				while($row=mysql_fetch_array($result))
			$hotel[]=$row;
			
		return $hotel;
				}
}
?>
