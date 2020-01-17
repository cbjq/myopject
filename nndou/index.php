<?php
	include 'header.php';
	include 'banner.php';

	//服务
	$condition = "LIMIT 6";
	$serv_type = $db->select_all('serv_type','*',$condition);

	//案例
	$cases = $db->select_all('cases','*',$condition);

	include './views/index.html';
	include 'footer.php';