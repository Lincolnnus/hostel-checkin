<html>
<head>
<script src="../js/jquery.min.js"></script>
<script src="../js/cookie.js"></script>
<script>
$(document).ready(function() {
                  if(checkCookie("uid")==0)
                  {
                  window.location="../index.php";
                  }else{var uid=getCookie("uid");$("#uid").val(uid);}
                  });
</script>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
padding: 0 3px;
border: 1px solid #EEEEEE;
}
.fail
{
background:red;
}
.success
{
background:green;
}
</style>
<script>
function selectall(element)
{
    if(element.checked)
    {
        var bookdata=document.getElementsByName("bookselect");
        for(var i=0;i<bookdata.length;i++)
            bookdata[i].checked=true;
    }
    else
    {
        var bookdata=document.getElementsByName("bookselect");
        for(var i=0;i<bookdata.length;i++)
            bookdata[i].checked=false;
    }
}
function saveToDB()
{
    var bookdata=document.getElementsByName("bookselect");
    var uid=getCookie("uid");
    var token=getCookie("token");
    var i=0;
    while(i<bookdata.length)
    {
        if( bookdata[i].checked)
        {
            var id="book"+(i+1);
            var selected=document.getElementById(id).getElementsByClassName("bookdata");
            var booking=new Array();
            for(j=0;j<selected.length;j++)
                booking[j]=selected[j].innerHTML;
            $.ajax({
                   type: "POST",
                   url: "admin.php",
                   id:"book"+(i+1),
                   dataType:"json",
                   data: { booking: booking,uid:uid,token:token,action:"saveRecord"}
                   }).success(function( msg ) {
                              document.getElementById(this.id).style.background="green";
                              })
            .fail(function(msg)
                  {document.getElementById(this.id).style.background="red";});
        }
        i++;
    }
}
</script>
</head>
<body>
<div id="xls">
<?php
include_once("connection.php"); 
$path="../upload/";
switch ($_SERVER['REQUEST_METHOD']) 
{
    case 'POST':
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
		     if (file_exists($path. $_FILES["file"]["name"]))
		     { echo $_FILES["file"]["name"] . " already exists. ";}
		     else
		     {
		      move_uploaded_file($_FILES["file"]["tmp_name"], $path . $_FILES["file"]["name"]);
		    	$fname=$path . $_FILES["file"]["name"]; 
			    $message="Upload: " . $_FILES["file"]["name"] . "<br />";
			    $message.="Type: " . $_FILES["file"]["type"] . "<br />";
			    $message.="Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		    	    $message.="Stored in: " . $fname."<br />";
                require_once 'excel_reader.php';
                $data = new Spreadsheet_Excel_Reader($fname);
                print_r($data->dump(true,true));
                unlink($fname);
		     }
		  }
	      }else { echo "Invalid file"; }
    break;
}
?>
</div>
<button onclick="saveToDB()">Save To Database</button>
</body>
</html>
