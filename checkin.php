<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script>
var IP="http://localhost/hotel/api";
function getcheckinfo()
{
	var email=getCookie("email");
	var code=getCookie("confirmation");
	$.ajax({
	  type: "GET",
	  url: IP+"/check.php",
	  dataType: "json",
	  data: { email: email, confirmation: code }
	}).success(function( msg ) {
	  console.log(msg);
	  if(msg.status=="raw")
	  {
		 var hotelinfo="Hotel Name:"+msg.hotel.hname+"<br>Hotel Address:"+msg.hotel.haddress+"<br>Hotel Contact Information:"+msg.hotel.contact+"<br>";
	 	 var checkinfo="Checkin Date:"+msg.checkindate;
	 	 $("#hotelinfo").html(hotelinfo);
	         $("#checkinfo").html(checkinfo);
		 $("#confirmed").hide();
 	  }
	  else if(msg.status=="checked")
	  {
		$("#confirm").hide();
	  }
	}).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");});

}
function confirm()
{
	var email=getCookie("email");
	var code=getCookie("confirmation");
	$.ajax({
	  type: "POST",
	  url: IP+"/check.php",
	  dataType: "json",
	  data: { email: email, confirmation: code }
	}).success(function( msg ) {
	  console.log(msg);
	  alert("successful");
	}).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");window.location="checkin.php";});

}
$(document).ready(function() { 
if(checkCookie("email")==0)
{
   	window.location="index.php";
}
else 
{
	getcheckinfo();
}
}) 
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1>Check In</h1>
		<a href="index.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="account.php" data-icon="info" data-iconpos="notext" data-rel="dialog" data-transition="fade">My Account</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div data-role="collapsible" data-collapsed="false">
		<h3><img src="css/images/login.png"/>Checkin Information</h3>
		<p>
			<div id="hotelinfo"></div>
			<div id="checkinfo"></div>
			<div id="confirm"><button data-theme="b" onclick="confirm()" onkeypress="confirm()">Confirm</button></div>
			<div id="confirmed"><button data-theme="a" >Confirmed</button></div>
		</p>
	</div>
	</div>
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div> 
</div><!-- /page -->
</body>
</html>
