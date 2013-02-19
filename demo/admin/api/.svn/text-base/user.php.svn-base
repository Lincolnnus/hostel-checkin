<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    $uid=$_GET["uid"];
    if(isset($_GET["field"]))
    {
	  switch ($_GET["field"]) 
          {
            case 'upload':
		    $query = sprintf("SELECT * FROM `upload` WHERE uid='%s'",mysql_real_escape_string($uid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
		    else 
		    {
			while($row=mysql_fetch_array($result)) $upload[]=$row;
			echo json_encode(array('upload' => $upload));
		    }//successfully get upload information
            break;
            case 'record':
		    $query = sprintf("SELECT * FROM `record` WHERE lastadminID='%s'",mysql_real_escape_string($uid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
		    else 
		    {
			while($row=mysql_fetch_array($result)) $record[]=$row;
			echo json_encode(array('record' => $record));
		    }//successfully get record information
            break;
            case 'checkin':
		    $query = sprintf("SELECT * FROM `checkin` WHERE uid='%s'",mysql_real_escape_string($uid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
		    else 
		    {
			while($row=mysql_fetch_array($result)) $checkin[]=$row;
			echo json_encode(array('checkin' => $checkin));
		    }//successfully get checkin information
            break;
	    case 'book':
		    $query = sprintf("SELECT * FROM `book` WHERE uid='%s'",mysql_real_escape_string($uid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
		    else 
		    {
			while($row=mysql_fetch_array($result)) $book[]=$row;
			echo json_encode(array('book' => $book));
		    }//successfully get checkin information
            break;
           }
    }
    break;
    case 'POST':
     if(!isset($_POST["uid"])) echo "Error:No User";
     else
     {
         $uid=$_POST["uid"];
	 $query = sprintf("SELECT email FROM `user` WHERE uid='%s'",
		mysql_real_escape_string($uid)
	 );
	 $result = mysql_query($query);
	 if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	 }
	 else  if(mysql_num_rows($result)<=0){echo "No Such user";}
         else {
		$row=mysql_fetch_array($result);$email=$row["email"];
	 }//successfully get user information
	  switch ($_POST['field']) 
	 {
	     case 'checkin':
	     if(isset($_POST["rid"]))
	     {
		    $rid=$_POST["rid"];
		    $query = sprintf("SELECT * FROM `book` WHERE recordID='%s'",mysql_real_escape_string($rid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0)
		    { 
			    $query = sprintf("SELECT * FROM `record` WHERE rid='%s'",mysql_real_escape_string($rid));
			    $result2 = mysql_query($query);
			    if (!$result2) {
				    $message  = 'Invalid query: ' . mysql_error() . "\n";
				    $message .= 'Whole query: ' . $query;
				    die($message);
			    }else if(mysql_num_rows($result2)<=0){echo "Error:No Such record";}
			    else 
			    {
				$row=mysql_fetch_array($result2);
                                if($row["email"]==$email) 
                                { 
                                     //Insert To the book table
                                     echo json_encode(array('record' => $row)); 
                                }
                                else echo "Error:Emails don't match";
			    }//checkin step 1.
		    }
		    else 
		    {
                         //insert into the checkin table
			$row=mysql_fetch_array($result);echo json_encode(array('checkin' => $row));
		    }//successfully get checkin information
	     }else echo "No record selected";
	     break;
	     case 'checkout':
 	     if(isset($_POST["cid"]))
	     {
		    $cid=$_POST["cid"];
		    $query = sprintf("SELECT * FROM `checkin` WHERE cid='%s'",mysql_real_escape_string($cid));
		    $result = mysql_query($query);
		    if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
		    }else if(mysql_num_rows($result)<=0){ echo "error:no such checkin information";}
                    else{
		            $row=mysql_fetch_array($result); 
		            if (!$row["paid"])
		            {
		                    if (pay($cid)) 
		                    {
				            $query = sprintf("UPDATE `checkin` SET paid=1 WHERE cid='%s'",mysql_real_escape_string($cid));
					    $result = mysql_query($query);
					    if (!$result) echo "payment update error";
					    else echo json_encode("successfully paid");
		                    }else echo "error with payment";
		             }//Go to payment
		             else 
                             { 
				    $query = sprintf("UPDATE `checkin` SET checkoutDate=CURRENT_TIMESTAMP WHERE cid='%s'",mysql_real_escape_string($cid));
				    $result = mysql_query($query);
				    if (!$result) {echo "error checkout";}
				    else echo json_encode("successfully checkout");
		             }
                   }
             }else echo "No checkin id selected";//checkout
             break;
	  }
     }
    break;
}
function authentication($uid)
{
   return true;
}
function pay($cid)
{
  return true;
}
?>
