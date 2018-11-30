<?php
ob_start();
session_start();
require 'connection.php';
if($_POST['h']){
	$user=htmlentities($_POST['user']);
	$password=htmlentities($_POST['password']);
	$q=mysql_query("select * from customers where username='$user' and password=$password limit 1");
	if(mysql_num_rows($q)>0){
		$r=mysql_fetch_assoc($q);
		$_SESSION['user_id']=$r['id'];
		echo"<h2 style='text-align:center;color:green'>welcome $user <br>you will redirected after 3 second</h2>";
		header("Refresh:3;url=index.php");
	}
	else{
	    echo"<h2 style='text-align:center;color:green'>invalid username or password <br>you will be redirected after 3 seconds</h2>";
		header("Refresh:3;url=login.php");
	}
}
ob_flush();
?>