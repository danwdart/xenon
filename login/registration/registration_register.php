<?php
/*
	Project: 		The Xenon Project 2009.
	File: 			registration_register.php
	Description: 	Registration of a new user.
	
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
	$firstname = '';
	$lastname = '';
	$email = '';
	$user = '';
	$password = '';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// the user has sent the registration form
		// validate the HTTP POST parameters
		// firstname
		if(empty($errors)) {
			if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
				$firstname = $_POST['firstname'];
				$firstname = strip_tags($firstname);
				$firstname = trim($firstname);
				$firstname = mb_strtolower($firstname, "UTF-8");  
				$firstname = ucfirst($firstname);
			} else {
				$errors[] = 'You must fill in all of the fields.';
			}
		}
		
		// lastname
		if(empty($errors)) {
			if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
				$lastname = $_POST['lastname'];
				$lastname = strip_tags($lastname);
				$lastname = trim($lastname);
				$lastname = mb_strtolower($lastname, "UTF-8");  
				$lastname = ucfirst($lastname);
			} else {
				$errors[] = 'You must fill in all of the fields.';
			}
		}
		
		// email
		if(empty($errors)) {
			if (isset($_POST['email']) && !empty($_POST['email'])) {
				$email = $_POST['email'];
				if (strpos($email, ' ') != false) {
					$errors[] = 'Your email is invalid.';
				} else {
					$email = strip_tags($email);
					$email = trim($email);
					$email = mb_strtolower($email, "UTF-8");
					
					// validate the email
					require_once('./registration_emailvalidator.php');			
					$validator = new EmailValidator(); 
					if (!$validator->validate($email)) {
						// invalid email address
						$errors[] = 'Your email address is invalid.';
					}
				}
			} else {
				$errors[] = 'You must fill in all of the fields.';
			}
		}
		
		// user
		if(empty($errors)) {
			if (isset($_POST['user']) && !empty($_POST['user'])) {
				$user = $_POST['user'];
				if (strpos($user, ' ') != false) {
					$errors[] = 'Your username is invalid.';
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
		if(empty($errors)) {
			if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
				$password = $_POST['pwd'];
				if (strpos($password, ' ') != false) {
					$errors[] = 'Your password is invalid.';
				}
			} else {
				$errors[] = 'You must fill in all of the fields.';
			}
		}
		
		// verify the user credentials
		if (empty($errors)) {
			//include('./../db/mysql_connect.php');
			$firstname = mysql_real_escape_string($firstname);
			$lastname = mysql_real_escape_string($lastname);
			$email = mysql_real_escape_string($email);
			$user = mysql_real_escape_string($user);
			$password = mysql_real_escape_string($password);

			// ensure that the choosen username is unique!
			$query = "SELECT (username)
						FROM users 
						WHERE username='$user' LIMIT 1";
			$result = @mysql_query($query);
			$num = @mysql_num_rows($result);
			if ($num == 1) {
				// the username already exists
				$errors[] = 'The choosen username already exists. Please choose another one.';
			} else {
				// create the user
				// create a random activation key that will be sent by link to the users email address to verify his/her account
				$activationkey = md5(uniqid(rand(), true));
				$activationkey = mysql_real_escape_string($activationkey);
				// create the query
				$query = "INSERT
							INTO users
							(username, firstname, lastname, email, password, joindate, active)
							VALUES ('$user', '$firstname', '$lastname', '$email', '$password', now(), '$activationkey')";
				$result = @mysql_query($query); 
				if (mysql_affected_rows() == 1)	{
					// send the email to the new user with the activation link of his/her account
					$subject = "Xenon - Welcome";
					$body = "Hello " . $firstname . ",\n\n";
					$body .= "thanks for your registration at Xenon. Before you can ";
					$body .= "use Xenon, you have to activate your account. Therefore ";
					$body .= "please use the following link:\n\n";					
					$hostname = $_SERVER['HTTP_HOST'];
					$body .= "http://" . $hostname . "/index.php?" . XENON_HTTP_GET_TASK . "=" . XENON_HTTP_GET_ACTIVATE . "&x=" . mysql_insert_id() . "&y=$activationkey\n\n";
					$body .= "Your username is: " . $user . "\n\n";
					$body .= "If you have any questions or just want to say hello, ";
					$body .= "do not hesitate to contact us!\n\n";
					$body .= "Have fun and enjoy,\n";
					$body .= "your Xenon team\n\n\n";
					$header='From: Xenon <info@xenon.com>';
					mail(utf8_decode($email), utf8_decode($subject), utf8_decode($body), utf8_decode($header));
				} else {
					$errors[] = 'An error occurred. Please try again.';
				}
			}
		}
		
		if (empty($errors)) {
			// the user has successfully registered
?>
			<xenon>
				<action>
					<task>messageBox</task>
					<content>Registration was successfully! You will get an email with the activation link in a few seconds!</content>
				</action>
				<action>
					<task>rawjs</task>
					<js>
						var dom = document.getElementById(REGISTRATION_OUTPUTID_STATUS);
						if (dom) {
							dom.innerHTML = 'Registration was successfully. You will get an email with the activation link in a few seconds.';
							dom.className = 'success';
						}
						dom = document.getElementById(REGISTRATION_INPUTID_FIRSTNAME);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_INPUTID_LASTNAME);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_INPUTID_EMAIL);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_INPUTID_USER);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD1);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_BUTTONID_LOGIN);
						if (dom) {
							dom.disabled = false;
						}
						dom = document.getElementById(REGISTRATION_BUTTONID_SEND);
						if (dom) {
							dom.disabled = false;
						}
					</js>
				</action>
			</xenon>
<?php
		} else {
			// an error occurred during the registration of the user
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
					var dom = document.getElementById(REGISTRATION_OUTPUTID_STATUS);
					if (dom) {
						dom.innerHTML = '<?php echo $errorDescr; ?>';
						dom.className = 'error';
					}
					dom = document.getElementById(REGISTRATION_INPUTID_FIRSTNAME);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_INPUTID_LASTNAME);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_INPUTID_EMAIL);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_INPUTID_USER);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD1);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_BUTTONID_LOGIN);
					if (dom) {
						dom.disabled = false;
					}
					dom = document.getElementById(REGISTRATION_BUTTONID_SEND);
					if (dom) {
						dom.disabled = false;
					}
				</js>
				</action>
			</xenon>
<?php
		}
		exit;
	} else {
		// registration form
?>

<div id='registration' class='invisible'>
<link rel="stylesheet" type="text/css" href="./registration/registration_style.css"/>
<script src="./registration/registration_register.js" type="text/javascript"></script>
<table>
<tr><td class='halignleft' colspan="2"><label for='reg-firstname'>Firstname</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='text' id='reg-firstname' name='reg-firstname' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for='reg-lastname'>Lastname</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='text' id='reg-lastname' name='reg-lastname' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for='reg-email'>E-Mail</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='text' id='reg-email' name='reg-email' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for='reg-user'>User</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='text' id='reg-user' name='reg-user' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for="reg-password">Password</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='password' id='reg-password' name='reg-password' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for="reg-password1">Password (repeat)</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='password' id='reg-password1' name='reg-password1' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td colspan='2'></td></tr>
<tr>
<td class='halignleft'><input id='reg-btn-login' type='submit' class='button' onclick='registration_hide(); login_show();' value='Login'/></td>
<td class='halignright'><input id='reg-btn-send' type='submit' class='button' onclick='registration_sendCredentials()' value='Register'/></td>
</tr>
<tr><td colspan='2'></td></tr>
<tr><td colspan='2'>
<div id='reg-status' class='error error-hidden'>An error occurred. Please try again.</div>
</td></tr>
</table>
</div>

<?php
	}
?>