<?php
$con=mysql_connect('localhost','root','');
if(!$con){
	die('the error in connect to server localhost');
}
$q=mysql_query('create database if not exists flowers');
if(!$q){echo "error in create data base";}
mysql_query('use flowers');
$q=mysql_query("create table if not exists customers(
id int not null auto_increment primary key,
username varchar(100),
passowrd varchar(100),
phone varchar(11),

address varchar(50)
)
");
if(!$q){echo mysql_error();}
$q=mysql_query('create table if not exists categories(
id int not null auto_increment primary key,
name varchar(100)
)');
if(!$q){echo mysql_error();}
mysql_query("insert into categories values('','Next Day Flowers'),('','Best Seller'),('','Birthday Flowers'),('','Sympathy Flowers')");
$q=mysql_query('create table if not exists products(
id int not null auto_increment primary key,
cat_id int not null,
name varchar(100),
image varchar(100),
price varchar(50),
offer_price varchar(50),
sales int,
description text,
origin varchar(50)
)');
if(!$q){echo mysql_error();}
$q=mysql_query("insert into products values
('','1','name1','images/1.jpg','50.35','28.45',3,'this is a flower description','paris')
,('',1,'name2','images/2.jpg',50.35,28.45,3,'this is a flower description','England')
,('',1,'name3','images/3.jpg',44.50,24.70,3,'this is a flower description','paris')
,('',1,'name4','images/4.jpg',44.50,24.70,3,'this is a flower description','England')
,('',2,'name1','images/5.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',2,'name2','images/6.jpg',50.35,28.45,3,'this is a flower description','England')
,('',2,'name3','images/7.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',2,'name4','images/8.jpg',44.50,24.70,3,'this is a flower description','paris')
,('',3,'name1','images/9.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',3,'name2','images/10.jpg',50.35,28.45,3,'this is a flower description','England')
,('',3,'name3','images/11.jpg',50.35,28.45,7,'this is a flower description','paris')
,('',4,'name4','images/12.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',4,'name1','images/13.jpg',44.50,24.70,3,'this is a flower description','paris')
,('',2,'name2','images/14.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',3,'name3','images/15.jpg',44.50,24.70,3,'this is a flower description','paris')
,('',3,'name4','images/16.jpg',50.35,28.45,3,'this is a flower description','England')
,('',3,'name1','images/17.jpg',44.50,24.70,3,'this is a flower description','paris')
,('',2,'name2','images/18.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',1,'name3','images/19.jpg',50.35,28.45,3,'this is a flower description','paris')
,('',1,'name4','images/20.jpg',44.50,24.70,3,'this is a flower description','England')
");
if(!$q){echo mysql_error();}
$q=mysql_query('create table if not exists orders(
id int not null auto_increment primary key,
cust_id int not null,
name varchar(100),
code varchar(100),
company varchar(100),
street varchar(100),
line  varchar(100),
town varchar(100),
country varchar(100),
phone varchar(11),
date varchar(20),
price varchar(20)
)');
if(!$q){echo mysql_error();}
?>