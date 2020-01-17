<?php
include 'head.php';
// $funs->pre($case_type);die;
// var_dump($db);
$del_url = $_SERVER['REQUEST_URI'];
$query_str = $_SERVER['QUERY_STRING'];

// $del_url 
$limit = 4;



//分页
if(isset($_GET['case_id']) && $_GET['case_id'] != 0){
  $case_type_id = $_GET['case_id'];
  
  $sql = "select count(*) from nnd_cases,nnd_case_type where case_type=$case_type_id and nnd_case_type.case_type_id=nnd_cases.case_type";
  // echo $sql;die;
  $count = $db->feel_select_one($sql);
 $pages_total = ceil($count/$limit);
 if(isset($_GET['page'])){
   $_GET['page'] = $_GET['page'] > $pages_total ? $pages_total : $_GET['page'];
 }
 $current = isset($_GET['page']) ? $_GET['page'] : 1;
 $offset = ($current-1)*$limit;
  //$data_total = 
  $sql = "select * from nnd_cases,nnd_case_type where case_type=$case_type_id and nnd_case_type.case_type_id=nnd_cases.case_type limit $offset,$limit";

 $case = $db->feel_select_all($sql);

//  pre($info);
}else{
  $sql = "select count(*) from nnd_cases,nnd_case_type where nnd_case_type.case_type_id=nnd_cases.case_type";

  $count = $db->feel_select_one($sql);
  $pages_total = ceil($count/$limit);
  if(isset($_GET['page'])){
   $_GET['page'] = $_GET['page'] > $pages_total ? $pages_total : $_GET['page'];
 }
 $current = isset($_GET['page']) ? $_GET['page'] : 1;
 $offset = ($current-1)*$limit;
  $sql = "select * from nnd_cases,nnd_case_type where nnd_case_type.case_type_id=nnd_cases.case_type limit $offset,$limit";

 $case = $db->feel_select_all($sql);
}

//删除功能
if(isset($_GET['page'])){
  $page = $_GET['page'] > $pages_total ? $pages_total:$_GET['page'];
}

$del_url = $funs->del_jump_url();

$del_jump = $_SERVER['REQUEST_URI'];

if(isset($_GET['del'])){
  $case_id = $_GET['del'];
  $sql = "select case_img from nnd_cases where case_id = $case_id ";
  $file = "test.txt";

  $img=$db->feel_select_one($sql);
  //$file = '..'.$img;
 $file = is_file('thumbs/'.basename('/teach_nndou'.$img)) ? 'thumbs/'.basename('/teach_nndou'.$img): '..'.$img;
 if(isset($_GET['page']) || isset($_GET['del'])){
   
   $del_jump=substr($del_jump,0,strpos($del_jump,'&'));
  }
  $sql = "delete from nnd_cases where case_id=$case_id";
  // echo $sql;die;
  $res = $db->dele($sql);
  if($res){
               if(is_file('uploads/'.basename('/teach_nndou'.$img))){
                 unlink('uploads/'.basename('/teach_nndou'.$img));
               }
               if(is_file('water/'.basename('/teach_nndou'.$img))){
                unlink('water/'.basename('/teach_nndou'.$img));
              }
              if(is_file($file)){ 
        if(unlink($file)){
            echo "<script>alert('删除成功');window.location.href='$del_url';</script>";
          }
          echo "<script>alert('数据库删除成功，文件{$file}删除失败');window.location.href='$del_url';</script>";
      }
        echo "<script>alert('数据库删除成功，{$file}不是文件');window.location.href='$del_url';</script>";
      }else{
        
        echo "<script>alert('删除失败');</script>";
      }

// $sql = "delete from nnd_cases where case_id=$case_id";
// $res = $funs->dele($sql);
// if($res){
//   echo "<script>alert('删除成功');window.location.href='$del_url';</script>";
// }else{
  
//   echo "<script>alert('删除失败');</script>";
// }
}


