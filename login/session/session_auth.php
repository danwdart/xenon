<?php
/*
	Project: 		The Xenon Project 2009.
	File: 			session_auth.php
	Description: 	Ensures that a user has successfully logged in.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			06. April 2009
*/

	session_start();
	
	function session_authenticated() {
		if (isset($_SESSION['id']))	{
			return true; // The user is currently logged in
		} else {
			return false; // The user is currently not logged in
		}
	}
?>