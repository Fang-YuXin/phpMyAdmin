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

	$email=$_POST['email'];//post獲取表單裡的name
	$pwd=$_POST['Password'];

	if ($email && $pwd){//如果使用者名稱和密碼都不為空
		$sql = "SELECT mid,email,pwd FROM member WHERE email='$email' and pwd='$pwd'";//檢測資料庫是否有對應的username和password的sql
		$result =  mysqli_query($link,$sql);//執行sql
		$rows=mysqli_num_rows($result);//返回一個數值
		if($email == 'S999@ncue.edu.tw' && $pwd='a12345'){ 
			echo "<script type='text/javascript'>alert('管理者登入成功');</script>";
			header("refresh:0;url=../administrator.html");
		}
		elseif($rows){//0 false 1 true
		$result =  mysqli_query($link,$sql);//執行sql
		$row = mysqli_fetch_row($result);
		if ($row[1] == $email && $row[2] == $pwd) {
        $_SESSION['mid'] = $row[0];
    	}
		header("refresh:0;url=../allitem_.html");//如果成功跳轉至welcome.html頁面
		exit;



		}
		else{
		echo "<script type='text/javascript'>alert('使用者名稱或密碼錯誤');</script>";
		echo"<script>
		setTimeout(function(){window.location.href='../login.html';},1000);
		</script>;";//如果錯誤使用js 1秒後跳轉到登入頁面重試;
		}
	}
	else{//如果使用者名稱或密碼有空
	echo "<script type='text/javascript'>alert('表單填寫不完整');</script>";
	echo"
	<script>
	setTimeout(function(){window.location.href='../login.html';},1000);
	</script>;";
	//如果錯誤使用js 1秒後跳轉到登入頁面重試;
	}


	//購物車
	// if ($row[6] == $email && $row[7] == $pwd) {
 //        $_SESSION['mid'] = $row[0];
 //    } 

	mysqli_free_result($result);
	mysqli_close($link);;//關閉資料庫
	?>





</body>
</html>
