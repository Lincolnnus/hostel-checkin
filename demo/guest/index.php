<html>
<head>
<title>Guest-Index</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script src="js/jquery.blockUI.js"></script>

<link rel="stylesheet" href="css/datepicker.css" /> 
<script src="js/jQuery.ui.datepicker.js"></script>
<style>
.ui-collapsible.ui-collapsible-collapsed .ui-collapsible-heading .ui-icon-plus, .ui-icon-arrow-r {
	background-position: -108px 0;
}
.ui-icon-arrow-l {
	background-position: -144px 0;
}
.ui-icon-arrow-u {
	background-position: -180px 0;
}
.ui-collapsible .ui-collapsible-heading .ui-icon-minus, .ui-icon-arrow-d {
	background-position: -216px 0;
}
#errorWrapper {
	border: 1px solid #456f9a /*{b-bar-border}*/;
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
	border-style:none
}
#errorClose {
	float:right;
}
</style>
<script>

function timer(action)
{
	switch(action){
		
	   case 'start':
	   
	 
	   counter=setTimeout(function(){  checkLogout('start');$.blockUI({ message: $('#question6'), css: { width: '500px',border:"none" } }); 
	   $('#yes6').click(function() { 
	   
             $.unblockUI(); 
			 checkLogout('stop');
			 timer('start');
			
			
        }); 
		
		  $('#no6').click(function() { 
	   
           
			 $.unblockUI(); 
			  logout();
			
        }); 
		//checkLogout('start');
}, coutTime); 

	   
	   break;
	   
	   
	   case 'stop':
	   
	   
	   break;
		
		
		
		}

// document.getElementById("timer").innerHTML=count + " secs"; // watch for spelling
}
function checkLogout(action){
	
	switch(action)
{
	case 'start':
	
    logoutTimer= setTimeout(logout,120000);	
	break;
	case 'stop':
	//clearTimeout(logoutTimer);
	clearTimeout(logoutTimer);	
	break
	}   
		
	}
