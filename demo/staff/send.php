<html>
<head>
<script src="js/jquery.min.js"></script>
<script src="js/cookie.js"></script>
<script>
$(document).ready(function() {
                  if(checkCookie("uid")!=0)
                  {
                  	var uid=getCookie("uid");
                  	$("#uid").val(uid);
                  	var token=getCookie("token");
                  	$("#token").val(token);
                  }
                  });
</script>
</head>
<body>
  <form  action="http://54.251.118.233/pl/demo/staff/api/url.php" method="POST" enctype="multipart/form-data" data-ajax="false">
              <input type="file" name="file" id="file" /> 
              <input type="hidden" name="email" id="token" value="peng" /> 
              <input type="hidden" name="password" id="uid"/>
              <input type="hidden" name="action" id="action" value="uploadXls"/>
              <br />
              <input type="submit" name="submit" value="Upload" />
 </form>
</body>
</html>
