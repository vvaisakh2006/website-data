<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass =  'xxxxxxx';
$dbnm='database';
$con = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbnm,$con) or die(mysql_error());
?>