<?php
session_start();//开启session
$table = array(
    'pic0' => "虎",
    'pic1' => "鸟",
    'pic2' => "鱼",
    'pic3' => "猫",
);
$index = rand(0,3);
$value = $table['pic'.$index];
$_SESSION['authcode'] = $value;
$filename = dirname(__FILE__).'\\pic'.$index.'.jpg';
$content = file_get_contents($filename);

header("Content-type:image/jpeg");
echo $content;