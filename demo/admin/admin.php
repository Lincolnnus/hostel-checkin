<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<link rel="stylesheet" href="css/datepicker.css" /> 
<script src="js/jQuery.ui.datepicker.js"></script>
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
                 return hotel;
}
function getCheckData(){
	
	 var uid=getCookie('uid');
  var token=getCookie('token');
	$.ajax({
		type:"POST",
		url:"api/getCheckData.php",
		dataType:"json",
		data:{uid:uid,token:token}
		
		
		}).success(function(msg){	
			var data=msg;
			var checkData=$("#checkdata");
			checkData.html('');
			for(var i=0;i<data.length;i++){
				
			
				 var newli=$('<li>'+data[i].email+data[i].confirmation+'</li>').appendTo(checkData);
				
				}
		
		stuffList.listview( "refresh" );
		
		}) .fail(function(msg){
			
			alert("nimei");
			showError("Error Getting Stuffs");
    });
	
	}

function buildApp(){
        showError("Building...");
        var uid=getCookie("uid");
        var token=getCookie("token");
        var hid=getCookie("hid");
         $.ajax({
               type: "POST",
               url: "api/hotel.php",
               dataType: "json",
               data: { uid:uid, token: token,step:'4'}
               }).success(function( msg ) {
				   alert(msg);
                showError("Built");
         }).fail(function(msg){
			 alert("ni mei");
			 showError(msg);});
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
    function getPreferences(){
       var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getPreferences' }
               }).success(function( msg ) {
                var settings=msg;
                console.log(settings);
                $('#inactivityTimer').val(settings.inactivityTimer);
				$('#legend1').append(settings.inactivityTimer);
                $('#mailHost').val(settings.mailHost);
                $('#mailUsername').val(settings.mailUsername);
                $('#mailPassword').val(settings.mailPassword);
                $('#mailPort').val(settings.mailPort);
                $('#maxInstance').val(settings.maxInstance);
                $('#businessDate').val(settings.businessDate);
                $('#companyName').val(settings.companyName);
                          }).fail(function(msg){showError("Fail Getting Preferences");});
    }
 function getBrowsers(){
      var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getBrowsers' }
               }).success(function( msg ) {
                var browsers=msg;
                $("#supportedBrowsers").html('');
                for (var i=0;i<browsers.length;i++)
                {
                  if (browsers[i].supported==1)
                  {
                  var newBrowser=$('<li><input type="checkbox" checked onchange="updateBrowsers('+browsers[i]["bid"]+',0)">'+browsers[i]["name"]+'</li>').appendTo(
                  $("#supportedBrowsers"));
                  }else{
                  var newBrowser=$('<li><input type="checkbox" onchange="updateBrowsers('+browsers[i]["bid"]+',1)">'+browsers[i]["name"]+'</li>').appendTo(
                  $("#supportedBrowsers"));
                  }
                }
                console.log(browsers);
            }).fail(function(msg){showError("Fail Getting Browsers");});
    }
      function saveSettings(){
      showError("Saving...");
      var settings=new Object();
      settings.inactivityTimer=$('#inactivityTimer').val();
      settings.mailHost=$('#mailHost').val();
      settings.mailUsername=$('#mailUsername').val();
      settings.mailPassword=$('#mailPassword').val();
      settings.mailPort=$('#mailPort').val();
      settings.maxInstance=$('#maxInstance').val();
      settings.businessDate=$('#businessDate').val();
      settings.companyName=$('#companyName').val();
       var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'updatePreferences',settings:settings}
               }).success(function( msg ) {
                showError("Saved");
                          }).fail(function(msg){showError("Fail Updating");});
    }
    function updateBrowsers(bid,supported){
      var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,bid:bid,supported:supported,action:'updateBrowsers' }
               }).success(function( msg ) {
                showError("Done!");
            }).fail(function(msg){showError("Fail Getting Browsers");});
    }
     function getEmails(){
      var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getEmails' }
               }).success(function( msg ) {
                $('#emailTemplates').html('');
                var emails=msg;
                for (var i=0;i<emails.length;i++)
                {
                  var newEmail=$('<div data-role="collapsible"><h3>'+emails[i]['subject']+'</h3>'+
                    '<p> Subject:<input type="text" id="subject'+emails[i].eid+'" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" value="'+emails[i]['subject']+'">'+
                    'From:<input type="text" id="from'+emails[i].eid+'" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" value="'+emails[i]["from"]+'">'+
                    '<a onclick="gotoPreview()">Copy&Paste the HTML Email to Preview <button>Preview</button></a>'+
                    'Message:<textarea id="message'+emails[i].eid+'"  class="ui-input-textarea ui-body-c ui-corner-all ui-shadow-inset">'+emails[i]['message']+'</textarea>'+
                    '<button data-theme="b" onclick="updateEmails('+emails[i].eid+')">Save Change</button>'+
                    '</p></div>').appendTo($('#emailTemplates'));
                  $('button').button();
                }
                $('div[data-role=collapsible]').collapsible();
            }).fail(function(msg){showError("Fail Getting Browsers");});
    }
    function updateEmails(eid){
      var uid=getCookie("uid");
        var token=getCookie("token");
        var from=$('#from'+eid).val();
        var subject=$('#subject'+eid).val();
        var message=$('#message'+eid).val();
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,eid:eid,from:from,subject:subject,message:message,action:'updateEmails' }
               }).success(function( msg ) {
                showError("Done!");
            }).fail(function(msg){showError("Fail Getting Emails");});
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
                   $("#welcome").html("Admin Panel");
                   console.log(hotel);
                          $('#hname').val(hotel.name);
                          $('#haddress').val(hotel.address);
                          $('#hphone').val(hotel.contact);
                          $('#hzip').val(hotel.zip);
                          $('#hmanager').val(hotel.hmanager);
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
    }).fail(function(msg){showError("Error Assigning User");
	
	$('#stuffEmail').val("");
	$('#stuffFirstname').val("");
	$('#stuffLastname').val("");
	
	
	});
}

