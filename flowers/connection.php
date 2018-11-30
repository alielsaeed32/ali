<?php
session_start();
$con=mysql_connect('localhost','root','','flowers');
mysql_query('use flowers');
if(!$con){
	die('error in the connection of database flowers');
}
?>