<?php
function addHotel($email,$hotelname,$hoteladdr,$hotelmanager,$hotelphone,$hotelzip)
{
	$query = sprintf("INSERT INTO `hotel`(hname,haddress,hmanager,hphone,hzip,hemail) VALUES('%s','%s','%s','%s','%s','%s')",
		mysql_real_escape_string($hotelname),
		mysql_real_escape_string($hoteladdr),
		mysql_real_escape_string($hotelmanager),
		mysql_real_escape_string($hotelphone),
		mysql_real_escape_string($hotelzip),
		mysql_real_escape_string($email)
	 );
	$result = mysql_query($query);
	if (!$result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    return false;
	}
	else { 
		return true;
	}
}
function getAuthorizedHotels()
{
		$query = sprintf("SELECT * FROM `hotel` WHERE verified='%s' ORDER BY queryTime DESC",
		mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while($row=mysql_fetch_array($result))
			$hotel[]=$row;
		return $hotel;
	}
}
function getNewHotels()
{
		$query = sprintf("SELECT * FROM `hotel` WHERE verified='%s' ORDER BY queryTime DESC",
		mysql_real_escape_string(0));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while($row=mysql_fetch_array($result))
			$hotel[]=$row;
		return $hotel;
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
function saveHotel($hotel)
{
	$hid=$hotel["hid"];
	$hname=$hotel["hname"];
	$haddress=$hotel["haddress"];
	$hzip=$hotel["hzip"];
	$hmanager=$hotel["hmanager"];
	$hphone=$hotel["hphone"];
	$hURL=$hotel["hURL"];
	$hDB=$hotel["hDB"];
	$hDir=$hotel["hDir"];
	$query = sprintf("UPDATE `hotel` SET hname='%s',haddress='%s',hzip='%s',hphone='%s',hmanager='%s',hURL='%s', hDir='%s',hDB='%s' WHERE hid='%s'",
		mysql_real_escape_string($hname),
		mysql_real_escape_string($haddress),
		mysql_real_escape_string($hzip),
		mysql_real_escape_string($hphone),
		mysql_real_escape_string($hmanager),
		mysql_real_escape_string($hURL),
		mysql_real_escape_string($hDir),
		mysql_real_escape_string($hDB),
		mysql_real_escape_string($hid));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		return true;
	}
}
function deleteHotel($hid)
{
    

    $query = sprintf("DELETE FROM hotel WHERE hid='%s'",
        mysql_real_escape_string($hid));
    $result = mysql_query($query);
       if (!$result) {
        return false;
    }
       else    {
   
        return true;
       }
    
}
function verifyHotel($hid)
{
	$query = sprintf("UPDATE `hotel` SET verified='%s' WHERE hid='%s'",
		mysql_real_escape_string(1),
		mysql_real_escape_string($hid));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		$hotel=getHotel($hid);
		return true;
	}
}
function unverifyHotel($hid)
{
	$query = sprintf("UPDATE `hotel` SET verified='%s' WHERE hid='%s'",
		mysql_real_escape_string(0),
		mysql_real_escape_string($hid));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		return true;
	}
}
function updateLogo($hid,$img)
{
                 $query = sprintf("UPDATE `hotel` SET hlogo='%s' WHERE hid='%s'",
                                  mysql_real_escape_string($img),
                                  mysql_real_escape_string($hid));
                 $result = mysql_query($query);
                 if (!$result) {
                     return false;
                 }
                 else {
                     return'<img width="100px" src="'.$img.'"/>';
                 }
}
function shutdownAll()
{
	$query = sprintf("SELECT * FROM `hotel` WHERE verified='%s' ORDER BY queryTime DESC",
	mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while($row=mysql_fetch_array($result)){
		echo shell_exec('ls');
		echo shell_exec('sudo chmod 777 ../../hotels/one');
		$output = shell_exec('cp ../index.php ../../hotels/one/index.php');
		echo $output;
		}
		return true;
	}
}
function setOffline()
{
	$query = sprintf("SELECT * FROM `hotel` WHERE verified='%s' ORDER BY queryTime DESC",
		mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while($row=mysql_fetch_array($result))
			$hotel[]=$row;
		return $hotel;
	}
}
function startAll()
{
	$query = sprintf("SELECT * FROM `hotel` WHERE verified='%s' ORDER BY queryTime DESC",
		mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while($row=mysql_fetch_array($result))
			$hotel[]=$row;
		return $hotel;
	}
}
function backupAll()
{
	$query = sprintf("SELECT * FROM `hotel` WHERE verified='%s' ORDER BY queryTime DESC",
		mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while($row=mysql_fetch_array($result))
			$hotel[]=$row;
		return $hotel;
	}
}
function base64_encode_image ($imagefile) {
        $imgtype = array('jpg', 'gif', 'png');
        $filename = file_exists($imagefile) ? htmlentities($imagefile) : die('Image file name does not exist');
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($filetype, $imgtype)){
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        } else {
            return'Invalid image type, jpg, gif, and png is only allowed';
        }
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
function buildApp($hotel)
{
	 $hotel='<?xml version="1.0" encoding="utf-8"?><hotel>'.
	 '<name>'.$hotel["hname"].'</name><address>'.$hotel["haddress"].'</address><logo>'.
     $hotel["hlogo"].'</logo><zip>'.$hotel["hzip"].'</zip>
     <contact>'.$hotel["hphone"].'</contact><tac>Terms and Conditions</tac></hotel>';
     $file="../app/hotel.xml";
     if(!file_exists($file)){
  		return "File not found";
     }else{
 	 $fh = fopen($file, 'w+');
     fwrite($fh, $hotel);
     fclose($fh);
     return true;
  	 }
}
