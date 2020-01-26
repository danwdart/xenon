 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<title>Welcome to the Xenon System</title>
<style type="text/css">
body {
background-color: white;
}
#main {
position:absolute;
top: 0px;
left: 0px;
padding-left: 0px;
padding-top:0px;
width: 1000px;
height:600px;
background-color: white;
}

#toppanel {
position:absolute;
top: 0px;
left: 0px;
padding-left: 0px;
padding-top:0px;
height: 50px; 
width: 1000px;
background-color: #6666ff;
}
#inside {
position:absolute;
top: 50px;
left: 0px;
padding-left: 0px;
padding-top:0px;
height: 500px;
width:1000px;
}

#inside2 {
position:absolute;
top: 50px;
left: 0px;
padding-left: 0px;
padding-top:0px;
height: 500px;
width:1000px;
color: black;
background-color: white;
}

#bottompanel {
position:absolute;
top: 550px;
left: 0px;
padding-left: 0px;
padding-top:0px;
height: 50px;
width:1000px;
background-color: #9999ff;
}

#moon,#moon2,#moon3,#moon4,#moon5 {
position:absolute;
left:200px;
top:200px;
height:108px;
width:90px;
}

#earth {
position:absolute;
left:450px;
top:150px;
height:100px;
width:100px;
}


#centrepanel {

position:absolute;
top: 50px;
left: 0px;
padding-left: 0px;
padding-top:0px;
height: 500px;
width:1000px;
color: black;
background-color: white;
}

#background {
position:absolute;
top: -50px;
left: 0px;
padding-left: 0px;
padding-top:0px;
height: 500px;
width:1000px;
}

#text,#text2,#text3,#text4,#text5 {
position: absolute;
font-size: 20px;
width: 100px;
text-align:center;
font-family: Sans Serif;
}

#weather {
position: absolute;
font-size:24px;
left: 600px;
top: 420px;
font-family: Sans Serif;
}

</style>
<script type="text/javascript">
<!--
var numdegrees=0;
var number=0.3;
var mult=1;
var multspeed=0.1;

function spinmoon(id,angle,istext) {

var themoon=document.getElementById(id);

sinvalue=Math.sin((numdegrees+angle)*(Math.PI/180))
cosvalue=Math.cos((numdegrees+angle)*(Math.PI/180))

 themoon.style.top=Math.floor(150-mult*150*cosvalue)+"px";  // 80last
 themoon.style.left=Math.floor(450+mult*300*sinvalue)+"px";

if (istext==1) {
themoon.style.top = Math.floor(150-mult*150*cosvalue) + 100 +"px";
}

/*
 themoon.style.height=(Math.floor(90-36*cosvalue))+"px";
 themoon.style.width=(Math.floor(70-30*cosvalue))+"px";
*/
}

function init() {
spinmoon("moon",0,0);
spinmoon("moon2",72,0);
spinmoon("moon3",144,0);
spinmoon("moon4",216,0);
spinmoon("moon5",288,0);
spinmoon("text",0,1);
spinmoon("text2",72,1);
spinmoon("text3",144,1);
spinmoon("text4",216,1);
spinmoon("text5",288,1);

// Validity Adjustment
if (numdegrees >= 360) {
numdegrees=0;
}
if (numdegrees < 0) {
numdegrees = 360;
}

numdegrees+=number;

timer=setTimeout("init();",20);
}

function getbigger(id) {
var theicon=document.getElementById(id);
theicon.style.height="120px";
theicon.style.width="100px";

}

function getsmaller(id) {
var theicon=document.getElementById(id);
theicon.style.height="108px";
theicon.style.width="90px";
}

//	Begin App Categories
function internet() {
fancychange();

document.getElementById('earth').src="back.png";
document.getElementById('earth').onclick= menu;

document.getElementById('moon').src="voip.png";
document.getElementById('moon').onclick = voip;

document.getElementById('moon2').src="im.png";
document.getElementById('moon2').onclick = im;

document.getElementById('moon3').src="email.png";
document.getElementById('moon3').onclick = email;

document.getElementById('moon4').src="browser.png";
document.getElementById('moon4').onclick = browser;

document.getElementById('moon5').src="favourites.png";
document.getElementById('moon5').onclick = favourites;

}

function work() {
fancychange();
document.getElementById('earth').src="back.png";
document.getElementById('earth').onclick= menu;
}

function games() {
fancychange();
document.getElementById('earth').src="back.png";
document.getElementById('earth').onclick= menu;
}

