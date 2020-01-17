<?php
session_start();
session_destroy();
echo "<script>alert('退出成功');window.location.href='login.php';</script>";

//window.location.href='$del_url'
// setTimeout(function(){
//     alert("3秒之后洗澡");
// }, 3000);