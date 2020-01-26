<!--

var theme = "crystal";

function init() {}

function goout(num) {
document.getElementById("moon"+num).style.top=Math.floor(600-228*Math.sin((30*num*3.14159)/180))+"px";
document.getElementById("moon"+num).style.left=Math.floor(500+228*Math.cos((30*num*3.14159)/180))+"px";
document.getElementById("text"+num).style.top=Math.floor(600-228*Math.sin((30*num*3.14159)/180))+80+"px";
document.getElementById("text"+num).style.left=Math.floor(500+228*Math.cos((30*num*3.14159)/180))+"px";
document.getElementById("text"+num).style.display="block";
}
function goin(num) {
document.getElementById("moon"+num).style.top=Math.floor(600-220*Math.sin((30*num*3.14159)/180))+"px";
document.getElementById("moon"+num).style.left=Math.floor(500+220*Math.cos((30*num*3.14159)/180))+"px";
document.getElementById("text"+num).style.top=Math.floor(600-220*Math.sin((30*num*3.14159)/180))+80+"px";
document.getElementById("text"+num).style.left=Math.floor(500+220*Math.cos((30*num*3.14159)/180))+"px";
document.getElementById("text"+num).style.display="none";
}

function internet() {

/*
document.getElementById('earth').src="back.png";
*/

document.getElementById('earth').onclick= menu;

document.getElementById('moon1').src="themes/"+theme+"/browser.png";
document.getElementById('moon1').onclick = startapp('browser');
document.getElementById('text1').innerHTML="Browser";

document.getElementById('moon2').src="themes/"+theme+"/email.png";
document.getElementById('moon2').onclick = startapp('email');
document.getElementById('text2').innerHTML="Email";

document.getElementById('moon3').src="themes/"+theme+"/messenger.png";
document.getElementById('moon3').onclick = startapp('messenger');
document.getElementById('text3').innerHTML="Messenger";

document.getElementById('moon4').src="themes/"+theme+"/blog.png";
document.getElementById('moon4').onclick = startapp('blog');
document.getElementById('text4').innerHTML="Blog";

document.getElementById('moon5').src="themes/"+theme+"/phone.png";
document.getElementById('moon5').onclick=startapp('phone');
document.getElementById('text5').innerHTML= "Phone";

}

function work() {
// fancychange();

/*
document.getElementById('earth').src="back.png";
*/
document.getElementById('earth').onclick= menu;

document.getElementById('moon1').src="themes/"+theme+"/writer.png";
document.getElementById('moon1').onclick = startapp("writer");
document.getElementById('text1').innerHTML="Writer";

document.getElementById('moon2').src="themes/"+theme+"/spreadsheet.png";
document.getElementById('moon2').onclick = startapp("preadsheet");
document.getElementById('text2').innerHTML="Spreadsheet";

document.getElementById('moon3').src="themes/"+theme+"/presenter.png";
document.getElementById('moon3').onclick = startapp("presenter");
document.getElementById('text3').innerHTML="Presenter";

document.getElementById('moon4').src="themes/"+theme+"/drawing.png";
document.getElementById('moon4').onclick = startapp("drawing");
document.getElementById('text4').innerHTML="Drawing";

document.getElementById('moon5').src="themes/"+theme+"/dictionary.png";
document.getElementById('moon5').onclick = startapp("dictionary");
document.getElementById('text5').innerHTML= "Dictionary";

}

function games() {
// fancychange();
/*
document.getElementById('earth').src="back.png";

*/

document.getElementById('earth').onclick= menu;

document.getElementById('moon1').src="themes/"+theme+"/tetris.png";
document.getElementById('moon1').onclick = startapp("tetris");
document.getElementById('text1').innerHTML="Tetris";

document.getElementById('moon2').src="themes/"+theme+"/pong.png";
document.getElementById('moon2').onclick = startapp("pong");
document.getElementById('text2').innerHTML="Pong";

document.getElementById('moon3').src="themes/"+theme+"/pacman.png";
document.getElementById('moon3').onclick = startapp("pacman");
document.getElementById('text3').innerHTML="Pacman";

document.getElementById('moon4').src="themes/"+theme+"/potud.png";
document.getElementById('moon4').onclick = startapp("potud");
document.getElementById('text4').innerHTML="PotUD";

document.getElementById('moon5').src="themes/"+theme+"/gamestore.png";
document.getElementById('moon5').onclick=startapp("gamestore");
document.getElementById('text5').innerHTML= "Game Store";

}

