<?php 
include 'head.php';
	if(!$_COOKIE['islogin']){
		echo "<script>alert('你还没登录，请先登录,在2秒后将跳转到登录页面。。。');setTimeout(function(){window.location.href='login.php'},2000);</script>";exit;
	}
$sql = "select * from nnd_info_type";
$info_type = feel_select_all($sql);
if(isset($_COOKIE['user']['login']) && $_COOKIE['islogin']==1){
echo '你已经登录';
}else{
    echo '你还没登录';
}
// foreach($_COOKIE as $k => $v){
//     if(is_array($v)){
//         foreach($v as $sk => $sv){

//         }
//     }
//     echo 2;die;
// }
if($_POST){
    $info['info_title'] = $_POST['title'];
    $info['info_content'] = $_POST['editorValue'];
    $info['info_img'] = '/admin/uploads/'.uploadf_r('pic','uploads');
    $info['info_time'] = time();
    $info['info_type'] = $_POST['type'];
    $img_thumb = $info['info_img'];
    // echo $img_thumb.'#####';
    // echo basename($img_thumb).'====';
    // echo is_file(basename($img_thumb)).'-------';die;

    //缩略图
      thumb('./uploads/'.basename($img_thumb),110,110,'thumbs/');


    //文字水印图
    $w_path = watermark('./uploads/'.basename($img_thumb),'水印图片');

    // window.location.href='info_list.php'
    
   if(insert($info)){
       $type = $_POST['type'];
        echo "<script>alert('添加咨讯成功');window.location.href='info_list.php?info_id={$type}';</script>";
    }else{
        echo "<script>alert('添加咨讯失败，请重新添加');';</script>";
    }
}

// pre($info_type);
?>
<?php include 'commen.php';?>
    <!-- End: Sidebar -->
    <link href="css/bootstrap-fileinput.css" rel="stylesheet">
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加资讯</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" enctype='multipart/form-data'>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">添加咨讯</div>
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
                                                <?php foreach($info_type as $k => $v){ ?>
                                                <option value="<?php echo $v['info_type_id'];?>"><?php echo $v['info_type_name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="title" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="MAX_FILE_SIZE" VALUE="1048576">
                                        <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" />
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
					<p></p>

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
<!-- <script src="js/jquery.min.js"></script> -->
<script src="js/bootstrap-fileinput.js"></script>
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
    var ue = UM.getEditor('myEditor', {
        autoClearinitialContent: true,
        wordCount: false,
        elementPathEnabled: false,
        initialFrameHeight: 300
    });
</script>
</body>

</html>