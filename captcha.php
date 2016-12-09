<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/5
 * Time: 20:21
 */
session_start();//开启session

$image = imagecreatetruecolor(100,30);
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
//字母数字混合
$captch_code = '';
for ($i=0;$i<4;$i++) {
    $fontsize = 6;//字体大小
    $fontcolor = imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
    $date =   '123456789abcdefghijklmnpqrstuvwxyz';
    $fontcontent =substr($date,rand(0,strlen($date)-1),1);

    $captch_code.=$fontcontent;

    $x = ($i*25)+rand(5,10);
    $y = rand(5,10);
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
$_SESSION['authcode'] = $captch_code;

for ($i=0;$i<200;$i++){
    $black = imagecolorallocate($image,rand(5,200),rand(5,200),rand(5,200));
    imagesetpixel($image,rand(0,99),rand(0,29),$black);
}

for ($i=0;$i<8;$i++) {
    $linecolor = imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
    imageline($image,rand(0,99),rand(0,29),rand(0,99),rand(0,29),$linecolor);
}

header("Content-type:image/jpeg");
imagejpeg($image);
imagedestroy($image);