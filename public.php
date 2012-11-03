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
#errorWrapper{
position:absolute;
width:33%;
left:33%;
top:25%;
background-color:white;
}
#errorClose{
float:right;
}
</style>
<script src="js/variable.js"></script>
<script>
var IP="api";
function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function getHotel()
{
                 if (window.XMLHttpRequest)
                 {// code for IE7+, Firefox, Chrome, Opera, Safari
                 xmlhttp=new XMLHttpRequest();
                 }
                 else
                 {// code for IE6, IE5
                 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                 }
                 xmlhttp.open("GET","hotel.xml",false);
                 xmlhttp.send();
                 xmlDoc=xmlhttp.responseXML;
                 var x=xmlDoc.getElementsByTagName("hotel");
                 var hotelxml=x[0];
                 var hotel=new Object();
                 hotel.name=hotelxml.getElementsByTagName("name")[0].childNodes[0].nodeValue;
                 hotel.address=hotelxml.getElementsByTagName("address")[0].childNodes[0].nodeValue;
                 hotel.tac=hotelxml.getElementsByTagName("tac")[0].childNodes[0].nodeValue;
                 hotel.logo=hotelxml.getElementsByTagName("logo")[0].childNodes[0].nodeValue;
                 hotel.zip=hotelxml.getElementsByTagName("zip")[0].childNodes[0].nodeValue;
                 hotel.contact=hotelxml.getElementsByTagName("contact")[0].childNodes[0].nodeValue;
                 return hotel;
}
function showError(msg)
{
        $("#errorMsg").html(msg);
        $("#errorWrapper").show();
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
          setCookie('type',msg.type,1);
          if(msg.type==1)
                   {window.location="index.php";}
          else if(msg.type==2)
                   {window.location="manage.php";}
          else if(msg.type==3)
                   {window.location="admin.php";}
		}).fail(function(msg){
                showError("Error Login");
		});
	}
        else
        { showError("Invalid Email Address");}

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
		  window.location="visitorCheckin.php";
                   }).fail(function(msg){showError("Invalid Checkin Email and Checkin Code");});
	}
        else
        { showError("Invalid Email Address");}

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
		}).fail(function(msg){showError("Error Signing Up");});
        }
        else {showError("Invalid Email Address");}
}
$(document).ready(function() {
                  var hotel=getHotel();
                  $("#logo").html('<center><img src="'+hotel.logo+'" title="'+hotel.name+'" width="200px"></center>');
                  $("#welcome").html(hotel.name);
                  $("#aboutUs").append('<h3>'+hotel.name+'</3>');
                  $("#aboutUs").append('<a> Address:'+hotel.address+'</a><br>');
                  $("#aboutUs").append('<a> Zip Code:'+hotel.zip+'</a><br>');
                  $("#aboutUs").append('<a> Contact No:'+hotel.contact+'</a><br>');
                  if(checkCookie("uid")!=0){window.location="index.php";}
                  $("#errorWrapper").hide();
                  $("#errorClose").click(function(){$("#errorWrapper").hide();});
});
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1 id="welcome">Welcome</h1>
		<a href="" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
	</div><!-- /header -->

	<div data-role="content">
	<div id="logo">
	<br>
	</div>
	<div data-role="collapsible-set">
		<div data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>Check In</h3>
            <p>
                <label class="ui-hidden-accessible">Checkin Email:</label>
			    <input type="text" id="checkinemail" name="checkinemail" placeholder="Checkin Email"/>
                <label class="ui-hidden-accessible">Password:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Checkin Code"/>
                 <button data-theme="b" onclick="checkin()" onkeypress="checkin()">Checkin</button>
            </p>
		</div>
		<div id="loginpage" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Login</h3>
		<p>
			    <input type="text" id="loginemail" name="loginemail" placeholder="Email"/>
			    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password"/>
                 <button data-theme="b" onclick="login()" onkeypress="login()">Login</button>
		</p>
		</div>
		<div id="signup" data-role="collapsible">
		<h3><img src="css/images/signup.png"/>Sign Up</h3>
		<p>
			    <input type="text" id="signupemail" name="signupemail" placeholder="Email"/>
			    <input type="password"id="signuppassword" name="signuppassword" placeholder="Password"/>
			    <input type="password"id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"/>
                 <button data-theme="b" onclick="signup()" onkeypress="signup()">Sign Up</button>
		</p>
		</div>
		<div data-role="collapsible">
		<h3><img src="css/images/about.png"/>Contact Us</h3>
		<p id="aboutUs"></p>
		</div>
	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div>
                 <div id="errorWrapper"><center id="errorMsg"></center><img src="images/close_icon.png" width="30px" title="close" id="errorClose"/></div>
</div><!-- /page -->
</body>
</html>
