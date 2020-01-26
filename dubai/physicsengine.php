<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
<title>Dan's Physics Engine</title>
<style type="text/css">

body {
background-color: black;
color: white;
}

#moon {
position: absolute;
height: 50px;
width: 50px;
top: 50px;
left:50px;
}

#earth {
position: absolute;
height: 200px;
width: 200px;
top: 300px;
left: 300px;
}
</style>
<script type="text/javascript">
<!--
// G=6.67*10^-11;
G = 10;
M = 4*10^6;
var diffx;
var diffy;
function init() {
var moonx = document.getElementById(moon).style.left;
var moony = document.getElementById(moon).style.top;
diffx=moonx-300;
diffy=moony-300;
accelerationx = (G*M)/(diffx)^2;
document.getElementById(accx).innerHTML=accelerationx;
accelerationy = (G*M)/(diffy)^2;
document.getElementById(accy).innerHTML=accelerationy;
moonx += accelerationx;
document.getElementById(moonxv).innerHTML=moonx;
moony += accelerationy;
document.getElementById(moonyv).innerHTML=moony;
document.getElementById(moon).style.left = moonx;
document.getElementById(moon).style.top = moony;
timer=setTimeout("init();",50);
}
// -->
</script>
</head>
<body onload="init();">
<img src="earth.png" id="earth" alt="Earth" />
<img src="moon.png" id="moon" alt="Moon" />
<div id="accx"></div>
<br /><div id="accy"></div>
<br /><div id="moonxv"></div>
<br /><div id="moonyv"></div>
</body>
</html>
