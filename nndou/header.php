<?php
	//加载配置文件
	include './autoload.php';
	$funs = new Functions();
	$conf = new Conf();
	$db = Db::getInstance();
	//导航信息查询
	$sql = "SELECT * FROM nnd_nav";

	$nav_info = mysqli_query($db->getConn(),$sql);

	while ($res = mysqli_fetch_assoc($nav_info)){
		$nav[] = $res;
	}

	//当前url
	$current_url = basename($_SERVER['PHP_SELF']);
	$current_url = $current_url != '' ? $current_url : 'index.php';
	if(strpos($current_url,'?')){
		$current_url = mb_substr($current_url,0,strpos($current_url,'?'));
	}
	$web_name = $funs->get_web_name($current_url);
	//加载头部
	include './views/header.html';

	define('ACCESS',TRUE);