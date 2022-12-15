<?php
header('Access-Control-Allow-Origin: *');
$geturl = urldecode($_SERVER['QUERY_STRING']);
$headers =apache_request_headers();
showImg($geturl);
function showImg($img){
  $info = getimagesize($img);
  $imgExt = image_type_to_extension($info[2], false); //获取文件后缀
  $fun = "imagecreatefrom{$imgExt}";
  $imgInfo = $fun($img);         //1.由文件或 URL 创建一个新图象。如:imagecreatefrompng ( string $filename )
  //$mime = $info['mime'];
  $mime = image_type_to_mime_type(exif_imagetype($img)); //获取图片的 MIME 类型
  header('Content-Type:'.$mime);
  $quality = 100;
  if($imgExt == 'png') $quality = 9;   //输出质量,JPEG格式(0-100),PNG格式(0-9)
  $getImgInfo = "image{$imgExt}";
  $getImgInfo($imgInfo, null, $quality); //2.将图像输出到浏览器或文件。如: imagepng ( resource $image )
  imagedestroy($imgInfo);
}
?>