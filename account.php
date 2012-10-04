<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script>
var IP="http://localhost/hotel/api";
function changepass()
{
    var oldpass=$("#oldpass").val();
    var password=$("#password").val();
    var confirmpass=$("#confirmpass").val();
    if((oldpass!="")&&(password!="")&&(confirmpass!=""))
    {
    var uid=getCookie("uid");var token=getCookie("token");
    $.ajax({
	  type: "POST",
	  url: IP+"/account.php",
	  dataType: "json",
	  data: { uid: uid, token: token,oldpass:oldpass,password:password,confirmpass:confirmpass,task:'changepass'}
	}).success(function( msg ) {
	 alert("Successful"); window.location="account.php";
	}).fail(function(msg){alert("Fail To Update Password");window.location="account.php";});
     }else alert("Please Enter the password correctly");
}
function changeprofile()
{
    var fname=$("#fname").val();
    var lname=$("#lname").val();
    var title=$("#title").val();
    var uid=getCookie("uid");var token=getCookie("token");
    $.ajax({
	  type: "POST",
	  url: IP+"/account.php",
	  dataType: "json",
	  data: { uid: uid, token: token,fname:fname,lname:lname,title:title,task:'changeprofile'}
	}).success(function( msg ) {
	 alert("Successful"); window.location="account.php";
	}).fail(function(msg){alert("Fail To Update");window.location="account.php";});
   
}
$(document).ready(function() { 
if(checkCookie("uid")==0)
{
   	window.location="index.php";
}
else 
{
	var uid=getCookie("uid");var token=getCookie("token");
	$.ajax({
	  type: "GET",
	  url: IP+"/account.php",
	  dataType: "json",
	  data: { uid: uid, token: token }
	}).success(function( msg ) {
	  $("#fname").val(msg.fname);
	  $("#lname").val(msg.lname);
	  $("#title").val(msg.title);
	}).fail(function(msg){alert("Unauthorized");window.location="index.php";});
}
}) 
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1>My Accout</h1>
		<a href="mine.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="account.php" data-icon="info" data-iconpos="notext" data-rel="dialog" data-transition="fade">My Account</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div id="changeprofile" data-role="collapsible">
		<h3><img src="css/images/login.png"/>My Information</h3>
		<p>
			<form method="post">
			<label>First Name:</label>
			    <input type="text" id="fname" name="fname"/>
			<label>Last Name:</label>
			    <input type="text" id="lname" name="lname"/>
			<label>Title:</label>
			    <input type="text" id="title" name="title"/>
			<button data-theme="b" onclick="changeprofile()" onkeypress="changeprofile()">Save Changes</button>
			</form>
		</p>
	</div>
	<div data-role="collapsible-set">
		<div id="changepass" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Change Password</h3>
		<p>
			<form method="post">
			<label class="ui-hidden-accessible">Old Password:</label>
			    <input type="text" id="oldpass" name="oldpass" placeholder="Old Password"/>
			<label class="ui-hidden-accessible">New Password:</label>
			    <input type="password" id="password" name="password" placeholder="New Password"/>
			<label class="ui-hidden-accessible">Confirm Password:</label>
			    <input type="password" id="confirmpass" name="confirmpass" placeholder="Confirm Password"/>
			<button data-theme="b" onclick="changepass()" onkeypress="changepass()">Change Password</button>
			</form>
		</p>
	</div>
	</div>
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div> 
</div><!-- /page -->
</body>
</html>
