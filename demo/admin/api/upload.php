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
#errorWrapper{
 border: 1px solid  #456f9a /*{b-bar-border}*/;
  background:       #5e87b0 /*{b-bar-background-color}*/;
  color:          #fff /*{b-bar-color}*/;
  font-weight: bold;
  text-shadow: 0 /*{b-bar-shadow-x}*/ 1px /*{b-bar-shadow-y}*/ 1px /*{b-bar-shadow-radius}*/ #3e6790 /*{b-bar-shadow-color}*/;
  background-image: -webkit-gradient(linear, left top, left bottom, from( #6facd5 /*{b-bar-background-start}*/), to( #497bae /*{b-bar-background-end}*/)); /* Saf4+, Chrome */
  background-image: -webkit-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* Chrome 10+, Saf5.1+ */
  background-image:    -moz-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* FF3.6 */
  background-image:     -ms-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* IE10 */
  background-image:      -o-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* Opera 11.10+ */
  background-image:         linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/);
position:absolute;
z-index: 100;
width:33%;
left:33%;
top:30%;
}
#errorClose{
float:right;
}
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
function showError(msg)
{       $('#preferencePage').trigger('collapse');
        $('#adminPage').trigger('collapse');
		$('#stuffPage').trigger('collapse');
        $("#errorMsg").html(msg);
        $("#errorWrapper").show();
}
function hideError()
{
  $("#errorWrapper").hide();
}
function checkbox(i){
	 var bookdata=document.getElementById(i).getElementsByClassName("bookselect");;
      			  
          bookdata.attr("checked",true).checkboxradio("refresh");
		  return true;
	
	
	}
	
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
function checkRecord()
{
    var bookdata=document.getElementsByName("bookselect");
    var uid=getCookie("uid");
    var token=getCookie("token");
    var i=0;
	var count=0;
	var count2=0;
   while(i<bookdata.length)
    {
		
        if( bookdata[i])
        {
            var id="book"+(i+1);
            var selected=document.getElementById(id).getElementsByClassName("bookdata");
            var booking=new Array();
            for(j=0;j<selected.length;j++)
                booking[j]=selected[j].innerHTML;
            $.ajax({
				   async: false,
                   type: "POST",
                   url: "admin.php",
                   id:"book"+(i+1),
                   dataType:"json",
                   data: { booking: booking,uid:uid,token:token,action:"checkRecord"}
                   }).success(function( msg ) {
					   /*if database do not have record, highlight it by red color*/
                              document.getElementById(this.id).style.background="red";
							  count++;
                              }).fail(function(msg)
                  {
					/*if database do not have record, highlight it by green color and make it checked*/
					  document.getElementById(this.id).style.background="green";	
					  			     		 
                       var bookdata=document.getElementsByName("bookselect");					 
      	               bookdata[i].checked=true;
					   count2++;
		
					  /*this function is to make checkbox checked*/
		            
					 
				   });
				
							 		
        }
   	i++;
    } 
	
	showError("There are " +count+ " records have already been found in database(hilighted by red) and " +count2+ " new records can be saved into database(hilighted in red)");
	$("#saveDB").show();
	$("#checkRe").hide();
}

function saveToDB()
{
    var bookdata=document.getElementsByName("bookselect");
    var uid=getCookie("uid");
    var token=getCookie("token");
    var i=0;
	var count=0;
	var count2=0;
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
				   async: false,
                   type: "POST",
                   url: "admin.php",
                   id:"book"+(i+1),
                   dataType:"json",
                   data: { booking: booking,uid:uid,token:token,action:"saveRecord"}
                   }).success(function( msg ) {
                              document.getElementById(this.id).style.background="yellow";
							  count++;
                              })
            .fail(function(msg)
                  {document.getElementById(this.id).style.background="blue";count2++;});
        }
        i++;
    }
	showError("There are " +count+ " records have already been saved in database(hilighted by yellow) and " +count2+ " records failed to be saved into database(hilighted in blue)");
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

<button onClick="checkRecord()" id="checkRe">Check Input File</button>

<button onClick="saveToDB()" id="saveDB" style="display:none;" >Save to Database</button>
<div id="errorWrapper" style="display:none;">
                  <center id="errorMsg"></center>
                  <img src="../css/images/close_icon.png" width="30px" title="close" onClick="hideError()" id="errorClose"/>
                </div>
</body>
</html>