//批量删除
if(isset($_POST) && !empty($_POST['idarr'])){
  $idarr = implode(',',$_POST['idarr']);
  
  $sql = "delete from nnd_cases where case_id in ($idarr)";
  // echo $sql;die;
  $self = $_SERVER['PHP_SELF'];
  if($db->del($sql)){
    
    $sql = "select case_img from nnd_cases where case_id in ($idarr) ";
    $res = $db->feel_select_all($sql);
    
    if(is_array($res)){
        foreach($res as $v){
        //echo is_file('..'.$v['info_img']);
        if(is_file('..'.$v['info_img']))
        unlink('..'.$v['info_img']);
        if(is_file('water/'.basename('/teach_nndou'.$v['info_img']))){
          unlink('water/'.basename('/teach_nndou'.$v['info_img']));
        }
        if(is_file('uploads/'.basename('/teach_nndou'.$v['info_img']))){
          unlink('uploads/'.basename('/teach_nndou'.$v['info_img']));
        }
        if(is_file('thumbs/'.basename('/teach_nndou'.$v['info_img']))){
          unlink('thumbs/'.basename('/teach_nndou'.$v['info_img']));
        }
      }
      
    }
    // die;
      echo "<script>alert('数据库删除成功');location.href='$del_url';</script>";
    }else{
      echo "<script>alert('数据库删除失败');location.href='$del_url';</script>";
    }
}
?>
<?php include 'commen.php';?>
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">案例管理<?php  echo $count;?></li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">案例列表</div>
                  <a href="case_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加案例</a>
                </div>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="panel-body">
                  <h2 class="panel-body-title"><?php echo isset($_GET['case_id'])&&$_GET['case_id'] !=0 ? $case[0]['case_type_name1'] : '所有案例';?><?php echo $count;?></h2>
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100">
                        <input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>标题</th>
                        <th width="350">内容</th>
                        <th>图片</th>
                        <th>分类</th>
                        <th width="100">操作</th>
                      </tr>
                      <?php foreach($case as $item){ ?>
                    	<tr class="success">
                        <td class="text-center">
                          <input type="checkbox" value="<?php echo $item['case_id'];?>" name="idarr[]" class="cbox">
                        </td>
                        <td><?php echo $item['case_name'];?></td>
                        <td><?php echo mb_substr($item['case_content1'],0,50);?></td>
                        <td>
                          <img <?php 
                        if(is_file('water/'.basename('/teach_nndou'.$item['case_img']))){
                          echo "src='water/".basename('/teach_nndou'.$item['case_img'])."' "." width='120'";
                        }elseif(is_file('thumbs/'.basename('/teach_nndou'.$item['case_img']))){
                          echo "src='thumbs/".basename('/teach_nndou'.$item['case_img'])."'";
                        }else{
                                 echo "src='..".$item['case_img']."' "." width='120' ";
                        }   ?>
                        ></td>
                        <td><?php echo $item['case_type_name1'];?></td>
                        <td>
		                      <div class="btn-group">
		                        <a href="case_edit.php?edit=<?php echo $item['case_id'];?>" class="btn btn-default btn-gradient">
                              <span class="glyphicons glyphicon-pencil"></span>
                            </a>
                            <a onclick="return confirm('确定要删除吗？');" href="<?php echo $del_url;?>del=<?php echo $item['case_id'];?>" class="btn btn-default btn-gradient dropdown-toggle">
                            <span class="glyphicons glyphicon-trash">
                            </span>
                          </a>
		                      </div>
                        
                        </td>
                      </tr>
                          <?php } ?>
                      <!-- <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr> -->
                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall">
                    <span class="glyphicons glyphicon-trash"></span>
                    </button>
                  </div>
                  
                  <div class="pull-right">
                    <!-- <ul class="pagination" id="paginator-example">
                      <li><a href="#">&lt;</a></li>
                      <li><a href="#">&lt;&lt;</a></li>
                      <li><a href="#">1</a></li>
                      <li class="active"><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&gt;</a></li>
                      <li><a href="#">&gt;&gt;</a></li>
                    </ul> -->
                    <?php echo $funs->page($current,$count,$limit,$pages_total,3,'pagination');?>
                  </div>
                  
                </div>
                </form>
              </div>
          </div>
        </div>




        
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
</body>
</html>