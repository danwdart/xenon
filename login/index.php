<?php
/*
	Project:		The Xenon Project 2009.
	File: 			index.php
	Description:	Start point of each new Xenon session. The user must successfully log in to use the features of Xenon.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			06. April 2009
*/

	$inc_path = dirname(__FILE__);
	if ($inc_path[strlen($inc_path)-1] != '/') {
		$inc_path .= '/';
	}
	include($inc_path . 'core/settings.php');
	include($inc_path . 'session/session_auth.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
<!--cascading style sheets-->
<link rel="stylesheet" type="text/css" href="./core/style.css"/>
<!--javascript-->
<script src="./core/settings.js" type="text/javascript"></script>
<script src="./core/ajax.js" type="text/javascript"></script>
<script src="./core/sha1.js" type="text/javascript"></script>
<title>Welcome to the Xenon System</title>
</head>
<?php 
	if (session_authenticated()) {
		// The user is currently logged in
		// ToDo: Load the Xenon System in respect to the user settings
?>
<body>
<?php
	} else {
		// The user is currently not logged in
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[XENON_HTTP_GET_TASK])) {
			if ($_GET[XENON_HTTP_GET_TASK] == XENON_HTTP_GET_ACTIVATE) {
?>
<body onload='activation_show();'>
<?php
			} else {
?>
<body onload='login_show();'>
<?php
			}
		} else {
?>
<body onload='login_show();'>
<?php
		}
	}
?>
<!--all-->
<div id='all'>
<!--header-->
<div id='header'>
</div>
<!--content-->
<div id='content'>
<?php
	if (session_authenticated()) {
		// The user is currently logged in
		// ToDo: Load the Xenon System in respect to the user settings
	} else {
		// The user is currently not logged in
		if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[XENON_HTTP_GET_TASK])) {
			if ($_GET[XENON_HTTP_GET_TASK] == XENON_HTTP_GET_ACTIVATE) {
				include($inc_path . '/registration/registration_activate.php');
			}
		}	
		include($inc_path . '/session/session_login.php');
		include($inc_path . '/registration/registration_register.php');
	}
?>
</div>
<!--footer-->
<div id='footer'>
<table>
<tr>
<td id='footer-left' class='halignleft valignmiddle'>The Xenon Project 2009.</td>
<td id='footer-status' class='haligncenter valignmiddle'>
<?php
	if (session_authenticated()) {
		// The user is currently logged in
?>
Logged in as <?php echo $_SESSION['user']; ?> <a href='./session/session_logout.php'>Log out</a>
<?php
	} else {
		// The user is currently not logged in
?>
You are currently not logged in. Please log in or register.
<?php
	}
?>
</td>
<td id='footer-right' class='halignright valignmiddle'>Version 0.1beta</td>
</tr>
</table>
</div>
</div>
</body>
</html>