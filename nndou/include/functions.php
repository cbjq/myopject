<?php
class Functions{
	//创建缩略图
	function thumb($filename,$des_w,$des_h,$copy_url){
		// echo $filename;die;
		// $suffix = pathinfo($filename)['extension'];
		//  $new_file = $copy_url.rand().'.'.$suffix;
		$new_file = $copy_url.basename($filename);
		$img_info = getimagesize($filename);
		// pre($img_info);die;
		$width = $img_info[0];
		$height = $img_info[1];
		$img_type = $img_info[2];
		if($img_type == 1){
			$des_img = imagecreatefromgif($filename);
		}elseif($img_type == 2){
			$des_img = imagecreatefromjpeg($filename);
		}elseif($img_type == 3){
			$des_img = imagecreatefrompng($filename);
		}
		$img_new = imagecreatetruecolor($des_w,$des_h);
		//  pre($img_new);die;
		imagecopyresized($img_new,$des_img,0,0,0,0,$des_w,$des_h,$width,$height);
		//header('Content-Type:image/png');
		if(imagepng($img_new,$new_file)){
			$fage = true;
		}else{
			$fage = false;
		}
		imagedestroy($img_new);
		return $fage;
	}



	



	//路径拼接
	function conpant_url(){
		$url = $_SERVER['PHP_SELF'].'?';
		if(isset($_GET)){
			foreach($_GET as $k => $v){
				if($k != 'page'){
					$url .= $k.'='.$v.'&'; 
				}
			}
		}
		return $url;
	}


	//删除路径拼接
	function del_jump_url(){
		$url = $_SERVER['PHP_SELF'].'?';
		
		if(isset($_GET)){
			
			// echo $_GET['page'];die;
			foreach($_GET as $k => $v){
				if($k != 'del'){
					$url .= $k.'='.$v.'&'; 
				}
			}
		}
		return $url;
	}


	//删除路径拼接
	function del_url(){
		$url = $_SERVER['PHP_SELF'].'?';
		if(isset($_GET)){
			foreach($_GET as $k => $v){
				if($k != 'page' || $k != 'del'){
					$url .= $k.'='.$v.'&'; 
				}
			}
		}
		return $url;
	}



	//分页
	function page($current,$data_total,$limit,$page_total,$size=5,$class='mypage'){
		$size = $size > $page_total ? $page_total : $size;
		if($current > $page_total){
			$current = $page_total;
		}elseif($current<0){
			$current = 1;
		}else{
			if($current <= floor($size/2)){
			$start = 1;
			$start = $start < 1 ? 1 : $start;
			$end = $page_total>$size?$size:$page_total;
		}elseif($current > floor($size/2) && $current < $page_total-floor($size/2)){
			$start = $current-floor($size/2) > 0 ? $current-floor($size/2) : 1;
			$end = $current+floor($size/2);

		}elseif($current >= $page_total-floor($size/2)){
			$start = ($page_total - $size)>0?$page_total-$size:1;
			
			$end = $page_total;
		}
		}
		$url = $this->conpant_url();
		// echo $url;
		//$size = $size % 2 == 0 ? $size+1 : $size;
		
		
		$str = "";
		$str .= '<ul class="'.$class.'">';
			if($current == 1){
				$str .= '<li><a><</a></li>';
			}else{
				$pre = $current-1;
				$str .= "<li class='prev'><a href='?page=1'>首页</a></li>";
				$str .= "<li class='prev'><a href='?page=$pre'><</a></li>";
			}
			
			for($i = $start;$i<=$end;$i++){
				if($i == $current){
					$str .= '<li class = "active"><a  href="?page='.$i.'">'.$i.'</a></li>';
				}else{
					 
					$str .= '<li><a href="'.$url.'page='.$i.'">'.$i.'</a></li>';
				}
				
			}
			if($current == $page_total){
				$str .= '<li class="next"><a>></a></li>';
				
			}else{
				$next = $current+1;
				// echo $current;
				$str .= "<li class='next'><a href='?page=".$next."'> ></a></li>";
				$str .= "<li class='prev'><a href='?page={$page_total}'>尾页</a></li>";
			}
		$str .= '</ul>';
		return $str;
	}





