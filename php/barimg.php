<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>qqqq</title>
<link href="css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
</head>


<body class="sb-nav-fixed">     
<?php
        include 'barchart.php';
        $img=imagecreate(800,500);                      //建構圖片
        $w=imagecolorallocate($img,255,255,255);        //配置白色
        $bl=imagecolorallocate($img,0,0,0);             //配置黑色
        $bw=imagecolorallocate($img,150,150,150);       //配置灰色
        $red=imagecolorallocate($img,255,0,0);          //配置紅色
        
        imagefill($img,0,0,$w);                         //背景填滿白色
        imageline($img,70,20,70,470,$bw);               //畫縱軸
        imageline($img,70,470,700,470,$bw);             //畫橫軸
        
        
        $bg[0]=0;        //火
        $bg[1]=0;        //水
        $bg[2]=0;        //電
        $bg[3]=0;
        $bg[4]=0;
        $row= $db -> query("SELECT COUNT(*) FROM member WHERE birthday>='1980-01-01' AND birthday<='1985-12-31'");
        foreach($row as $ret){
                switch($ret['bg']){
                        case "火":
                                $bg[0]++;
                                break;
                        case "水":
                                $bg[1]++;
                                break;
                        case "電":
                                $bg[2]++;
                                break;
                }
        }
        if($bg[0]>=$bg[1] && $bg[0]>=$bg[2]){
                $sp = $bg[0];
        }else if($bg[1]>= $bg[2]){
                $sp = $bg[1];
        }else{
                $sp = $bg[2];
        }
        $allsp = pow(10,strlen($sp));
        $exsp = $allsp / 100;
        
        for($i=0;$i<=10;$i++){
                imageline($img,68,20+45*$i,700,20+45*$i,$bw);
                imagefttext($img,10,0,10,25+45*$i,$bl,'DFTT_NM9.TTC',$allsp/10*(10-$i));
        }
        
        $nme1 = "屬性";
        imagefttext($img,15,0,720,480,$bl,'DFTT_NM9.TTC',$nme1);
        
        for($i = 0; $i <= 2; $i++){
                imageline($img,280+($i*210),468,280+($i*210),472,$bw);
                imagefilledrectangle($img,165+210*$i,470,185+210*$i,470-$bg[$i]/$exsp*4.5,$red);
                imagefttext($img,10,0,165+210*$i,465-$bg[$i]/$exsp*4.5,$bl,'DFTT_NM9.TTC',$bg[$i]);
                switch($i){
                        case 0:
                                $nme2 = "火";
                                break;
                        case 1:
                                $nme2 = "水";
                                break;
                        case 2:
                                $nme2 = "電";
                }
                imagefttext($img,17,0,165+210*$i,492,$bl,'DFTT_NM9.TTC',$nme2);
        }
        
        imagepng($img);                                                                //製成png
        imagedestroy($img);                                                        //銷毀圖片
?>
</body>
</html>