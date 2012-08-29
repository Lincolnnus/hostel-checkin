<?php
session_start(); 
if (!(isset($_SESSION['email'])&&($_SESSION['role']=='admin')))
header('Location: login.php?uri=upload.php');
?>
<html>
<body>

<form action="api/uploader.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>
