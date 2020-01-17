<?php
function rand_str(){
    $s_str = 'abcdfgfijklmnopqrstuvwxyz0123456789';
    $ran_num = rand(1,4);
    $shuff = str_shuffle($s_str);
    $re_str = mb_substr($shuff,0,4);
    $len = strlen($re_str);
    $reg = '/[a-z]/';
    $new_str = '';
    for($i = 0;$i < $len;$i++){
        if(preg_match($reg,$re_str[$i])){
            if($i==rand(0,strlen($s_str))){
                $re_str[$i] = strtoupper($re_str[$i]);
            } 
        }
        $new_str .= $re_str[$i];
    }
    return $new_str;
}

//  echo rand_str();
function thumbs(){
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
    
    $c_width = 150;
    $c_height = 50;
    $c_img = imagecreatetruecolor($c_width,$c_height);
    $c_color = imagecolorallocate($c_img,rand(0,255),rand(0,255),rand(0,255));
    // $back = imagecolorallocate($img,0,0,0);
    // $red = imagecolorallocate($img,255,0,0);
    // $blue = imagecolorallocate($img,0,255,0);
    // $pink = imagecolorallocate($img,255,0,255);
    //imagefilledrectangle( resource $img  , int $x1  , int $y1  , int $x2  , int $y2  , int $color  );
   
    //imagefttext($img,50,0,$x,$y,$red,'./fonts/STXINGKA.TTF',$string);
    $c_len = strlen($c_str);
    $c_x = rand(1,$c_width);
    $c_y = rand(1,$c_height);
    // echo $c_str;die;
    imagettftext($c_img,20,0,10,10,$c_color,realpath('./fonts/msyhbd.ttc'),$c_str);
    for($i=0;$i< $c_len;$i++){
        
        imagestring($c_img,rand(-30,30),$c_x,$c_y,$c_str[$i],$c_color);
    }
    // imagestring($img,rand(-30,30),imagefontwidth($x),$y,$string,$pink);
    //imagesetpixel  ( resource $image  , int $x  , int $y  , int $color  );
    //imagefilledellipse  ( resource $image  , int $cx  , int $cy  , int $width  , int $height  , int $color  );
    //imageline  ( resource $image  , int $x1  , int $y1  , int $x2  , int $y2  , int $color  );
    //  pre($img_new);die;
    // imagecopyresized($img_new,$des_img,0,0,0,0,$des_w,$des_h,$width,$height);
    session_start();
     $_SERVER['c_str']= $c_str;
    header('Content-Type:image/png');
    imagepng($c_img);

    
    imagedestroy($c_img);
}
thumbs();
setcookie('user[name]','chen',time()+60);
setcookie('user[age]',1000,time()+60);
include '../include/conf.php';
setcookie('user[nam]','chen',time()+60);
setcookie('user[ag]',1000,time()+60);
setcookie('user[login]',1,time()+60);
$img_arr ='./uploads/20200106100102187.png';
function watermark5($img_arr,$string = ''){
    list($width,$height,$type) = getimagesize($img_arr);
    $types = [
        1=> 'gif',
        2=>'jpeg',
        3=>'png'
    ];
    $createimg = 'imagecreatefrom'.$types[$type];
    
    $img = $createimg($img_arr);
    //给图片颜色
    $white = imagecolorallocate($img,255,255,255);
    $back = imagecolorallocate($img,0,0,0);
    $red = imagecolorallocate($img,255,0,0);
    $blue = imagecolorallocate($img,0,255,0);
    $pink = imagecolorallocate($img,255,0,255);
    imageline($img,0,0,$width,$height,$red);
    $x = mt_rand(4,$width - strlen($string)*imagefontwidth(50)-50);
    $y = mt_rand(4,$height-imagefontheight(50)-50);
    //tj字体
   // $font=imageloadfont('./fonts/msyhbd.ttc');
    imagettftext($img,20,0,$x,$y,$red,realpath('./fonts/msyhbd.ttc'),$string);
    //imagefttext($img,50,0,$x,$y,$red,'./fonts/STXINGKA.TTF',$string);
    imagestring($img,1,$x,$y,$string,$pink);
    //保存
    $save = "image".$types[$type];
    $save($img,'water/'.rand().'.'.$types[$type]);
    //
    imagedestroy($img);
}
 //watermark('uploads/20200107010158911.png','水印图片');
function watermark20($ori_img,$w_img,$path='./'){
    list($ori_width,$ori_height,$ori_type) = getimagesize($ori_img);
    list($w_width,$w_height,$w_type) = getimagesize($w_img);
    $types = [
        1=> 'gif',
        2=>'jpeg',
        3=>'png'
    ];
    $createoriimg = 'imagecreatefrom'.$types[$ori_type];
    $createwimg = 'imagecreatefrom'.$types[$w_type];
    $img_src = $createoriimg($ori_img);//原图
    $img_des = $createwimg($w_img);//水印
    //随机位置
    $x = mt_rand(4,$ori_width - $w_width);
    $y = mt_rand(4,$ori_height-$w_height);
    // $x = 10;
    // $y = $ori_height - $w_height;
    //拷贝图片
    imagecopy($img_src,$img_des,$x,$y,0,0,$w_width,$w_height);
    //输出
    //header("Content-Type:image/{$types[$ori_type]}");
    $save = "image".$types[$ori_type];
    $save($img_src,$path.date('YmdHis').'.'.$types[$ori_type]);
    $save($img_src);

    //销毁变量
    imagedestroy($img_src);
    imagedestroy($img_des);
}
//watermark2('uploads/20200107010158911.png','images/logo.png','water/');
//thumb($img_arr,110,110,'thumbs/');die;
// $suffix = pathinfo($img_arr)['extension'];
// $new_file = rand().'.'.$suffix;
// //  echo $new_file;die;
// $img_info = getimagesize($img_arr);
// // pre($img_info);die;
// $width = $img_info[0];
// $height = $img_info[1];
// $img_type = $img_info[2];
// if($img_type == 1){
//     $des_img = imagecreatefromgif($img_arr);
// }elseif($img_type == 2){
//     $des_img = imagecreatefromjpeg($img_arr);
// }elseif($img_type == 3){
//     $des_img = imagecreatefrompng($img_arr);
// }

// $des_w = 150;
// $des_h = 102;
// $img_new = imagecreatetruecolor($des_w,$des_h);
// //  pre($img_new);die;
// imagecopyresized($img_new,$des_img,0,0,0,0,$des_w,$des_h,$width,$height);
// header('Content-Type:image/png');
// imagepng($img_new,'thumbs/hhhs.png');
// imagedestroy($img_new);
?>
<script>
var keys = 'n';
var vs = 'dd';
// var infos=[name:'n',age:5];
console.log($infos)
localStorage.setItem(keys,vs);
console.log(localStorage.getItem(keys));
sessionStorage.setItem(keys,vs);
console.log(localStorage.getItem(localStorage.key(keys)))

</script>
