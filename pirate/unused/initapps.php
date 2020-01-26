<?php
for ($n=1;$n<=25;$n++;) {
$appname[$n]=$mysql_query("SELECT app".$n." FROM apps WHERE username='".$username."'";
$applabel[$n]=$mysql_query("SELECT label FROM appinfo WHERE name='".$appname[$n]."'";
$appdesc[$n]=$mysql_query("SELECT description FROM appinfo WHERE name='".$appname[$n]."'";
$appicon[$n]="apps/internet/".$appname[$n]."/icon.png";
}
?>
