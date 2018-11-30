<?php
ob_start();
session_start();
require "connection.php";
if($_POST['h']){
	$user=htmlentities($_POST['user']);
	$password=htmlentities($_POST['password']);
	$rpassword=htmlentities($_POST['rpassword']);
	$phone=htmlentities($_POST['phone']);
	$address=htmlentities($_POST['address']);
	$user=strstr($user,array("'"=>"/'","_"=>"/_","%"=>"/%"));
	$password=strstr($password,array("'"=>"/'","_"=>"/_","%"=>"/%"));
	$rpassword=strstr($rpassword,array("'"=>"/'","_"=>"/_","%"=>"/%"));
	$phone=strstr($phone,array("'"=>"/'","_"=>"/_","%"=>"/%"));
	$address=strstr($address,array("'"=>"/'","_"=>"/_","%"=>"/%"));
}
if($error=valid_form()){
	show($error);
}
else{
	$q=mysql_query("select * from customers where username='$user'");
	if(mysql_num_rows($q)>0){
		echo"<h2>the username $user already registered <br>you will be redirected after 3 seconds</h2>";
		header("Refresh:3;url=register.php");
	}
	else{
		$q=mysql_query("insert into customers values('','$user','$password','$address','$phone')");
		if($q){
			$_SESSION['user_id']=mysql_insert_id();
			echo "<h2 style='text-align:center;color:green'>successfully registered the username $user <br>you will be redirected after 3 seconds</h2>";
			header("Resfresh:3;url=index.php");
		}
		else{
			echo mysql_error();
		}
	}
}
function valid_form(){
	global $user,$password,$rpassword;
	$error=array();
	if(strlen($password)<=8||!preg_match("#[a-z]#",$password)||!preg_match("#[A-Z]#",$password)||!preg_match("#[/d]#",$password)){
		$error['password']='the password should be strong longer than 8 symbols has capital and small letters, and numbers';
	}
	if($password!=$rpassword){
		$error['rpassword']='the two passwords must be identical';
	}
}
function show($error=''){
global $user,$password,$rpassword,$address,$phone;
?>
<html>
<head>
<title>registration</title>
</head>
<body>
<form method='post' action='register_process'>
<table>
<tr>
<td>username:</td><td><input type='text' name='user'<?php echo "value='" . $user. " ' ></td> ";
if($error['user']){echo "<td style='color:red'>".$error['user']."</td>";}?>
</tr>
<tr>
<td>password:</td><td><input type='password' name='password'<?php echo "value='" . $password. " ' ></td> ";
if($error['password']){echo "<td style='color:red'>".$error['password']."</td>";}?>
</tr>
<tr>
<td>re-enter password:</td><td><input type='password' name='rpassword'<?php echo "value='" . $rpassword. " ' ></td> ";
if($error['rpassword']){echo "<td style='color:red'>".$error['rpassword']."</td>";}?>
<tr>
<td>phone:</td><td><input type='text' name='phone'></td>
</tr>
<tr>
<td>address:</td><td><input type='text' name='address'></td>
</tr>
</tr>
</table>
<input type='hidden'name='h' value='1'>
<input type='submit' name='submit' value='submit'>
</form>
<a href='index.php' style='text-align:center;display:block;margin-left:20px;width:150px;background-color:#ad58b8;pading:20px;font-size:20px;color:white;padding:10px;text-decoration:none'>got to home page</a>
</body>
</html>
	
	<?php
}
ob_flush();
?>