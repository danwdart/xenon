<div id="audio" style="position: absolute;width: 200px;height: 400px;left: 50px;top: 50px;background-color: black;color: white;display:none;">
<audio id="music" controls="1" src="user/water.ogg">Needs HTML5 Browser!</audio>
<p>
<img src="player_play.png" onclick="document.getElementById('music').play();" alt="" />
<img src="player_pause.png" onclick="document.getElementById('music').pause();" alt="" />
<p><a href="#" onclick="document.getElementById('music').src='user/water.ogg';">Water - SaReGaMa</a></p>

<!--
<p>Music Search:</p>
<p>Artist: <input type="text" id="artist" /></p>
<p>Track: <input type="text" id="track" /></p>
<input type="button" value="Search" onclick="document.getElementById('music').src='http://api.jamendo.com/get2/stream/track/redirect?streamencoding=ogg2&artist=' + document.getElementById('artist') + '&name='+document.getElementById('name');" />
</p>
-->
</div>
