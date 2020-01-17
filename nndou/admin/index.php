<?php 
include 'head.php';
?>
<?php include 'commen.php';?>

  <!-- End: Sidebar -->    
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
      </ol>
    </div>
    <div class="container">
		<div class="col-md-9">
			<div id="docs-content">
				<h2 class="page-header margin-top-none">个人信息</h2>
				<table class="table">
					<tr>
					<td colspan="2">您好，<?php echo $_SESSION['username'];?></td>
					</tr>
					<tr>
					<td width="150">最后登录时间:</td>
					<td><?php echo date('Y-m-d H:i:s',$_SESSION['lastlogin']);?></td>
					</tr>
					<tr>
					<td>最后登录IP:</td>
					<td><?php echo $_SERVER['SERVER_ADDR'];?></td>
					</tr>
				</table>

				<h2 class="page-header margin-top-none">系统信息</h2>
				<table class="table">
				  <tr>
				    <td width="100">操作系统：</td>
				    <td><?php echo PHP_OS;?></td>
				  </tr>
				  <tr>
				    <td>PHP 版本:</td>
				    <td><?php echo PHP_VERSION;?></td>
				  </tr>
				  <tr>
				    <td>MySQL 版本:</td>
				    <td><?php echo mysqli_get_server_info($db->getConn());?></td>
				  </tr>
				</table>
			</div>
		</div>
    </div> 
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --></body>

</html>