<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<script>
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
function getcheckinfo()
                          {

                          var hotel=getHotel();
                          var uid=getCookie("uid");
                          var email=getCookie("email");
                          var confirmation=getCookie("confirmation");
                          var token=getCookie("token");
                          $.ajax({
                                 type: "GET",
                                 url: "api/check.php",
                                 dataType: "json",
                                 data: {uid:uid, email: email, confirmation:confirmation,token:token }
                                 }).success(function( msg ) {
                                            if(msg.step=="0"){
                                            displayCanvas(hotel,msg.user,msg.booking);
                                            } else if(msg.step=="1"){
                                            displayCanvas(hotel,msg.user,msg.booking);
                                            }
                                            }).fail(function(msg){alert("Invalid Checkin Email and Checkin Code");});
                          
                          }
function handleStart(evt) {
  evt.preventDefault();
  var c=document.getElementById("checkinCanvas");
  var ctx = c.getContext("2d");
  var touches = evt.changedTouches;
  for (var i=0; i<touches.length; i++) {
    ongoingTouches.push(touches[i]);
    var color = colorForTouch(touches[i]);
    ctx.fillStyle = color;
    ctx.fillRect(touches[i].pageX-2, touches[i].pageY-2, 4, 4);
  }
}
 var ongoingTouches = new Array;
    
    function colorForTouch(touch) {
      var id = touch.identifier;
      id = id.toString(16); // make it a hex digit
      return "#" + id + id + id;
    }
    
    function ongoingTouchIndexById(idToFind) {
      for (var i=0; i<ongoingTouches.length; i++) {
        var id = ongoingTouches[i].identifier;
        
        if (id == idToFind) {
          return i;
        }
      }
      return -1;    // not found
    }
