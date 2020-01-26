<?php
/*
	Project: 		The Xenon Project 2009.
	File: 			session_verify.php
	Description: 	Verify the user credentials.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			08. April 2009
*/

	$inc_path = dirname(__FILE__);
	if ($inc_path[strlen($inc_path)-1] != '/') {
		$inc_path .= '/';
	}
	include($inc_path . '../core/settings.php');
	include($inc_path . '../db/mysql_connect.php');

	$errors = array();
	$user = '';
	$password = '';
	$language = '';
	$query = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// validate the HTTP POST parameters
		// user
		if (empty($errors)) {
			if (isset($_POST['user']) && !empty($_POST['user'])) {
				$user = $_POST['user'];
				if (strpos($user, ' ') != false) {
					$errors[] = 'Invalid username.';
				} else {
					$user = strip_tags($user);
					$user = trim($user);
					$user = mb_strtolower($user, "UTF-8");
				}
			} else {		
				$errors[] = 'You must fill in all of the fields.';
			}
		}
		
		// password
		if (empty($errors)) {
			if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
				$password = $_POST['pwd'];
				if (strpos($password, ' ') != false) {
					$errors[] = 'Invalid password.';
				}
			} else {
				$errors[] = 'You must fill in all of the fields.';
			}
		}
		
		// language
		if (empty($errors)) {
			if (isset($_POST['lang']) && !empty($_POST['lang'])) {
				if ($_POST['lang'] == 'default') {
					// default language
					$language = XENON_DEFAULT_SESSION_LANGUAGE;
				} else if ($_POST['lang'] == 'en') {
					// english
					$language = $_POST['lang'];
				} else {
					$errors[] = 'Please choose a language for this session.';
				}			
			} else {
				$errors[] = 'You must fill in all of the fields.';		
			}
		}
		
		// verify the user credentials
		if (empty($errors)) {
			$user = mysql_real_escape_string($user);
			$password = mysql_real_escape_string($password);
			
			$query = "SELECT id, firstname, lastname, email FROM users WHERE username = '$user' AND password = '$password' AND active IS NULL LIMIT 1";
			$result = @mysql_query($query);
			$num = @mysql_num_rows($result);
			if ($num == 1) {
				// valid user credentials
				session_start();
				// set the session variables
				$userinfo = mysql_fetch_row($result);
				$_SESSION['id'] = $userinfo[0];
				$_SESSION['firstname'] = $userinfo[1];
				$_SESSION['lastname'] = $userinfo[2];
				$_SESSION['email'] = $userinfo[3];
				$_SESSION['user'] = $user;
			} else {
				// invalid user credentials
				$errors[] = 'Sorry, your user credentials are invalid.';
			}
		}
	} else {
		$errors[] = 'Please use the Xenon login.';
	}
	
	// generate the login response	
	if (empty($errors)) {
		// valid user credentials
?>
	<xenon>
		<action>
			<task>rawjs</task>
			<js>
				var dom = document.getElementById(SESSIONID);
				if (dom) {
					dom.style.display = 'none';
					dom.parentNode.removeChild(dom);
				}
				dom = document.getElementById('footer-status');
				if (dom) {
					dom.innerHTML = '';
					var domNew = document.createElement('span');
					if (domNew) {
						domNew.innerHTML = 'Logged in as <?php echo $_SESSION['user']; ?> ';
						dom.appendChild(domNew);
					}
					domNew = document.createElement('a');
					if (domNew) {
						domNew.href ='./session/session_logout.php';
						domNew.innerHTML = 'Log out';
						dom.appendChild(domNew);
					}			
				}				
				alert('You have successfully logged in. Enjoy Xenon!');
			</js>
		</action>
	</xenon>
<?php
	} else {
		// invalid user credentials
		$errorDescr = '';
		foreach ($errors as $err) {
			if (!empty($errorDescr)) {
				$errorDescr .= "\n";
			}
			$errorDescr .= $err;
		}
?>
	<xenon>
		<action>
			<task>rawjs</task>
			<js>
				var dom = document.getElementById(SESSION_OUTPUTID_STATUS);
				if (dom) {
					dom.innerHTML = '<?php echo $errorDescr; ?>';
					dom.className = 'error';
				}	
				dom = document.getElementById(SESSION_INPUTID_USER);
				if (dom) {
					dom.disabled = false;
				}
				dom = document.getElementById(SESSION_INPUTID_PASSWORD);
				if (dom) {
					dom.disabled = false;
				}
				dom = document.getElementById(SESSION_INPUTID_LANGUAGE);
				if (dom) {
					dom.disabled = false;
				}
				dom = document.getElementById(SESSION_BUTTONID_REGISTER);
				if (dom) {
					dom.disabled = false;
				}
				dom = document.getElementById(SESSION_BUTTONID_SEND);
				if (dom) {
					dom.disabled = false;
				}
			</js>
		</action>
	</xenon>
<?php
	}	
?>