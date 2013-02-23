<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Enterprise Guest Engagement System</title>
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script src="js/ajax_captcha.js"></script>
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
tr,table,tbody{
  width:100%;
}
td{
  width:50%;
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
                 xmlhttp.open("GET","../demo/hotel.xml",false);
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
        $('#signup').trigger('collapse');
        $('#loginpage').trigger('collapse');
        $("#errorMsg").html(msg);
        $("#errorWrapper").show();
}
function login()
{
  showError("Login in process...");
	var email=$("#loginemail").val();
	var password=$("#loginpassword").val();
        if(validateEmail(email))
	{
		$.ajax({
		  type: "POST",
		  url: "api/admin.php",
		  dataType: "json",
		  data: { email: email, password: password }
		}).success(function( msg ) {
		  setCookie('uid',msg.uid,1);
		  setCookie('token',msg.token,1);
		  setCookie('uname',msg.uname,1);
		  setCookie('email',msg.email,1);
      window.location="admin.php";
		}).fail(function(msg){
                showError("Error Login");
		});
	}
        else
        { showError("Invalid Email Address");}

}
function hideError()
{
  $("#errorWrapper").hide(); 
  window.location.reload();
}
function gotoDemo()
{
  window.open("../demo/guest/");
}
$(document).ready(function() {
 /* var hotel=getHotel();
  $("#hotelLogo").attr('src',hotel.logo);
  $("#hotelLogo").attr('title',hotel.name);*/
});
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1 id="welcome">Enterprise Guest Engagement System - System Administration Module</h1>
	</div><!-- /header -->

	<div data-role="content">
	<div id="logo">
    <center><img width="30%" title="Asplan Logo" src="css/images/logo.png"/></center>
	<br>
	</div>
	<div data-role="collapsible-set">
    <div id="loginpage" data-role="collapsible">
    <h3><img src="css/images/login.png"/>Login</h3>
    <p>
          <input type="text" id="loginemail" name="loginemail" placeholder="Your Email"/>
          <input type="password" id="loginpassword" name="loginpassword" placeholder="Your Password"/>
                 <button data-theme="b" onClick="login()" >Login</button>
    </p>
    </div>
    <div id="confirmapage" data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>System Demo</h3>
            <p>
              <a onClick="gotoDemo()"><img id="hotelLogo" src="css/images/test.png" width="20%" title="http://54.251.118.233/pl/demo/guest"></br>
              http://54.251.118.233/pl/demo/guest
              </a>
            </p>
    </div>
		<div id="signup" data-role="collapsible">
		<h3><img src="css/images/signup.png"/>Partner with us testing</h3>
		<p>
      <form id="frmCaptcha" name="frmCaptcha">
    <table> 
         <tr>
        <td>
          <input type="text" id="signupemail" name="signupemail" placeholder="Email"/></td>
        <td>
          <input type="text" id="hotelname" name="hotelname" placeholder="Hotel Name"/>
        </td>
      </tr>
      <tr>
        <td>       
          <input type="text" id="hoteladdr" name="hoteladdr" placeholder="Hotel Address"/>
        </td>
        <td>
          <input type="text" id="hotelzip" name="hotelzip" placeholder="Zip Code"/>
        </td>
      </tr>
        <tr>
        <td>       
          <input type="text" id="hotelmanager" name="hotelmanager" placeholder="Your Name"/>
        </td>
        <td>
          <input type="text" id="hotelphone" name="hotelphone" placeholder="Contact Number"/>
        </td>
      </tr>    
      <tr>

        <td>
          <input id="txtCaptcha" type="text" name="txtCaptcha" value="" maxlength="10" size="20" placeholder="Random Code Here" />
        </td>
        <td> 
            <img id="imgCaptcha" width="200px" src="api/create_image.php" />
        </td>
      </tr>
    </table> 

         <input id="btnCaptcha" type="button" value="Submit" name="btnCaptcha" 
            onclick="getParam(document.frmCaptcha)" /> 
    <div><h1 id="result"></h1></div>
  </form> 
		</p>
		</div>
		<div data-role="collapsible">
		<h3><img src="css/images/about.png"/>About us</h3>
		<p id="aboutUs">
       <img width="800px" title="Asplan Logo" src="css/images/asplan.png"/>
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
