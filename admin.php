<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Website System Administration Module</title>
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
.ui-input-textarea{
  height:500px;
  width:100%;
}
#message{
   border:1px solid black;
}
#errorClose{
float:right;
}
</style>
<script>
/*var count=240;//session 30 seconds

var counter=setInterval(timer, 1000); 
function timer()
{
  count=count-1;
  if (count <= 0)
  {
     var answer = confirm("Session Expired, Do You Want To Continue?")
  if (answer){
    count=240;
  }
  else{
    logout();
  }
  }

 document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
}*/
    function logout(){
      setCookie('uid','','-1');
      setCookie('token','','-1');
      window.location="index.php";
    }
    function showError(msg)
    {
        $('#preferencePage').trigger('collapse');
        $("#errorMsg").html(msg);
        $("#errorWrapper").show();
    }

    function hideError()
  {
    $("#errorWrapper").hide(); 
    window.location.reload();
  }
    function gotoHotel(hid){
      setCookie('hid',hid,'1');
      window.location="hotel.php";
    }
    function gotoHome(){
      window.open("index.php");
    }
    $(document).ready(function() {
                      $("#businessDate").datepicker();
                      if(checkCookie("uid")){
                        var uid=getCookie("uid");
                      }else{
                         window.location="index.php";
                      }
                    });
    function getAuthorizedHotels() {
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getAuthorizedHotels'}
               }).success(function( msg ) {
                          var hotels=msg;
                          var hotel=$("#authorizedHotels");
                          hotel.html('');
                          if(hotels)
                          {
                          for(var i=0;i<hotels.length;i++)
                          {
                            var newli=$('<li><a onclick="gotoHotel('+hotels[i].hid+')">'+hotels[i].hname+'</a></li>').appendTo(hotel);
                          }
                        }
                          hotel.listview( "refresh" );
                          }).fail(function(msg){console.log(msg);});
    }
    function gotoDemo(){
      window.location="../demo/guest/";
    }
    function gotoPreview(){
      window.open("http://www.onlinehtmleditor.net/");
    }
    function getNewHotels() {
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getNewHotels' }
               }).success(function( msg ) {
                          var hotels=msg;
                          var hotel=$("#newHotels");
                          hotel.html('');
                           if(hotels)
                          {
                          for(var i=0;i<hotels.length;i++)
                          {
                            var newli=$('<li><a onclick="gotoHotel('+hotels[i].hid+')">'+hotels[i].hname+'</a></li>').appendTo(hotel);
                          }
                        }
                          hotel.listview( "refresh" );
                          }).fail(function(msg){console.log(msg);});
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
                $('#inactivityTimer').val(settings.inactivityTimer);
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
    function setOffline(){
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'setOffline'}
               }).success(function( msg ) {
                showError("Succeed");
                          }).fail(function(msg){showError("Fail");});
    }
    function shutdownAll(){
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'shutdownAll'}
               }).success(function( msg ) {
                showError("Succeed");
                          }).fail(function(msg){showError("Fail");});
    }
     function startAll(){
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'startAll'}
               }).success(function( msg ) {
                showError("Succeed");
                          }).fail(function(msg){showError("Fail");});
    }
     function backupAll(){
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'backupAll'}
               }).success(function( msg ) {
                showError("Succeed");
                          }).fail(function(msg){showError("Fail");});
    }
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b" data-add-back-btn="true">
		<h1>Enterprise Guest Engagement System</h1>
        <a onclick="gotoHome()" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
	</div><!-- /header -->

	<div data-role="content">
        <div><h2>Website System Administration Module</h2></div>
	<div data-role="collapsible-set">
    <div data-role="collapsible">
      <h3 id="preferencePage" onclick="getPreferences()">System Preferences</h3>
      <p>
        <div data-role="collapsible-set">
           <div data-role="collapsible">
             <h3>Session Inactivity Timer(minutes)</h3>
              <p>
                <input id="inactivityTimer" type="text">
                <button data-theme="b" onclick="saveSettings()">Change</button>
             </p>
           </div>
           <div data-role="collapsible">
            <h3>Set Business Date</h3>
           <p>
              <input type="text" id="businessDate">
              <button data-theme="b" onclick="saveSettings()">Set</button>
            </p>
          </div>
           <div data-role="collapsible">
             <h3 onclick="getEmails()">Email Templates</h3>
              <p>
               <div id="emailTemplates" data-role="collapsible-set">
              </div>
             </p>
           </div>

           <div data-role="collapsible">
             <h3 onclick="">Email Defaults</h3>
              <p>
                <ul>
                <li>Mail Server Host:<input id="mailHost"  type="text" value="ssl://smtp.gmail.com"></li>
                <li>Mail Server User Name:<input id="mailUsername" type="text" value="asplanservices@gmail.com"></li>
                <li>Mail Server Password:<input id="mailPassword" type="password" value="***"></li>
                <li>Mail Server Port:<input id="mailPort" type="text" value="465"></li>
                <li>Email Name Displayed in the Email:<input id="companyName" type="text" value="Asplan Checkin<noreply@asplan.com>"></li>
                <li><button data-theme="b" onclick="saveSettings()">Save</button></li>
              </ul>
             </p>
           </div>
           <div data-role="collapsible">
             <h3 onclick="">Web Services</h3>
              <p>
               Web Service Parameters
               <li>Application Server:Apache2</li>
               <li>Database:MySQL</li>
               <li>Language:PHP,JavaScript,HTML</li>
             </p>
           </div>
           <div data-role="collapsible">
             <h3 onclick="">Maximum Instances Allowed</h3>
              <p>
                <input id="maxInstance" type="text" value="100">
                <button data-theme="b" onclick="saveSettings()">Save</button>
             </p>
           </div>
            <div data-role="collapsible">
             <h3 onclick="getBrowsers()">Browser Type Support</h3>
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
           <button data-theme="a" onclick="setOffline()">Confirm</button>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>Shutdown all Instances</h3>
      <p>
           <button data-theme="a" onclick="shutdownAll()">Confirm</button>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>Start all Instances</h3>
      <p>
           <button data-theme="b" onclick="startAll()">Confirm</button>
      </p>
    </div>
    <div data-role="collapsible">
      <h3>Backup all Instances</h3>
      <p>
           <button data-theme="b" onclick="backupAll">Backup</button>
      </p>
    </div>
    </div>
      </p>
    </div>
		<div data-role="collapsible">
            <h3 onclick="getNewHotels()">Enrol New Hospitality Partner</h3>
            <p>
            <ul id="newHotels" data-role="listview" data-filter="true" data-filter-placeholder="Search hotels..." data-filter-theme="d"data-theme="d" data-divider-theme="d">
            </ul>
            </p>
		</div>
    <div data-role="collapsible"> 
            <h3 onclick="getAuthorizedHotels()">Enrolled Hospitality Partner Maintenance Facility</h3>
            <p>
            <ul id="authorizedHotels" data-role="listview" data-filter="true" data-filter-placeholder="Search hotels..." data-filter-theme="d"data-theme="d" data-divider-theme="d">
		      	</ul>
            </p>
		</div>
    <div data-role="collapsible">
    <h3>Log Out System Administration</h3>
    <p>
    <button data-theme="b" onclick="logout()">Confirm</button>
    </p>
    </div>

	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Enterprise Guest Engagement System.
Copyright &copy;2012-2013 Asplan Services Private Limited (19834692/W), Singapore. All Rights Reserved</h4></div>
 <div id="errorWrapper" style="display:none;">
                  <center id="errorMsg"></center>
                  <img src="css/images/close_icon.png" width="30px" title="close" onclick="hideError()" id="errorClose"/>
   </div>
</div><!-- /page -->
</body>
</html>