function media() {
fancychange();
document.getElementById('earth').src="back.png";
document.getElementById('earth').onclick= menu;
}

function myfiles() {
alert ("My Files function not yet implemented.");
}

//	End App Categories
//	Begin Menu Switchback
function menu() {
fancychange();
document.getElementById('earth').src="menulogo.png";
document.getElementById('earth').onclick="";
document.getElementById('moon').src="internet.png";
document.getElementById('moon').onclick = internet;
document.getElementById('moon2').src="work.png";
document.getElementById('moon2').onclick = work;
document.getElementById('moon3').src="games.png";
document.getElementById('moon3').onclick = games;
document.getElementById('moon4').src="media.png";
document.getElementById('moon4').onclick = media;
document.getElementById('moon5').src="myfiles.png";
document.getElementById('moon5').onclick = myfiles;
}
//	End Menu Switchback

//	Start Apps

function voip() {
alert ("VOIP function not yet implemented.");
}

function im() {
alert ("IM function not yet implemented.");
}

function email() {
alert ("Email function not yet implemented.");
}
function browser() {
alert ("Browser function not yet implemented.");
}
function favourites() {
fancychange();
document.getElementById('earth').src="back.png";
document.getElementById('earth').onclick= internet;

document.getElementById('moon').src="fav1.png";
document.getElementById('moon').onclick = fav1;

document.getElementById('moon2').src="fav2.png";
document.getElementById('moon2').onclick = fav2;

document.getElementById('moon3').src="fav3.png";
document.getElementById('moon3').onclick = fav3;

document.getElementById('moon4').src="fav4.png";
document.getElementById('moon4').onclick = fav4;

document.getElementById('moon5').src="fav5.png";
document.getElementById('moon5').onclick = fav5;
}
function fav1() {
alert ("Not Implemented");
}
function fav2() {
alert ("Not Implemented");
}
function fav3() {
alert ("Not Implemented");
}
function fav4() {
alert ("Not Implemented");
}
function fav5() {
alert ("Not Implemented");
}

//	End Apps

function hidemenu() {
document.getElementById('inside').style.display="none";
document.getElementById('inside2').style.display="inline";
}
function showmenu() {
document.getElementById('inside2').style.display="none";
document.getElementById('inside').style.display="inline";
}

function goin() {
mult -=multspeed;
timerin = setTimeout("goin();",10);
if (mult <= 0) { timerout= setTimeout("goout();",10);   clearTimeout(timerin);}
}
function goout() {
mult +=multspeed;
timerout= setTimeout("goout();",10);
if (mult >= 1) { clearTimeout(timerout); }
}
function fancychange() {
goin();
mult=1;
}

// -->
</script>

</head>
<body onload="init();">
<div id="main">
	<div id="toppanel">
			<div style="text-align: center;"><img src="xenonlogo.png" alt="Xenon Logo"  /></div>
	</div>
	<div id="inside">
		
		<div id="centrepanel">
			<img src="clouds.jpg" id="background" alt="background"  />
			<img src="menulogo.png" id="earth" alt="Earth" />
			<img src="internet.png" alt="Moon" id="moon" onclick="internet();" onmouseover="getbigger('moon');" onmouseout="getsmaller('moon');" />
			<img src="work.png" alt="Moon" id="moon2" onclick="work();" onmouseover="getbigger('moon2');" onmouseout="getsmaller('moon2');" />
			<img src="games.png" alt="Moon" id="moon3" onclick="games();" onmouseover="getbigger('moon3');" onmouseout="getsmaller('moon3');" />
			<img src="media.png" alt="Moon" id="moon4" onclick="media();" onmouseover="getbigger('moon4');" onmouseout="getsmaller('moon4');" />
			<img src="myfiles.png" alt="Moon" id="moon5"  onclick="myfiles();" onmouseover="getbigger('moon5');" onmouseout="getsmaller('moon5');" />
			<div id="text"><!--Internet--></div>
			<div id="text2"><!--Work--></div>
			<div id="text3"><!--Games--></div>
			<div id="text4"><!--Media--></div>
			<div id="text5"><!--My Files--></div>
			<div id="weather">The weather will be light cloud.</div>
		</div>
	
	
	
	</div>
	
	<div id="inside2" style="display:none;">
			This is a sample app that would be launched via the menu. Click on the Menu button below to show the menu again.
	</div>

	<div id="bottompanel">
		<img src="menu.png" onclick="showmenu();" alt="Show Menu" />
	</div>
</div>

</body>
</html>
