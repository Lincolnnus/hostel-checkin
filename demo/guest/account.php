<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<link rel="stylesheet" href="css/datepicker.css" /> 
<script src="js/jQuery.ui.datepicker.js"></script>
<style type="text/css">
.ss select{margin-right:30px;


	
	
	
	}
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
 function logout(){
      setCookie('uid','','-1');
      setCookie('token','','-1');
      window.location="index.php";
    }

  function gotoHome(){
    window.location='index.php';
  }
   function changePass() {
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
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update Password");window.location="account.php";});
                                        }else alert("Please Enter the password correctly");
                                        }
  
                                        function changeProfile()
                                        {
                                        var fname=$("#fname").val();
                                        var lname=$("#lname").val();
                                        var title=$("#title").val();
										var birth=$("#birth").val();
										var phone=$("#phone").val();
										
										var sex=$("#sex").val();
                                        var email=getCookie('email');
                                        var uid=getCookie("uid");var token=getCookie("token");
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email,fname:fname,lname:lname,title:title,birth:birth,phone:phone,sex:sex,task:'changeProfile'}
                                               }).success(function( msg ) {
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
                                        
                                        }
										
										function changePreference()
										{
											var eMotel=$("input[name='checkbox1[]']:checked:enabled").val();
									     //var eMotel=$("#checkbox1").val();
                                        var eBinn=$("input[name='checkbox2[]']:checked:enabled").val();
                                        var eBhotel=$("input[name='checkbox3[]']:checked:enabled").val();
                                        var eSchain=$("input[name='checkbox4[]']:checked:enabled").val();
                                        var mBinn=$("input[name='checkbox5[]']:checked:enabled").val();
                                        var mIbhotel=$("input[name='checkbox6[]']:checked:enabled").val();
                                        var mSchain=$("input[name='checkbox7[]']:checked:enabled").val();
										var mBchain=$("input[name='checkbox8[]']:checked:enabled").val();
										var uIbhotel=$("input[name='checkbox9[]']:checked:enabled").val();
								        var uSchain=$("input[name='checkbox10[]']:checked:enabled").val();
								        var uBchain=$("input[name='checkbox11[]']:checked:enabled").val();
								        var uChotel=$("input[name='checkbox12[]']:checked:enabled").val();	
										
										var select1=$("#select1").val();
                                       
                                        var select2=$("#select2").val();
										  var select3=$("#select3").val();
								          var select4=$("#select4").val();
										  
										  var select5=$("#select5").val();
										  
								var select6=$("#select6").val();
								var select7=$("#select7").val();
								var select8=$("#select8").val();
								var select9=$("#select9").val();
								var select10=$("#select10").val();
								var select11=$("#select11").val();
										
										var uid=getCookie("uid");
                                        var token=getCookie("token");
									
										
											
										$.ajax({
										
											   type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data:{ uid:uid,token:token,eMotel:eMotel,eBinn:eBinn,eBhotel:eBhotel,eSchain:eSchain,mBinn:mBinn,mIbhotel:mIbhotel,mSchain:mSchain,mBchain:mBchain,uIbhotel:uIbhotel,uSchain:uSchain,uBchain:uBchain,uChotel:uChotel,select1:select1,select2:select2,select3:select3,select4:select4,select5:select5,select6:select6,select7:select7,select8:select8,select9:select9,select10:select10,select11:select11,task:'changePreference'}
											   											   
											   }
											   ).success(function( msg ) {
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
											
											
											
											
																																	
																																												
											
											}
                                        function changePassport()
                                        {
                                        var passport=$("#passportNo").val();
                                        var expireDate=$("#expireDate").val();
                                        var issueDate=$("#issueDate").val();
                                         var issueCountry=$("#issueCountry").val();
                                        var issueCity=$("#issueCity").val();
                                        var email=getCookie("email");
                                        var uid=getCookie("uid");
                                        var token=getCookie("token");
										var sex=$("#sex2").val();
										var address=$("#address").val();
										var birthPlace=$("#birthPlace").val();
										var nationality=$("#nationality").val();
										var birth=$("#birth2").val();
										
										
									
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",

                                               data: { uid: uid, token: token,email:email,issueCountry:issueCountry,issueCity:issueCity,passport:passport,expireDate:expireDate,issueDate:issueDate,sex:sex,address:address,birthPlace:birthPlace,nationality:nationality,birth:birth,task:'changePassport'}
                                               }).success(function( msg ) {
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
                                        
                                        }
       function getPreference() {
        var uid=getCookie("uid");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: "api/account.php",
               dataType: "json",
               data: { uid:uid, token: token,task:'getPreference' }
               }).success(function( msg ) {
				 $.each(msg, function(key, val) {
    $('<tr><td>ID: '+key+'</td><td id="'+key+'">'+val+'</td><tr>').appendTo('#show');
});
				 
                          var hotels=msg;
                          var hotel1=$("#economyHotel");
						  var hotel2=$("#midrangeHotel");
						  var hotel3=$("#upscaleHotel");
						  var list1=$("#list1");
						  var list2=$("#list2");
						  var list3=$("#list3");
						  var list4=$("#list4");
						  var list5=$("#list5");
						  var list6=$("#list6");
						   var list7=$("#list7");
						  var list8=$("#list8");
						  var list9=$("#list9");
						  var list10=$("#list10");
						  var list11=$("#list11");
						
                           hotel1.html('');
						   hotel2.html('');
						   hotel3.html('');
						   list1.html('');
						   list2.html('');
						   list3.html('');
						   list4.html('');
						   list5.html('');
						   list6.html('');
						    list7.html('');
							 list8.html('');
							  list9.html('');
							   list10.html('');
							    list11.html('');
                            if(hotels)
                          {
                          for(var i=0;i<hotels.length;i++)
                          { 
						  
							  for(var j=1;j<24;j++){
							  switch(j){
								  case 1 :
								 
								  var check=hotels[i][j];
								  if(check){
								 
							    $("[name='checkbox1[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
                         						
							break;
							      case 2:
								  	  var check=hotels[i][j];
								   if(check){
								 
							    $("[name='checkbox2[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								  
								     case 3:
									  var check=hotels[i][j];
								  if(check){
								 
							    $("[name='checkbox3[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  
								  break;
								    case 4:
								   	  var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox4[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								  case 5:
								  var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox5[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								   case 6:
								    var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox6[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								   case 7:
								   var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox7[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								    case 8:
								     var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox8[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								     case 9:
								   var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox9[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								     case 10:
								    var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox10[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								     case 11:
								  var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox11[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								     case 12:
								   var check=hotels[i][j];
									   if(check){
								 
							    $("[name='checkbox12[]']").attr("checked",true).checkboxradio("refresh");
						
								  }
								  break;
								    case 13:
									var check=hotels[i][j];									
									$("#select1 option[value='"+ check + "']").attr("selected", true);
									$("#select1").selectmenu('refresh', true);									
								   var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list1);	
								  break;
								   case 14:
								   var check=hotels[i][j];									
									$("#select2 option[value='"+ check + "']").attr("selected", true);
									$("#select2").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list2);	
								  break;
								   case 15:
								   var check=hotels[i][j];									
									$("#select3 option[value='"+ check + "']").attr("selected", true);
									$("#select3").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list3);	
								  break;
								   case 16:
								   var check=hotels[i][j];									
									$("#select4 option[value='"+ check + "']").attr("selected", true);
									$("#select4").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list4);	
								  break;
								   case 17:
								   var check=hotels[i][j];									
									$("#select5 option[value='"+ check + "']").attr("selected", true);
									$("#select5").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list5);	
								  break;
								   case 18:
								   var check=hotels[i][j];									
									$("#select6 option[value='"+ check + "']").attr("selected", true);
									$("#select6").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list6);	
								  break;
								   case 19:
								   var check=hotels[i][j];									
									$("#select7 option[value='"+ check + "']").attr("selected", true);
									$("#select7").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list7);	
								  break;
								   case 20:
								   var check=hotels[i][j];									
									$("#select8 option[value='"+ check + "']").attr("selected", true);
									$("#select8").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list8);	
								  break;
								   case 21:
								   var check=hotels[i][j];									
									$("#select9 option[value='"+ check + "']").attr("selected", true);
									$("#select9").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list9);	
								  break;
								   case 22:
								   var check=hotels[i][j];									
									$("#select10 option[value='"+ check + "']").attr("selected", true);
									$("#select10").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list10);	
								  break;
								     case 23:
									 var check=hotels[i][j];									
									$("#select11 option[value='"+ check + "']").attr("selected", true);
									$("#select11").selectmenu('refresh', true);		
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list11);	
								  break;
							
							  }
							  }
                          }
                        }
                          hotel.listview( "refresh" );
                          }).fail(function(msg){console.log(msg);});
    }



                                        function getProfile()
                                        {
                                        
                                        var uid=getCookie("uid");
										var token=getCookie("token");
                                        var email=getCookie("email");
										var hname=getCookie("hname");
									
                                        $.ajax({
                                               type: "GET",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email}
                                               }).success(function( msg ) {
												
												   
												          $("#welcome").append(hname);
												          $("#username").append(msg.fname);
                                                          $("#fname").val(msg.fname);
                                                          $("#lname").val(msg.lname);
                                                          $("#title").val(msg.title);
														  $("#address").val(msg.uaddress);
												$("#birthPlace").val(msg.birthPlace);
														  $("#birth").val(msg.birth);
														  $("#birth2").val(msg.birth);
														 $("#sex").val(msg.sex);
														  $("#sex2").val(msg.sex);
														
                                                          $("#passportNo").val(msg.passport);
														   $("#expireDate").val(msg.expireDate);
                                                          $("#issueDate").val(msg.issueDate);
                                                          $("#issueCountry").val(msg.issueCountry);
														  $("#issueCity").val(msg.issueCity);
														  $("#phone").val(msg.phone);
														  var userName2=msg.fname+msg.lname;
														  $("#userName2").append(userName2);
														  
							   
                               $("#nationality").val(msg.nationality);
                                                         
                                                          }).fail(function(msg){alert("Unauthorized");//window.location="index.php";
                                                        });
                                        }$(document).ready(function() {
                                          $("#expireDate").datepicker();
                                          $("#issueDate").datepicker();
										  $("#birth").datepicker();
										   $("#birth2").datepicker();
										   getPreference();
if(checkCookie("uid")==0){
    window.location="index.php";
}else{
  var uid=getCookie("uid");
  getProfile();
  timeCount();
}
});
</script>
</head>
<body>
<div data-role="page">

  <div data-role="header" data-theme="b">
<h1 >Enterprise Guest Engagement System - </h1>
		<h1>Customer Instance Guest Interface Module - </h1>
		<h1 id="welcome"></h1>
    <a href="mine.php" data-icon="home" data-iconpos="notext" data-rel="back">Home</a>
  </div><!-- /header -->

  <div data-role="content">
   <div><h3 id="userName2">My Account-User Profile for </h3></div>

  <div data-role="collapsible-set">
    <div id="changeprofile" data-role="collapsible">
    <h3><img src="css/images/login.png"/>Basic Information</h3>
    <p>     
          <label>First Name:</label><input type="text" id="fname" name="fname"/>
          <label>Last Name:</label><input type="text" id="lname" name="lname"/>
          <label>Salutation:</label><input type="text" id="title" name="title"/>
          <label>Mobile Number:</label><input type="text" id="phone" name="phone"/>
          <label>Email:</label><input type="text" id="email" name="email"/>
          <label>Birthday:</label><input type="text" id="birth" name="birth"/>
          <label>Sex:</label><input type="text" id="sex" name="sex"/>
                <button data-theme="b" onClick="changeProfile()" onKeyPress="changeProfile()">Save Changes</button>
    </p>
  </div>
  </div>
    <div data-role="collapsible-set">
        <div id="changeprofile" data-role="collapsible">
        <h3><img src="css/images/login.png"/>Passport Information</h3>
        <p>
                Passport Number:
                <input type="text" id="passportNo" name="passportNo" placeholder="Passport No"/>
                <table>
                  <tr>
                    <td>
                       Date of Issue:
                      <input type="text" id="issueDate" name="issueDate" placeholder="Passport Issue Date"/>
                    </td>
                    <td>
                       Date of Expiry:
                      <input type="text" id="expireDate" name="expireDate" placeholder="Passport Expire Date"/>
                    </td>
                     <td>
                       Country of Issue:	
                      <input type="text" id="issueCountry" name="issueCountry" placeholder="Issue Country"/>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      City of Issue:
                      <input type="text" id="issueCity" name="issueCity" placeholder="Issue City"/>
                    </td>
                    <td>
                     Place of Birth:
                     <input type="text" id="birthPlace" name="birthplace" palceholder="Place of Birth"/>
                     </td>
                     <td>
                     Date of Birth:
                     <input type="text" id="birth2" name="birth2" placeholder="Date of Birth"/>
                     </td>
                  </tr>
                  
                  <tr>
                  <td>
                  Sex:
                  <input type="text" id="sex2"  name="sex2" placeholder="Sex"/>
                  </td>
                  <td>
                  Nationality:
                  <input type="text" id="nationality" name="nationality" placeholder="Nationality"/>
                  </td>
                  <td>
                  Address:
                  <input type="text" id="address" name="address" placeholder="Address"/>
                  </td>
                  </tr>
                  
                </table>
                


                <br><br><br>
                <br><br><br>
                <br><br>
                <button data-theme="b" onClick="changePassport()" onKeyPress="changePassport()">Save Changes</button>
        </p>
    </div>
    </div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Digital Passport</h3>
<p>
<iframe src="uploadPassport.php" seamless></iframe>
<img width="200px" id="myPassport">
</p>
</div>
</div>
<div data-role="collapsible-set">
<div data-role="collapsible">
<h3><img src="css/images/login.png"/>Your ID Photo</h3>
<p>
<iframe src="uploadPhoto.php" seamless></iframe>
<img width="50px" id="myPhoto">
</p>
</div>
</div>
  <div data-role="collapsible-set">
    <div id="changepass" data-role="collapsible">
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
  </div>
<div data-role="collapsible-set">
      <div data-role="collapsible">
        <h3><img src="css/images/login.png"/> Your Preference </h3>
        <div data-role="collapsible-set">
          <div data-role="collapsible">
            <h3> Hotel Type </h3>
            <div id="checkboxes1" data-role="fieldcontain">
              <fieldset data-role="controlgroup" data-type="vertical">
                <legend> Economy Hotel </legend>
                 <input id="checkbox1" name='checkbox1[]' type="checkbox" value="Motel">
                <input name='checkbox1[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox1"> Motel </label>
                <input id="checkbox2" name='checkbox2[]' type="checkbox" value="Bed &amp; Breakfast inn">
                <input name='checkbox2[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox2"> Bed &amp; Breakfast inn </label>
                <input id="checkbox3" name='checkbox3[]' type="checkbox" value="Boutique Hotel">
                 <input name='checkbox3[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox3"> Boutique Hotel </label>
                <input id="checkbox4" name='checkbox4[]'
                                type="checkbox" value="Standardized hotel affiliated/operated by recongnized chain">
                                 <input name='checkbox4[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox4"> Standardized hotel affiliated / operated by recognized chain </label>
              </fieldset>
            </div>
            <div id="checkboxes2" data-role="fieldcontain">
              <fieldset data-role="controlgroup" data-type="vertical">
                <legend> Midrange Hotel </legend>
                <input id="checkbox5" name='checkbox5[]' type="checkbox" value="Bed &amp; Breakfast inn">
                <input name='checkbox5[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox5"> Bed &amp; Breakfast inn </label>
                <input id="checkbox6" name='checkbox6[]' type="checkbox" value="Independent Boutique Hotel">
                <input name='checkbox6[]' type="checkbox" hidden="hidden" value='' checked >


                <label for="checkbox6"> Independent Boutique Hotel </label>
                <input id="checkbox7" name='checkbox7[]'
                                type="checkbox" value="Standardized hotel affiliated/operated by recognized chain">
                                <input name='checkbox7[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox7"> Standardized hotel affiliated / operated by recognized chain </label>
                <input id="checkbox8" name='checkbox8[]'
                                type="checkbox" value="Boutique hotel operated by recognized chain">
                                <input name='checkbox8[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox8"> Boutique hotel operated by recognized chain </label>
              </fieldset>
            </div>
            <div id="checkboxes3" data-role="fieldcontain">
              <fieldset data-role="controlgroup" data-type="vertical">
                <legend> Upscale Hotel </legend>
                <input id="checkbox9" name='checkbox9[]' type="checkbox" value="Independent Boutique Hotel">
                <input name='checkbox9[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox9"> Independent Boutique Hotel </label>
                <input id="checkbox10" name='checkbox10[]'
                                type="checkbox" value="Standardized hotel affiliated/operated by recognized chain">
                                <input name='checkbox10[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox10"> Standardized hotel affiliated / operated by recognized chain </label>
                <input id="checkbox11" name='checkbox11[]'
                                type="checkbox" value="Boutique hotel operated by recognized chain">
                                <input name='checkbox11[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox11"> Boutique hotel operated by recognized chain </label>
                <input id="checkbox12" name='checkbox12[]' type="checkbox" value="Convention Stype Hotel">
                <input name='checkbox12[]' type="checkbox" hidden="hidden" value='' checked >
                <label for="checkbox12"> Convention Stype Hotel </label>
              </fieldset>
            </div>
          </div>
        </div>
        <div data-role="collapsible-set" class="ss">
          <div data-role="collapsible">
            <h3> Technology </h3>
            <div data-role="fieldcontain">
              <label for="selectmenu1"> Internet Access in Room </label>
              <select id="select1" name="Internet Access in Room">
                <option value="Not Available" > Not Available </option>
                <option value="Available for Hourly Usage" > Available for Hourly Usage </option>
                <option value="Available for 24 hour Usage"> Available for 24 hour Usage </option>
                <option value="Available for Free"> Available for Free </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu3" style="margin-right:53px;"> Business Center </label>
              <select id="select2" name=" Business Center">
                <option value="Not Available"> Not Available </option>
                <option value="A centrally Located Business Center"> A centrally Located Business Center </option>
                <option value="Multiple business kiosks throughout  the facilities"> Multiple business kiosks throughout the facilities </option>
                <option value="Mini-business center(printer,fax,etc)available in room"> Mini-business center(printer,fax,etc)available in room </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu4" style="margin-right:25px;"> Internet Reservation </label>
              <select id="select3" name=" Internet Reservation">
                <option value="No"> No </option>
                <option value="Yes"> Yes </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu5" style="margin-right:45px;"> Internet Check-in </label>
              <select id="select4" name=" Internet Check-in">
                <option value="No"> No </option>	
                <option value="Yes"> Yes </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu6" style="margin-right:45px;"> Mobile Check-In </label>
              <select id="select5" name="  Mobile Check-In">
                <option value="No"> No </option>
                <option value="Yes"> Yes </option>
              </select>
            </div>
          </div>
        </div>
        <div data-role="collapsible-set">
          <div data-role="collapsible">
            <h3> Customization </h3>
            <div data-role="fieldcontain">
              <label for="selectmenu7" style="margin-right:75px;"> Pet Policy </label>
              <select id="select6" name="Pet Policy">
                <option value="No Pets"> No Pets </option>
                <option value="Small Pets"> Small Pets </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu8" style="margin-right:28px;"> Flexible Check-In </label>
              <select id="select7" name="Flexible Check-In">
                <option value="No"> No </option>
                <option value="Yes"> Yes </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu8"> Room Customization </label>
              <select id="select8" name=" Room Customization">
                <option value="No"> No </option>
                <option value="Yes"> Yes </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu9" style="margin-right:78px;"> Childcare </label>
              <select id="select9" name="Childcare">
                <option value="Not Available"> Not Available </option>
                <option value="In room nanny facility at extra charge"> In room nanny facility at extra charge </option>
                <option value="In room nanny facility  + kids club(6-12yrs) at extra charge"> In room nanny facility + kids club(6-12yrs) at extra charge </option>

                <option value="In room nanny facility  + kids club(6-12yrs) +day care(6 mo older) at extra charge"> In room nanny facility + kids club(6-12yrs) +day care(6 mo older) at extra
                charge </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu10" style="margin-right:88px;"> Kitchen </label>
              <select id="select10" name="  Kitchen">
                <option value="Available"> Available </option>
                <option value="Coffee-maker available at no extra cost"> Coffee-maker available at no extra cost </option>
                <option value="Coffee-maker available at no extra cost+small microwave+fridge"> Coffee-maker available at no extra cost+small microwave+fridge </option>
              </select>
            </div>
            <div data-role="fieldcontain">
              <label for="selectmenu11" style="margin-right:87px;"> Laundry </label>
              <select id="select11" name=" Laundry">
                <option value="In Room Washer at no extra cost"> In Room Washer at no extra cost </option>
                <option value="Iron with Iron Table"> Iron with Iron Table </option>
              </select>
            </div>
          </div>
           <button data-theme="b" onClick="changePreference()" onKeyPress="changePreference()">Save Changes</button>
    
                    
        
           
           
        </div>
       
      </div>
    </div>
    
    
</div>
  <div data-role="footer" data-theme="b"><h4>Enterprise Guest Engagement System.
Copyright &copy;2012-2013 Asplan Services Private Limited (19834692/W), Singapore. All Rights Reserved</h4></div> 
</div><!-- /page -->

</body>
</html>
