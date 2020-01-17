<?php 
function rand_str(){
    $s_str = 'abcdfgfijklmnopqrstuvwxyz0123456789';
    $ran_num = rand(1,4);
    $shuff = str_shuffle($s_str);
    $len = strlen($s_str);
    $reg = '/[a-z]/';
    $new_str = '';
    for($i = 0;$i < $len;$i++){
        if(preg_match($reg,$shuff[$i])){
            if($i==rand(0,strlen($s_str))){
                $shuff[$i] = strtoupper($shuff[$i]);
            } 
        }
        $new_str .= $shuff[$i];
    }
    $re_str = mb_substr($new_str,0,4);
    return $re_str;
}
  $c_str = rand_str();
  // echo $filename;die;
  // $suffix = pathinfo($filename)['extension'];
  //  $new_file = $copy_url.rand().'.'.$suffix;
  // $new_file = $copy_url.basename($filename);
  // $img_info = getimagesize($filename);
  // pre($img_info);die;
  // $width = $img_info[0];
  // $height = $img_info[1];
  // $img_type = $img_info[2];
  // if($img_type == 1){
  //     $des_img = imagecreatefromgif($filename);
  // }elseif($img_type == 2){
  //     $des_img = imagecreatefromjpeg($filename);
  // }elseif($img_type == 3){
  //     $des_img = imagecreatefrompng($filename);
  // }
  
  $c_width = 60;
  $c_height = 30;
//   echo $c_str;die;
  $c_img = imagecreatetruecolor($c_width,$c_height);
//   echo $c_img;die;
  $c_color = imagecolorallocate($c_img,rand(0,255),rand(0,255),rand(0,255));
  //   $x = rand(1,$c_width - strlen($_str)*imagefontwidth(20)-20);
  //     $y = rand(1,$c_height-imagefontheight(20)-20);
  $pink = imagecolorallocate($c_img,255,0,255);
  $white = imagecolorallocate($c_img,255,255,255);
    $back = imagecolorallocate($c_img,0,0,0);
    $red = imagecolorallocate($c_img,255,0,0);
    $blue = imagecolorallocate($c_img,0,255,0);
  $c_len = strlen($c_str);
  $c_x = mt_rand(5,($c_width-55));
  //echo $c_x;
  $c_y = mt_rand(20,($c_height-10));
//  echo '---+',$c_y;die;
//   echo '-----',$c_width-strlen($c_str)*imagefontwidth(20)-30;
//   echo '-----',$c_height-imagefontheight(10);die;
  imagefilledrectangle( $c_img  , 1  , 1  , $c_width  , $c_height , $white  );
  imagettftext($c_img,15,rand(-10,10),$c_x,$c_y,$c_color,realpath('./fonts/msyhbd.ttc'),$c_str);
  for($i=0;$i< 50;$i++){
    imagesetpixel  ( $c_img  , rand(1,$c_width)  , rand(1,$c_height)  ,  $c_color  );
    imagefilledellipse  ( $c_img  , rand(1,$c_width)  , rand(1,$c_height)  , 1  , 1  , $c_color  );
  }
  for($i=0;$i< 5;$i++){
    imageline  ( $c_img  , rand(1,$c_width)  , rand(1,$c_height)  , rand(1,$c_width)  , rand(1,$c_height) , $c_color  );
  }
  // imagestring($img,rand(-30,30),imagefontwidth($x),$y,$string,$pink);
  //  pre($img_new);die;
  // imagecopyresized($img_new,$des_img,0,0,0,0,$des_w,$des_h,$width,$height);
  session_start();
   $_SESSION['c_str']= $c_str;
  header('Content-Type:image/png');
  imagepng($c_img);
  imagedestroy($c_img);