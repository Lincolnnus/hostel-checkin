<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<style>
.ui-collapsible.ui-collapsible-collapsed .ui-collapsible-heading .ui-icon-plus,
.ui-icon-arrow-r { background-position: -108px 0; }
.ui-icon-arrow-l { background-position: -144px 0; }
.ui-icon-arrow-u { background-position: -180px 0; }
.ui-collapsible .ui-collapsible-heading .ui-icon-minus,
.ui-icon-arrow-d { background-position: -216px 0; }
</style>
<script>
var IP="http://localhost/hotel/api";
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
function checkin()
{
	var email=getCookie("email");
	var code=$("#checkincode").val();
        if(checkCookie("email")!=0)
	{
		$.ajax({
		  type: "GET",
		  url: IP+"/check.php",
		  dataType: "json",
		  data: { email: email, confirmation: code }
		}).success(function( msg ) {
		  console.log(msg);
		  setCookie('confirmation',msg.confirmation,1);
		  window.location="checkin.php";
		}).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");window.location="index.php";});
	}
        else
        { alert("Invalid Email Address");window.location="index.php";}

}
function getcheckin()
{
	var email=getCookie("email");
	var token=getCookie("token");
        if(checkCookie("email")!=0)
	{
		$.ajax({
		  type: "GET",
		  url: IP+"/mine.php",
		  dataType: "json",
		  data: { email: email, token: token }
		}).success(function( msg ) {
		  console.log(msg);
		  //setCookie('confirmation',msg.confirmation,1);
		  //window.location="checkin.php";
		}).fail(function(msg){console.log("Error Getting Checkin Infor");});
	}
        else
        { alert("Invalid Email Address");window.location="index.php";}

}
function logout()
{
	deleteAllCookies();
 	window.location="index.php";
}
$(document).ready(function() { 
if(checkCookie("uid")!=0) 
{
 var fname=getCookie("fname");
 $("#welcome").html(fname+"'s Qikinn");
 getcheckin();
} 
else
{window.location="index.php";} }) 
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1 id="welcome">Qikinn System</h1>
		<a href="" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="account.php" data-icon="info" data-iconpos="notext" data-rel="dialog" data-transition="fade">My Account</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div data-role="collapsible">
		<h3><img src="css/images/chekin.png"/>My Qinnkins</h3>
		<p>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Bookings</h3>
			<p>
			</p>
			</div>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Confirmations</h3>
			<p>
			</p>
			</div>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Checkins</h3>
			<p>
			</p>
			</div>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Checkouts</h3>
			<p>
			</p>
			</div>
		</p>
		</div>
		<div data-role="collapsible">
		<h3><img src="css/images/chekin.png"/>Check In</h3>
		<p>
			<form id="checkinForm" method="post">
			<label class="ui-hidden-accessible">Password:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Checkin Code"/>
			<button data-theme="b" onclick="checkin()" onkeypress="checkin()">Checkin</button>
			</form>
		</p>
		</div>
		<a id="logout" data-rel="dialog" data-theme="b" onclick="logout()" onkeypress="logout()" data-role="button">
		<img src="css/images/signup.png"/>Log Out
		</a>
	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div> 
</div><!-- /page -->
</body>
</html>
