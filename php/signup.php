<!doctype html>
<html lang="zh-Hant-TW">
<head>
<meta charset="utf-8">
<title>Regist</title>
</head>

<body>
<?php

	$link = mysqli_connect("localhost","a0230","pwd0230");
	mysqli_select_db($link,"a0230");

	$name = $_POST['name'];
	$email = $_POST['email'];
	$pwd = $_POST['password'];
	$ID = $_POST['id'];
	$birthday = $_POST['birthday'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	

	$catch = "SELECT * FROM member;";
	$result = mysqli_query($link,$catch);
	$maxrow = mysqli_num_rows($result);
	$string1 = strval($maxrow);
	$row = "m0000$string1";
	$cart="cart_$string1";
	mysqli_query($link,"SET NAMES UTF8");

$sql = "INSERT INTO member (`mId`, `ID`, `name`, `birthday`, `phone`, `address`, `email`, `pwd`)VALUES ('".$row."','".$ID."','".$name."','".$birthday."','".$phone."','".$address."','".$email."','".$pwd."') ; ";
$sql .="CREATE TABLE $cart (mid char(8) NOT NULL,pid char(6) NOT NULL,pname varchar(30) CHARACTER SET big5 COLLATE big5_chinese_ci NOT NULL,price INT NOT NULL,pnum INT NOT NULL, totalprice INT NOT NULL,PRIMARY KEY(mid,pid)); ";

	mysqli_multi_query ( $link ,  $sql ); 
// mysqli_query($link,$sqlstr&$newcart);

header("Location:../login.html");
mysqli_free_result($result);
mysqli_close($link);

?>

</body>
</html>