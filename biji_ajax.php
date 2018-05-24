<?php include_once("conn/conn.php");session_start();?>
<?php 
$page_nums=$_POST['page'];
$page_size=4*$page_nums;
$bjName=$_POST['bjName'];
$userId=$_SESSION['logined'];
if($bjName==''){
    $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_note a
    left JOIN tb_note_publish b
    on a.noteid=b.noteid");
    $infog=mysqli_fetch_object($sqlg);
}else{

    $nameArr=explode(' ',$bjName);
    for($index=0;$index<count($nameArr);$index++){
        if($index==0){
            $whereSql=" where (title like '%$nameArr[$index]%') ";
        }
        $whereSql .= " And (title like '%$nameArr[$index]%') ";
    }
    //空格分隔多条件模糊查询
    $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_note a
    left JOIN tb_note_publish b
    on a.noteid=b.noteid".$whereSql);
    $infog=mysqli_fetch_object($sqlg);
}
if($infog->noteid==''){
    echo '<div class="col-md-12 redBtn" >OhOh 暂时没有搜索到相关内容!!</div>';
}else{

do{
    $sqlc=mysqli_query($link,"select COUNT(*) AS cnt FROM tb_note_zan WHERE noteid='".$infog->noteid."'" );
    $infoc=mysqli_fetch_object($sqlc);

    $sqlc1=mysqli_query($link,"select COUNT(*) AS cnt FROM tb_note_sc WHERE noteid='".$infog->noteid."'" );
    $infoc1=mysqli_fetch_object($sqlc1);

    $sqlx=mysqli_query($link,"select * FROM tb_note_zan WHERE userid='".$userId."' AND noteid='".$infog->noteid."'");
    $infox=mysqli_fetch_object($sqlx);

    $sqlx1=mysqli_query($link,"select * FROM tb_note_sc WHERE userid='".$userId."' AND noteid='".$infog->noteid."'");
    $infox1=mysqli_fetch_object($sqlx1);

?>
<div class="col-md-4 myImg" id="<?php echo $infog->noteid?>">
    <div class="myContent">
        <div class="myTitle"><a class="xTitle"><?php echo $infog->title?></a>
            <button type="button" class="btn" title="更多"  data-html="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="发布者：<?php echo $infog->userid?><br><br><button class='btn btn-info form-control' onclick='editNote();' <?php if($infog->userid!=$userId) echo 'disabled'?>>修改</button><button class='btn btn-danger form-control' data-toggle='modal' data-target='#myModaldel' <?php if($infog->userid!=$userId) echo 'disabled'?>>删除</button>" style="float:right;">
            <span class="glyphicon glyphicon-option-horizontal"></span>
            </button>
        </div>
        <hr>
        <div class="myWenzi">
            <?php echo $infog->intro?>
        </div>
        <hr>
        <div class="myTail">
            ID:<em id="bjId"><?php echo $infog->noteid?></em>
            <div class="scBtn <?php if(($infox1->userid)!=''){echo 'redBtn';}?>" id="sc"><span class="glyphicon glyphicon-heart-empty"></span>&nbsp;收藏(<b id="scNum<?php echo $infog->noteid?>"><?php echo $infoc1->cnt ?></b>)</div>
            <div class="zanBtn <?php if(($infox->userid)!=''){echo 'redBtn';}?>" id="zan"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;赞(<b id="zanNum<?php echo $infog->noteid?>"><?php echo $infoc->cnt?></b>)&nbsp;&nbsp;</div>
        </div>
    </div>
</div>
<?php
    }while($infog=mysqli_fetch_object($sqlg));
}
?>
<!--Bootstrap 模态框（Modal） -->
<div class="modal fade" id="myModaldel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    警告!!!
                </h4>
            </div>
            <div class="modal-body">
                您正在进行删除操作，其他人不再看得到您该篇笔记，该操作不可撤回，且发布该笔记时获得的积分将被扣回。
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">不删了
                </button>
                <button type="button" class="btn btn-default">
                    确定删除
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script>$(function () { $("[data-toggle='popover']").popover();})</script>