 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<title>Welcome to the Xenon System</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="xenon.js"></script>
</head>
<body onload="init();">
	<div id="menu">
			<!--<img src="clouds.jpg" id="background" alt="background"  />-->
			<img src="themes/crystal/menulogo.png" id="earth" alt="" />
			<img src="themes/crystal/internet.png" alt="" id="moon1" onclick="internet();" onmouseover="goout(1);" onmouseout="goin(1);" />
			<img src="themes/crystal/work.png" alt="" id="moon2" onclick="work();" onmouseover="goout(2);" onmouseout="goin(2);" />
			<img src="themes/crystal/games.png" alt="" id="moon3" onclick="games();" onmouseover="goout(3);" onmouseout="goin(3);" />
			<img src="themes/crystal/media.png" alt="" id="moon4" onclick="media();" onmouseover="goout(4);" onmouseout="goin(4);" />
			<img src="themes/crystal/more.png" alt="" id="moon5"  onclick="more();" onmouseover="goout(5);" onmouseout="goin(5);" />
			<div id="text1">Internet</div>
			<div id="text2">Work</div>
			<div id="text3">Games</div>
			<div id="text4">Media</div>
			<div id="text5">More</div>
	</div>
<!-- PHP Include relevant apps here -->
<?php include 'apps/media/audio/app.php';?>
</body>
</html>
