<?php
session_start(); //session start is important

$random_alpha = md5(rand()); //generation of random string

/** Genrate a captcha of length 6 */
$captcha_code = substr($random_alpha, 0, 6);
$captcha_code = strtoupper($captcha_code);
$_SESSION["captcha_code"] = $captcha_code;

/* Width and Height of captcha */
$img = imagecreatetruecolor(170,50);

/* Backgorund color of captcha */
$captcha_background = imagecolorallocate($img, 255,255,255);
imagefill($img,0,0,$captcha_background);

$captcha_text_color = imagecolorallocate($img, 39,55,70);

/* Text size and properties */
$font_size = 32;
$img_width = 80;
$img_height = 48;

/** For Lines */
$line_color = imagecolorallocate($img, 64,64,64); 
for($i=0;$i<6;$i++) {
    imageline($img,0,rand()%50,200,rand()%50,$line_color);
}

/*For pixels */
$pixel_color = imagecolorallocate($img, 0,0,255);
for($i=0;$i<1000;$i++) {
    imagesetpixel($img,rand()%170,rand()%59,$pixel_color);
}  

/* you are the one is a font file */
$ttf_used = 'You are the one.ttf';
imagettftext($img, $font_size, 0, 25, 35, $captcha_text_color, $ttf_used, $captcha_code);
header("Content-type: image/jpeg");


imagejpeg($img);             
// imagedestroy($img);

?>