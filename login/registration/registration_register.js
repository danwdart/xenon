/*
	Project: 		The Xenon Project 2009.
	File: 			registration_register.js
	Description: 	Registration functions.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			08. April 2009
*/

// Defines
var REGISTRATIONID = 'registration'; // id of the registration form
var REGISTRATION_INPUTID_FIRSTNAME = 'reg-firstname'; // id of the registration input field firstname
var REGISTRATION_INPUTID_LASTNAME = 'reg-lastname'; // id of the registration input field lastname
var REGISTRATION_INPUTID_EMAIL = 'reg-email'; // id of the registration input field email
var REGISTRATION_INPUTID_USER = 'reg-user'; // id of the registration input field user
var REGISTRATION_INPUTID_PASSWORD = 'reg-password'; // id of the registration input field password
var REGISTRATION_INPUTID_PASSWORD1 = 'reg-password1'; // id of the registration input field password
var REGISTRATION_OUTPUTID_STATUS = 'reg-status'; // id of the registration status output
var REGISTRATION_BUTTONID_LOGIN = 'reg-btn-login'; // id of the show login form button
var REGISTRATION_BUTTONID_SEND = 'reg-btn-send'; // id of the send credentials button

function registration_show() {
	// clear the input fields
	var dom = document.getElementById(REGISTRATION_INPUTID_FIRSTNAME);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(REGISTRATION_INPUTID_LASTNAME);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(REGISTRATION_INPUTID_EMAIL);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(REGISTRATION_INPUTID_USER);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD1);
	if (dom) { dom.value = ''; }
	dom = document.getElementById(REGISTRATION_BUTTONID_SEND);
	if (dom) { dom.disabled = false; }
	dom = document.getElementById(REGISTRATION_BUTTONID_LOGIN);
	if (dom) { dom.disabled = false; }	
	dom = document.getElementById(REGISTRATION_OUTPUTID_STATUS);
	if (dom) {
		dom.innerHTML = '';
		dom.className = 'error error-hidden';
	}
	
	// show the registration form
	dom = document.getElementById(REGISTRATIONID);
	if (dom) {
		dom.className = '';
	}
}

function registration_hide() {
	var dom = document.getElementById(REGISTRATIONID);
	if (dom) {
		dom.className = 'invisible';
	}
}

function registration_validateInputData() {
	if (!registration_validateInputData_Firstname()) { return false; }
	if (!registration_validateInputData_Lastname()) { return false; }
	if (!registration_validateInputData_EMail()) { return false; }
	if (!registration_validateInputData_User()) { return false; }
	if (!registration_validateInputData_Passwords()) { return false; }
	
	// ok (the user has filled every input field with data)
	return true;
}

function registration_validateInputData_Firstname() {
	// firstname
	var dom = document.getElementById(REGISTRATION_INPUTID_FIRSTNAME);
	if (dom) {
		if (dom.value != '') {
			return true;
		}
	}
	return false;
}

function registration_validateInputData_Lastname() {
	// lastname
	var dom = document.getElementById(REGISTRATION_INPUTID_LASTNAME);
	if (dom) {
		if (dom.value != '') {
			return true;
		}
	}
	return false;
}

function registration_validateInputData_EMail() {
	// email
	var dom = document.getElementById(REGISTRATION_INPUTID_EMAIL);
	if (dom) {
		if (dom.value != '') {
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if (reg.test(dom.value) == false) {
				return false;
			} else {
				return true;
			}
		}
	}
	return false;
}

function registration_validateInputData_User() {
	// user
	var dom = document.getElementById(REGISTRATION_INPUTID_USER);
	if (dom) {
		if (dom.value != '') {
			return true;
		}
	}
	return false;
}

function registration_validateInputData_Passwords() {
	// password
	var dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD);
	var dom1 = document.getElementById(REGISTRATION_INPUTID_PASSWORD1);
	if (dom && dom1) {
		if (dom.value != '' && dom1.value != '') {
			if (dom.value == dom1.value != '') {
				return true;
			}
		}
	}
	return false;
}

function registration_sendCredentials() {
	var dom;
	// ensure that the user has correctly filled the registration fields
	if (!registration_validateInputData()) {
		dom = document.getElementById(REGISTRATION_OUTPUTID_STATUS);
		if (dom) {
			dom.innerHTML = 'You must fill in all of the fields.';
			dom.className = 'error';
		}
		return;
	}
	
	// ensure that the ajax object is available
	if (!ajax) {
		dom = document.getElementById(REGISTRATION_OUTPUTID_STATUS);
		if (dom) {
			dom.innerHTML = 'The ajax object is not available. Please try to reload Xenon.';
			dom.className = 'error';
		}
		return;
	}
	
	// hide the registration status if the user credentials seems good
	dom = document.getElementById(REGISTRATION_OUTPUTID_STATUS);
	if (dom) {
		dom.innerHTML = 'An error occurred. Please try again.';
		dom.className = 'error error-hidden';
	}
	
	// get the registration data and disable the registration fields so that the user cannot modify the registration fields
	var params; // ajax parameters
	dom = document.getElementById(REGISTRATION_INPUTID_FIRSTNAME);
	params = 'firstname=';
	if (dom) {
		dom.disabled = true;
		params += dom.value;
	}
	dom = document.getElementById(REGISTRATION_INPUTID_LASTNAME);
	params += '&lastname=';
	if (dom) {
		dom.disabled = true;
		params += dom.value;
	}
	dom = document.getElementById(REGISTRATION_INPUTID_EMAIL);
	params += '&email=';
	if (dom) {
		dom.disabled = true;
		params += dom.value;
	}
	dom = document.getElementById(REGISTRATION_INPUTID_USER);
	params += '&user=';
	if (dom) {
		dom.disabled = true;
		params += dom.value;
	}
	dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD);
	params += '&pwd=';
	if (dom) {
		dom.disabled = true;
		params += SHA1(dom.value);
	}
	dom = document.getElementById(REGISTRATION_INPUTID_PASSWORD1);
	if (dom) {
		dom.disabled = true;
	}
	dom = document.getElementById(REGISTRATION_BUTTONID_SEND);
	if (dom) { dom.disabled = true; }
	dom = document.getElementById(REGISTRATION_BUTTONID_LOGIN);
	if (dom) { dom.disabled = true; }
	
	// send the login request
	ajax.request(XENON_HTTP_HOST + '/registration/registration_register.php', params);
}

function validateEMail(address) {
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if (reg.test(address) == false) {
		return false;
	}
	return true;
}