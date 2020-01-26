<?php
/*
	Project: 		The Xenon Project 2009.
	File: 			session_login.php
	Description: 	Login.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			08. April 2009
*/

?>

<div id='session' class='invisible'>
<link rel="stylesheet" type="text/css" href="./session/session_style.css"/>
<script src="./session/session_login.js" type="text/javascript"></script>
<table>
<tr><td class='halignleft' colspan="2"><label for='session-user'>User</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='text' id='session-user' name='session-user' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for="session-password">Password</label></td></tr>
<tr><td class='halignleft' colspan="2"><input type='password' id='session-password' name='session-password' class='inputtext' size='50' maxlength='50' value=''/></td></tr>
<tr><td class='halignleft' colspan="2"><label for="session-language">Language (for this session)</label></td></tr>
<tr><td class='halignleft' colspan="2">
<select id='session-language' name='session-language' class='inputselect'>
<option value="default" selected>( Default )</option>
<option value="en">English</option>
</select>
</td></tr>
<tr><td colspan='2'></td></tr>
<tr>
<td class='halignleft'><input id='session-btn-register' type='submit' class='button' onclick='login_hide(); registration_show();'; value='Register'/></td>
<td class='halignright'><input id='session-btn-send' type='submit' class='button' onclick='login_sendCredentials()' value='Login'/></td>
</tr>
<tr><td colspan='2'></td></tr>
<tr><td colspan='2'>
<div id='session-status' class='error error-hidden'>An error occurred. Please try again.</div>
</td></tr>
</table>
</div>