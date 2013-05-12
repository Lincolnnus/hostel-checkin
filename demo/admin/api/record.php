<?php
function getRecord($rid)
{
	    $query = sprintf("SELECT email FROM `record` WHERE rid='%s'",mysql_real_escape_string($rid));
	    $result = mysql_query($query);
	    if (!$result) {
		   return false;
	    }else if(mysql_num_rows($result)<=0)
	    {return false;}
	    $row=mysql_fetch_array($result);
	    return $row;//successfully get record information*/
}
function checkRecord($booking){
	$bid=$booking[0];
	$confirmation=$booking[1];
	 $query = sprintf("SELECT * FROM `record` WHERE rid='%s'",mysql_real_escape_string($bid));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    echo($message);
	    }else if(mysql_num_rows($result)<=0)
	    {
            return false;
	    }
		return $bid;

	
	
	}
function saveRecord($booking)
{
	$bid=$booking[0];
	$confirmation=$booking[1];
	$email=$booking[16];
	for($i=0;$i<count($booking);$i++)
	{
	  $b[]= $booking[$i];
	}
	// Formulate Query
	// This is the best way to perform an SQL query
	// For more examples, see mysql_real_escape_string()
	$query = sprintf("INSERT INTO `record`(rid,
		confirmation,
		hotelName,
		priceName,
		status,
		createDate,
		codeID,
		title,
		name,
		firstName,
		address,
		company,
		zip,
		city,
		country,
		state,
		email,
		tel,fax,currency,totalPrice,totalRoom,visitortax,totalVisitortax,origin,amountcc,autorisationcc,transactioncc,comment,roomnamelist,rememberprice,room1,typeofbed1,numberofadults1,arrivalday1,arrivalmonth1,arrivalyear1,arrivalhour1,numberofdays1,nonsmoking1,numberofchildren1,room2,typeofbed2,numberofadults2,arrivalday2,arrivalmonth2,arrivalyear2,arrivalhour2,numberofdays2,nonsmoking2,numberofchildren2,room3,typeofbed3,numberofadults3,arrivalday3,arrivalmonth3,arrivalyear3,arrivalhour3,numberofdays3,nonsmoking3,numberofchildren3,typeresa,extrafield,lastadminID) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
	mysql_real_escape_string($b[0]),
	mysql_real_escape_string($b[1]),
	mysql_real_escape_string($b[2]),
	mysql_real_escape_string($b[3]),
	mysql_real_escape_string($b[4]),
	mysql_real_escape_string($b[5]),
        mysql_real_escape_string($b[6]),
	mysql_real_escape_string($b[7]),
	mysql_real_escape_string($b[8]),
	mysql_real_escape_string($b[9]),
	mysql_real_escape_string($b[10]),
	mysql_real_escape_string($b[11]),
	mysql_real_escape_string($b[12]),
	mysql_real_escape_string($b[13]),
	mysql_real_escape_string($b[14]),
	mysql_real_escape_string($b[15]),
        mysql_real_escape_string($b[16]),
	mysql_real_escape_string($b[17]),
	mysql_real_escape_string($b[18]),
	mysql_real_escape_string($b[19]),
        mysql_real_escape_string($b[20]),
	mysql_real_escape_string($b[21]),
	mysql_real_escape_string($b[22]),
	mysql_real_escape_string($b[23]),
	mysql_real_escape_string($b[24]),
	mysql_real_escape_string($b[25]),
        mysql_real_escape_string($b[26]),
	mysql_real_escape_string($b[27]),
	mysql_real_escape_string($b[28]),
	mysql_real_escape_string($b[29]),
        mysql_real_escape_string($b[30]),
	mysql_real_escape_string($b[31]),
	mysql_real_escape_string($b[32]),
	mysql_real_escape_string($b[33]),
	mysql_real_escape_string($b[34]),
	mysql_real_escape_string($b[35]),
        mysql_real_escape_string($b[36]),
	mysql_real_escape_string($b[37]),
	mysql_real_escape_string($b[38]),
	mysql_real_escape_string($b[39]),
	mysql_real_escape_string($b[40]),
	mysql_real_escape_string($b[41]),
	mysql_real_escape_string($b[42]),
	mysql_real_escape_string($b[43]),
	mysql_real_escape_string($b[44]),
	mysql_real_escape_string($b[45]),
        mysql_real_escape_string($b[46]),
	mysql_real_escape_string($b[47]),
	mysql_real_escape_string($b[48]),
	mysql_real_escape_string($b[49]),
	mysql_real_escape_string($b[50]),
	mysql_real_escape_string($b[51]),
	mysql_real_escape_string($b[52]),
	mysql_real_escape_string($b[53]),
	mysql_real_escape_string($b[54]),
	mysql_real_escape_string($b[55]),
        mysql_real_escape_string($b[56]),
	mysql_real_escape_string($b[57]),
	mysql_real_escape_string($b[58]),
	mysql_real_escape_string($b[59]),
        mysql_real_escape_string($b[60]),
        mysql_real_escape_string($b[61]),
	mysql_real_escape_string($b[62]),
	mysql_real_escape_string($uid)
 );

	// Perform Query
	$result = mysql_query($query);
	// Check result
	// This shows the actual query sent to MySQL, and the error. Useful for debugging.
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}else {
		
		
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
							
			return sendFreshCustomer($email,$Customer,$password,$confirmation);
				
							
							
                        }
                        
                    }
                    else
                    {
                     	$name=$b[7]."".$b[9]." ".$b[8];
		                return sendConfirmation($b[16],$name,$b[1]);
                    }

		
		
		
		
		
		
	
	}
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