<?php
ob_start();
session_start();
require"connection.php";
if(time()>($_SESSION['start_cart']+60*60*1000)){
	unset($_SESSION['cart']);
}
header("Cache-Control: no-cache, must-revalidate");	
header("Expires: Thu, 31 May 1984 04:35:00 GMT");	
if($_SESSION['cart']){
	echo "<table border=3><tr><th>name</th><th>img</th><th>price</th><th>quantity</th><th>total</th></tr>";
	$total=0;
	foreach($_SESSION['cart'] as $k=>$v){
		$q=mysql_query("select * from products where id='$k'");
		$r=mysql_fetch_assoc($q);
		$total_cost=$r['price']*$v;
		$total+=$total_cost;
		echo "<tr><td>$r[name]</td><td><img src=$r[img] width=100px height=100px></td>
		<td>$r[price] \$</td><td>$v</td><td>$total_cost \$</td></tr>";
	}
	echo "</table>";
	$shopping=20;
	$total+=$shopping;
	echo "<h2>total cost: $total \$</h2>";
}
else
	echo "Empty Cart <br>";
echo "<a href='index.php' style='width:160px;height:50px;padding:4 20px;border-radius:8px;
text-decoration:none;background-color:#ad58b8;text-align:center;'>Continue Shopping</a>";	

?>