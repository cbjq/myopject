<?php
	include 'header.php';
	include 'banner.php';
	//查询案例分类
	$case_type = $db->select_all('case_type','*','LIMIT 3');

	// 查询案例
	if(!empty($_GET['type'])){
		$type = $_GET['type'];
	}else{
		$type = 1;
	}
	//通过分类查找案例
	$conditon = "WHERE case_type = {$type}";
	$cases = $db->select_all('cases','*',$conditon);

	include 'views/show.html';
	include 'footer.php';