<?php
include_once("connection.php"); 
$path="/Library/WebServer/Documents/check/passport/";
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'POST':
    $uid=$_POST["uid"];
    if (authentication($uid))
    {
	    $allowedExts = array("jpg","png","jpeg");
	    $extension = end(explode(".", $_FILES["file"]["name"]));
	    if (($_FILES["file"]["size"] < 4000000)&& in_array($extension, $allowedExts))
	    {
		  if ($_FILES["file"]["error"] > 0)
		  {
		     echo "Error: " . $_FILES["file"]["error"] . "<br />";
		  }
		  else
		  {
		     if (file_exists("upload/" . $_FILES["file"]["name"]))
		     { echo $_FILES["file"]["name"] . " already exists. ";}
		     else
		     {
		        move_uploaded_file($_FILES["file"]["tmp_name"], $path . $_FILES["file"]["name"]);
			$fname=$path . $_FILES["file"]["name"];
			$query = sprintf("INSERT INTO `upload` (uid,fname) values ('%s','%s')",
				mysql_real_escape_string($uid),
				mysql_real_escape_string($fname));
			$result = mysql_query($query);
			if (!$result) {
			    $message  = 'Invalid query: ' . mysql_error() . "\n";
			    $message .= 'Whole query: ' . $query;
			    die($message);
			}
			else {    
			    $message="Upload: " . $_FILES["file"]["name"] . "<br />";
			    $message.="Type: " . $_FILES["file"]["type"] . "<br />";
			    $message.="Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		    	    $message.="Stored in: " . $fname."<br />";
			    echo json_encode($message);//successfully upload
			}
		     }
		  }
	      }else { echo "Invalid file"; }
      }
      else echo "Authentication Failed";
    break;
}
function authentication($uid)
{
   return true;
}
?>
