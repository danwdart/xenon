/*
	Project: 		The Xenon Project 2009.
	File: 			ajax.js
	Description: 	Provides a browser independent XmlHttp object.
	
	Author: 		Sven Kerschbaum <sven.kerschbaum@t-online.de>
	Date: 			08. April 2009
*/

// Create the browser independent XMLHttpRequest object
var ajax = new Object();

// Provide the XMLHttpRequest class for IE 5.x-6.x
if (typeof(XMLHttpRequest) == "undefined") {
	XMLHttpRequest = function() {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP.6.0");
		} catch ( e ) {}
			
		try	{
			return new ActiveXObject("Msxml2.XMLHTTP.3.0");
		} catch ( e ) {}
			
		try	{
			return new ActiveXObject("Msxml2.XMLHTTP")
		} catch ( e ) {}
			
		try	{
			return new ActiveXObject("Microsoft.XMLHTTP")
		} catch ( e ) {}
			
     	alert('Sorry, but Xenon only works with AJAX capable browsers!');
	}
}

/* --- request() ------------------------------------------------------------------------------------------ request() --- */
/**
 *  @brief   Provides a browser independent XMLHttpRequest class.
 *
 *  @param   a_url         		  [  in ]  String that specifies either the absolute or a relative URL
 *  @param   a_vars				  [  in ]  Array that contains all variables that should be sent
 *  @param   a_callbackFunction   [  in ]  The callback function for the request
 *
 *  @return  Nothing
 */
/* --- request() ------------------------------------------------------------------------------------------ request() --- */
ajax.request = function( /*  in */ a_url,
					     /*  in */ a_vars
						) {
	var request =  new XMLHttpRequest();
	request.open("POST", a_url, true);
	//request.open( "GET", a_url + "?" + a_vars, true );
	var dummy = new Date();
	var dummyMs = dummy.getMilliseconds();
	
	//request.open( "GET", a_url + "?" + a_vars + "&dummyrand=" + Math.random() + "&dummyms=" + dummyMs, true );
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 
	request.onreadystatechange = function()	{
		var DONE = 4, OK = 200;
		if (request.readyState == DONE && request.status == OK)	{
			if (request.responseText) {
				try {
					xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
					xmlDoc.async="false";
					xmlDoc.loadXML(request.responseText);
				} catch(e) {
					parser=new DOMParser();
					parser.async="false";
					xmlDoc=parser.parseFromString(request.responseText,"text/xml");
				}
				if(request.responseText != '<xenon><action><task>pong</task></action></xenon>') {
					localEngine(xmlDoc);
				}
			}
		}
	};
	request.send(a_vars);
	//request.send( null );
	return request;
}

/*
*
*This function is needed because firefox dom is a crap, so we have to use the
*firefox only "textContent" instead of nodeValue to be sure that we'll get the entire
*Node value, and not only the first 4096 chars.
*anyway, have an abstraction never is bad... or almost never
*/
function getNodeValue(node){
	if(!node){
		return '';
	}
	if(typeof(node.textContent) != 'undefined'){
		return node.textContent;
	}
	return node.firstChild.nodeValue;
}

/*
* This functions parse the ajax.request response.
*/
function localEngine(msg) {
	// Message is not set, could be an empty response to a request
	if(msg.hasChildNodes()) {
		var actions = msg.getElementsByTagName('action');
		var mySize = actions.length;
		for(count=0;count < mySize;count++) {
			try {
				task = getNodeValue(actions[count].getElementsByTagName('task')[0]);
				if(task == 'createWidget') {
				} else if(task == 'messageBox') {
					content = getNodeValue(actions[count].getElementsByTagName('content')[0]);
					alert(content);
				} else if(task == 'setValue') {
				} else if(task == 'setValueB64') {
				} else if(task == 'concatValue') {
				} else if(task == 'concatValueB64') {
				} else if(task == 'concatDiv') {
				} else if(task == 'rawjs') {
					js = getNodeValue(actions[count].getElementsByTagName('js')[0]);
					js=js.replace(/\n/,"");
					js=js.replace(/\r/,"");
					eval(js);
				} else if(task == 'setDiv') {
				} else if(task == 'loadScript') {
					url = getNodeValue(actions[count].getElementsByTagName('url')[0]);
					dhtmlLoadScript(url);
				} else if(task == 'loadCSS') {
					url = getNodeValue(actions[count].getElementsByTagName('url')[0]);
					id = getNodeValue(actions[count].getElementsByTagName('id')[0]);
					dhtmlLoadCSS(url,id);
				} else if(task == 'removeCSS') {
					id = getNodeValue(actions[count].getElementsByTagName('id')[0]);
					dhtmlRemoveCSS(id);
				} else if(task == 'removeWidget') {
				} else if(task == 'createDiv') {
				} else if(task == 'setWallpaper') {
				} else if(task == 'updateCss') {
				} else if(task == 'makeDrag') {
				} else if(task == 'rawSendMessage') {
				} else if(task == 'addEvent') {
				} else if(task == 'createLayer') {
				} else if(task == 'removeLayer') {
				} else if(task == 'showLayer') {
				} else if(task == 'hideLayer') {
				} else if(task == 'fadeOutLayer') {
				} else if(task == 'fadeInLayer') {
				}
			} catch (err) {
			}
		}
	}
}

