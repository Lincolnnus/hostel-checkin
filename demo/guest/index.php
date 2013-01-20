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
top:50%;
border:1px solid grey;
background-color:white;
}
#errorClose{
float:right;
}
</style>
<script>
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
function showError(msg)
{
        $('#confirmPage').trigger('collapse');
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
		  url: "api/login.php",
		  dataType: "json",
		  data: { email: email, password: password }
		}).success(function( msg ) {
		 setCookie('uid',msg.uid,1);
		  setCookie('token',msg.token,1);
		  setCookie('fname',msg.fname,1);
		  setCookie('email',msg.email,1);
          if(checkCookie('confirmation')){window.location="checkin.php";}
          else{window.location="index.php";}
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
                        url: "api/confirm.php",
                        dataType: "json",
                        data: { email: email, confirmation: confirmation}
                        }).success(function( msg ) {
                                   if(msg.status=='sent'){
                                   showError("Please Check Your Email To Verify your email address and then Login");
                                   }
                                   else if (checkCookie('uid')){
                                    window.location="checkin.php";
                                   }
                                   else{
                                         showError("To Protect Your Personally Information,Please Login");
                                         setCookie('email',msg.email,1);
                                         setCookie('confirmation',msg.confirmation,1);
                                         $('#confirmPage').trigger('collapse');
                                         $('#loginPage').trigger('expand');
                                      }
                                   }).fail(function(msg){showError("Invalid Checkin Email and Checkin Code");});
                 }
                 else
                 {
                    showError("Invalid Email Address");}
                 
                 }
                 function gotoStaff()
                 {window.open("../staff/");}
function signup()
{
	var email=$("#signupemail").val();
        if(validateEmail(email))
        {
		$.ajax({
		  type: "POST",
		  url: "api/signup.php",
		  dataType: "json",
		  data: { email: email}
		}).success(function( msg ) {
                   showError("Email Sent to "+email+", Please Verify your Email Address");
		}).fail(function(msg){showError("Error Sending Email");});
        }
        else {showError("Invalid Email Address");}
}
function hideError()
{
  $("#errorWrapper").hide();
}
function showHotel(hotel)
{
                  $("#logo").html('<center><img src="'+hotel.logo+'" title="'+hotel.name+'" width="150px"></center>');
                  $("#welcome").html(hotel.name);
                  $("#aboutUs").append('<h3>'+hotel.name+'</3>');
                  $("#aboutUs").append('<a> Address:'+hotel.address+'</a><br>');
                  $("#aboutUs").append('<a> Zip Code:'+hotel.zip+'</a><br>');
                  $("#aboutUs").append('<a> Contact No:'+hotel.contact+'</a><br>');
}
function checkUser()
{
    if(checkCookie('uid')){
      $('#loginPage').hide();
     // $('#signupPage').hide();
      $('#checkinemail').val(getCookie('email'));
     }else{
      $('#myPage').hide();
      $('#logoutPage').hide();
     }
}
    function logout(){
      setCookie('uid','','-1');
      setCookie('token','','-1');
      window.location="index.php";
    }
    function myCheckin(){
      var email=getCookie("email");
                                        var token=getCookie("token");
                                        if(checkCookie("email")!=0)
                                        {
                                        $.ajax({
                                               type: "GET",
                                               url: "api/mine.php",
                                               dataType: "json",
                                               data: { email: email, token: token }
                                               }).success(function(checkin) {
                                                          $("#myConfirmation").html("");
                                                          $("#currentCheckin").html("");
                                                          $("#myHistory").html("");
                                                          for(var i=0;i<checkin.length;i++)
                                                          {
                                                          switch(checkin[i].step)
                                                          {
                                                          case "0":
                                                          $("#myConfirmation").append('<li><a onclick="showCheckin('+checkin[i].rid+')" >'+checkin[i].arrivalday1+'/'+checkin[i].arrivalmonth1+'/'+checkin[i].arrivalyear1+'</a></li>');
                                                          break;
                                                          case "1":
                                                          $("#currentCheckin").append('<li><a onclick="showCheckin('+checkin[i].rid+')" >'+checkin[i].arrivalday1+'/'+checkin[i].arrivalmonth1+'/'+checkin[i].arrivalyear1+'</a></li>');
                                                          break;
                                                          case "2":
                                                          $("#myHistory").append('<li><a onclick="showCheckin('+checkin[i].confirmation+')">'+checkin[i].checkindate+'</a></li>');
                                                          break;
                                                          }
                                                          }
                                                          $("#myConfirmation").listview("refresh");
                                                          $("#currentCheckin").listview("refresh");
                                                          $("#myHistory").listview("refresh");
                                                          }).fail(function(msg){console.log("Error Getting Checkin Infor");});
                                        }
                                        else
                                        { alert("Invalid Email Address");window.location="index.php";}
     
    }
    function showCheckin(confirmation){
                                        var email=getCookie("email");
                                        var code=setCookie('confirmation',confirmation,1);
                                        window.location="checkin.php";
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
		<div id="confirmPage" data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>Confirmation</h3>
            <p>
                <label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="checkinemail" name="checkinemail" placeholder="Email"/>
                <label class="ui-hidden-accessible">Code:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Confirmation Code"/>
                 <button data-theme="b" onclick="checkin()" onkeypress="checkin()">Checkin</button>
            </p>
		</div>
		<div id="loginPage" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Login</h3>
		<p>
			    <input type="text" id="loginemail" name="loginemail" placeholder="Email"/>
			    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password"/>
                 <button data-theme="b" onclick="login()" onkeypress="login()">Login</button>
                 <a style="float:right;" onclick="gotoStaff()">Staff Login</a>
		</p>
		</div>
		<!--<div id="signupPage" data-role="collapsible">
		<h3><img src="css/images/signup.png"/>Signup</h3>
		<p>
			    <input type="text" id="signupemail" name="signupemail" placeholder="Email"/>
                 <button data-theme="b" onclick="signup()" onkeypress="signup()">Sign Up</button>
		</p>
		</div>-->
    <div id="myPage" data-role="collapsible">
    <h3 onclick="myCheckin()"><img src="css/images/chekin.png"/>My Checkins</h3>
    <p>
      <div data-role="collapsible">
      <h3 ><img src="css/images/chekin.png"/>New Confirmations</h3>
      <p>
                 <ul id="myConfirmation" data-role="listview">
                 </ul>
      </p>
      </div>
      <div data-role="collapsible">
      <h3 ><img src="css/images/chekin.png"/>Current Checkin</h3>
      <p>
                 <ul id="currentCheckin" data-role="listview">
                 </ul>
      </p>
      </div>
      <div data-role="collapsible">
      <h3><img src="css/images/chekin.png"/>History</h3>
      <p>
                 <ul id="myHistory" data-role="listview">
                 </ul>
      </p>
      </div>
    </p>
    </div>
        <div id="logoutPage" data-role="collapsible">
                 <h3> <img src="css/images/signup.png"/>Log Out</h3>
                 <p>
                 <a id="logout" data-rel="dialog" data-theme="a" onclick="logout()" onkeypress="logout()" data-role="button">
                 Confirm
                 </a>
                 </p>
        </div>
		<div data-role="collapsible">
		<h3><img src="css/images/about.png"/>Contact Us</h3>
		<p id="aboutUs"></p>
		</div>
	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div>
                <div id="errorWrapper" style="display:none;">
                  <center id="errorMsg"></center>
                  <img src="css/images/close_icon.png" width="30px" title="close" onclick="hideError()" id="errorClose"/>
                </div>
  </div><!-- /page -->
</body>
</html>
