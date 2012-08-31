<?php
include_once("connection.php"); 
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'GET':
    if(isset($_GET["upid"]))
    {
	    $upid=$_GET["upid"];
	    $query = sprintf("SELECT * FROM `upload` WHERE upid='%s'",mysql_real_escape_string($upid));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
	    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
	    else 
            {
		require_once 'excel_reader.php';
		$row=mysql_fetch_array($result);
		$data = new Spreadsheet_Excel_Reader($row["fname"]);
		$arr = array('uploader' => $row["uid"], 'importSource' => $row["fname"],'xls' => $data->dump(true,true));
		echo json_encode($arr);
           }//successfully get upload information
    }
    else if(isset($_GET["rid"]))
    {
	    $rid=$_GET["rid"];
	    $query = sprintf("SELECT email FROM `record` WHERE rid='%s'",mysql_real_escape_string($rid));
	    $result = mysql_query($query);
	    if (!$result) {
		    $message  = 'Invalid query: ' . mysql_error() . "\n";
		    $message .= 'Whole query: ' . $query;
		    die($message);
	    }else if(mysql_num_rows($result)<=0){echo "No Such record";}
	    else {$row=mysql_fetch_array($result);echo json_encode($row);}//successfully get record information
    }
    break;
    case 'POST':
    $uid=$_POST["uid"];
    if (authentication($uid))
    {
	$importSource=$_POST["importSource"];
	$booking=$_POST["booking"];
	$bid=$booking[0];
	$confirmation=$booking[1];
	for($i=0;$i<count($booking);$i++)
	{
	  $b[]= $booking[$i];
	}
	// Formulate Query
	// This is the best way to perform an SQL query
	// For more examples, see mysql_real_escape_string()
	$query = sprintf("INSERT INTO `record`(rid,confirmation,hotelName,priceName,status,createDate,codeID,title,name,firstName,address,company,zip,city,country,state,email,tel,fax,currency,totalPrice,totalRoom,visitortax,totalVisitortax,origin,amountcc,autorisationcc,transactioncc,comment,roomnamelist,rememberprice,room1,typeofbed1,numberofadults1,arrivalday1,arrivalmonth1,arrivalyear1,arrivalhour1,numberofdays1,nonsmoking1,numberofchildren1,room2,typeofbed2,numberofadults2,arrivalday2,arrivalmonth2,arrivalyear2,arrivalhour2,numberofdays2,nonsmoking2,numberofchildren2,room3,typeofbed3,numberofadults3,arrivalday3,arrivalmonth3,arrivalyear3,arrivalhour3,numberofdays3,nonsmoking3,numberofchildren3,typeresa,extrafield,lastadminID,uploadStatus,importSource) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
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
	mysql_real_escape_string($uid),
	mysql_real_escape_string("success"),
	mysql_real_escape_string($importSource)
 );
	// Perform Query
	$result = mysql_query($query);
	// Check result
	// This shows the actual query sent to MySQL, and the error. Useful for debugging.
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	}else echo json_encode("success");//successfully insert the record
      }
      else echo "Authentication Failed";
    break;
}
function authentication($uid)
{
   return true;
}
?>
