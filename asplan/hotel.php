<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>System Control Panel</title>
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
#message{
   border:1px solid black;
}
#errorClose{
float:right;
}
</style>
<script>
  function getEmails(){
      var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,action:'getEmails' }
               }).success(function( msg ) {
                $('#message').html('');
                var emails=msg;
                for (var i=1;i<emails.length;i++)
                {
                  var newEmail=$('<div data-role="collapsible"><h3>'+emails[i]['subject']+'</h3>'+
                    '<p> Subject:<input type="text" id="subject'+emails[i].eid+'" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" value="'+emails[i]['subject']+'">'+
                    'From:<input type="text" id="from'+emails[i].eid+'" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset" value="'+emails[i]["from"]+'">'+
                    '<a onclick="gotoPreview()">Copy&Paste the HTML Email to Preview <button>Preview</button></a>'+
                    'Message:<textarea id="message'+emails[i].eid+'"  class="ui-input-textarea ui-body-c ui-corner-all ui-shadow-inset">'+emails[i]['message']+'</textarea>'+
                    '<button data-theme="b" onclick="updateEmails('+emails[i].eid+')">Save Change</button>'+
                    '</p></div>').appendTo($('#message'));
                  $('button').button();
                }
                $('div[data-role=collapsible]').collapsible();
            }).fail(function(msg){showError("Fail Getting Browsers");});
    }
    function showError(msg)
    {
        $('#hotelInfo').trigger('collapse');
        $('#buildPage').trigger('collapse');
        $("#errorMsg").html(msg);
        $("#errorWrapper").show();
    }
    function logout(){
      setCookie('uid','','-1');
      setCookie('token','','-1');
      window.location="index.php";
    }
    function gotoAdmin(){
      window.location="admin.php";
    }
    $(document).ready(function() {
                      if(checkCookie("hid")){
                        getHotel();
						$("#fuck").hide();
                      }else{
                         window.location="index.php";
                      }
                    });
    function getHotel() {
        var uid=getCookie("uid");
        var token=getCookie("token");
        var hid=getCookie("hid");
        $.ajax({
               type: "GET",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,hid:hid,action:'getHotel'}
               }).success(function( msg ) {
                         // $('#hotelInfo').trigger('expand');
                          var hotel=msg;
                          $('#emailTo').val(hotel.hemail);
                          $('#hotelEmail').html(hotel.hemail);
                          $('#hotelURL').html(hotel.hURL);
                          $('#hotelName').html(hotel.hname);
                          $('#hname').val(hotel.hname);
                          $('#haddress').val(hotel.haddress);
                          $('#hphone').val(hotel.hphone);
                          $('#hzip').val(hotel.hzip);
                          $('#hmanager').val(hotel.hmanager);
                          $('#hURL').val(hotel.hURL);
                          $('#hDir').val(hotel.hDir);
                          $('#hDB').val(hotel.hDB);
                          $('#hlogo').attr('src',hotel.hlogo);
                          $('#emailMessage').val($('#message').html());
                          if(hotel.verified>0){
                            $('#verify').hide();
							$('#hoteltitle').html("Enrolled Hospitality Partner Maintenance facility - ");
							$('#hoteltitle').append(hotel.hname);
							$('#sendEmail').hide();
                          }else{
							$('#hoteltitle').html("Enrol New Hospitality Partner - ")
							$('#hoteltitle').append(hotel.hname);
                            $('#verified').hide();
                            $('#buildPage').hide();
                          }
                          }).fail(function(msg){showError(msg);});
    }
    function hideError()
  {
    $("#errorWrapper").hide(); 
    window.location.reload();
  }
     function saveHotel() {
        showError("Saving...");
        var uid=getCookie("uid");
        var token=getCookie("token");
        var hotel=new Object();
        hotel.hid=getCookie("hid");
        hotel.hname=$('#hname').val();
        hotel.haddress=$('#haddress').val();
        hotel.hzip=$('#hzip').val();
        hotel.hmanager=$('#hmanager').val();
        hotel.hphone=$('#hphone').val();
        hotel.hURL=$('#hURL').val();
        hotel.hDir=$('#hDir').val();
        hotel.hDB=$('#hDB').val();
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,hotel:hotel,action:'saveHotel'}
               }).success(function( msg ) {
                          showError("Saved");
                          }).fail(function(msg){showError(msg);});
    }
     function deleteHotel() {
        showError("Deleting...");
        
        var uid=getCookie("uid");
        var token=getCookie("token");
       
        var hid=getCookie("hid");
         $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,hid:hid,action:'deleteHotel'}
               }).success(function( msg ) {
                          showError("Deleted");
			  location.href = "admin.php"
                          }).fail(function(msg){showError(msg);});
        
     }
    function verifyHotel() {
      var r=confirm("Confirm Verfied?");
      if (r==true){
        showError("Unverifying...");
        $('#sendEmail').trigger('collapse');
        var uid=getCookie("uid");
        var token=getCookie("token");
        var hid=getCookie("hid");
        var email=new Object();
       var from=$('#emailFrom').val();
        var to=$('#emailTo').val();
        var subject=$('#emailSubject').val();
        var message=$('#emailMessage').val();        
console.log(email);
alert(from);
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,hid:hid,from:from,to:to,subject:subject,message:message,action:'verifyHotel'}
               }).success(function( msg ) {
                $('#verified').show();
                $('#buildPage').show();
                $('#verify').hide();
                showError("Success");
                          }).fail(function(msg){showError(msg.responseText);});
      }
    }
    function buildApp(){
        showError("Building...");
        var uid=getCookie("uid");
        var token=getCookie("token");
        var hid=getCookie("hid");
         $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,hid:hid,action:'buildApp'}
               }).success(function( msg ) {
                showError("Built");
         }).fail(function(msg){showError(msg);});
    }
    function gotoDemo(){
      window.location="../demo/guest/";
    }
    function unverifyHotel() {
      var r=confirm("Confirm Unverfy?");
      if (r==true){
        showError("Unverifying...");
        $('#sendEmail').trigger('collapse');
        var uid=getCookie("uid");
        var token=getCookie("token");
        var hid=getCookie("hid");
        var email=new Object();
        email.from=$('#emailFrom').val();
        email.to=$('#emailTo').val();
        email.subject=$('#emailSubject').val();
        email.message=$('#emailMessage').val();
        $.ajax({
               type: "POST",
               url: "api/admin.php",
               dataType: "json",
               data: { uid:uid, token: token,hid:hid,email:email,action:'unverifyHotel'}
               }).success(function( msg ) {
                $('#verified').hide();
                $('#verify').show();
                showError("Success");
                          }).fail(function(msg){showError(msg.responseText);});
      }
    }
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b" data-add-back-btn="true">
		<h1 id="hoteltitle"></h1>
        <a onClick="gotoAdmin()" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
	</div><!-- /header -->

	<div data-role="content">
        <div><h2>Hotel Information</h2></div>
	<div data-role="collapsible-set" >
		<div id="hotelInfo" data-role="collapsible">
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
                    Manager Name:
                  </td>
                  <td>
                    <input id="hmanager" name="hmanager">
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
                 <tr>
                  <td>
                    Hotel URL:
                  </td>
                  <td>
                    <input id="hURL" name="hURL">
                  </td>
                </tr>
                 <tr>
                  <td>
                   Hotel Directory:
                  </td>
                  <td>
                    <input id="hDir" name="hDir">
                  </td>
                </tr>
                 <tr>
                  <td>
                    Database Name:
                  </td>
                  <td>
                    <input id="hDB" name="hDB">
                  </td>
                </tr>
                <tr>
                   <td>
                  </td>
                  <td>
                    <button onClick="saveHotel()">Save</button>
                  </td>
                 <td>
                    <button data-theme="a" onClick="deleteHotel()">Delete</button>
                  </td>
                </tr>
              </table>
            </p>
		</div>
    <div data-role="collapsible"> 
            <h3> Change Logo</h3>
            <p>
                   <img width="100px" id="hlogo"><br>
                    Change Logo:
                   <iframe src="upload.php" seamless>
                    <p>Your browser does not support iframes.</p>
                   </iframe>
            </p>
		</div>
        <div id="emailTemplates2" data-role="collapsible-set"></div>
     <div data-role="collapsible"> 
            <h3 id="sendEmail"> Send Verification Email</h3>
            <p id="fuck">
                Subject:<input id="emailSubject" type="text" placeholder="Title of the Email" value="Verified By Asplan">
                To:<input id="emailTo" type="text" placeholder="Receiver's Email Address"> 
                From:<input type="text" id="emailFrom" value="Asplan Services<asplanservices@gmail.com>">
                Message: <div id="message"><p>Dear <a id="managerName">Shao</a>,</p><p>Your request has been approved by Asplan Service.</p>
                <p>You are now the default system admin for <a id="hotelName"></a></p>
                <p>Email Address: <a id="hotelEmail"></a></p>
                <p>Password: <a id="hotelPassword"></a></p>
                <p>Please access your admin account via <a id="hotelURL"></a></p>
                <p>Best Regards,</p>
                <p>Asplan Service Team</p></div>
                
                
                
                
                <textarea cols="100" rows="100" id="emailMessage" placeholder="Please Paste The HTML Email"></textarea>        
                     <div id="verified"><button onClick="unverifyHotel()" data-theme="b">Verified</button></div>
                     <div id="verify"><button onClick="verifyHotel()" data-theme="a">Verify</button></div>
            </p>
    </div>
    <div id="buildPage" data-role="collapsible"> 
            <h3> Build App for this Hotel</h3>
            <p>
              <div data-role="collapsible-set">
                <div data-role="collapsible">
                  <h3 id="step1">Step 1,Create New Database</h3>
                  <p>
                    <button>Next</button>
                  </p>
                </div>
                 <div data-role="collapsible">
                  <h3 id="step2">Step 2,Copy Empty Database</h3>
                  <p>
                      <button>Next</button>
                  </p>
                </div>
                 <div data-role="collapsible">
                  <h3 id="step3">Step 3,Insert Admin Account</h3>
                  <p>
                      <button>Next</button>
                  </p>
                </div>
                 <div data-role="collapsible">
                  <h3 id="step4">Step 4,Create Hotel Directory</h3>
                  <p>
                      <button>Next</button>
                  </p>
                </div>
                <div data-role="collapsible">
                  <h3 id="step5">Step 5,Copy Hotel Module</h3>
                  <p>
                      <button>Next</button>
                  </p>
                </div>
                <div data-role="collapsible">
                  <h3 id="step6">Step 6,Copy Hotel Meta Data</h3>
                  <p>
                    <button data-theme="b" onClick="buildApp()">Finish Building</button>
                  </p>
                </div>
              </div>
            </p>
    </div>
    <div data-role="collapsible">
    <h3>Log Out</h3>
    <p>
    <button data-theme="b" onClick="logout()">Confirm</button>
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
