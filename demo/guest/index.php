<html>
<head>
<title>Guest-Index</title>
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
 border: 1px solid  #456f9a /*{b-bar-border}*/;
  background:       #5e87b0 /*{b-bar-background-color}*/;
  color:          #fff /*{b-bar-color}*/;
  font-weight: bold;
  text-shadow: 0 /*{b-bar-shadow-x}*/ 1px /*{b-bar-shadow-y}*/ 1px /*{b-bar-shadow-radius}*/ #3e6790 /*{b-bar-shadow-color}*/;
  background-image: -webkit-gradient(linear, left top, left bottom, from( #6facd5 /*{b-bar-background-start}*/), to( #497bae /*{b-bar-background-end}*/)); /* Saf4+, Chrome */
  background-image: -webkit-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* Chrome 10+, Saf5.1+ */
  background-image:    -moz-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* FF3.6 */
  background-image:     -ms-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* IE10 */
  background-image:      -o-linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/); /* Opera 11.10+ */
  background-image:         linear-gradient( #6facd5 /*{b-bar-background-start}*/, #497bae /*{b-bar-background-end}*/);
position:absolute;
z-index: 100;
width:33%;
left:33%;
top:30%;
}
#errorClose{
float:right;
}
</style>
<script>
var counter=setInterval(timer, 1000); 
function timer()
{
 
  time=time-1;
 
  if (time <= 0)
  
  {
  var answer = confirm("Session Expired, Do You Want To Continue?")
  if (answer){
     time=count;
	
				
  }
  else{
    logout();
  }
  
  }
 

// document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
}
function checklogout(){
	
	if(time<-30){logout();}
	else{return ture;}
		
	}
function gotoAccount(){
    window.location="account.php";
}

function countValue(){
	
	
    time=count;
	
	
	
	
	}
