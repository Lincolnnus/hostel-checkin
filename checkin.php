<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/main.js"></script>
<script src="js/cookie.js"></script>
<script>
$(document).ready(function() {
                  
$("#checkin1").hide();
$("#checkin2").hide();
$("#checkin3").hide();
$("#checkin4").hide();
if(checkCookie("email")==0)
{
   	window.location="index.php";
}else{getcheckinfo();}
})
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1>Check In</h1>
		<a data-icon="home" data-iconpos="notext" data-transition="slide" data-rel="back">Home</a>
		<a href="about.php" data-icon="info" data-iconpos="notext" data-rel="dialog" data-transition="fade">My Account</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div data-role="collapsible" data-collapsed="false">
		<h3><img src="css/images/login.png"/>Checkin Information</h3>
		<p>
			<div id="hotelinfo"></div>
			<div id="checkinfo"></div>
			<div id="checkin1"><button data-theme="b" onclick="confirm()" onkeypress="confirm()">Confirm</button></div>
			<div id="checkin2"><button data-theme="a" >Confirmed</button></div>
            <div id="checkin3" onkeypress="checkout();" onclick="checkout();"><button data-theme="b" >Check Out</button></div>
            <div id="checkin4"><button data-theme="a" >Finished</button></div>
		</p>
	</div>
	</div>
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div> 
</div><!-- /page -->
</body>
</html>
