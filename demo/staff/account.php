<html>
<head>
<title>Hotel Staff-Customer Account</title>
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
                            var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel1);							
							break;
							      case 2:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel1);	
								  break;
								  
								     case 3:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel1);	
								  break;
								    case 4:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel1);	
								  break;
								  case 5:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel2);	
								  break;
								   case 6:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel2);	
								  break;
								   case 7:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel2);	
								  break;
								    case 8:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel2);	
								  break;
								     case 9:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel3);	
								  break;
								     case 10:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel3);	
								  break;
								     case 11:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel3);	
								  break;
								     case 12:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(hotel3);	
								  break;
								    case 13:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list1);	
								  break;
								   case 14:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list2);	
								  break;
								   case 15:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list3);	
								  break;
								   case 16:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list4);	
								  break;
								   case 17:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list5);	
								  break;
								   case 18:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list6);	
								  break;
								   case 19:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list7);	
								  break;
								   case 20:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list8);	
								  break;
								   case 21:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list9);	
								  break;
								   case 22:
								    var newli=$('<li>'+hotels[i][j]+'</li>').appendTo(list10);	
								  break;
								     case 23:
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
									
                                        $.ajax({
                                               type: "GET",
                                               url: "api/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email}
                                               }).success(function( msg ) {
											
												   
												
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
if(checkCookie("uid")==0){
    window.location="index.php";
}else{
  var uid=getCookie("uid");
  getProfile();
}
});
</script>
</head>
<body>
<div data-role="page">

  <div data-role="header" data-theme="b">
    <h1 id="userName2">My Account - User Profile for </h1>
    <a href="mine.php" data-icon="home" data-iconpos="notext" data-rel="back">Home</a>
  </div><!-- /header -->

  <div data-role="content">
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
            <h3 onClick="getNewHotels()"><img src="css/images/login.png"/>See Customer Preference</h3>
            <p>

            <label>Economy Hotel</label> <ul id="economyHotel"></ul>
          
            <label>Midrange Hotel</label><ul id="midrangeHotel"></ul>
            
             <label>UpscaleHotel</label><ul id="upscaleHotel"></ul>
             <label> Internet Access in Room</label><ul id="list1"></ul>
             <label> Business Center</label><ul id="list2"></ul>
              <label> Internet Reservation </label><ul id="list3"></ul>
               <label>Internet Check-in </label><ul id="list4"></ul>
                <label>Mobile Check-In </label><ul id="list5"></ul>
                 <label> Pet Policy </label><ul id="list6"></ul>
                  <label> Flexible Check-In  </label><ul id="list7"></ul>
                   <label>  Room Customization </label><ul id="list8"></ul>
                    <label>  Childcare  </label><ul id="list9"></ul>
                     <label> Kitchen </label><ul id="list10"></ul>
                      <label> Laundry </label><ul id="list11"></ul>
                      
             
  
            </p>
             <button data-theme="b" onClick="getPreference()" onKeyPress="getPreference()">Get Preference</button>
		</div> 
        </div>
    
</div>
  <div data-role="footer" data-theme="b"><h4>Enterprise Guest Engagement System.
Copyright &copy;2012-2013 Asplan Services Private Limited (19834692/W), Singapore. All Rights Reserved</h4></div> 
</div><!-- /page -->

</body>
</html>
