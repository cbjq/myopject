<?php 
include 'head.php';
$type = !empty($_GET['case_id'])?$_GET['case_id']:0;
$type_id = !empty($_GET['edit']) ? $_GET['edit'] : '没有数据可编辑';
$sql = "select * from nnd_cases where case_id = $type_id ";
$case = $db->feel_select_ones($sql);
// pre($info);
$sql = "select * from nnd_case_type";
$case_type = $db->feel_select_all($sql);
if($_POST){
    // trim(preg_match('/^<p>\w<\/p>$/',$_POST['editorValue']));
//    $funs->pre($_POST);die;
       if(isset($_FILES) && !empty($_FILES['pic']['name'])){
             //获取文件类型
        $type = $_FILES['pic']['type'];
        $type = explode('/',$type);
        //$type = substr($type,strpos($type,'/')+1);
        //获取后缀
    $suffix = array_pop($type);
    $filename = date('YmdHms').mt_rand(100,999).'.'.$suffix;
    $in_info['case_img'] = '/admin/uploads/'.$filename;
}
    $content=preg_replace('/&lt;[\s]*p[\s]*&gt;/','',htmlspecialchars($_POST['editorValue']));
    $content=preg_replace('/&lt;[\s]*\/p[\s]*&gt;/','',$content);
    $in_info['case_name'] = trim($_POST['title']);
    $in_info['case_content1'] = trim($content);
    $in_info['case_type'] = trim($_POST['type']);
    // $funs->pre($content);
    // $funs->pre($in_info);die;
    $img_thumb = !empty($in_info['case_img'])&&isset($in_info['case_img'])?$in_info['case_img']:'';
    // echo $img_thumb.'#####';
    // echo basename($img_thumb).'====';
    // echo is_file(basename($img_thumb)).'-------';die;
    
    // window.location.href='info_list.php'
    $condition = "where case_id = $type_id";
   if($db->update2('cases',$in_info,$condition)){
 if(!empty($filename) && isset($filename) && !empty($suffix) && isset($suffix)){

     $funs->uploadf_r2('pic','uploads',$filename,$suffix);
 }
        if($img_thumb!=''){
            $funs->thumb('./uploads/'.basename($img_thumb),110,110,'thumbs/');
        }
        
        echo "<script>alert('编辑咨讯成功');window.location.href='case_list.php?case_id={$case['case_type']}';</script>";
    }else{
        echo "<script>alert('编辑咨讯失败，请重新编辑');</script>";
    }
}
?>
<?php include 'commen.php';?>
    <!-- End: Sidebar -->
    <link href="css/bootstrap-fileinput.css" rel="stylesheet">
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">修改案例</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" enctype='multipart/form-data'>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑案例</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="info_list.php"
                                       class="btn btn-default btn-gradient dropdown-toggle"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">分类</span>
                                            <select name="type" id="standard-list1" class="form-control">
                                                <?php foreach($case_type as $v){ ?>
                                                <option <?php echo $case['case_type']==$v['case_type_id'] ?"selected" : ''; ?> value="<?php echo $v['case_type_id'];?>"> <?php echo $v['case_type_name1']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="title" value="<?php echo $case['case_name'];?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="MAX_FILE_SIZE" VALUE="1048576">
                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" <?php 
                        if(is_file('water/'.basename('/teach_nndou'.$case['case_img']))){
                          echo "src='water/".basename('/teach_nndou'.$case['case_img'])."' "." width='120'";
                        }elseif(is_file('thumbs/'.basename('/teach_nndou'.$case['case_img']))){
                          echo "src='thumbs/".basename('/teach_nndou'.$case['case_img'])."'";
                        }else{
                                 echo "src='..".$case['case_img']."' "." width='120' ";
                        }   ?> alt="" />
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file">
                                                    <span class="fileinput-new">选择文件</span>
                                                    <span class="fileinput-exists">换一张</span>
                                                    <input type="file" name="pic" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                </span>
                                                <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
					<p><?php echo $case['case_content1'];?></p>

                                    </script>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <!-- End: Content -->
</div>
<!-- End: Main -->
<script src="js/bootstrap-fileinput.js"></script>
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
    var ue = UM.getEditor('myEditor', {
        autoClearinitialContent: false,
        wordCount: false,
        elementPathEnabled: false,
        initialFrameHeight: 300
    });
</script>
</body>

</html>