<?php
class Conf{
	public $cur_dir;

	// 配置
	public $confs = [];
	public function __construct(){
		$this->cur_dir = '/teach_nndou';
		$this->confs['current_url'] = basename($_SERVER['PHP_SELF']);
		$this->confs['root'] = 'http://'.$_SERVER['HTTP_HOST'].$this->cur_dir;
		// css目录
		$this->confs['css_dir'] = $this->confs['root'].'/static/styles/';
		// js目录
		$this->confs['js_dir'] = $this->confs['root'].'/static/scripts/';
		// 图片目录
		$this->confs['img_dir'] = $this->confs['root'].'/static/images/';
		$this->confs['file_name'] = basename($_SERVER['PHP_SELF']);
	}
	
}
	