function handleEnd(evt) {
  evt.preventDefault();
  var c=document.getElementById("checkinCanvas");
  var ctx = c.getContext("2d");
  var touches = evt.changedTouches;
  ctx.lineWidth = 4;
  for (var i=0; i<touches.length; i++) {
    var color = colorForTouch(touches[i]);
    var idx = ongoingTouchIndexById(touches[i].identifier);
     
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(ongoingTouches[i].pageX, ongoingTouches[i].pageY);
    ctx.lineTo(touches[i].pageX, touches[i].pageY);
    ongoingTouches.splice(i, 1);  // remove it; we're done
  }
}
function handleCancel(evt) {
  evt.preventDefault();
  var touches = evt.changedTouches;
  for (var i=0; i<touches.length; i++) {
    ongoingTouches.splice(i, 1);  // remove it; we're done
  }
}
function handleMove(evt) {
  evt.preventDefault();
  var c=document.getElementById("checkinCanvas");
  var ctx = c.getContext("2d");
  var touches = evt.changedTouches;
   
  ctx.lineWidth = 4;
         
  for (var i=0; i<touches.length; i++) {
    var color = colorForTouch(touches[i]);
    var idx = ongoingTouchIndexById(touches[i].identifier);
 
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(ongoingTouches[idx].pageX, ongoingTouches[idx].pageY);
    ctx.lineTo(touches[i].pageX, touches[i].pageY);
    ctx.closePath();
    ctx.stroke();
    ongoingTouches.splice(idx, 1, touches[i]);  // swap in the new touch record
  }
}
var idPhoto=new Image();
var passportPhoto=new Image();
function displayCanvas(hotel,user,check)
{
    $('#checkinfo').html('<canvas style="border:1px solid #000000;" id="checkinCanvas" width="800" height="1000"></canvas>');
    var c=document.getElementById("checkinCanvas");
    var ctx=c.getContext("2d");
    /*c.addEventListener("touchstart", handleStart, false);
    c.addEventListener("touchend", handleEnd, false);
    c.addEventListener("touchcancel", handleCancel, false);
    //c.addEventListener("touchleave", handleLeave, false);
    c.addEventListener("touchmove", handleMove, false);*/
    ctx.font="30px Arial";
    ctx.fillText(user.title,50,80);
    ctx.fillText(user.fname,120,80);
    ctx.fillText(user.lname,280,80);
    ctx.font="20px Arial";
    ctx.fillText("Email Address: "+check.email,50,120);
    ctx.fillText("Phone Number: "+user.phone,50,150);
    ctx.font="30px Arial";
    ctx.fillText("Booking Reference ID: "+check.rid,50,250);
    ctx.font="20px Arial";
    ctx.fillText("Chechin Date(yyyy/mm/dd): "+check.arrivalyear1+'/'+check.arrivalmonth1+'/'+check.arrivalday1,50,300);
    ctx.fillText("Nights Stay: "+check.numberofdays1,500,300);
    ctx.fillText("Total Rooms: "+check.totalRoom,50,330);
    ctx.fillText("Total People: "+check.numberofadults1+' Adults '+check.numberofchildren1+' Children',200,330);
    ctx.fillText("Room Type: "+check.room1,500,330);
    ctx.font="30px Arial";
    ctx.fillText("Passport Information",50,400);
    ctx.font="20px Arial";
    ctx.fillText("Passport Number: "+user.passport,50,430);
    ctx.fillText("Expire Date(yyyy/mm/dd): "+user.expireDate,50,460);
    ctx.fillText("Issue Date(yyyy/mm/dd): "+user.issueDate,450,460);
    ctx.fillText("Issue Country: "+user.issueCountry,50,490);
    ctx.fillText("Issue City: "+user.issueCity,450,490);
   // var idPhoto=new Image();
    idPhoto.src=user.idPhoto;
   // ctx.drawImage(idPhoto,600,20,150,150);
   // var passportPhoto=new Image();
    passportPhoto.src=user.passportPhoto;
   // ctx.drawImage(passportPhoto,50,500,500,500);
    ctx.fillText("Signature: ",50,600);
    var width=document.body.offsetWidth*0.8;
    var height=1.4142*width;
    $('#checkinCanvas').width(width);
    $('#checkinCanvas').height(height);
    //Draw Pencil
    var color='blue';
    var started=false;
    var pencil=[];//The Pencil Object
    var newpoly=[];//Every Stroke is treated as a Continous Polyline
    var width=document.body.offsetWidth*0.8;
    var height=1.4142*width;
    $('#checkinCanvas').width(width);
    $('#checkinCanvas').height(height);

}
function addSignature(){
      var c=document.getElementById("checkinCanvas");
    var ctx=c.getContext("2d");
     var color='blue';
    var started=false;
    var pencil=[];//The Pencil Object
    var newpoly=[];//Every Stroke is treated as a Continous Polyline
    $('#checkinCanvas').width("800");
    $('#checkinCanvas').height("1000");

    $('#checkinCanvas').mousedown(function(e) {
                        newpoly=[];//Clear the Stroke

                        started=true;
                        newpoly.push( {"x":e.offsetX,"y":e.offsetY});//The percentage will be saved
                        ctx.globalAlpha = 1;
                        ctx.beginPath();
                        ctx.moveTo(e.offsetX,e.offsetY);
                        ctx.strokeStyle = color;
                        ctx.stroke();
                        });
    $('#checkinCanvas').mousemove(function(e) {
                        if(started)
                        {
                        newpoly.push( {"x":e.offsetX,"y":e.offsetY});
                        ctx.lineTo(e.offsetX,e.offsetY);
                        ctx.stroke();
                        }
                        });
    $('#checkinCanvas').mouseup(function(e) {
                        started=false;
                        pencil.push(newpoly);//Push the Stroke to the Pencil Object
                        newpoly=[];//Clear the Stroke
                        var x,y,w,h;
                        x=pencil[0][0].x;
                        y=pencil[0][0].y;
                        var maxdistance=0;//The Most Remote Point to Determine the Markup Size
                        var points="";
                        for (var i=0;i<pencil.length;i++)
                        {
                        newpoly=pencil[i];
                        for(j=0;j<newpoly.length;j++)
                        {
                        points+=newpoly[j].x+','+newpoly[j].y+' ';
                        }
                        points=points.slice(0, -1)
                        points+=';';
                        }
                        });
    $('#checkinCanvas').touchstart(function(e) {
                        e.preventDefault();
                        newpoly=[];//Clear the Stroke
                        started=true;
                        newpoly.push( {"x":e.originalEvent.layerX,"y":e.originalEvent.layerY});//The percentage will be saved
                        ctx.globalAlpha = 1;
                        ctx.beginPath();
                        ctx.moveTo(e.originalEvent.layerX,e.originalEvent.layerY);
                        ctx.strokeStyle = color;
                        ctx.stroke();
                        console.log()
                        });
    $('#checkinCanvas').touchmove(function(e) {
                        e.preventDefault();
                        if(started)
                        {
                        newpoly.push( {"x":e.originalEvent.layerX,"y":e.originalEvent.layerY});
                        ctx.lineTo(e.originalEvent.layerX,e.originalEvent.layerY);
                        ctx.stroke();
                        }
                        });
    $('#checkinCanvas').touchend(function(e) {
                        e.preventDefault();
                        started=false;
                        pencil.push(newpoly);//Push the Stroke to the Pencil Object
                        newpoly=[];//Clear the Stroke
                        var x,y,w,h;
                        x=pencil[0][0].x;
                        y=pencil[0][0].y;
                        var maxdistance=0;//The Most Remote Point to Determine the Markup Size
                        var points="";
                        for (var i=0;i<pencil.length;i++)
                        {
                        newpoly=pencil[i];
                        for(j=0;j<newpoly.length;j++)
                        {
                        points+=newpoly[j].x+','+newpoly[j].y+' ';
                        }
                        points=points.slice(0, -1)
                        points+=';';
                        }
                        });
}
function gotoAccount(){
    window.location="account.php";
}
function loadPhoto(){
	$('#title').append("loadPhoto");
    var c=document.getElementById("checkinCanvas");
    var ctx=c.getContext("2d");
    ctx.drawImage(idPhoto,600,20,150,150);
}
function loadPassport(){
	$('#title').append("loadPassport");
    var c=document.getElementById("checkinCanvas");
    var ctx=c.getContext("2d");
    ctx.drawImage(passportPhoto,300,500,500,500);
loadPhoto();
}
function saveCanvas(){
    var c=document.getElementById("checkinCanvas");
    document.location = c.toDataURL("image/png");
}
$(document).ready(function() {
if(checkCookie("email")==0)
{
   	window.location="index.php";
}else{getcheckinfo();}
})
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1 id="title">Check-In:</h1>
		<a data-icon="home" data-iconpos="notext" data-transition="slide" data-rel="back">Home</a>
        <a onClick="window.location.reload()" data-icon="refresh" data-iconpos="notext">Refresh</a>
	</div><!-- /header -->

	<div data-role="content">
	<div data-role="collapsible-set">
		<div data-role="collapsible" >
		<h3><img src="css/images/login.png"/>Checkin Information</h3>
		<p>
                        <button onClick="loadPassport()" data-theme="b" >Load ID Photo</button>
            <div id="checkinfo"></div>
             <button onClick="saveCanvas()" data-theme="b" >Save it</button>
            <button onClick="gotoAccount()" data-theme="c" >My Account</button>
               
        </p>
	</div>
	</div>
	<div data-role="footer" data-theme="b"><h4>Enterprise Guest Engagement System.
Copyright &copy;2012-2013 Asplan Services Private Limited (19834692/W), Singapore. All Rights Reserved</h4></div> 
</div><!-- /page -->
</body>
</html>
