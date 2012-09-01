<html>
<head>
<script src="js/jquery.min.js"></script>
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
var uid="1";
function getUploads()
{
	$.ajax({
	  type: "get",
	  url: "api/user.php",
 	  dataType:"json",
	  data: { uid:uid,field:"upload"}
	}).success(function( msg ) {
          for(var i=0;i<msg.upload.length;i++)
          {
          $("#upload").append('<a href="record.php?upid='+msg.upload[i].upid+'">Record '+msg.upload[i].upid+',Uploaded at:'+msg.upload[i].upload_time+'</a>');
          }
	})
        .fail(function()
        {alert("Error Getting The Uploading History");});
}
$(document).ready(function() {
      getUploads();
});
</script>
</head>
<body>
<div id="upload">
</div>
</body>
</html>
