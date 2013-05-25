<!DOCTYPE html>
<html>
	<head>
	<title>My Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css" />
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.mobile-1.1.1.js"></script>
	<script src="js/jquery.validate.js"></script>
	<style>
		label.error {
				color: red;
				font-size: 16px;
				font-weight: normal;
				line-height: 1.4;
				margin-top: 0.5em;
				width: 100%;
				float: none;
		}

		@media screen and (orientation: portrait){
				label.error { margin-left: 0; display: block; }
		}

		@media screen and (orientation: landscape){
				label.error { display: inline-block; margin-left: 22%; }
		}

		em { color: red; font-weight: bold; padding-right: .25em; }
	</style>
</head>
<body>

	<div id="page1" data-role="page">

		<div data-role="header">
			<h1>Welcome</h1>
		</div>

		<div data-role="content">
			<form method="GET">
				<div data-role="fieldcontain">
					<label for="email">Email:</label>
					<input type="email" name="email" id="email" />
				</div>
				<div data-role="fieldcontain">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" />
				</div>
				<input data-role="submit" type="submit" value="Login" />
			</form>
		</div>

	</div>

	<script>
		$('#page1').bind('pageinit', function(event) {
			$('form').validate({
				rules: {
					email: {
						required: true
					},
					password: {
						required: true
					}
				}
			});
		});
	</script>
</body>
</html>
