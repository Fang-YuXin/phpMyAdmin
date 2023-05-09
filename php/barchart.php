<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
	<?php

$link = Mysqli_connect("localhost","a0230","pwd0230");
Mysqli_select_db($link,"a0230");



$sqlstr1 = "SELECT COUNT(*) FROM member WHERE birthday>='1980-01-01' AND birthday<='1985-12-31'";
$sqlstr2 = "SELECT COUNT(*) FROM member WHERE birthday>='1986-01-01' AND birthday<='1990-12-31'";
$sqlstr3 = "SELECT COUNT(*) FROM member WHERE birthday>='1991-01-01' AND birthday<='1995-12-31'";
$sqlstr4 = "SELECT COUNT(*) FROM member WHERE birthday>='1996-01-01' AND birthday<='2000-12-31'";
$sqlstr5 = "SELECT COUNT(*) FROM member WHERE birthday>='2001-01-01' ";
	
$result1 = Mysqli_query($link,$sqlstr1);
$result2 = Mysqli_query($link,$sqlstr2);
$result3 = Mysqli_query($link,$sqlstr3);
$result4 = Mysqli_query($link,$sqlstr4);
$result5 = Mysqli_query($link,$sqlstr5);



Mysqli_free_result($result1);
Mysqli_free_result($result2);
Mysqli_free_result($result3);
Mysqli_free_result($result4);
Mysqli_free_result($result5);
Mysqli_close($link);

?>
</body>
</html>