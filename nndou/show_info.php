<?php
include 'header.php';
if(!empty($_GET) && ($_GET['case_id'] != '')){
    $case_id = $_GET['case_id'];
}
$case_id = $case_id =='' ? 1 : $case_id;
$condition = "where case_id = $case_id and nnd_cases.case_type=nnd_case_type.case_type_id";
$case_info = union_select_one('cases','case_type',$condition);
include 'views/show_info.html';
include 'footer.php';