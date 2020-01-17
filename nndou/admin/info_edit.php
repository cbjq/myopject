<?php 
include 'head.php';
$type = !empty($_GET['info_id'])?$_GET['info_id']:0;
$type_id = !empty($_GET['edit']) ? $_GET['edit'] : '没有数据可编辑';
$sql = "select * from nnd_info where info_id = $type_id ";
$info = feel_select_ones($sql);
// pre($info);
$sql = "select * from nnd_info_type";
$info_type = feel_select_all($sql);
if($_POST){
    $in_info['info_title'] = $_POST['title'];
    $in_info['info_content'] = $_POST['editorValue'];
    $in_info['info_img'] = '/admin/uploads/'.uploadf_r('pic','uploads');
    $in_info['info_time'] = time();
    $in_info['info_type'] = $_POST['type'];
    $img_thumb = $in_info['info_img'];
    // echo $img_thumb.'#####';
    // echo basename($img_thumb).'====';
    // echo is_file(basename($img_thumb)).'-------';die;
     thumb('./uploads/'.basename($img_thumb),110,110,'thumbs/');
    // window.location.href='info_list.php'

   if(update($in_info,$type_id)){
        echo "<script>alert('编辑咨讯成功');window.location.href='info_list.php?info_id={$type}';</script>";
    }else{
        echo "<script>alert('编辑咨讯失败，请重新编辑');';</script>";
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
                <li class="active">修改资讯</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" enctype='multipart/form-data'>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">编辑咨讯</div>
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
                                                <?php foreach($info_type as $v){ ?>
                                                <option <?php echo $info['info_type']==$v['info_type_id'] ?"selected" : ''; ?> value="<?php echo $v['info_type_id'];?>"> <?php echo $v['info_type_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="title" value="<?php echo $info['info_title'];?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="MAX_FILE_SIZE" VALUE="1048576">
                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php echo 'thumbs/'.basename('/teach_nndou'.$info['info_img']);;?>" alt="" />
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
					<p><?php echo $info['info_content'];?></p>

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