<?php
ob_start();
session_start();
require 'connection.php';
if(time()>$_SESSION['cart_start']+60*60*1000){
	unset($_SESSION['cart']);
}
header("Cache-Control:no-cache, must-revalidate");
header("Expires:Thu,31 May 1984 04:35:00 GMT");
?>
<html>
<head>
<title>my website</title>
<link rel="stylesheet" href='css/style.css'>
</head>
<body>
<div id="container">
  <div id="header">
   <?php
   if($_SESSION['user_id']){
	   echo "<a href'logout.php'>Log Out</a><br>";
   }
   else{
	   echo "<a href='register.php'>Register</a> or <a href='login.php'>Log In</a>";
   }
   ?>
   <div id="cart">
   <a href='viewcart.php'><img src="images/nb-vcO.gif"></a>
   <?php
    if($_SESSION['cart']){
		$count=count($_SESSION['cart']);
			echo "$count item total";
			$total=0;
			foreach($_SESSION['cart']as $k=>$val){
				$q=mysql_query("select * from products where id='$k'");
				$r=mysql_fetch_assoc($q);
				$total_cost=$r['price'];
				$total+=$total_cost;
			}
			$shipping=20;
			$total+=$shipping;
			echo"$total";
		}
		else{
			echo"total: 0.0";
		}
		
	?>
	<a href="index.php" style="width:160px;height:50px;padding:4 20px;border-radius:8px;text-decoration:none;background-color:#ad58b8;text-align:center;">Continue Shopping</a>	
   
   </div>
  </div>
  	<br clear=both>
			<form method=get action='search.php'>
				<input type="text" name="key" placeholder="Search for...">
				<input type="submit" value="Search" style="width:70px;height:24px;padding:3px 18px;background-color:green;color:white;line-height:10px;">
	</form>
	<div id='content'>
	<div id='con1'>
	 <div id='best'>
	 <?php
	    $q=mysql_query("select * from products order by sales desc limit 1");
		if($q){
			$r=mysql_fetch_assoc($q);
			$id=$r['id'];
			$img=$r['image'];
			$name=$r['name'];
			$price=$r['price'];
			$ofer_price=$r['ofer_price'];
			$description=$r['description'];
			echo"<img src='$img'><br>$name<br>";
			if($price_ofer){
				echo "<del><span  class='price'>$price \$</span></del><span  class='offer_price'> $offer_price \$</span>";
			}
			echo"<br>$description<br><a class='order_now' href='addtocart.php?id=$id'>order now</a> ";
		}
	 ?>
	 </div>
	 <img class="c" src="images/236x304x40_roses_callout.jpg">
	 <img class="c" src="images/236x304x40_roses_callout.jpg">
	</div>
	<?php
	$qc=mysql_query("select * from categories limit 4");
	if($qc){
		while($rc=mysql_fetch_assoc($qc)){
			$cat_id=$rc['id'];
			$cat_name=$rc['name'];
			$qp=mysql_query("select * from products where cat_id='$cat_id' order by id desc limit 1");
			if($qp){
				$rp=mysql_fetch_assoc($qp);
			$img=$rp['image'];
			$name=$rp['name'];
			$price=$rp['price'];
			$ofer_price=$rp['ofer_price'];
			$description=$rp['description'];
			echo"<div class='product'>
			 <h3>$cat_name</h3>
			 <img src='$img'><br>$name<br>$description<br>";
			 if($ofer_price){
				 echo "from <del><span  class='price'>$price \$</span></del> <span  class='offer_price'>$offer_price \$</span>";
			 }
			 else{
			    echo "<span  class='price'>$price \$</span>";}
			echo"<br><a class='order_now' href='addtocart.php?id=$rp[id]'>order now</a></div>";
			 
			
			}
		}
	}
	?>
	<hr>
	<br clear='left'>
	<?php
	$q=mysql_query("select * from products order by id desc limit 3");
	if($q){
		while($r=mysql_fetch_assoc($q)){
			$id=$r['id'];
			$img=$r['image'];
			$name=$r['name'];
			$price=$r['price'];
			$ofer_price=$r['ofer_price'];
			$description=$r['description'];
			echo"<div class='product2'>
			<img src='$img'><br>$name<br>$description<br>";
			if($ofer_price){
				echo "from <del><span  class='price'>$price \$</span></del> <span  class='offer_price'>$offer_price \$</span>";
			}
			else{
				echo "<span  class='price'>$price \$</span>";
			}
			echo"<br><a class='order_now' href='addtocart.php?id=$id'>order now</a></div>";
			
		}
	}
	ob_flush();
	?>
	</div>
	<div id='footer'></div>
</div>
</body>
</html>