function deleteStuff(){
	var stuffEmail=$('#stuffList').val();
	showError("Processing");

	$.ajax({
		   type:"POST",
		   url:"api/assignStuff.php",
		   dataType:"json",
		   data:{stuffEmail:stuffEmail}		   		   	   
		   
		   }).success(function(msg){
			   showError("Delete Successfully");
															  
	
			   }).fail(function(msg){showError("error");
			   	showError(stuffEmail);
											   
											   });
	
	
	
	
	
	
	
	
	
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
                            var newli=$('<option><a>'+stuffs[i].email+'</a></li>').appendTo(stuffList);
                          }
                          stuffList.listview( "refresh" );
    }).fail(function(msg){showError("Error Getting Stuffs");});
}
$(document).ready(function() {
				  $("#businessDate").datepicker();
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
    <div data-role="collapsible-set">
    <div data-role="collapsible">
      <h3 id="preferencePage" onClick="getPreferences()">System Preferences</h3>
      <p>
        <div data-role="collapsible-set">
           <div data-role="collapsible">
             <h3>Session Inactivity Timer(minutes)</h3>
              <p>
                 <form>
                <label ></label>
                <legend id="legend1">Click to select your preferred timer and Current Timer is:</legend>
                <select id="inactivityTimer">
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                </select>
                </form>
                <button data-theme="b" onClick="saveSettings()">Change</button>
             </p>
           </div>
           <div data-role="collapsible">
            <h3>Set Business Date</h3>
           <p>
              <input type="text" id="businessDate">
              <button data-theme="b" onClick="saveSettings()">Set</button>
            </p>
          </div>
           <div data-role="collapsible">
             <h3 onClick="getEmails()">Email Templates</h3>
              <p>
                   <div id="emailTemplates" data-role="collapsible-set">
                   </div>
             </p>
           </div>

           <div data-role="collapsible">
             <h3 onClick="">Email Defaults</h3>
              <p>
                <ul>
                <li>Mail Server Host:<input id="mailHost"  type="text" value="ssl://smtp.gmail.com"></li>
                <li>Mail Server User Name:<input id="mailUsername" type="text" value="asplanservices@gmail.com"></li>
                <li>Mail Server Password:<input id="mailPassword" type="password" value="***"></li>
                <li>Mail Server Port:<input id="mailPort" type="text" value="465"></li>
                <li>Hotel Name Displayed in the Email:<input id="companyName" type="text" value="Asplan Checkin<noreply@asplan.com>"></li>
                <li><button data-theme="b" onClick="saveSettings()">Save</button></li>
              </ul>
             </p>
           </div>
           <div data-role="collapsible">
             <h3 onClick="">Web Services</h3>
              <p>
               Web Service Parameters
               <li>Application Server:Apache2</li>
               <li>Database:MySQL</li>
               <li>Language:PHP,JavaScript,HTML</li>
             </p>
           </div>
                <input id="maxInstance" type="hidden" value="100">
            <div data-role="collapsible">
             <h3 onClick="getBrowsers()">Browser Type Support</h3>
              <p>
                Any browser which supports HTML5<br>
                <ul id="supportedBrowsers">
                 
                </ul>
             </p>
           </div>
        </div>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>System Operations Management</h3>
      <p>
      <div data-role="collapsible-set">
    <div data-role="collapsible">
      <h3>Set System Online/Offline</h3>
      <p>
           <button data-theme="a" onClick="setOffline()">Confirm</button>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>Shutdown my Instance</h3>
      <p>
           <button data-theme="a" onClick="shutdownAll()">Confirm</button>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>Start my Instance</h3>
      <p>
           <button data-theme="b" onClick="startAll()">Confirm</button>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>Backup my Instance</h3>
      <p>
           <button data-theme="b" onClick="backupAll">Backup</button>
      </p>
    </div>
    </div>
      </p>
    </div>
     <div data-role="collapsible">
      <h3>Hotel Information</h3>
      
            <p>
              <table>
                <tr>
                  <td>
                    Hotel Name:
                  </td>
                  <td>
                    <input id="hname" name="hname">
                  </td>
                </tr>
                <tr>
                   <td>
                    Hotel Address:
                  </td>
                  <td>
                    <input id="haddress" name="haddress">
                  </td>
                </tr>
                <tr>
                   <td>
                    Hotel Zip Code:
                  </td>
                  <td>
                    <input id="hzip" name="hzip">
                  </td>
                </tr>
                <tr>
                   <td>
                    Phone Number:
                  </td>
                  <td>
                    <input id="hphone" name="hphone">
                  </td>
                </tr>				                
              </table>
			  <p>
                   <img width="100px" id="hlogo"><br>
                    Change Logo:
                   <iframe src="upload.php" seamless>
                    <p>Your browser does not support iframes.</p>
                   </iframe>
            </p>
			  <button onClick="saveHotel()">Save</button>
            </p>
    
    
    
  </div>
  </p>
  </div>
    <div id="importPage" data-role="collapsible">
    <h3>Import Checkin Data</h3>
    <p>
                  <iframe width="100%" height="50%" src="upload.php" seamless>
                    <p>Your browser does not support iframes.</p>
                   </iframe>  
	 <p>
            <ul id="checkdata" data-role="listview" data-filter="true" data-filter-placeholder="Search hotels..." data-filter-theme="d"data-theme="d" data-divider-theme="d">
		      	</ul>
            </p>
					
				    <button data-theme="b" onClick=" getCheckData()">Get CheckData</button>
    </div>
		<div id="adminPage" data-role="collapsible">
		<h3>Enrol New User</h3>
		<p>
			    <input type="text" id="stuffEmail" name="stuffEmail" placeholder="New User Email"/>
          <input type="text" id="stuffFirstname" name="stuffFirstname" placeholder="New User First Name"/>
          <input type="text" id="stuffLastname" name="stuffLastname" placeholder="New User Last Name"/>
                 <button data-theme="b" onClick="assignStuff()">Proceed to Enrol</button>
		</p>
		</div>
    <div id="stuffPage" data-role="collapsible">
    <h3 onClick="getStuff()">Enrolled Users</h3>
    <p>
      <form  id="stuffForm" data-role="listview" data-filter="true" data-filter-placeholder="Search Stuffs..." data-filter-theme="d"data-theme="d" data-divider-theme="d" >
	   <select id="stuffList" >
	   
	   </select>
       </form>
	   
    </p>
	<button data-theme="b" onClick="deleteStuff()">Delete Enrolled Users</button>
    </div>
    <div id="passPage" data-role="collapsible">
    <h3>Change Password</h3>
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
                 <h3>Log Out</h3>
                 <p>
                 <a id="logout" data-rel="dialog" data-theme="a" onClick="logout()" onKeyPress="logout()" data-role="button">
                 Confirm
                 </a>
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
