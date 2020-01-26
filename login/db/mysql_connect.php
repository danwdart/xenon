<?php
// CHANGE THESE VALUES
DEFINE ('DB_USER', 'xenonproject_xenon');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'sql');
DEFINE ('DB_NAME', 'xenonproject_xenon');
 
$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Error while connecting to the database of Xenon: ' . mysql_error());
@mysql_select_db (DB_NAME) OR die('Error while connecting to the database of Xenon: ' . mysql_error() ); 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
?>
