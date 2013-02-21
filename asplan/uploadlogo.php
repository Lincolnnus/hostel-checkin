<html>
<head>
<script src="js/jquery.min.js"></script>
<script src="js/cookie.js"></script>
<script>
$(document).ready(function() {
                  if(checkCookie("uid")==0){
                  window.location="index.php";
                  }else{
                  	var uid=getCookie("uid");
                  	$("#uid").val(uid);
                  	var token=getCookie("token");
                  	$("#token").val(token);
                  	var hid=getCookie("hid");
                  	$("#hid").val(hid);
                  }
                  });
</script>
</head>
<body>
  <form  action="api/admin.php" method="POST" enctype="multipart/form-data" data-ajax="false">
              <input type="file" name="file" id="file" /> 
              <input type="hidden" name="token" id="token" /> 
              <input type="hidden" name="uid" id="uid"/>
              <input type="hidden" name="hid" id="hid"/>
              <input type="hidden" name="action" id="action" value="uploadLogo"/>
              <br />
              <input type="submit" name="submit" value="Upload" />
 </form>
</body>
</html>
