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
top:30%;
border:1px solid grey;
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
                 xmlhttp.open("GET","../hotel.xml",false);
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
function changePass()
                                        {
                                        var oldpass=$("#oldpass").val();
                                        var password=$("#password").val();
                                        var confirmpass=$("#confirmpass").val();
                                        if((oldpass!="")&&(password!="")&&(confirmpass!=""))
                                        {
                                        var uid=getCookie("uid");var token=getCookie("token");
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,oldpass:oldpass,password:password,confirmpass:confirmpass,task:'changePass'}
                                               }).success(function( msg ) {
                                                          alert("Successful");
                                                          window.location="index.php";
                                                          }).fail(function(msg){alert("Fail To Update Password");window.location="index.php";});
                                        }else alert("Please Enter the password correctly");
                                        }
function showError(msg)
{
        $('#adminPage').trigger('collapse');
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
          if(checkCookie('confirmation')){window.location="checkin.php";}
          else{window.location="admin.php";}
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
                 var confirmation=$("#checkincode").val();
                 if(validateEmail(email))
                 {
                 $.ajax({
                        type: "GET",
                        url: IP+"/confirm.php",
                        dataType: "json",
                        data: { email: email, confirmation: confirmation}
                        }).success(function( msg ) {
                                   if(msg.status=='sent')
                                   {
                                   showError("Please Check Your Email To Verify your email address and then Login");
                                   }
                                   else if (checkCookie('uid')){
                                   setCookie('email',msg.email,1);
                                   setCookie('confirmation',msg.confirmation,1);
                                    window.location="checkin.php";
                                   }else{showError("To Protect User Data,Please Login");
                                   setCookie('email',msg.email,1);
                                   setCookie('confirmation',msg.confirmation,1);
                                   $('#confirmpage').trigger('collapse');
                                   $('#loginPage').trigger('expand');
                                 }
                                   }).fail(function(msg){showError("Invalid Checkin Email and Checkin Code");});
                 }
                 else {
                    showError("Invalid Email Address");
                 }
                 
                 }
function gotoGuest()
{
  window.location="../guest/"
}
function hideError()
{
  $("#errorWrapper").hide();
}
function signup()
{
	var email=$("#signupemail").val();
        if(validateEmail(email))
        {
		$.ajax({
		  type: "POST",
		  url: IP+"/signup.php",
		  dataType: "json",
		  data: { email: email}
		}).success(function( msg ) {
                   showError("Email Sent to "+email+", Please Verify your Email Address");
		}).fail(function(msg){showError("Error Sending Email");});
        }
        else {showError("Invalid Email Address");}
}
function logout(){
      setCookie('uid','','-1');
      setCookie('token','','-1');
      setCookie('confirmation','','-1');
      window.location="index.php";
    }
function showHotel(hotel)
{
  $("#logo").html('<center><img src="'+hotel.logo+'" title="'+hotel.name+'" width="150px"></center>');
                  $("#welcome").html("Enterprise Guest Engagement System - Customer Instance System Administration Modulel"+'<br />');
		    $("#welcome").append(hotel.name);

                  $("#aboutUs").append('<h3>'+hotel.name+'</3>');
                  $("#aboutUs").append('<a> Address:'+hotel.address+'</a><br>');
                  $("#aboutUs").append('<a> Zip Code:'+hotel.zip+'</a><br>');
                  $("#aboutUs").append('<a> Contact No:'+hotel.contact+'</a><br>');
}
function checkUser()
{
}
function assignStuff()
{
  var stuffEmail=$('#stuffEmail').val();
  var stuffFirstname=$('#stuffFirstname').val();
  var stuffLastname=$('#stuffLastname').val();
  showError("Processing");
  $.ajax({
      type: "POST",
      url: "api/assignStuff.php",
      dataType: "json",
      data: { stuffEmail: stuffEmail,stuffFirstname:stuffFirstname,stuffLastname:stuffLastname}
    }).success(function( msg ) {
                   showError("Email Sent to "+stuffEmail+", Please Verify the Email Address");
    }).fail(function(msg){showError("Error Assigning Stuff");});
}
function getStuff()
{
  var uid=getCookie('uid');
  var token=getCookie('token');
  $.ajax({
      type: "POST",
      url: "api/getStuff.php",
      dataType: "json",
      data: {uid:uid,token:token}
    }).success(function( msg ) {
       var stuffs=msg;
                          var stuffList=$("#stuffList");
                          stuffList.html('');
                          for(var i=0;i<stuffs.length;i++)
                          {
                            var newli=$('<li><a>'+stuffs[i].email+'</a></li>').appendTo(stuffList);
                          }
                          stuffList.listview( "refresh" );
    }).fail(function(msg){showError("Error Getting Stuffs");});
}
$(document).ready(function() {
                  var hotel=getHotel();
                  showHotel(hotel);
                  checkUser();
});
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1 id="welcome">Welcome</h1>
		<a data-rel="back" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
	</div><!-- /header -->

	<div data-role="content">
	<div id="logo">
	<br>
	</div>
	<div data-role="collapsible-set">
		<div id="loginPage" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Login</h3>
		<p>
			    <input type="text" id="loginemail" name="loginemail" placeholder="Email"/>
			    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password"/>
                 <button data-theme="b" onClick="login()" onKeyPress="login()">Login</button>
                 <a onClick="gotoGuest()" style="float:right;">Guest Login</a>
		</p>
		</div>
		<div data-role="collapsible">
		<h3><img src="css/images/about.png"/>Contact Us</h3>
		<p id="aboutUs"></p>
		</div>
	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Enterprise Guest Engagement System.
Copyright &copy;2012-2013 Asplan Services Private Limited (19834692/W), Singapore. All Rights Reserved</h4></div>
    <div id="errorWrapper" style="display:none;">
                  <center id="errorMsg"></center>
                  <img src="css/images/close_icon.png" width="30px" title="close" onClick="hideError()" id="errorClose"/>
                </div>
  </div><!-- /page -->
</body>
</html>
