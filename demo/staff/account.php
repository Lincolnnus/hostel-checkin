<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<link rel="stylesheet" href="css/datepicker.css" /> 
<script src="js/jQuery.ui.datepicker.js"></script>
<script>
  function gotoHome(){
    window.location='index.php';
  }
  
                                        function changeProfile()
                                        {
                                        var fname=$("#fname").val();
                                        var lname=$("#lname").val();
                                        var title=$("#title").val();
                                        var email=getCookie('email');
                                        var uid=getCookie("uid");var token=getCookie("token");
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email,fname:fname,lname:lname,title:title,task:'changeProfile'}
                                               }).success(function( msg ) {
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
                                        
                                        }

                                        function changePassport()
                                        {
                                        var passport=$("#passportNo").val();
                                        var expireDate=$("#expireDate").val();
                                        var issueDate=$("#issueDate").val();
                                         var issueCountry=$("#issueCountry").val();
                                        var issueCity=$("#issueCity").val();
                                        var email=getCookie('email');
                                        var uid=getCookie("uid");
                                        var token=getCookie("token");
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email,issueCountry:issueCountry,issueCity:issueCity,passport:passport,expireDate:expireDate,issueDate:issueDate,task:'changePassport'}
                                               }).success(function( msg ) {
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
                                        
                                        }

                                        function getProfile()
                                        {
                                        
                                        var uid=getCookie("uid");var token=getCookie("token");
                                        var email=getCookie("email");
                                        $.ajax({
                                               type: "GET",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email}
                                               }).success(function( msg ) {
                                                          $("#fname").val(msg.fname);
                                                          $("#lname").val(msg.lname);
                                                          $("#title").val(msg.title);
                                                          $("#passportNo").val(msg.passport);
                                                          $("#expireDate").val(msg.expireDate);
                                                          $("#issueDate").val(msg.issueDate);
                                                          $("#issueCountry").val(msg.issueCountry);
                                                          $("#issueCity").val(msg.issueCity);
                                                          $("#title").val(msg.title);
                                                          $("#myPassport").attr('src',msg.passportPhoto);
                                                          $("#myPhoto").attr('src',msg.idPhoto);
                                                          }).fail(function(msg){alert("Unauthorized");//window.location="index.php";
                                                        });
                                        }$(document).ready(function() {
                                          $("#expireDate").datepicker();
                                          $("#issueDate").datepicker();
if(checkCookie("uid")==0){
   	window.location="index.php";
}else{
	var uid=getCookie("uid");
	getProfile();
}
});
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1>User Profile</h1>
		<a href="mine.php" data-icon="home" data-iconpos="notext" data-rel="back">Home</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div id="changeprofile" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Basic Information</h3>
		<p>			
			    <input type="text" id="fname" name="fname"/>
			    <input type="text" id="lname" name="lname"/>
			    <input type="text" id="title" name="title"/>
                <button data-theme="b" onclick="changeProfile()" onkeypress="changeProfile()">Save Changes</button>
		</p>
	</div>
    <div data-role="collapsible-set">
        <div id="changeprofile" data-role="collapsible">
        <h3><img src="css/images/login.png"/>Checkin Required Information</h3>
        <p>
                Passport Number:
                <input type="text" id="passportNo" name="passportNo" placeholder="Passport No"/>
                <table>
                  <tr>
                    <td>
                      Issue Date:
                      <input type="text" id="issueDate" name="issueDate" placeholder="Passport Issue Date"/>
                    </td>
                    <td>
                      Exprire Date:
                      <input type="text" id="expireDate" name="expireDate" placeholder="Passport Expire Date"/>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Issue Country:
                      <input type="text" id="issueCountry" name="issueCountry" placeholder="Issue Country"/>
                    </td>
                    <td>
                      Issue City:
                      <input type="text" id="issueCity" name="issueCity" placeholder="Issue City"/>
                    </td>
                  </tr>
                </table>
                <br><br><br>
                <br><br><br>
                <br><br>
                <button data-theme="b" onclick="changePassport()" onkeypress="changePassport()">Save Changes</button>
        </p>
    </div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Passport Photo Copy</h3>
<p>
<iframe src="uploadPassport.php" seamless="seamless"></iframe>
<img width="200px" id="myPassport">
</p>
</div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Your ID Photo</h3>
<p>
<iframe src="uploadPhoto.php" seamless="seamless"></iframe>
<img width="50px" id="myPhoto">
</p>
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
