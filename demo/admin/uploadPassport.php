<html>
<head>
<script src="js/jquery.min.js"></script>
<script src="js/cookie.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
$(document).ready(function() {
                  var uid=getCookie('uid');
                  var token=getCookie('token');
                  var email=getCookie('email');
                  $('#email').val(email);
                  $('#uid').val(uid);
                  $('#token').val(token);});
</script>
</head>
<body>
<form id="uploadForm" enctype="multipart/form-data" method="post" action="api/uploadPassport.php">
<input id="uploadjing" type="file" accept="image/*" name="file">
<input type="hidden" id="uid" name="uid">
<input type="hidden" id="token" name="token">
<input type="hidden" id="email" name="email">
<input type="submit" name="submit" value="Upload" data-theme="b">
</form>
</body>
</html>
