<?php
/*
	Project: 		The Xenon Project 2009.
	File: 			registration_activate.php
	Description: 	Activation of a user account.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			09. April 2009
*/

	$inc_path = dirname(__FILE__);
	if ($inc_path[strlen($inc_path)-1] != '/') {
		$inc_path .= '/';
	}
	include($inc_path . '../core/settings.php');
	include($inc_path . '../db/mysql_connect.php');
	
	$errors = array();
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		// validate the HTTP Get parameters
		if (empty($errors)) {
			if (isset($_GET[XENON_HTTP_GET_TASK])) {
				if ($_GET[XENON_HTTP_GET_TASK] != XENON_HTTP_GET_ACTIVATE) {
					$errors[] = 'Please use the activation link provided by Xenon (email).';
				}
			} else {
				$errors[] = 'Please use the activation link provided by Xenon (email).';
			}
		}
		
		if (empty($errors)) {
			if (isset($_GET['x'])) {
				$x = (int) $_GET['x'];
			} else {
				$errors[] = 'Please use the activation link provided by Xenon (email).';
			}
		}
	
		if (empty($errors)) {
			if (isset($_GET['y'])) {
				$y = $_GET['y'];
			} else {
				$errors[] = 'Please use the activation link provided by Xenon (email).';
			}
		}
		
		if (empty($errors)) {
			if (($x > 0) && (strlen($y) == 32)) {
				// activate the user account
				//include('./../db/mysql_connect.php');
				$x = mysql_real_escape_string($x);
				$y = mysql_real_escape_string($y);
			
				$query = "UPDATE users SET active=NULL WHERE (id=$x AND active='" . $y . "') LIMIT 1";  
				$result = mysql_query($query);
				if (mysql_affected_rows() != 1)	{
					// activation was not successful
					$errors[] = 'Please use the activation link provided by Xenon (email).';
				}
			} else {
				// the user account could not be activated
				$errors[] = 'Please use the activation link provided by Xenon (email).';
			}	
		} else {
			// the user account could not be activated
			$errors[] = 'Please use the activation link provided by Xenon (email).';
		}
	}	
?>

<div id='activation' class='invisible'>
<link rel="stylesheet" type="text/css" href="./registration/registration_activate.css"/>
<script src="./registration/registration_activate.js" type="text/javascript"></script>
<?php
	if (empty($errors)) {
		// the activation was successful
?>
	<div id='act-status' class='success'>
	<div>Your account is now active. You can now log in and enjoy Xenon.</div>
	<a href='javascript:activation_hide();javascript:login_show()'>Login</a>	
	</div>	
<?php
	} else {
		// the activation was not successful
		$errorDescr = '';
		foreach ($errors as $err) {
			if (!empty($errorDescr)) {
				$errorDescr .= "\n";
			}
			$errorDescr .= $err;
		}
?>
<div id='act-status' class='error'><?php echo $errorDescr; ?></div>
<?php
	}
?>
</div>