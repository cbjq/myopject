<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <title>CMS内容管理系统</title>
  <meta name="keywords" content="Admin">
  <meta name="description" content="Admin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Core CSS  -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/glyphicons.min.css">

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="css/theme.css">
  <link rel="stylesheet" type="text/css" href="css/pages.css">
  <link rel="stylesheet" type="text/css" href="css/plugins.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">

  <!-- Boxed-Layout CSS -->
  <link rel="stylesheet" type="text/css" href="css/boxed.css">

  <!-- Demonstration CSS -->
  <link rel="stylesheet" type="text/css" href="css/demo.css">

  <!-- Your Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  
  <!-- Core Javascript - via CDN --> 
  <script type="text/javascript" src="js/jquery.min.js"></script> 
  <script type="text/javascript" src="js/jquery-ui.min.js"></script> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="js/uniform.min.js"></script> 
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/custom.js"></script> 
</head>

<body>
<!-- Start: Header -->
<header class="navbar navbar-fixed-top" style="background-image: none; background-color: rgb(240, 240, 240);">
  <div class="pull-left"> <a class="navbar-brand" href="#">
    <div class="navbar-logo"><img src="images/logo.png" alt="logo"></div>
    </a> </div>
  <div class="pull-right header-btns">
    <a class="user"><span class="glyphicons glyphicon-user"></span> <?php echo $_SESSION['username'];?></a>
    <a href="quit.php" class="btn btn-default btn-gradient" type="button"><span class="glyphicons glyphicon-log-out"></span> 退出</a>
  </div>
</header>
<!-- End: Header -->

<!-- Start: Main -->
<div id="main"> 
    <!-- Start: Sidebar -->
  <aside id="sidebar" class="affix">
    <div id="sidebar-search">
    		<div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
    </div>
    <div id="sidebar-menu">
      <ul class="nav sidebar-nav">
        <li class="<?php echo $conf->confs['file_name']=='index.php'?'active':'';?>">
          <a href="index.php"><span class="glyphicons glyphicon-home "></span><span class="sidebar-title">后台首页</span></a>
        </li>

        <li class="<?php echo $conf->confs['file_name']=='info_list.php' ? 'active':'';?>"> <a href="info_list.php" class="accordion-toggle <?php echo $conf->confs['file_name']=='info_list.php' ? 'menu-open':'';?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">咨讯管理</span><span class="caret"></span></a>
          <ul class="nav sub-nav" id="sideEight" style="">
            <li class="<?php echo $conf->confs['file_name']=='info_list.php' && $_GET['info_id']==0 ? 'active':'';?>"><a href="info_list.php?info_id=0"><span class="glyphicons glyphicon-record"></span>所有资讯</a>
              <!-- <ul class="nav sub-nav" id="sideEight-sub" style="">
                <li><a href="article_list.html"><span class="glyphicons glyphicon-minus"></span> 互联网</a></li>
                <li><a href="#"><span class="glyphicons glyphicon-minus"></span> 数码</a></li>
                <li><a href="#"><span class="glyphicons glyphicon-minus"></span> IT</a></li>
                <li><a href="#"><span class="glyphicons glyphicon-minus"></span> 电信</a></li>
              </ul> -->
            </li>
            <?php foreach($info_type as $item){ ?>
            <li class="<?php echo $conf->confs['file_name']=='info_list.php' && $_GET['info_id']==$item['info_type_id'] ? 'active':'';?>"><a href="info_list.php?info_id=<?php echo $item['info_type_id'];?>"><span class="glyphicons glyphicon-record"></span> <?php echo $item['info_type_name'];?></a></li>
            <?php } ?>
            <!-- <li><a href="#"><span class="glyphicons glyphicon-record"></span> 生活</a></li> -->
          </ul>
        </li>
        <li class="<?php echo $conf->confs['file_name']=='case_list.php' ? 'active':'';?>"> <a href="case_list.php" class="accordion-toggle <?php echo $conf->confs['file_name']=='case_list.php' ? 'menu-open':'';?>"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">案例管理</span><span class="caret"></span></a>
          <ul class="nav sub-nav" id="sideEight" style="">
            <li class="<?php echo $conf->confs['file_name']=='case_list.php' && $_GET['case_id']==0 ? 'active':'';?>"><a href="case_list.php?case_id=0"><span class="glyphicons glyphicon-record"></span>所有案例</a>
              <!-- <ul class="nav sub-nav" id="sideEight-sub" style="">
                <li><a href="article_list.html"><span class="glyphicons glyphicon-minus"></span> 互联网</a></li>
                <li><a href="#"><span class="glyphicons glyphicon-minus"></span> 数码</a></li>
                <li><a href="#"><span class="glyphicons glyphicon-minus"></span> IT</a></li>
                <li><a href="#"><span class="glyphicons glyphicon-minus"></span> 电信</a></li>
              </ul> -->
            </li>
            <?php foreach($case_type_list as $item){ ?>
            <li class="<?php echo $conf->confs['file_name']=='case_list.php' && $_GET['case_id']==$item['case_type_id'] ? 'active':'';?>"><a href="case_list.php?case_id=<?php echo $item['case_type_id'];?>"><span class="glyphicons glyphicon-record"></span> <?php echo $item['case_type_name1'];?></a></li>
            <?php } ?>
            <!-- <li><a href="#"><span class="glyphicons glyphicon-record"></span> 生活</a></li> -->
          </ul>
        </li>
        <li>
          <a href="cate_list.html"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">文章分类管理</span></a>
        </li>
        <li>
          <a href="user_list.html"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">系统管理员</span></a>
        </li>
      </ul>
    </div>
  </aside>