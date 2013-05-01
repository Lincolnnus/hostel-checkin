<html>
<head>
<title>Hotel Staff-Index</title>
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
				 hotel.email=hotelxml.getElementsByTagName("email")[0].childNodes[0].nodeValue;
				 hotel.url=hotelxml.getElementsByTagName("url")[0].childNodes[0].nodeValue;
				 hotel.manager=hotelxml.getElementsByTagName("manager")[0].childNodes[0].nodeValue;
                 return hotel;
}
function showError(msg)
{
        $("#errorMsg").html(msg);
        $("#errorWrapper").show();
}
function getBooking()
{
  var uid=getCookie('uid');
  var token=getCookie('token');               
  $.ajax({
      type: "POST",
      url: "api/getBooking.php",
      dataType: "json",
      data: {uid:uid,token:token}
    }).success(function( msg ) {
//		alert(msg);
       var booking=msg;
                          var bookingList=$("#newBooking");
                          bookingList.html('');
                          for(var i=0;i<booking.length;i++)
                          {
                            var newli=$('<li><a onclick="showBooking(\''+booking[i].confirmation+'\',\''+booking[i].email+'\')">'+"Check-in Date:"+booking[i].arrivalday1+'/'+booking[i].arrivalmonth1+'/'+booking[i].arrivalyear1+'&nbsp;'+'&nbsp;'+'&nbsp;'+"Confirmation Code:"+booking[i].confirmation+'</a></li>').appendTo(bookingList);
                          }
                          bookingList.listview( "refresh" );
    }).fail(function(msg){showError("Error Getting Stuffs");});
}
 
 function showBooking(msg1,msg2){
	                                    var code=setCookie('confirmation',msg1,1);
                                        var email=setCookie('email',msg2,1);
                                       
									

                                        window.location="checkin.php";
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
                                                          }).fail(function(msg){alert("Fail To Update Password");//window.location="index.php";
                                                          });
                                        }else alert("Please Enter the password correctly");
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
	  setCookie('hname','','-1');
	  setCookie('fname','','-1');
	  setCookie('email','','-1');
      window.location="index.php";
    }
function showHotel(hotel)
{
	setCookie('hname',hotel.name,1);
  $("#logo").html('<center><img src="'+hotel.logo+'" title="'+hotel.name+'" width="150px"></center>');
   $("#welcome").html("Enterprise Guest Engagement System - Customer Instance System "+'<br />'+"Checkin Modulel-");
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
  }else{
    $('#passPage').hide();
    $('#logoutPage').hide();
	$('#getbooking').hide();
	$('#confirmapage').hide();
  }
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
	<div id="getbooking" data-role="collapsible">
            <h3 onClick="getBooking()"><img src="css/images/chekin.png"/>Get Booking Customer</h3>
            <p>
            <ul id="newBooking" data-role="listview" data-filter="true" data-filter-placeholder="Search Booking..." data-filter-theme="d"data-theme="d" data-divider-theme="d">
            </ul>
            </p>
		</div>
   

			
	<div id="confirmapage" data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>Guest Confirmation</h3>
            <p>
                <label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="checkinemail" name="checkinemail" placeholder="Email"/>
                <label class="ui-hidden-accessible">Code:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Confirmation Code"/>
                 <button data-theme="b" onClick="checkin()" onKeyPress="checkin()">Checkin</button>
            </p>
		</div>
		<div id="loginPage" data-role="collapsible">
		<h3><img src="css/images/login.png"/>Login</h3>
		<p>
			    <input type="text" id="loginemail" name="loginemail" placeholder="Email"/>
			    <input type="password" id="loginpassword" name="loginpassword" placeholder="Password"/>
                 <button data-theme="b" onClick="login()" onKeyPress="login()">Login</button>
                 <a onClick="gotoGuest()" style="float:right;">Guest Login</a>
		</p>
		</div>
     <div id="passPage" data-role="collapsible">
    <h3><img src="css/images/login.png"/>Change Password</h3>
    <p>
      <form method="post">
      <label class="ui-hidden-accessible">Old Password:</label>
          <input type="text" id="oldpass" name="oldpass" placeholder="Old Password"/>
      <label class="ui-hidden-accessible">New Password:</label>
          <input type="password" id="password" name="password" placeholder="New Password"/>
      <label class="ui-hidden-accessible">Confirm Password:</label>
          <input type="password" id="confirmpass" name="confirmpass" placeholder="Confirm Password"/>
      <button data-theme="b" onClick="changePass()" onKeyPress="changePass()">Change Password</button>
      </form>
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
