<?php 

session_start();
include '../autoload.php';

$conf = new Conf();

if(!isset($_SESSION['islogin'])){
    if($conf->confs['file_name']!='login.php')
    echo "<script>alert('没有登录，请先登录');window.location.href='login.php';</script>";
}
$db = Db::getInstance();
$info_type = $db->select_all('info_type','*');
$funs = new Functions();
$case_type_list = $db->select_all('case_type','*');
// $funs->pre($case_type_list);die;
?>


