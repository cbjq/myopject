<?php
	// 轮播图控制页面

	//不能直接访问banner.php
	$current_url = basename($_SERVER['REQUEST_URI']);
	if($current_url == 'banner.php') die('Permission denied!');

	$sql = "SELECT * FROM nnd_banner";
	$ban_info = mysqli_query($db->getConn(),$sql);
	while ($res = mysqli_fetch_assoc($ban_info)){
		$banner[] = $res;
	}

	include 'views/banner.html';