	//返回网站名称
	function get_web_name($current_url){
		switch($current_url){
			case 'index.php':
				return '首页';
			case 'solution.php':
				return '解决方案';
			case 'news_center.php':
				return '咨讯中心';
			case 'cases.php':
				return '案例展示';
			case 'about.php':
				return '了解牛牛豆';
			case 'show_info.php':
				return '查看详情';
			default :
				return '首页';
		}
	}



	//pdo连接
	function pdoconnect(){
		$dbms = 'mysql';
		$host = 'localhost';
		$dbname = 'teach_nndou';
		$user = 'root';
		$pass = '';
		$dsn = "$dbms:host=$host;dbname=$dbname";
		$db = new PDO($dsn,$user,$pass);
		return $db;
	}

	//验证的函数
	function check(){
		$db = $this->pdoconnect();
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$corde = strtolower(trim($_POST['corde']));
		if(empty($username)){
			echo "<script>alert('用户名不能为空');window.location.href='login.php';</script>";
		}else{
			if(strlen($username)>6){
				echo "<script>alert('用户名长度在1-6个字符');</script>";
			}
		}
		if(empty($password)){
			echo "<script>alert('密码不能为空');window.location.href='login.php';</script>";
		}
		if(empty($corde)){
			echo "<script>alert('验证码不能为空');window.location.href='login.php';</script>";
		}else{
			if(strtolower($_SESSION['c_str']) != $corde){
				echo "<script>alert('验证码不正确');window.location.href='login.php';</script>";
				// echo $corde,'---'.$_SESSION['c_str'];
			}
		}
		$password = md5($password);
		$sql = "select admin_id,admin_name,admin_last_login from nnd_admin where admin_name = :username and admin_pwd = :pwd";
		$userinfo = $db->prepare($sql);
		$userinfo->execute([':username'=>$username,':pwd'=>$password]);
		$resinfo = [];
		if($userinfo->rowCount() > 0){
			$resinfo = $userinfo->fetch(PDO::FETCH_NUM);
			if(is_array($resinfo)){
			list($id,$username,$lastlogin) = $resinfo;
		}
			$_SESSION['islogin']=1;
			$_SESSION['id']=$id;
			$_SESSION['username']=$username;
			$_SESSION['lastlogin']=$lastlogin;
		echo "<script>alert('登录成功');window.location.href='index.php';</script>";
		}
		
		echo "<script>alert('用户名或密码不正确');setTimeout(function(){window.location.href='login.php';},5000)</script>)";exit;
	}


	//设置cookie
	function setcook($id,$username,$lastlogin){
		setcookie('id',$id,time()+60*60,'/');
		setcookie('username',$username,time()+60*60,'/');
		setcookie('islogin',1,time()+60*60,'/');
		setcookie('lastlogin',date('Y-m-d H:i:s',$lastlogin),time()+60*60,'/');
	}

	//添加文字水印的方法
	function watermark($img_arr,$string = ''){
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
		$min = 4;
		$max = ($width - strlen($string)*imagefontwidth(50)-50)<$min?$min+5:($width - strlen($string)*imagefontwidth(50)-50);
		$x = mt_rand($min,$max);
		$y = mt_rand(4,$height-imagefontheight(50)-50);
		//tj字体
	   // $font=imageloadfont('./fonts/msyhbd.ttc');
		imagettftext($img,20,0,$x,$y,$red,realpath('./fonts/msyhbd.ttc'),$string);
		//imagefttext($img,50,0,$x,$y,$red,'./fonts/STXINGKA.TTF',$string);
		imagestring($img,1,$x,$y,$string,$pink);
		//保存
		$save = "image".$types[$type];
		$w_file = 'water/'.basename($img_arr);
		$save($img,$w_file);
		imagedestroy($img);
		return $w_file;
	}


