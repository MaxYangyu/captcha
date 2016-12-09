<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5
 * Time: 20:21
 */
session_start();//开启session

$image = imagecreatetruecolor(200,60);
$color = imagecolorallocate($image,255,255,255);
imagefill($image,0,0,$color); //铺满画布
//数字验证码
/*
for ($i=0;$i<4;$i++){
    $fontsize = 6;//字体大小
    $fontcolor = imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));//字体颜 （0-120为深色）
    $fontcontent =rand(0,9);//字为随机
    $x = ($i*25)+rand(5,10);
    $y = rand(5,10);
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
*/
$size = './simkai.ttf';
$scr ='大数据时代背景下机器学习在各行各业都有广泛应用本课对机器学习做入门级介绍主要介绍机器学习的概念典型的行业案例并对比机器学习和传统数据分析的差别一些经典的算法最后是Demo演示';
$strdb = str_split($scr,3);
$captch_code = '';
for ($i=0;$i<4;$i++) {
    $fontcolor = imagecolorallocate($image,rand(0, 120), rand(0, 120), rand(0,120));
    $index = rand(0,count($strdb));
    $cn = $strdb[$index];
    $captch_code .= $cn;
    imagettftext($image, mt_rand(20, 24), mt_rand(-60, 60), (40 * $i + 20), mt_rand(30, 35), $fontcolor, $size, $cn);
        }
$_SESSION['authcode'] = $captch_code;

for ($i=0;$i<200;$i++){
    $black = imagecolorallocate($image,rand(5,200),rand(5,200),rand(5,200));
    imagesetpixel($image,rand(0,199),rand(0,59),$black);
}

for ($i=0;$i<8;$i++) {
    $linecolor = imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
    imageline($image,rand(0,199),rand(0,59),rand(0,199),rand(0,59),$linecolor);
}

header("Content-type:image/jpeg");
imagejpeg($image);
imagedestroy($image);