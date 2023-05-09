<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<?php
	session_start();

	$link = mysqli_connect("localhost","a0230","pwd0230");
	mysqli_query($link,'SET NAMES UTF8');
	mysqli_select_db($link,"a0230");

	$mid= $_SESSION['mid'];
	for($i=0;$i<intval(strlen($mid));$i++)
	{
		if(($mid[$i]!="0")&($mid[$i]!="m"))
			{
			break;
			}
		
	}

	$number = substr($mid,$i);
	
	$row1 = "cart_$number";
	$sqlstr = "SELECT * FROM $row1";
	$result = mysqli_query($link, $sqlstr);
	$maxrow = mysqli_num_rows($result);


	

	for($i = 0;$i < $maxrow; $i++)
	{
	$row = mysqli_fetch_row($result);

	echo
	"<table width='1050' action='delete.php' method='GET'>
	  <tr style='text-align: center;' >
	    <td class='col-1'>$row[1]</td>
	    <td class='col-2'><img src=../$row[2] style='background-size:contain;height:75px'></td>
	    <td class='col-2'>$row[3]</td>
	    <td class='col-2'>$row[4]</td>
	    <td class='col-2'>$row[5]</td>
	    <td class='col-2'>$row[6]</td>
	    <td class='col-1'><button1 id='$row[1]' class='btn btn-outline-info' type='submit'>delete</button1></td>
	    <script>
        var btn = document.getElementsByTagName('button1');
        document.body.onclick = function(event){    //冒泡处理
            var id = event.target.id;
            console.log(id);
            location.href='delete.php?id=' +id;
        }
      </script>
	  </tr>
	</table>
	  ";
	}

	mysqli_free_result($result);
	mysqli_close($link);
?>

<!-- <td><a href='delete.php?id= $row[2]'>删除</a></td> -->
</body>
</html>