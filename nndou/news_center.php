<?php
	include 'header.php';
	$ele = 'count(*)';
	$data_total = $db->select_one('info',$ele)[0];

	$limit = 5;
	$current = !empty($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
	$page_total = ceil($data_total/$limit);
	$current = $current > $page_total ? $page_total : $current;
	$page = $funs->page($current,$data_total,$limit,$page_total);
	if(isset($_GET) && $_GET['page']>0){
		$current = $_GET['page'];
		$offset = ($current-1) * $limit;
	}
	$condition = 'order by info_id desc limit '.$offset.','.$limit;
	$info = $db->select_all('info','*',$condition);
	//  $funs-> pre($info);die;
	include 'views/news_center.html';

	include 'footer.php';