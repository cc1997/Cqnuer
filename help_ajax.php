<?php include_once("conn/conn.php");session_start();?>
<?php 
$page_nums=$_POST['page'];
$page_size=4*$page_nums;
$helpLoc=$_POST['helpLoc']; 
$helpTime=$_POST['helpTimeRec'];
$helpType=$_POST['helpTypeRec'];
$userId=$_SESSION['logined'];
if($helpLoc==''&&$helpTime==''&&$helpType==''){//无
    $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
    left JOIN tb_help_publish b
    on a.helpid=b.helpid order by time desc");
    $infog=mysqli_fetch_object($sqlg);
}
else if($helpLoc!=''&&$helpTime==''&&$helpType==''){//一重限制

    $nameArr=explode(' ',$helpLoc);
    for($index=0;$index<count($nameArr);$index++){
        if($index==0){
            $whereSql=" where (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
        }
        $whereSql .= " And (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
    }
    //空格分隔多条件模糊查询
    $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
    left JOIN tb_help_publish b
    on a.helpid=b.helpid".$whereSql." order by time desc");
    $infog=mysqli_fetch_object($sqlg);

}
else if($helpLoc==''&&$helpTime==''&&$helpType!=''){//一重限制

    $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
    left JOIN tb_help_publish b
    on a.helpid=b.helpid where typeid=".$helpType." order by time desc");
    $infog=mysqli_fetch_object($sqlg);

}
else if($helpLoc==''&&$helpTime!=''&&$helpType==''){//一重限制

    if($helpTime=='jf1'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid order by helpvalue desc");
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='jf2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid order by helpvalue asc");
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='sj2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid order by time asc");
        $infog=mysqli_fetch_object($sqlg);
    }
    else{
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid order by time desc");
        $infog=mysqli_fetch_object($sqlg);
    }

}
else if($helpLoc!=''&&$helpTime!=''&&$helpType==''){//二重限制

    $nameArr=explode(' ',$helpLoc);
    for($index=0;$index<count($nameArr);$index++){
        if($index==0){
            $whereSql=" where (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
        }
        $whereSql .= " And (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
    }
    //空格分隔多条件模糊查询
    if($helpTime=='jf1'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.'order by helpvalue desc');
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='jf2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.'order by helpvalue asc');
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='sj2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.'order by time asc');
        $infog=mysqli_fetch_object($sqlg);
    }
    else{
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.'order by time desc');
        $infog=mysqli_fetch_object($sqlg);
    }
    
}

else if($helpLoc!=''&&$helpTime==''&&$helpType!=''){//二重限制
    $nameArr=explode(' ',$helpLoc);
    for($index=0;$index<count($nameArr);$index++){
        if($index==0){
            $whereSql=" where (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
        }
        $whereSql .= " And (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
    }
    $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
    left JOIN tb_help_publish b
    on a.helpid=b.helpid ".$whereSql."and typeid=".$helpType." order by time desc");
    $infog=mysqli_fetch_object($sqlg);
}
else if($helpLoc==''&&$helpTime!=''&&$helpType!=''){//二重限制
    
    $whereSql=' where typeid='.$helpType;
    if($helpTime=='jf1'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.' order by helpvalue desc');
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='jf2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.' order by helpvalue asc');
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='sj2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.' order by time asc');
        $infog=mysqli_fetch_object($sqlg);
    }
    else{
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql.' order by time desc');
        $infog=mysqli_fetch_object($sqlg);
    }

}
else if($helpLoc!=''&&$helpTime!=''&&$helpType!=''){//三重限制

    $nameArr=explode(' ',$helpLoc);
    for($index=0;$index<count($nameArr);$index++){
        if($index==0){
            $whereSql=" where (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
        }
        $whereSql .= " And (startloc like '%$nameArr[$index]%' or endloc like '%$nameArr[$index]%') ";
    }
    //空格分隔多条件模糊查询
    $typeSql=' typeid='.$helpType;
    if($helpTime=='jf1'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql."and".$typeSql." order by helpvalue desc");
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='jf2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql."and".$typeSql." order by helpvalue asc");
        $infog=mysqli_fetch_object($sqlg);
    }
    else if($helpTime=='sj2'){
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql."and".$typeSql." order by time asc");
        $infog=mysqli_fetch_object($sqlg);
    }
    else{
        $sqlg=mysqli_query($link,"select a.*,b.userid,b.time FROM tb_cqnu_help a
        left JOIN tb_help_publish b
        on a.helpid=b.helpid".$whereSql."and".$typeSql." order by time desc");
        $infog=mysqli_fetch_object($sqlg);
    }

}
do{
    
    $sqlc=mysqli_query($link,"select * FROM tb_cqnu_help a
    left JOIN tb_cqnu_jifen b
    on a.typeid=b.type
    WHERE helpid='".$infog->helpid."'" );
    $infoc=mysqli_fetch_object($sqlc);
?>
<div class="col-md-3 myImg" id="<?php echo $infog->helpid?>">
    <div class="myContent">
        <div class="myTitle"><button class="btn btn-primary btn-xs"><?php echo $infoc->describex?></button><a style="line-height:28px;padding-left:7px;"><?php echo $infog->title?></a>
            <a style="float:right;cursor:pointer;" class="xTags" title="帮不到忙"><span class="glyphicon glyphicon-remove"></span></a>
        </div>
        <hr>
        <div class="myWenzi">
            <?php echo $infog->content?>
        </div>
        <hr>
        <div class="myTime">
            限时：<?php echo $infog->starttime?>~<?php echo $infog->endtime?>
        </div>
        <hr>
        <div class="myWay">
            路线：<?php echo $infog->startloc?>~<?php echo $infog->endloc?>
        </div>
        <hr>
        <div id='otherId'>
            发起人ID：<a><?php echo $infog->userid?></a>
        </div>
        <hr>
        <div class="myTail">
            <div> 总编号:<em id="hpId"><?php echo $infog->helpid?></em></div>类型编号:<em id="typeId"><?php echo $infog->typeid?></em>
            <div class="sjBtn redBtn" id="agreeHelp"  data-toggle="modal" data-target="#confirmModal"><span class="glyphicon glyphicon-yen"></span>&nbsp;奖励：<?php echo $infog->helpvalue?>&nbsp;积分&nbsp;&nbsp;</div>
        </div>
    </div>
</div>
<?php
}while($infog=mysqli_fetch_object($sqlg));
?>