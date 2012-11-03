var IP="api";
function getParameterByName(name)
{
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
                          var regexS = "[\\?&]" + name + "=([^&#]*)";
                          var regex = new RegExp(regexS);
                          var results = regex.exec(window.location.search);
                          if(results == null)
                          return "";
                          else
                          return decodeURIComponent(results[1].replace(/\+/g, " "));
                          }
                          function getcheckinfo()
                          {
                          var email=getCookie("email");
                          var code=getCookie("confirmation");
                          $.ajax({
                                 type: "GET",
                                 url: IP+"/check.php",
                                 dataType: "json",
                                 data: { email: email, confirmation: code }
                                 }).success(function( msg ) {
                                            if(msg.status=="1")
                                            {
                                            var hotelinfo="Hotel Name:"+msg.hotel.hname+"<br>Hotel Address:"+msg.hotel.haddress+"<br>Hotel Contact Information:"+msg.hotel.contact+"<br>";
                                            var checkinfo="Checkin Date:"+msg.checkindate;
                                            $("#hotelinfo").html(hotelinfo);
                                            $("#checkinfo").html(checkinfo);
                                            $("#checkin1").show();
                                            $("#checkin2").hide();
                                            $("#checkin3").hide();
                                            $("#checkin4").hide();
                                            }
                                            else if(msg.status=="2")
                                            {
                                            $("#checkin2").show();
                                            $("#checkin1").hide();
                                            $("#checkin3").hide();
                                            $("#checkin4").hide();
                                            }
                                            else if(msg.status=="3")
                                            {
                                            $("#checkin3").show();
                                            $("#checkin1").hide();
                                            $("#checkin2").hide();
                                            $("#checkin4").hide();
                                            }
                                            else if(msg.status=="4")
                                            {
                                            $("#checkin4").show();
                                            $("#checkin1").hide();
                                            $("#checkin2").hide();
                                            $("#checkin3").hide();
                                            }
                                            }).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");});
                          
                          }
                          function confirm()
                          {
                          var email=getCookie("email");
                          var code=getCookie("confirmation");
                          $.ajax({
                                 type: "POST",
                                 url: IP+"/check.php",
                                 dataType: "json",
                                 data: { email: email, confirmation: code }
                                 }).success(function( msg ) {
                                            console.log(msg);
                                            alert("successful");window.location.reload();
                                            }).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");});
                          
                          }
                          function checkout()
                          {
                          var email=getCookie("email");
                          var code=getCookie("confirmation");
                          $.ajax({
                                 type: "POST",
                                 url: IP+"/checkout.php",
                                 dataType: "json",
                                 data: { email: email, confirmation: code }
                                 }).success(function( msg ) {
                                            console.log(msg);
                                            alert("successful");window.location.reload();
                                            }).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");});
                          
                          }
                          function validateEmail(email) {
                          var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                                        return re.test(email);
                                        }
                                        function checkin()
                                        {
                                        var email=getCookie("email");
                                        var code=$("#checkincode").val();
                                        if(checkCookie("email")!=0)
                                        {
                                        $.ajax({
                                               type: "GET",
                                               url: IP+"/check.php",
                                               dataType: "json",
                                               data: { email: email, confirmation: code }
                                               }).success(function( msg ) {
                                                          console.log(msg);
                                                          setCookie('confirmation',msg.confirmation,1);
                                                          window.location="checkin.php";
                                                          }).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");window.location="index.php";});
                                        }
                                        else
                                        { alert("Invalid Email Address");window.location="index.php";}
                                        
                                        }
                                        function showCheckin(confirmation)
                                        {
                                        var email=getCookie("email");
                                        var code=setCookie('confirmation',confirmation,1);
                                        if(checkCookie("email")!=0)
                                        {
                                            window.location="checkin.php";
                                        }
                                        else
                                        { alert("Invalid Email Address");window.location="index.php";}
                                        }
                                        function getCheckin()
                                        {
                                        var email=getCookie("email");
                                        var token=getCookie("token");
                                        if(checkCookie("email")!=0)
                                        {
                                        $.ajax({
                                               type: "GET",
                                               url: IP+"/mine.php",
                                               dataType: "json",
                                               data: { email: email, token: token }
                                               }).success(function(checkin) {
                                                          $("#checkin1").html("");
                                                          $("#checkin2").html("");
                                                          $("#checkin3").html("");
                                                          $("#checkin4").html("");
                                                          for(var i=0;i<checkin.length;i++)
                                                          {
                                                          switch(checkin[i].status)
                                                          {
                                                          case "1":
                                                          $("#checkin1").append('<li><a onclick="showCheckin('+checkin[i].confirmation+')" >'+checkin[i].checkindate+'</a></li>');
                                                          break;
                                                          case "2":
                                                          $("#checkin2").append('<li><a onclick="showCheckin('+checkin[i].confirmation+')">'+checkin[i].checkindate+'</a></li>');
                                                          break;
                                                          case "3":
                                                          $("#checkin3").append('<li><a onclick="showCheckin('+checkin[i].confirmation+')">'+checkin[i].checkindate+'</a></li>');
                                                          break;
                                                          case "4":
                                                          $("#checkin4").append('<li><a onclick="showCheckin('+checkin[i].confirmation+')">'+checkin[i].checkindate+'</a></li>');
                                                          break;
                                                          }
                                                          }
                                                          $("#checkin1").listview("refresh");
                                                          $("#checkin2").listview("refresh");
                                                          $("#checkin3").listview("refresh");
                                                          $("#checkin4").listview("refresh");
                                                          }).fail(function(msg){console.log("Error Getting Checkin Infor");});
                                        }
                                        else
                                        { alert("Invalid Email Address");window.location="index.php";}
                                        
                                        }
                                        function logout()
                                        {
                                        deleteAllCookies();
                                        window.location="public.php";
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
                                               url: IP+"/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,oldpass:oldpass,password:password,confirmpass:confirmpass,task:'changepass'}
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
                                        var uid=getCookie("uid");var token=getCookie("token");
                                        $.ajax({
                                               type: "POST",
                                               url: IP+"/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token,fname:fname,lname:lname,title:title,task:'changeprofile'}
                                               }).success(function( msg ) {
                                                          alert("Successful"); window.location="account.php";
                                                          }).fail(function(msg){alert("Fail To Update");window.location="account.php";});
                                        
                                        }
                                        function getProfile()
                                        {
                                        
                                        var uid=getCookie("uid");var token=getCookie("token");
                                        $.ajax({
                                               type: "GET",
                                               url: IP+"/account.php",
                                               dataType: "json",
                                               data: { uid: uid, token: token }
                                               }).success(function( msg ) {
                                                          $("#fname").val(msg.fname);
                                                          $("#lname").val(msg.lname);
                                                          $("#title").val(msg.title);
                                                          }).fail(function(msg){alert("Unauthorized");window.location="index.php";});
                                        }
