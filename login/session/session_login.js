/*
	Project: 		The Xenon Project 2009.
	File: 			session_login.js
	Description: 	session login functions.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			08. April 2009
*/

// Defines
var SESSIONID = 'session'; // id of the login form
var SESSION_INPUTID_USER = 'session-user'; // id of the login input field user
var SESSION_INPUTID_PASSWORD = 'session-password'; // id of the login input field password
var SESSION_INPUTID_LANGUAGE = 'session-language'; // id of the login select field language
var SESSION_OUTPUTID_STATUS = 'session-status'; // id of the login status output
var SESSION_BUTTONID_REGISTER ='session-btn-register'; // id of the show registration form button
var SESSION_BUTTONID_SEND = 'session-btn-send'; // id of the send login form button

function login_show() {
	// clear the input fields
	var dom = document.getElementById(SESSION_INPUTID_USER);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(SESSION_INPUTID_PASSWORD);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(SESSION_INPUTID_LANGUAGE);
	if (dom) { dom.value = '0'; }	
	dom = document.getElementById(SESSION_BUTTONID_REGISTER);
	if (dom) { dom.disabled = false; }
	dom = document.getElementById(SESSION_BUTTONID_SEND);
	if (dom) { dom.disabled = false; }	
	dom = document.getElementById(SESSION_OUTPUTID_STATUS);
	if (dom) {
		dom.innerHTML = '';
		dom.className = 'error error-hidden';
	}
	
	// show the login form
	dom = document.getElementById(SESSIONID);
	if (dom) {
		dom.className = '';
	}
}

function login_hide() {
	var dom = document.getElementById(SESSIONID);
	if (dom) {
		dom.className = 'invisible';
	}
}

function login_validateInputData() {
	if (!login_validateInputData_User()) { return false; }
	if (!login_validateInputData_Password()) { return false; }
	if (!login_validateInputData_Language()) { return false; }
	
	// ok (the user has filled every input field with data)
	return true;
}

function login_validateInputData_User() {
	// user
	var dom = document.getElementById(SESSION_INPUTID_USER);
	if (dom) {
		if (dom.value != '') {
			return true;
		}
	}
	return false;
}

function login_validateInputData_Password() {
	// password
	var dom = document.getElementById(SESSION_INPUTID_PASSWORD);
	if (dom) {
		if (dom.value != '') {
			return true;
		}
	}
	return false;
}

function login_validateInputData_Language() {
	// language
	return true;
}

function login_sendCredentials() {
	var dom;
	// ensure that the user has correctly filled the login fields
	if (!login_validateInputData()) {
		dom = document.getElementById(SESSION_OUTPUTID_STATUS);
		if (dom) {
			dom.innerHTML = 'You must fill in all of the fields.';
			dom.className = 'error';
		}
		return;
	}
	
	// ensure that the ajax object is available
	if (!ajax) {
		dom = document.getElementById(SESSION_OUTPUTID_STATUS);
		if (dom) {
			dom.innerHTML = 'The ajax object is not available. Please try to reload Xenon.';
			dom.className = 'error';
		}
		return;
	}
	
	// hide the login status if the user credentials seems good
	dom = document.getElementById(SESSION_OUTPUTID_STATUS);
	if (dom) {
		dom.innerHTML = 'An error occurred. Please try again.';
		dom.className = 'error error-hidden';
	}
	
	// get the login data and disable the login fields so that the user cannot modify the login fields
	var params; // ajax parameters
	dom = document.getElementById(SESSION_INPUTID_USER);
	params = 'user=';
	if (dom) {
		dom.disabled = true;
		params += dom.value;
	}
	dom = document.getElementById(SESSION_INPUTID_PASSWORD);
	params += '&pwd=';
	if (dom) {
		dom.disabled = true;
		params += SHA1(dom.value);
	}
	dom = document.getElementById(SESSION_INPUTID_LANGUAGE);
	params += '&lang=';
	if (dom) {
		dom.disabled = true;
		params += dom.value;
	}
	dom = document.getElementById(SESSION_BUTTONID_REGISTER);
	if (dom) { dom.disabled = true; }
	dom = document.getElementById(SESSION_BUTTONID_SEND);
	if (dom) { dom.disabled = true; }	
	
	// send the login request
	ajax.request(XENON_HTTP_HOST + '/session/session_verify.php', params);
}