function gotoAccount(){
    window.location="account.php";
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
				count=60000*parseInt(settings.inactivityTimer); 
			
				
				  timer('start');
				 
				
				
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
					  var fname=$("#fname").val();
                                        var lname=$("#lname").val();
                                        var title=$("#title").val();
										//var birth=$("#birth").val();
										var phone=$("#phone").val();										
										//var sex=$("#sex").val();
										var passport=$("#passportNo").val();
                                        var expireDate=$("#expireDate").val();
                                        var issueDate=$("#issueDate").val();
                                        var issueCountry=$("#issueCountry").val();
                                        var issueCity=$("#issueCity").val();
                                        var email=getCookie("email");
                                        var uid=getCookie("uid");
                                        var token=getCookie("token");
										var sex2=$("#sex2").val();
										var address=$("#address").val();
										var birthPlace=$("#birthPlace").val();
										var nationality=$("#nationality").val();
										var birth2=$("#birth2").val();
				//showError("Processing...");
                 var email=$("#checkinemail2").val();
                 var confirmation=$("#checkincode2").val();
				 
			
											
				 
				 
				 if(fname==""||lname==""||title==""||phone==""||passport==""||expireDate==""||issueDate==""||issueCountry==""||issueCity==""||sex2==""||address==""||birthPlace==""||nationality==""||birth2==""){
					 
					  $.blockUI({ message: $('#question4'), css: { width: '500px',border:"none" } }); 
	   $('#yes4').click(function() {  
								  $("#account").trigger("expand");
			 $("#changeprofile").trigger("expand");
			 $("#changepassport").trigger("expand");
			 $.unblockUI(); 
			
     
        }); 
					 }else{
                 if(validateEmail(email))
                 {
                 $.ajax({
                        type: "GET",
                        url: "api/confirm.php",
                        dataType: "json",
                        data: { email: email, confirmation: confirmation}
                        }).success(function( msg ) {
							       
                                   if(msg.status=='sent'){
									  
									  //setCookie('confirmation',msg.confirmation,1);
									   var email=$("#checkinemail2").val("");
                                       var confirmation=$("#checkincode2").val("");
                                   showError("Please Check Your Email To Verify your email address and then Login");
                                   }                                 
                                   else{
									    var email=$("#checkinemail2").val("");
                                       var confirmation=$("#checkincode2").val("");
									  
                                         showError("Submit successfully! Go to My Hotel Status -> Pending check-in Confirmation to see your status");                                      
                                         //setCookie('confirmation',msg.confirmation,1);	
										 setCookie('confirmation','','-1');
										 setCookie('freshUser','','-1');
                                         $('#confirmPage').trigger('collapse');
                                         $('#loginPage').trigger('expand');		
										 $('#myPage').trigger('expand');
										 $('#pending').trigger('expand');
										  $.blockUI({ message: $('#question7'), css: { width: '500px',border:"none" } }); 
	   $('#yes7').click(function() { 
            // update the block message 
            //$.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
			 $.unblockUI(); 
			 
			 
 
           
        }); 	
                                      }
                                   }).fail(function(msg){
									     var email=$("#checkinemail2").val("");
                                       var confirmation=$("#checkincode2").val("");
									   
								        showError("Invalid Checkin Email and Checkin Code");});
                 }
                 else
                 {
                    showError("Invalid Email Address");}
					 }
                 
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
	   getPreference();
	   getProfile();
	  timeCount();
	  }
	  else if (checkCookie('uid')&&checkCookie('freshUser')){
		  var email=getCookie("email");
		  var confirmation=getCookie("confirmation");
		 // alert(email);
      $('#loginPage').hide();
	  $('#regPage').hide();
     // $('#signupPage').hide();
      $('#checkinemail').val(getCookie('email'));
	   $('#checkinemail2').val(email);
	   $('#checkincode2').val(confirmation);
	  $('#confirmPage').trigger('expand');
	 // $('#confirmPage').trigger('expand');	
	   //$('#loginPage').trigger('expand');	
	    getPreference();
		getProfile();
		
							  var fname=$("#fname").val();
                                        var lname=$("#lname").val();
                                        var title=$("#title").val();
										//var birth=$("#birth").val();
										var phone=$("#phone").val();										
										//var sex=$("#sex").val();
										var passport=$("#passportNo").val();
                                        var expireDate=$("#expireDate").val();
                                        var issueDate=$("#issueDate").val();
                                        var issueCountry=$("#issueCountry").val();
                                        var issueCity=$("#issueCity").val();
                                        var email=getCookie("email");
                                        var uid=getCookie("uid");
                                        var token=getCookie("token");
										var sex2=$("#sex2").val();
										var address=$("#address").val();
										var birthPlace=$("#birthPlace").val();
										var nationality=$("#nationality").val();
										var birth2=$("#birth2").val();
				 
  if(fname==""||lname==""||title==""||phone==""||passport==""||expireDate==""||issueDate==""||issueCountry==""||issueCity==""||sex2==""||address==""||birthPlace==""||nationality==""||birth2==""){

	  $.blockUI({ message: $('#question'), css: { width: '500px',border:"none" } }); 
	   $('#yes').click(function() { 
            // update the block message 
            //$.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
			 $.unblockUI(); 
			 $("#account").trigger("expand");
			$("#changeprofile").trigger("expand");
			 $("#changepassport").trigger("expand");
			  //$("#upPassport").trigger("expand");
			   //$("#upID").trigger("expand");
			 
 
           
        }); 
	  timeCount();
  }else{
	  
	  	  $.blockUI({ message: $('#question5'), css: { width: '500px',border:"none" } }); 
	   $('#yes5').click(function() { 
            // update the block message 
            //$.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
			 $.unblockUI(); 
			 
			 
 
           
        }); 
	  
	   timeCount();
	  
	  
	  }
                                   
     }
	 
	 else{
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
                                                          case "3":
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
	
	          
				 
				    $("#expireDate").datepicker({
		                   prevText: ' ', 
                           nextText: ' ',						
						   showButtonPanel:true,	
						   changeMonth: true,
                           changeYear: true,	
	                       yearRange: "-100:+50",				 
						   flat: true  
						                          
    });
                                          $("#issueDate").datepicker({
		                   prevText: ' ', 
                           nextText: ' ',						
						   showButtonPanel:true,	
						   changeMonth: true,
                           changeYear: true,	
	                       yearRange: "-100:+50",				 
						   flat: true                     
    });
										  $("#birth").datepicker({
		                   prevText: ' ', 
                           nextText: ' ',						
						   showButtonPanel:true,	
						   changeMonth: true,
                           changeYear: true,	
	                       yearRange: "-100:+50",				 
						   flat: true                  
    });
										   $("#birth2").datepicker({
		                   prevText: ' ', 
                           nextText: ' ',						
						   showButtonPanel:true,	
						   changeMonth: true,
                           changeYear: true,	
	                       yearRange: "-100:+50",				 
						   flat: true           
    });

			
            var hotel=getHotel();
                  showHotel(hotel);
                  checkUser();
				 
				  
			
				 
				
});

