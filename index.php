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
function login()
{
	var email=$("#loginemail").val();
	var password=$("#loginpassword").val();
        if(validateEmail(email))
	{
		$.ajax({
		  type: "POST",
		  url: IP+"/login.php",
		  dataType: "json",
		  data: { email: email, password: password }
		}).success(function( msg ) {
		  setCookie('uid',msg.uid,1);
		  setCookie('token',msg.token,1);
		  setCookie('fname',msg.fname,1);
		  setCookie('email',msg.email,1);
	 	  window.location=msg.nextlocation;
		}).fail(function(msg){alert("Error Login");
		});
	}
        else
        { alert("Invalid Email Address");window.location="index.php";}

}
function checkin()
{
	var email=$("#checkinemail").val();
	var code=$("#checkincode").val();
        if(validateEmail(email))
	{
		$.ajax({
		  type: "GET",
		  url: IP+"/check.php",
		  dataType: "json",
		  data: { email: email, confirmation: code }
		}).success(function( msg ) {
		  console.log(msg);
		  setCookie('email',msg.email,1);
		  setCookie('confirmation',msg.confirmation,1);
		  window.location="checkin.php";
		}).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");window.location="index.php";});
	}
        else
        { alert("Invalid Email Address");window.location="index.php";}

}
function signup()
{
	var email=$("#signupemail").val();
	var password=$("#signuppassword").val();
	var password2=$("#confirmpassword").val();
        if(validateEmail(email))
        {
		$.ajax({
		  type: "POST",
		  url: IP+"/signup.php",
		  dataType: "json",
		  data: { email: email, password: password,confirmpassword:password2 }
		}).success(function( msg ) {
		  console.log(msg);
		/*  setCookie('uid',msg.uid,1);
		  setCookie('token',msg.token,1);
	 	  window.location.reload(true);*/
		}).fail(function(msg){alert("Error Signing Up");window.location="index.php";});
        }
        else {alert("Invalid Email Address");window.location="index.php";}
}
$(document).ready(function() { 
if(checkCookie("uid")!=0){window.location="mine.php";}
});
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
	<div id="logo">
	<center><img src="images/qikinn.png" title="Logo"></center>
	<center>Some Vision Here</center>
	<br>
	</div>
	<div data-role="collapsible-set">
		<div id="loginpage" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Login</h3>
		<p>
			<form id="loginForm" method="post">
			<label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="loginemail" name="loginemail" placeholder="Email"/>
			<label class="ui-hidden-accessible">Password:</label>
			    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password"/>
			<button data-theme="b" onclick="login()" onkeypress="login()">Login</button>
			</form>
		</p>
		</div>
		<div data-role="collapsible">
		<h3><img src="css/images/chekin.png"/>Check In</h3>
		<p>
			<form id="checkinForm" method="post">
			<label class="ui-hidden-accessible">Checkin Email:</label>
			    <input type="text" id="checkinemail" name="checkinemail" placeholder="Checkin Email"/>
			<label class="ui-hidden-accessible">Password:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Checkin Code"/>
			<button data-theme="b" onclick="checkin()" onkeypress="checkin()">Checkin</button>
			</form>
		</p>
		</div>
		<div id="signup" data-role="collapsible">
		<h3><img src="css/images/signup.png"/>Sign Up</h3>
		<p>
			<form id="signupForm" method="post">
			<label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="signupemail" name="signupemail" placeholder="Email"/>
			<label class="ui-hidden-accessible">Password:</label>
			    <input type="password"id="signuppassword" name="signuppassword" placeholder="Password"/>
			<label class="ui-hidden-accessible">Confirm Password:</label>
			    <input type="password"id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"/>
			<button data-theme="b" id="signup">Sign Up</button>
			</form>
		</p>
		</div>
		<div data-role="collapsible">
		<h3><img src="css/images/about.png"/>About Us</h3>
		<p>Our Partners:<br><a href="http://www.amarahotels.com"><img src="images/amarahotels.png" title="Asia Amara Sanctuary"></a></p>
		</div>
	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div> 
</div><!-- /page -->
</body>
</html>
