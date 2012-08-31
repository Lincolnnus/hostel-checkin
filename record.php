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
var uploader,importSource;
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
function saveToDB(xls)
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
	  url: "api/record.php",
          id:"book"+(i+1),
 	  dataType:"json",
	  data: { booking: booking,uid:uploader,importSource:xls}
	}).success(function( msg ) {
	  document.getElementById(this.id).style.background="green";
	})
        .fail(function(msg)
        {document.getElementById(this.id).style.background="red";});
      }
      i++;
    }
}
function getXLS()
{
	$.ajax({
	  type: "get",
	  url: "api/record.php",
 	  dataType:"json",
	  data: { upid:2}
	}).success(function( msg ) {
          uploader=msg.uploader;
          xls=msg.xls;
          importSource:msg.importSource;
          $("#xls").append(xls);
	})
        .fail(function(msg)
        {console.log(msg);});
}
</script>
</head>
<body>
<div id="xls">
</div>
<button onclick="getXLS()">GET The TEST UPLOADED XLS</button>
<button onclick="saveToDB()">Save To Database</button>
</body>
</html>
