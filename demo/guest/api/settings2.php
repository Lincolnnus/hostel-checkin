<?php
function getPreferences(){
	$query = sprintf("SELECT * FROM `settings` WHERE sid='%s'",
	mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		$row=mysql_fetch_array($result);
		define("GMAIL_HOST",$row["mailHost"]);
		define("GMAIL_UNAME",$row["mailUsername"]);
		define("GMAIL_PASSWORD",$row["mailPassword"]);
		define("GMAIL_PORT",$row["mailPort"]); 
		define("COMPANY_NAME",$row["companyName"]);
		return $row;
	}
}
function getBrowsers(){
	$query = sprintf("SELECT * FROM `browser`");
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		while ($row=mysql_fetch_array($result))
		{
			$browser[]=$row;
		}
		return $browser;
	}
}
function updateBrowsers($bid,$supported){
	$query = sprintf("UPDATE `browser` SET supported='%s' WHERE bid='%s'",
	mysql_real_escape_string($supported),
	mysql_real_escape_string($bid));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
		return true;
	}
}
function updatePreferences($settings){
	$inactivityTimer=$settings["inactivityTimer"];
	$mailHost=$settings["mailHost"];
	$mailUsername=$settings["mailUsername"];
	$mailPassword=$settings["mailPassword"];
	$mailPort=$settings["mailPort"];
	$maxInstance=$settings["maxInstance"];
	$businessDate=$settings["businessDate"];
	$companyName=$settings["companyName"];
	$query = sprintf("UPDATE `settings` SET inactivityTimer='%s',mailHost='%s',mailUsername='%s',mailPassword='%s',mailPort='%s',maxInstance='%s',businessDate='%s',companyName='%s' WHERE sid='%s'",
		mysql_real_escape_string($inactivityTimer),
		mysql_real_escape_string($mailHost),
		mysql_real_escape_string($mailUsername),
		mysql_real_escape_string($mailPassword),
		mysql_real_escape_string($mailPort),
		mysql_real_escape_string($maxInstance),
		mysql_real_escape_string($businessDate),
		mysql_real_escape_string($companyName),
		mysql_real_escape_string(1));
	$result = mysql_query($query);
	if (!$result) {
	    return false;
	}
	else { 
     return true;
  	 }
}