function media() {
// fancychange();
/*
document.getElementById('earth').src="back.png";
*/
document.getElementById('earth').onclick= menu;


document.getElementById('moon1').src="themes/"+theme+"/audio.png";
document.getElementById('moon1').onclick = startapp("audio");
document.getElementById('text1').innerHTML="Audio Player";

document.getElementById('moon2').src="themes/"+theme+"/video.png";
document.getElementById('moon2').onclick = startapp("video");
document.getElementById('text2').innerHTML="Video Player";

document.getElementById('moon3').src="themes/"+theme+"/pictures.png";
document.getElementById('moon3').onclick = startapp("pictures");
document.getElementById('text3').innerHTML="Pictures";

document.getElementById('moon4').src="themes/"+theme+"/camera.png";
document.getElementById('moon4').onclick = startapp("camera");
document.getElementById('text4').innerHTML="Camera";

document.getElementById('moon5').src="themes/"+theme+"/creator.png";
document.getElementById('moon5').onclick=startapp("creator");
document.getElementById('text5').innerHTML= "Creator";

}

function more() {

// fancychange();
/*
document.getElementById('earth').src="back.png";
*/
document.getElementById('earth').onclick= menu;


document.getElementById('moon1').src="themes/"+theme+"/appstore.png";
document.getElementById('moon1').onclick = startapp("appstore");
document.getElementById('text1').innerHTML="App Store";

document.getElementById('moon2').src="themes/"+theme+"/background.png";
document.getElementById('moon2').onclick = startapp("background");
document.getElementById('text2').innerHTML="Change Background";

document.getElementById('moon3').src="themes/"+theme+"/userinfo.png";
document.getElementById('moon3').onclick = startapp("userinfo");
document.getElementById('text3').innerHTML="User Info";

document.getElementById('moon4').src="themes/"+theme+"theme.png";
document.getElementById('moon4').onclick = startapp("theme");
document.getElementById('text4').innerHTML="Theme";

document.getElementById('moon5').src="themes/"+theme+"/upload.png";
document.getElementById('moon5').onclick=startapp("upload");
document.getElementById('text5').innerHTML= "Upload";



}
//	End App Categories
//	Begin Menu Switchback
function menu() {
// fancychange();
document.getElementById('earth').src="themes/"+theme+"/menulogo.png";
document.getElementById('earth').onclick="";
document.getElementById('moon1').src="themes/"+theme+"/internet.png";
document.getElementById('moon1').onclick = internet;

document.getElementById('moon2').src="themes/"+theme+"/work.png";
document.getElementById('moon2').onclick = work;

document.getElementById('moon3').src="themes/"+theme+"/games.png";
document.getElementById('moon3').onclick = games;

document.getElementById('moon4').src="themes/"+theme+"/media.png";
document.getElementById('moon4').onclick = media;

document.getElementById('moon5').src="themes/"+theme+"/more.png";
document.getElementById('moon5').onclick = more;

document.getElementById('text1').innerHTML="Internet";
document.getElementById('text2').innerHTML="Work";
document.getElementById('text3').innerHTML="Games";
document.getElementById('text4').innerHTML="Media";
document.getElementById('text5').innerHTML="More";

}
//	End Menu Switchback
//	Start App Function
function startapp(app) {
/*
if (document.getElementById(app).style.display=="block") {
document.getElementById(app).style.display="none"; }
else {document.getElementById(app).style.display="block";}
*/
}
// -->
