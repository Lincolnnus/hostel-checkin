<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script src="js/main.js"></script>
<style>
.ui-collapsible.ui-collapsible-collapsed .ui-collapsible-heading .ui-icon-plus,
.ui-icon-arrow-r { background-position: -108px 0; }
.ui-icon-arrow-l { background-position: -144px 0; }
.ui-icon-arrow-u { background-position: -180px 0; }
.ui-collapsible .ui-collapsible-heading .ui-icon-minus,
.ui-icon-arrow-d { background-position: -216px 0; }
</style>
<script>
function visitorCheckin()
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
                          setCookie('email2',msg.email,1);
                          setCookie('confirmation',msg.confirmation,1);
                          window.location="visitorCheckin.php";
                          }).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");});
	}
    else
    { showError("Invalid Email Address");}
    
}
$(document).ready(function() {
                  if(checkCookie("uid")!=0)
                  {
                  if((checkCookie("type"))==1)
                  {window.location="index.php";}
                  var fname=getCookie("fname");
                  getCheckin();
                  $("#welcome").html(fname+"'s Checkins");
                  } 
                  else
                  {window.location="public.php";} })
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1 id="welcome">Welcome</h1>
		<a href="" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<a href="account.php" data-icon="gear" data-iconpos="notext" data-transition="turn">My Account</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
        <div id="visitorCheckin" data-role="collapsible">
            <h3><img src="css/images/login.png"/>Visitors Checkins</h3>
            <p>
            <input type="text" id="checkinemail" name="checkinemail" placeholder="Checkin Email"/>
            <input type="text" id="checkincode" name="checkincode" placeholder="Checkin Code"/>
            <button data-theme="b" onclick="visitorCheckin()" onkeypress="visitorCheckin()">Checkin</button>
            </p>
        </div>
         <div data-role="collapsible">
                 <h3><img src="css/images/chekin.png"/>Check In</h3>
                 <p>
                 <label class="ui-hidden-accessible">Password:</label>
                 <input type="text" id="checkincode" name="checkincode" placeholder="Checkin Code"/>
                 <button data-theme="b" onclick="checkin()" onkeypress="checkin()">Checkin</button>
                 </p>
        </div>
		<div data-role="collapsible">
		<h3><img src="css/images/chekin.png"/>My Checkins</h3>
		<p>
			<div data-role="collapsible">
			<h3 ><img src="css/images/chekin.png"/>My Bookings</h3>
			<p>
                 <ul id="checkin1" data-role="listview">
                 </ul>
			</p>
			</div>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Confirmations</h3>
			<p>
                 <ul id="checkin2" data-role="listview">
                 </ul>
			</p>
			</div>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Checkins</h3>
			<p>
                 <ul id="checkin3" data-role="listview">
                 </ul>
			</p>
			</div>
			<div data-role="collapsible">
			<h3><img src="css/images/chekin.png"/>My Checkouts</h3>
			<p>
                 <ul id="checkin4" data-role="listview">
                 </ul>
			</p>
			</div>
		</p>
		</div>
        <div data-role="collapsible">
                 <h3> <img src="css/images/signup.png"/>Log Out</h3>
                 <p>
                 <a id="logout" data-rel="dialog" data-theme="a" onclick="logout()" onkeypress="logout()" data-role="button">
                 Confirm
                 </a>
                 </p>
        </div>
	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div>
</div><!-- /page -->
</body>
</html>
