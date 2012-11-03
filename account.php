<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script src="js/main.js"></script>
<script>
var IP="api";
$(document).ready(function() {
if(checkCookie("uid")==0)
{
   	window.location="index.php";
                  }else{var uid=getCookie("uid");$("#photoUid").val(uid);$("#passportUid").val(uid);}
});
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1>My Accout</h1>
		<a href="mine.php" data-icon="home" data-iconpos="notext" data-rel="back">Home</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div id="changeprofile" data-role="collapsible">
		<h3 onclick="getProfile()" onkeypress="getProfile()"><img src="css/images/login.png"/>Basic Information</h3>
		<p>			
			    <input type="text" id="fname" name="fname"/>
			    <input type="text" id="lname" name="lname"/>
			    <input type="text" id="title" name="title"/>
                <button data-theme="b" onclick="changeProfile()" onkeypress="changeProfile()">Save Changes</button>
		</p>
	</div>
    <div data-role="collapsible-set">
        <div id="changeprofile" data-role="collapsible">
        <h3 onclick="getProfile()" onkeypress="getProfile()"><img src="css/images/login.png"/>Checkin Required Information</h3>
        <p>
                <input type="text" id="passportNo" name="passportNo" placeholder="Passport No"/>
                <input type="text" id="passportExpire" name="passportExpire" placeholder="Passport Expire Date"/>
                <input type="text" id="passport" name="passport" placeholder="Passport Issue Date"/>
                <button data-theme="b" onclick="changeProfile()" onkeypress="changeProfile()">Save Changes</button>
        </p>
    </div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Passport Photo Copy</h3>
<p>
<iframe src="uploadPassport.php"></iframe>
</p>
</div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Your ID Photo</h3>
<p>
<iframe src="uploadPhoto.php"></iframe>
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
			<button data-theme="b" onclick="changePass()" onkeypress="changePass()">Change Password</button>
			</form>
		</p>
	</div>
	</div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Add Preferences</h3>
<p>
<input type="checkbox" name="queensbed">Queens Bed
<input type="checkbox" name="queensbed">Only Coffee, No Tea
</p>
</div>
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div> 
</div><!-- /page -->
</body>
</html>
