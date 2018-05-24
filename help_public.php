<?php include_once("conn/conn.php");session_start();?>
<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
date_default_timezone_set("Asia/Chongqing");
$title = $_POST['titleHelp'];
$typeId = $_POST['helpTypeSelect'];
$intro = $_POST['introHelp'];
$times = $_POST['timeHelpS'];
$timee = $_POST['timeHelpE'];
$startLoc = $_POST['startHelp'];
$endLoc = $_POST['endHelp'];
$fen = $_POST['valueHelp'];
$userid=$_SESSION['logined'];
$date=strtotime("now");
$date=date("Y-m-j H:i:s");
$strOnly=mb_substr($date,11,8);//时间构成唯一标识、、开始
$arrOnly=explode(':',$strOnly);
echo $strOnlyx=$arrOnly[0].$typeId.$arrOnly[1].$fen.$arrOnly[2];//唯一标识！如果采用递增无法判断知道插入的id号，就无法在进一步将求助id和用户id相连、、结束//2+1(>2)+2+1(>2)+2
$sqlCheck = mysqli_query($link,"select maxfen from tb_cqnu_jifen where type=".$typeId);//看超过积分没
$infoCheck=mysqli_fetch_object($sqlCheck);
?>
<?php
if($title==''){
?>
<script>alert("请输入标题！！！");window.location.href='help.php';</script>
<?php
}else if(strlen($intro)>150){
?>
<script>alert("简介超过50字啦！");window.location.href='help.php';</script>
<?php
}else if($fen>$infoCheck->maxfen){
?>
<script>alert('分数超过最大限制，该类型最大限制分数为'+"<?php echo $infoCheck->maxfen?>");window.location.href='help.php';</script>
<?php
}else if($fen<=0){
?>
<script>alert("奖励别人的积分不能小于等于零分噢！");window.location.href='help.php';</script>
<?php    
}else if(mysqli_query($link,"insert into tb_cqnu_help(typeid,title,content,starttime,endtime,startloc,endloc,helpvalue,onlycheck) values('$typeId','$title','$intro','$times','$timee','$startLoc','$endLoc','$fen','$strOnlyx')")){
    
    $sqlfj=mysqli_query($link,"select * from tb_cqnu_help where onlycheck='".$strOnlyx."'");
    $infofj=mysqli_fetch_object($sqlfj);
    $helpid=$infofj->helpid;
    $fb_fen='-'.$fen;
    mysqli_query($link,"insert into tb_help_publish(userid,helpid,time) values('$userid','$helpid','$date')");
    mysqli_query($link,"insert into tb_jifen_detail(userid,describex,type,fen,time) values('$userid','帮帮积分交易','6','$fb_fen','$date')");
?>
<div >
    发布成功了！
    <a href="help.php">返回查看>></a>
</div>
<?php
}
?>