function timeCount(){
	
	
	    var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/getPreferences.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getPreferences' }
               }).success(function( msg ) {
                var settings=msg;
				count=60*parseInt(settings.inactivityTimer); 
				
				countValue(); 
				 
				
				
                          }).fail(function(msg){showError("Fail Getting Preferences");});
	

}

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
				 hotel.email=hotelxml.getElementsByTagName("email")[0].childNodes[0].nodeValue;
				 hotel.url=hotelxml.getElementsByTagName("url")[0].childNodes[0].nodeValue;
				 hotel.manager=hotelxml.getElementsByTagName("manager")[0].childNodes[0].nodeValue;
				
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
		  window.location="index.php";
		}).fail(function(msg){
                showError("Error Login");
		});
	}
        else
        { showError("Invalid Email Address");}

}
                 function checkin()
                 {
				showError("Processing...");
                 var email=$("#checkinemail2").val();
                 var confirmation=$("#checkincode2").val();
                 if(validateEmail(email))
                 {
                 $.ajax({
                        type: "GET",
                        url: "api/confirm.php",
                        dataType: "json",
                        data: { email: email, confirmation: confirmation}
                        }).success(function( msg ) {
                                   if(msg.status=='sent'){
									  
									  setCookie('confirmation',msg.confirmation,1);
                                   showError("Please Check Your Email To Verify your email address and then Login");
                                   }                                 
                                   else{
									  
                                         showError("Submit successfully! Go to My Check'in -> New Confirmation to see your status");                                      
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
				 
                 function registration()
                 {
				showError("Processing...");
                 var email=$("#checkinemail").val();
                 var confirmation=$("#checkincode").val();
				 
                 if(validateEmail(email))
				 
                 {
                 $.ajax({
                        type: "GET",
                        url: "api/registration.php",
                        dataType: "json",
                        data: { email: email, confirmation: confirmation}
                        }).success(function( msg ) {
                                   if(msg.status=='sent'){
									  
									
                                   showError("We have sent password to your email address.Please,check your email to login");
                                   }
                                   else if (checkCookie('uid')){
                                    window.location="index.php";
                                   }
                                   else{
									  
                                         showError("You are already the user.Do not need to registration!");                                                                                
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
				  setCookie('hname',hotel.name,1);
                  $("#welcome").append(hotel.name);
                                                                           
                          $('#hname').val(hotel.name);
                          $('#haddress').val(hotel.address);
                          $('#hphone').val(hotel.contact);
                          $('#hzip').val(hotel.zip);
                          $('#hmanager').val(hotel.manager);
                          $('#hURL').val(hotel.url);
						  $('#hemail').val(hotel.email);   
}
function checkUser()
{
    if(checkCookie('uid')){
      $('#loginPage').hide();
	  $('#regPage').hide();
     // $('#signupPage').hide();
      $('#checkinemail').val(getCookie('email'));
	  timeCount();
     }else{
      $('#myPage').hide();
      $('#logoutPage').hide();
	  $('#confirmPage').hide();
	  $('#account').hide();
     }
}
    function logout(){
      setCookie('uid','','-1');
      setCookie('token','','-1');
	  setCookie('hname','','-1');
	  setCookie('confirmation','','-1');
      setCookie('email','','-1');
	  setCookie('fname','','-1');
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
													
													
                                                         $("#myConfirmation").append('<li><a onclick="showCheckin(\''+checkin[i].confirmation+'\')" >'+"Check-in Date:"+checkin[i].arrivalday1+'/'+checkin[i].arrivalmonth1+'/'+checkin[i].arrivalyear1+'&nbsp;'+'&nbsp;'+'&nbsp;'+"Confirmation Code:"+checkin[i].confirmation+'</a></li>');
                                                          break;
                                                          case "1":
                                                          $("#currentCheckin").append('<li><a onclick="showCheckin(\''+checkin[i].confirmation+'\')" >'+"Check-in Date:"+checkin[i].arrivalday1+'/'+checkin[i].arrivalmonth1+'/'+checkin[i].arrivalyear1+'&nbsp;'+'&nbsp;'+'&nbsp;'+"Confirmation Code:"+checkin[i].confirmation+'</a></li>');
                                                          break;
                                                          case "2":
                                                          $("#myHistory").append('<li><a onclick="showCheckin(\''+checkin[i].confirmation+'\')" >'+"Check-in Date:"+checkin[i].arrivalday1+'/'+checkin[i].arrivalmonth1+'/'+checkin[i].arrivalyear1+'&nbsp;'+'&nbsp;'+'&nbsp;'+"Confirmation Code:"+checkin[i].confirmation+'</a></li>');
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
    function showCheckin(msg){
		                             
                                        var email=getCookie("email");
                                        var code=setCookie('confirmation',msg,1);
							
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
		<h1 >Enterprise Guest Engagement System - </h1>
		<h1>Customer Instance Guest Interface Module - </h1>
		<h1 id="welcome"></h1>
		<a data-rel="back" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
	</div><!-- /header -->

	<div data-role="content">
	<div id="logo">
	<br>
	</div>
	<div data-role="collapsible-set">
    <div id="regPage" data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>Registration</h3>
            <p>
                <label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="checkinemail" name="checkinemail" placeholder="Email"/>
                <label class="ui-hidden-accessible">Code:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Confirmation Code"/>
                 <button data-theme="b" onClick="registration()" onKeyPress="registration()">Check-in</button>
            </p>
		</div>
		<div id="confirmPage" data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>Confirmation</h3>
            <p>
                <label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="checkinemail2" name="checkinemail2" placeholder="Email"/>
                <label class="ui-hidden-accessible">Code:</label>
			    <input type="text" id="checkincode2" name="checkincode2" placeholder="Confirmation Code"/>
                 <button data-theme="b" onClick="checkin()" onKeyPress="checkin()">Check-in</button>
            </p>
		</div>
		<div id="loginPage" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Login</h3>
		<p>
			    <input type="text" id="loginemail" name="loginemail" placeholder="Email"/>
			    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password"/>
                 <button data-theme="b" onClick="login()" onKeyPress="login()">Login</button>
                
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
    <h3 onClick="myCheckin()"><img src="css/images/chekin.png"/>My Check-in's</h3>
    <p>
      <div data-role="collapsible">
      <h3 ><img src="css/images/chekin.png"/>New Confirmations</h3>
      <p>
                 <ul id="myConfirmation" data-role="listview">
                 </ul>
      </p>
      </div>
      <div data-role="collapsible">
      <h3 ><img src="css/images/chekin.png"/>Current Check-in</h3>
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
      <div id="account" data-role="collapsible">
                 <h3> <img src="css/images/signup.png"/>My Account</h3>
                 <p>
                 <a id="account" data-rel="dialog" data-theme="a" onClick="gotoAccount()" onKeyPress="gotoAccount()" data-role="button">
                 Go to My Account
                 </a>
                 </p>
        </div>
        <div id="logoutPage" data-role="collapsible">
                 <h3> <img src="css/images/signup.png"/>Log Out</h3>
                 <p>
                 <a id="logout" data-rel="dialog" data-theme="a" onClick="logout()" onKeyPress="logout()" data-role="button">
                 Confirm
                 </a>
                 </p>
        </div>
		<div data-role="collapsible">
		<h3><img src="css/images/about.png"/>Contact Us</h3>
				            <p>
              <table>
                <tr>
                  <td>
                    Hotel Name:
                  </td>
                  <td>
                    <input id="hname" name="hname" disabled>
                  </td>
                </tr>
                <tr>
                   <td>
                    Hotel Address:
                  </td>
                  <td>
                    <input id="haddress" name="haddress" disabled>
                  </td>
                </tr>
                <tr>
                   <td>
                    Hotel Zip Code:
                  </td>
                  <td>

                    <input id="hzip" name="hzip" disabled>
                  </td>
                </tr>
                <tr>
                   <td>
                    Manager Name:
                  </td>
                  <td>
                    <input id="hmanager" name="hmanager" disabled>
                  </td>
                </tr>
                <tr>
                   <td>
                    Phone Number:
                  </td>
                  <td>
                    <input id="hphone" name="hphone" disabled>
                  </td>
                </tr>
                 <tr>
                  <td>
                    Hotel URL:
                  </td>
                  <td>
                    <input id="hURL" name="hURL" disabled>
                  </td>
                </tr>
                 <tr>
                  <td>
                    Email:
                  </td>
                  <td>
                    <input id="hemail" name="hemail" disabled>
                  </td>
                </tr>
               
              </table>
            </p>

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
