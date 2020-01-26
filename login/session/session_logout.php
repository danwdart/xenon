<?php
/*
	Project: 		The Xenon Project 2009.
	File: 			session_logout.php
	Description: 	Logs out the user and destroys the session.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			06. April 2009
*/

	session_start();
    session_destroy();

	$hostname = $_SERVER['HTTP_HOST'];
	header('Location: http://'.$hostname.'/index.php');
?>