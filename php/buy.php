<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
	session_start();


	$link = mysqli_connect("localhost","a0230","pwd0230");
	mysqli_query($link,'SET NAMES UTF8');
	mysqli_select_db($link,"a0230");

	$pid = $_GET['id']; //等於button的value 等於product的pid
	$mid= $_SESSION['mid'];
	$pnum = intval(1);

//會員的cart編號
	for($i=0;$i<intval(strlen($mid));$i++)
	{
		if(($mid[$i]!="0")&($mid[$i]!="m"))
			{
			break;
			}
	}
	$number = substr($mid,$i);
	$row1 = "cart_$number";

//
	$sql2 = "SELECT * from $row1 where pid = '$pid'";
	$result2 = mysqli_query($link,$sql2);
	$maxrow = intval(mysqli_num_rows($result2));
	if ($maxrow == 1) {
		$sql1 = "SELECT pid,pphoto,pname,price,pnum FROM $row1 WHERE pid = '$pid'";
		$result1 = mysqli_query($link, $sql1);
		$maxrow = mysqli_num_rows($result1);
		for($i = 0;$i < $maxrow; $i++)
		{
		$row = mysqli_fetch_row($result1);
		$pnum = intval($row[4]+1);
		$total = intval($row[3])*intval($pnum);
		$sql3 = "UPDATE $row1 SET mid='$mid',pnum=$pnum,totalprice=$total WHERE pid='$pid'";
		mysqli_query($link, $sql3);
		echo "<script>alert('已成功更改購買商品數量!')</script>";
		header("refresh:0;url=../allitem_.html");
		mysqli_free_result($result1);
	}}

	else{
	$sql3 = "SELECT pid,pphoto,pname,price FROM product WHERE pid = '$pid'";

	$result3 = mysqli_query($link, $sql3);
	$maxrow = mysqli_num_rows($result3);

	for($i = 0;$i < $maxrow; $i++)
	{
	$row = mysqli_fetch_row($result3);
	$total = intval($row[3])*intval($pnum);
	$sql4 = "INSERT INTO $row1 (`mid`, `pid`,`pphoto`, `pname`, `price`, `pnum`, `totalprice`) VALUES ('$mid','$pid','$row[1]','$row[2]',$row[3],$pnum,$total)";
	mysqli_query($link, $sql4);
	echo "<script>alert('已成功加入購物車!')</script>";
	header("refresh:0;url=../allitem_.html");
	mysqli_free_result($result3);
	}}

	
	mysqli_free_result($result2);
	
	mysqli_close($link);;//關閉資料庫
	

?>	
</body>
</html>