//new functions imigrated from account
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
										//var birth=$("#birth").val();
										var phone=$("#phone").val();
										
										//var sex=$("#sex").val();
                                        var email=getCookie('email');
                                        var uid=getCookie("uid");var token=getCookie("token");
										if(fname==""||lname==""||title==""||phone==""){
											
											  $.blockUI({ message: $('#question2'), css: { width: '500px',border:"none" } }); 
	   $('#yes2').click(function() { 
            // update the block message 
            //$.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
			 $.unblockUI(); 
     
        }); 
											
											}else{
										
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",

                                               dataType: "json",
                                               data: { uid: uid, token: token,email:email,fname:fname,lname:lname,title:title,phone:phone,task:'changeProfile'}
                                               }).success(function( msg ) {
                                                          alert("Successful");
                                                          }).fail(function(msg){alert("Fail To Update");});
											}
                                        
                                        }
										
											
											function testProfile(){
												
													$("#changeprofile"+" :input").each(function(){
												   
												  if ($(this).val() == "") {
                                           alert("fillin");
                                                 }else{
													 
													 changeProfile();
													 }
												   
												   
												   
												   });
												
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
										
										if(passport==""||expireDate==""||issueDate==""||issueCountry==""||issueCity==""||sex==""||address==""||birthPlace==""||nationality==""||birth==""){
											
											
											  $.blockUI({ message: $('#question3'), css: { width: '500px',border:"none" } }); 
	   $('#yes3').click(function() { 
            // update the block message 
            //$.blockUI({ message: "<h1>Remote call in progress...</h1>" }); 
			 $.unblockUI(); 
     
        }); }
											else{
									
                                        $.ajax({
                                               type: "POST",
                                               url: "api/account.php",
                                               dataType: "json",

                                               data: { uid: uid, token: token,email:email,issueCountry:issueCountry,issueCity:issueCity,passport:passport,expireDate:expireDate,issueDate:issueDate,sex:sex,address:address,birthPlace:birthPlace,nationality:nationality,birth:birth,task:'changePassport'}
                                               }).success(function( msg ) {
                                                          showError("Successful");
														  // checkJump();
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
											}
                                        
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
											   async:false,
                                               data: { uid: uid, token: token,email:email}
                                               }).success(function( msg ) {
												
												   
												          $("#welcome").append(hname);
												          $("#username").append(msg.fname);
                                                          $("#fname").val(msg.fname);
                                                          $("#lname").val(msg.lname);
                                                          $("#title").val(msg.title);
														  //$("#phone").val(msg.phone);
														  $("#address").val(msg.uaddress);
												$("#birthPlace").val(msg.birthPlace);
														  //$("#birth").val(msg.birth);
														  $("#birth2").val(msg.birth);
														 //$("#sex").val(msg.sex);
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
                                        }
										
										

</script>
</head>
<body>
<div data-role="page">
  <div data-role="header" data-theme="b">
    <h1 >Enterprise Guest Engagement System - </h1>
    <h1>Customer Instance Guest Interface Module - </h1>
    <h1 id="welcome"></h1>
    <a data-rel="back" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a> </div>
  <!-- /header -->
  <div data-role="content">
    <div id="logo"> <br>
    </div>
    <div data-role="collapsible-set">
      <!--
    <div id="regPage" data-role="collapsible">
            <h3><img src="css/images/chekin.png"/>Registration</h3>
            <p>
                <label class="ui-hidden-accessible">Email:</label>
			    <input type="text" id="checkinemail" name="checkinemail" placeholder="Email"/>
                <label class="ui-hidden-accessible">Code:</label>
			    <input type="text" id="checkincode" name="checkincode" placeholder="Confirmation Code"/>
                 <button data-theme="b" onClick="registration()" onKeyPress="registration()">Register</button>
            </p>
		</div>
		-->
      <div id="confirmPage" data-role="collapsible">
        <h3 title='Type in Email & Confirmation Code to make check-in'><img src="css/images/chekin.png"/>Request Check-in Confirmation</h3>
        <p>
          <label class="ui-hidden-accessible">Email:</label>
          <input type="text" id="checkinemail2" name="checkinemail2" placeholder="Email"/>
          <label class="ui-hidden-accessible">Code:</label>
          <input type="text" id="checkincode2" name="checkincode2" placeholder="Confirmation Code"/>
          <button data-theme="b" onClick="checkin()" onKeyPress="checkin()">Submit</button>
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
        <h3 title="To see your Hotel Stay Information "onClick="myCheckin()"><img src="css/images/chekin.png"/>My Hotel Status</h3>
        <p>
        <div id="pending"data-role="collapsible">
          <h3 title="The Check-in confirmation waiting for approving"><img src="css/images/chekin.png"/>Pending Check-in Confirmation</h3>
          <p>
          <ul id="myConfirmation" data-role="listview">
          </ul>
          </p>
        </div>
        <div id="current"data-role="collapsible">
          <h3 title="Browse your Consume Information in hotel & Checkout"><img src="css/images/chekin.png"/>Stay Information & Checkout</h3>
          <p>
          <ul id="currentCheckin" data-role="listview">
          </ul>
          </p>
        </div>
        <div id="history" data-role="collapsible">
          <h3 title="To see your historical informaiton in hotel"><img src="css/images/chekin.png"/>History</h3>
          <p>
          <ul id="myHistory" data-role="listview">
          </ul>
          </p>
        </div>
        </p>
      </div>
      <div id="account" data-role="collapsible">
        <h3 title="Go to your account to modify your personal information"> <img src="css/images/signup.png"/>My Account</h3>
        <div data-role="collapsible-set">
          <div id="changeprofile" data-role="collapsible" data-theme="a">
            <h3 ><img src="css/images/login.png"/>Basic Information</h3>
            <p>
              <label>First Name:</label>
              <input type="text" id="fname" name="fname"/>
              <label>Last Name:</label>
              <input type="text" id="lname" name="lname"/>
              <label>Salutation:</label>
              <input type="text" id="title" name="title"/>
              <label>Mobile Number:</label>
              <input type="text" id="phone" name="phone"/>
              <!--<label>Email:</label>
              <input type="text" id="email" name="email"/>-->
             <!-- <label>Birthday:</label>
              <input type="text" id="birth" name="birth"/>-->
             <!-- <label>Sex:</label>
              <input type="text" id="sex" name="sex"/>-->
              <button data-theme="b" onClick="changeProfile()" onKeyPress="changeProfile()">Save Changes</button>
            </p>
          </div>
        </div>
        <div data-role="collapsible-set">
          <div id="changepassport" data-role="collapsible">
            <h3><img src="css/images/login.png"/>Passport Information</h3>
            <p> Passport Number:
              <input type="text" id="passportNo" name="passportNo" placeholder="Passport No"/>
            <table>
              <tr>
                <td> Date of Issue:
                  <input type="text" id="issueDate" name="issueDate" placeholder="Passport Issue Date"/></td>
                <td> Date of Expiry:
                  <input type="text" id="expireDate" name="expireDate" placeholder="Passport Expire Date"/></td>
                <td> Country of Issue:
                  <input type="text" id="issueCountry" name="issueCountry" placeholder="Issue Country"/></td>
              </tr>
              <tr>
                <td> City of Issue:
                  <input type="text" id="issueCity" name="issueCity" placeholder="Issue City"/></td>
                <td> Place of Birth:
                  <input type="text" id="birthPlace" name="birthplace" placeholder="Place of Birth"/></td>
                <td> Date of Birth:
                  <input type="text" id="birth2" name="birth2" placeholder="Date of Birth"/></td>
              </tr>
              <tr>
                <td> Sex:
                  <input type="text" id="sex2"  name="sex2" placeholder="Sex"/></td>
                <td> Nationality:
                  <input type="text" id="nationality" name="nationality" placeholder="Nationality"/></td>
                <td> Address:
                  <input type="text" id="address" name="address" placeholder="Address"/></td>
              </tr>
            </table>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button data-theme="b" onClick="changePassport()" onKeyPress="changePassport()">Save Changes</button>
            </p>
          </div>
        </div>
        <div data-role="collapsible-set">
          <div id="upPassport" data-role="collapsible">
            <h3><img src="css/images/login.png"/>Digital Passport</h3>
            <p>
              <iframe src="uploadPassport.php" seamless></iframe>
              <img width="200px" id="myPassport"> </p>
          </div>
        </div>
        <div data-role="collapsible-set">
          <div id="upID" data-role="collapsible">
            <h3><img src="css/images/login.png"/>Your ID Photo</h3>
            <p>
              <iframe src="uploadPhoto.php" seamless></iframe>
              <img width="50px" id="myPhoto"> </p>
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
      <div id="logoutPage" data-role="collapsible">
        <h3 title="Log out your current account"> <img src="css/images/signup.png"/>Log Out</h3>
        <p> <a id="logout" data-rel="dialog" data-theme="a" onClick="logout()" onKeyPress="logout()" data-role="button"> Confirm </a> </p>
      </div>
      <div data-role="collapsible">
        <h3 title="See contact information of hotel"><img src="css/images/about.png"/>Contact Us</h3>
        <p>
        <table>
          <tr>
            <td> Hotel Name: </td>
            <td><input id="hname" name="hname" disabled></td>
          </tr>
          <tr>
            <td> Hotel Address: </td>
            <td><input id="haddress" name="haddress" disabled></td>
          </tr>
          <tr>
            <td> Hotel Zip Code: </td>
            <td><input id="hzip" name="hzip" disabled></td>
          </tr>
          <tr>
            <td> Manager Name: </td>
            <td><input id="hmanager" name="hmanager" disabled></td>
          </tr>
          <tr>
            <td> Phone Number: </td>
            <td><input id="hphone" name="hphone" disabled></td>
          </tr>
          <tr>
            <td> Hotel URL: </td>
            <td><input id="hURL" name="hURL" disabled></td>
          </tr>
          <tr>
            <td> Email: </td>
            <td><input id="hemail" name="hemail" disabled></td>
          </tr>
        </table>
        </p>
      </div>
    </div>
  </div>
  <!-- /content -->
  <div data-role="footer" data-theme="b">
    <h4>Enterprise Guest Engagement System.
      Copyright &copy;2012-2013 Asplan Services Private Limited (19834692/W), Singapore. All Rights Reserved</h4>
  </div>
  <div id="question" style="display:none; cursor: default">
    <h1>Please,fill in your My Acoount information first</h1>
    <p>After fill in your My Account Information,you can go to check-in</p>
    <input type="button" id="yes" value="Go To Fill-in" />
  </div>
  <div id="question2" style="display:none; cursor: default">
    <h1>Please,fill in all information in below textbox</h1>
    <input type="button" id="yes2" value="Go To Fill-in" />
  </div>
  <div id="question3" style="display:none; cursor: default">
    <h1>Please,fill in all information in below textbox</h1>
    <input type="button" id="yes3" value="Go To Fill-in" />
  </div>
  <div id="question4" style="display:none; cursor: default">
    <h1>Please,fill in your My Acoount information first</h1>
    <input type="button" id="yes4" value="Go To Fill-in" />
  </div>
   <div id="question5" style="display:none; cursor: default">
    <h1>Click Submit button to make checkin</h1>
	 <p>We have pre-fill the confirmation code for you</p>
    <input type="button" id="yes5" value="Go To Fill-in" />
  </div>
   <div id="question6" style="display:none; cursor: default">
    <h1>Do you want to continute? </h1>
	
    <input type="button" id="yes6" value="Continute" />
    <input type="button" id="no6" value="Loug Out" />
  </div>
   <div id="question7" style="display:none; cursor: default">
    <h1>Submit successfully! Go to My Hotel Status -> Pending check-in Confirmation to see your status</h1>	
    <input type="button" id="yes6" value="Continute" />
    <input type="button" id="no6" value="Loug Out" />
  </div>
  <div id="errorWrapper" style="display:none;">
    <center id="errorMsg">
    </center>
    <img src="css/images/close_icon.png" width="30px" title="close" onClick="hideError()" id="errorClose"/> </div>
</div>
<!-- /page -->
</body>
</html>