	//添加图片水印的方法
	function watermark2($ori_img,$w_img,$path='./'){
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

	


	//单文件上传有返回文件名
function uploadf_r2($fname,$dirname,$filename,$suffix){
    if(!empty($_FILES[$fname])){
		
        $uploads = $dirname;
        $name = $_FILES[$fname]['name'];
        
        $allows = ['jpeg','jpg','png','gif'];
        //判断上传文件是否允许
        if(!in_array($suffix,$allows)){
            echo '不允许上传'.$suffix.'文件类型';
        exit;
        }
    //$filename = 'aa'.$suffix;
    //指定文件名
    
    $path = $uploads.'/'.$filename;
        //第一种上传方式
        // if(is_uploaded_file($_FILES['pic']['tmp_name'])){
        //     $res = copy($_FILES['pic']['tmp_name'],$uploads.'/'.$filename);
        //     if($res)
        //     {
        //         echo '<script>alert("上传成功！");window.location.href="index.html";</script>';
        //     }
        // }
    
        //第二种上传方法
        if(move_uploaded_file($_FILES[$fname]['tmp_name'],$path)){
            
        }
        else{
            echo '<script>alert("上传失败！");window.location.href="'.$dirname.'";</script>';
        }
    }
    
    if( !empty($_FILES)){
        if($_FILES[$fname]['error']){
            switch($_FILES[$fname]['error']){
            case 1:
                echo '上传的文件超出了upload_max_filesize文件大小';
            break;
            case 2:
                echo '上传的文件超出了max_file_size文件大小';
            break;
            case 3:
                echo '文件没有上传';
            break;
            case 4:
                echo '没有指定上传的文件';
            break;
            default:
            echo '未知错误';
        }
        }   
    }
}




	//单文件上传有返回文件名
function uploadf_r($fname,$dirname){
    if(!empty($_FILES[$fname])){
		
        $uploads = $dirname;
        $name = $_FILES[$fname]['name'];
        //获取文件类型
        $type = $_FILES[$fname]['type'];
        $type = explode('/',$type);
        //$type = substr($type,strpos($type,'/')+1);
        //获取后缀
    $suffix = array_pop($type);
    $filename = date('YmdHms').mt_rand(100,999).'.'.$suffix;
        $allows = ['jpeg','jpg','png','gif'];
        //判断上传文件是否允许
        if(!in_array($suffix,$allows)){
            echo '不允许上传'.$suffix.'文件类型';
        exit;
        }
    //$filename = 'aa'.$suffix;
    //指定文件名
    
    $path = $uploads.'/'.$filename;
        //第一种上传方式
        // if(is_uploaded_file($_FILES['pic']['tmp_name'])){
        //     $res = copy($_FILES['pic']['tmp_name'],$uploads.'/'.$filename);
        //     if($res)
        //     {
        //         echo '<script>alert("上传成功！");window.location.href="index.html";</script>';
        //     }
        // }
    
        //第二种上传方法
        if(move_uploaded_file($_FILES[$fname]['tmp_name'],$path)){
            return $filename;
        }
        else{
            echo '<script>alert("上传失败！");window.location.href="'.$dirname.'";</script>';
        }
    }
    
    if( !empty($_FILES)){
        if($_FILES[$fname]['error']){
            switch($_FILES[$fname]['error']){
            case 1:
                echo '上传的文件超出了upload_max_filesize文件大小';
            break;
            case 2:
                echo '上传的文件超出了max_file_size文件大小';
            break;
            case 3:
                echo '文件没有上传';
            break;
            case 4:
                echo '没有指定上传的文件';
            break;
            default:
            echo '未知错误';
        }
        }   
    }
}





	//print_r打印
	function pre($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
	//var_dump打印
	function dump($arr){
		echo '<pre>';
		var_dump($arr);
		echo '</pre>';
	}
}
