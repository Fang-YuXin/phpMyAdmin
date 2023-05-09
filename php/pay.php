<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<?php
	session_start();

	$link = mysqli_connect("localhost","a0230","pwd0230");
	mysqli_query($link,'SET NAMES UTF8');
	mysqli_select_db($link,"a0230");
	
	
	$mid = $_SESSION['mid'];
	$today = date("Y-m-d H:i:s");
	$payment = $_POST['payment'];
	$delivery = $_POST['delivery'];

	//找到會員的cart 
	for($i=0;$i<intval(strlen($mid));$i++)
	{
		if(($mid[$i]!="0")&($mid[$i]!="m"))
		{
		break;
		} 
	}
	$number = substr($mid, $i);
	$row1 = "cart_$number";

	//產生orderid
	$catch = "SELECT orderid FROM neworder GROUP BY(orderid);";
	$result1 = mysqli_query($link,$catch);
	$maxrow = mysqli_num_rows($result1);
	$string1 = strval($maxrow+1);
	$row2 = "t0000$string1";

	//會員購物車的資料(`mid`, `pid`, `pphoto`, `pname`, `price`, `pnum`, `totalprice`)
	$sqlstr2 = "SELECT * FROM $row1";
	$result2 = mysqli_query($link, $sqlstr2);
	$maxrow1 = mysqli_num_rows($result2);
	for($i = 0;$i < $maxrow1; $i++)
	{
	$row3 = mysqli_fetch_row($result2);

	//將資料新增到neworder	(`orderid`, `mid`, `orderdate`, `pid`, `pnum`, `totalprice`, `payment`, `productdelivery`)
	$sqlstr3 = "INSERT INTO neworder VALUES ('$row2','$mid','$today','$row3[1]',$row3[5],$row3[6],'$payment','$delivery');";
	mysqli_query($link, $sqlstr3);
	}

	//刪除會員購物車的資料
	$result2 = mysqli_query($link, $sqlstr2);
	$maxrow1 = mysqli_num_rows($result2);
	for($i = 0;$i < $maxrow1; $i++)
	{
	$row3 = mysqli_fetch_row($result2);
	$sqlstr4 = "DELETE FROM $row1 where pid = '$row3[1]';";
	mysqli_query($link, $sqlstr4);
}

		
	echo "<script>alert('感謝您的購物!')</script>";
	header("refresh:0;url=../home_.html");

	mysqli_free_result($result1);
	mysqli_free_result($result2);
	mysqli_close($link);

?>
</body>
</html>