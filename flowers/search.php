<?php
ob_flush();
session_start();
require "connection.php";
if(time()>$_SESSION['cart_start']+60*60*1000){
	unset($_SESSION['cart_start']);
}
header("Cache-Control: no-cache, must-revalidate");	
header("Expires: Thu, 31 May 1984 04:35:00 GMT");
$key=htmlentities($_GET['key']);
$key=strstr($key,array("'"=>"/'","_"=>"/_","%"=>"/%"));
$q=mysql_query("select * from products where name like '%k$key%' ");
if($q){
	echo "<table border=3><tr><th>name</th><th>img</th><th>price</th>
	<th>offer_price</th><th>sales</th><th>description</th><th>origin</th><th></th></tr>";
	while($r=mysql_fetch_assoc($q)){
		echo "<tr><td>$r[name]</td><td><img src='$r[img]' style='width:150px;height:150px;'></td><td>$r[price]</td>
		<td>$r[offer_price]</td><td>$r[sales]</td><td>$r[description]</td><td>$r[origin]</td>
		<td><a href='addtocart.php?prod_id=$r[prod_id]'>add to cart</a></td></tr>";
	}
	echo "</table>";
}
else
	echo "no results found<br>";
?>
<a href="index.php" style="width:160px;height:50px;padding:4 20px;border-radius:8px;text-decoration:none;background-color:#ad58b8;text-align:center;">go to home page</a>