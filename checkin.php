<?php
session_start();
?>
<html>
<head>
</head>
<body>
<div><?php if(isset($_REQUEST["error"])) echo $_REQUEST["error"];?></div>
<div>Please Enter The Booking Reference Code</div>
<form action="api/checkin.php" method="post">
<input type="text" name="rcode"/>
<input type="submit" name="submit">
</form>
</body>
</html>
