<html>
<head>
</head>
<body>
<form action="api/upload.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<input type="hidden" name="uid" value="1"/>
<br />
<input type="submit" name="submit" value="Upload" />
</form>

</body>
</html>
