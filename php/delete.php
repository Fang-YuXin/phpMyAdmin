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

	
	$mid= $_SESSION['mid'];
     $pid = $_GET['id'];
     $pnum = intval(0);
//會員的購物車名稱
	for($i=0;$i<intval(strlen($mid));$i++)
	{
		if(($mid[$i]!="0")&($mid[$i]!="m"))
			{
			    break;
			}
	}
	$number = substr($mid,$i);
	$row1 = "cart_$number";


//找商品的數量
	$sqlstr1 = "SELECT pnum from $row1 where pid = '$pid'";
     $result1 = mysqli_query($link, $sqlstr1);
     $maxrow1 = mysqli_num_rows($result1);
     for($i = 0;$i < $maxrow1; $i++)
     {
     $row = mysqli_fetch_row($result1);
     $pnum = $row[0];
     }
	
	if ($pnum == 1) {//pnum=1 整行刪掉
     	$sql2="DELETE FROM $row1 WHERE pid='$pid'";
     	$result2 = mysqli_query($link,$sql2);
     	echo "<script>alert('刪除成功!')</script>";
     	header("refresh:0;url=cart.php");		
	}

	else if ($pnum > 1) 
     
     {//pnum!=1  pnum-1
		$sql3 = "SELECT pid,pname,price,pnum FROM $row1 WHERE pid = '$pid'";
		$result3 = mysqli_query($link, $sql3);
		$maxrow = mysqli_num_rows($result3);
		for($i = 0;$i < $maxrow; $i++)
		{
            $row = mysqli_fetch_row($result3);
            $pnum = intval($row[3]-1);
            $total = intval($row[2])*intval($pnum);
            $sql3 = "UPDATE $row1 SET mid='$mid',pnum=$pnum,totalprice=$total WHERE pid='$pid'";
            mysqli_query($link, $sql3);
            echo "<script>alert('已成功更改購買商品數量!')</script>";
            header("refresh:0;url=cart.php");
            mysqli_free_result($result3);}}

     else{
          header("refresh:0;url=cart.php");
     }
	

	
	mysqli_free_result($result1);
	mysqli_close($link);;//關閉資料庫
	

?>	
</body>
</html>