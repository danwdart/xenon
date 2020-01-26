/*
	Project: 		The Xenon Project 2009.
	File: 			registration_activate.js
	Description: 	Activation functions.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			09. April 2009
*/

// Defines
var ACTIVATIONID = 'activation'; // id of the activation
var ACTIVATION_OUTPUTID_STATUS = 'act-status'; // id of the activation status output

function activation_show() {
	// show the activation
	dom = document.getElementById(ACTIVATIONID);
	if (dom) {
		dom.className = '';
	}
}

function activation_hide() {
	// hide the activation
	var dom = document.getElementById(ACTIVATIONID);
	if (dom) {
		dom.className = 'invisible';
	}
}
