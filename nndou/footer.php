<?php
	if(!defined('ACCESS')) die('Access Denied!');

	$config = $db->select_one('config');


	include './views/footer.html';