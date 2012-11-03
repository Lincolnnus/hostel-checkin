<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Administrator</title>
<link rel="stylesheet" href="css/jquery.mobile-1.1.1.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery.mobile-1.1.1.js"></script>
<script src="js/cookie.js"></script>
<style>
.ui-collapsible.ui-collapsible-collapsed .ui-collapsible-heading .ui-icon-plus,
.ui-icon-arrow-r { background-position: -108px 0; }
.ui-icon-arrow-l { background-position: -144px 0; }
.ui-icon-arrow-u { background-position: -180px 0; }
.ui-collapsible .ui-collapsible-heading .ui-icon-minus,
.ui-icon-arrow-d { background-position: -216px 0; }
</style>
<script>
    var IP="api";
    function addEmployee()
    {
        var email=$("#newemail").val();
        var admin=getCookie("email");
        var token=getCookie("token");
        $.ajax({
               type: "POST",
               url: IP+"/addEmployee.php",
               dataType: "json",
               data: { email: email,admin:admin, token: token }
               }).success(function( msg ) {
                          console.log(msg);
                        //  alert("successful");window.location.reload();
                          }).fail(function(msg){alert("UnAuthorized For This Action");});
    }
    $(document).ready(function() {
                      var employee=$("#employee");
                      var newli=$('<li><a>1</a></li>');
                      newli.appendTo(employee);
                      newli.live("click", function(){ alert("Goodbye!"); }); 
                      newli=$('<li><a>2</a></li>');
                      newli.appendTo(employee);
                      newli.live("click", function(){ alert("bye!"); });
                      newli=$('<li><a>3</a></li>');
                      newli.appendTo(employee);
                      newli.live("click", function(){ alert("Gooe!"); }); 
                      employee.listview( "refresh" );
                    });
</script>
</head>
<body>
<div data-role="page">

	<div data-role="header" data-theme="b" data-add-back-btn="true">
		<h1>Welcome</h1>
        <a href="" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
        <a href="setup.html" data-icon="gear" data-iconpos="notext" data-transition="fade">Setup</a>
	</div><!-- /header -->

	<div data-role="content">
        <div><h2>Administrator Control Panel</h2></div>
	<div data-role="collapsible-set">
		<div data-role="collapsible">
            <h3>Authorize New Employee</h3>
            <p>
            <input type="text" name="newemail" id="newemail" placeholder="Add an Employee's Email Address"/>
            <button data-theme="b" onclick="addEmployee();">Add</button>
            </p>
		</div>
        <div data-role="collapsible">
            <h3>Current Authorized Employees</h3>
            <p>
            <ul id="employee" data-role="listview" data-filter="true" data-filter-placeholder="Search people..." data-filter-theme="d"data-theme="d" data-divider-theme="d">
			</ul>
            </p>
		</div>
        <div data-role="collapsible">
        <h3>Import Booking Information,Only work on PC</h3>
        <p>
        <input type="file">
        <button data-theme="b">Import</button>
        </p>
    </div>
    <div data-role="collapsible">
    <h3>As a Normal Employee</h3>
    <p>
    <button data-theme="b" onclick="window.location='manage.php'">Go</button>
    </p>
    </div>

	</div>
	</div><!-- /content -->
	<div data-role="footer" data-theme="b"><h4>Copyright&copy;Asplan2012</h4></div>
</div><!-- /page -->
</body>
</html>
