<?php
$allowedExts = array("xls");
$extension = end(explode(".", $_FILES["file"]["name"]));
if (($_FILES["file"]["size"] < 4000000)&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
	    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	    echo "Type: " . $_FILES["file"]["type"] . "<br />";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	    echo "Stored in: " . $_FILES["file"]["tmp_name"];
	    if (file_exists("upload/" . $_FILES["file"]["name"]))
	    {
	      echo $_FILES["file"]["name"] . " already exists. ";
	    }
	    else
	    {
	      move_uploaded_file($_FILES["file"]["tmp_name"],
	      "/var/www/hotel/upload/" . $_FILES["file"]["name"]);
              $location='Location: handler.php?xls=upload/'.$_FILES["file"]["name"];
	      header($location);
	    }
    }
  }
else
  {
  echo "Invalid file";
  }
?>
