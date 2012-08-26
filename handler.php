<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader.php';
if(isset($_REQUEST["xls"]))
$xls=$_REQUEST["xls"];
else die("No XLS FILE");
$data = new Spreadsheet_Excel_Reader($xls);
?>
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
	  url: "api/handler.php",
          id:"book"+(i+1),
 	  dataType:"json",
	  data: { booking: booking }
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
<?php 
 echo $data->dump(true,true)
?>
<button onclick="saveToDB()">Save To Database</button>
</body>
</html>
