<?php
   include_once("connection.php"); 
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            if((isset($_GET["email"]))&&(isset($_GET["confirmation"])))
            {
                $email=$_GET["email"];
                $confirmation=$_GET["confirmation"];
                $query = sprintf("SELECT * FROM `record` WHERE email='%s' AND confirmation='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
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
                        
                        $insert=  splittable ($email,$confirmation);
                        if (!$insert) {
                            $message  = 'Invalid query:'.mysql_error();
                       }else

                        {
							 $password=md5(time());
							  $query2 = sprintf("UPDATE `user` SET password='%s' WHERE email='%s'",mysql_real_escape_string($password),mysql_real_escape_string($email));
							   $result2=mysql_query($query2);
							  update_token($email);
							 
	
							 
							
							 $query = sprintf("SELECT * FROM `user` WHERE email='%s'",mysql_real_escape_string($email));
                    $result = mysql_query($query);
							if (!$result) {
	                             $message  = 'Invalid query: ' . mysql_error() . "\n";
                    $message .= 'Whole query: ' . $query;
                    die($message);
	               }else if(mysql_num_rows($result)<=0){echo "No Such Hotel";}
	else { 
		 $row=mysql_fetch_array($result);
		 $userId=$row["uid"];
		 setPre($userId);
                    $CustomerName=array('fname'=>$row["fname"],'lname'=>$row["lname"]);
		
	}
					$fname=$CustomerName['fname'];	
					$lname=$CustomerName['lname'];	
					$Customer=$fname.$lname;
								include_once("email.php");
			sendCustomer($email,$Customer,$password);
				
							
							
                            echo json_encode(array('status'=>'sent','email' => $email,'confirmation'=>$confirmation));
                        }
                        
                    }
                    else
                    {
                        $user=mysql_fetch_array($result);
                        $status=$user["status"];
                        $insert=  insertBooking ($email,$confirmation);
                        if (!$insert) {
                            $message  = 'Invalid query:'.mysql_error();
                        }else
                        {
                            echo json_encode(array('status'=>$status,'email' => $email,'confirmation'=>$confirmation));
                        }
                    }
                }
            }
            else  {$message="Invalid Email or Confirmation Code";}
            if (isset($message)) { echo $message;}
            break;
    }
    function splittable ($email,$confirmation){
        $resultI = FALSE;
        if (mysql_query('BEGIN')) {
            $queryInsertUser = sprintf("INSERT user (title, fname, lname, uaddress, email, phone)SELECT title, firstName, name, address,  email, tel  FROM `record` WHERE email='%s' AND confirmation='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
            $resultI1= mysql_query($queryInsertUser);
            //$cid = mysql_insert_id();
            
            /* $bid = mysql_insert_id();
             $queryUpdateBooking= sprintf("UPDATE booking SET cid='%s' WHERE id='%s'", mysql_real_escape_string($cid),mysql_real_escape_string($bid));
             $resultI3= mysql_query($queryUpdateBooking);*/
            if($resultI1)  {
                $resultI = mysql_query('COMMIT'); // both queries looked OK, save
            }
            else{
                mysql_query('ROLLBACK'); // problems with queries, no changes
            }
        }
        return $resultI;
        
    }
	function update_token($email)
{
   $tokenLen = 16;
   if (file_exists('/dev/urandom')) { // Get 100 bytes of random data
		$randomData = file_get_contents('/dev/urandom', false, null, 0, 100) . uniqid(mt_rand(), true);
   } else {
		$randomData = mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true);
   }
   $token= substr(hash('sha512', $randomData), 0, $tokenLen);
   $query = sprintf("UPDATE user SET token='%s' WHERE email='%s'",
		mysql_real_escape_string($token),
		mysql_real_escape_string($email)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return 0;
	}
        else
        {
           return $token;
        }
}
    
    function insertBooking ($email,$confirmation){
        $resultI = FALSE;
        if (mysql_query('BEGIN')) {
            $query = sprintf("SELECT * FROM `booking` WHERE email='%s' AND confirmation='%s'",mysql_real_escape_string($email),mysql_real_escape_string($confirmation));
            $result = mysql_query($query);
            
            if (!$result) {
                
                $message = 'Invalid query:'.mysql_error();
            }else if(mysql_num_rows($result)<=0)
            {
                $queryInsertBooking= sprintf("INSERT  INTO `booking`(`rid`,`email`,`confirmation`,`hotelName`,`priceName`,`status`,`createDate`,`codeID`,`currency`,`totalPrice`,`totalRoom`,`visitortax`,`totalVisitortax`,`origin`,`amountcc`,`autorisationcc`,`transactioncc`,`comment`,`roomnamelist`,`rememberprice`,`room1`,`typeofbed1`,`numberofadults1`,`arrivalday1`,`arrivalmonth1`,`arrivalyear1`,`arrivalhour1`,`numberofdays1`,`nonsmoking1`,`numberofchildren1`,`room2`,`typeofbed2`,`numberofadults2`,`arrivalday2`,`arrivalmonth2`,`arrivalyear2`,`arrivalhour2`,`numberofdays2`,`nonsmoking2`,`numberofchildren2`,`room3`,`typeofbed3`,`numberofadults3`,`arrivalday3`,`arrivalmonth3`,`arrivalyear3`,`arrivalhour3`,`numberofdays3`,`nonsmoking3`,`numberofchildren3`,`typeresa`,`extrafield`)                                         SELECT `rid`,`email`,`confirmation`,`hotelName`,`priceName`,`status`,`createDate`,`codeID`,`currency`,`totalPrice`,`totalRoom`,`visitortax`,`totalVisitortax`,`origin`,`amountcc`,`autorisationcc`,`transactioncc`,`comment`,`roomnamelist`,`rememberprice`,`room1`,`typeofbed1`,`numberofadults1`,`arrivalday1`,`arrivalmonth1`,`arrivalyear1`,`arrivalhour1`,`numberofdays1`,`nonsmoking1`,`numberofchildren1`,`room2`,`typeofbed2`,`numberofadults2`,`arrivalday2`,`arrivalmonth2`,`arrivalyear2`,`arrivalhour2`,`numberofdays2`,`nonsmoking2`,`numberofchildren2`,`room3`,`typeofbed3`,`numberofadults3`,`arrivalday3`,`arrivalmonth3`,`arrivalyear3`,`arrivalhour3`,`numberofdays3`,`nonsmoking3`,`numberofchildren3`,`typeresa`,`extrafield` FROM record WHERE email='%s'",mysql_real_escape_string($email));
                $resultI2= mysql_query($queryInsertBooking);
                if($resultI2)  {
                    $resultI = mysql_query('COMMIT'); // both queries looked OK, save
                }
                else{
                    mysql_query('ROLLBACK'); // problems with queries, no changes
                }
            }
            else {$resultI=TRUE;}
        }
        return $resultI;
        
    }
		function setPre($uid){
			
    $query = sprintf("INSERT INTO `preference`(uid) VALUES('%s')",
	mysql_real_escape_string($uid)
 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	      return 0;
	}
        else
        {
          return true;
        }
}

    
    ?>
