<?php
header("Content-Type: text/html;charset=utf-8");
include_once("conn/conn.php");
session_start();
date_default_timezone_set("Asia/Chongqing");
$tit=$_POST["title"];
$intr=$_POST["intro"];
$cont=$_POST["content"];
$userid=$_SESSION["logined"];
$cont2="";
$date=strtotime("now");
$date=date("Y-m-j H:i:s");
$status=$_POST["status"];
if(!get_magic_quotes_gpc()){
        $cont2 = addslashes($_POST["content"]);//非常神奇的函数！自动把字符转义！by hexuchao
}

//echo $tit;
//echo $cont2;
//echo $date;


//if($tit="") {echo "NOx1";exit;}
//if($cont="") {echo "NOx2";exit;}
if($cont2==""){echo "NO";exit;}
$sql=mysqli_query($link,"select title from tb_cqnu_note where title='".$tit."'");
$info=mysqli_fetch_object($sql);
if($info!=false)
 {
  echo "NO1"; 
  exit; 
 }

if(mysqli_query($link,"insert into tb_cqnu_note(title,content,intro) values('$tit','$cont2','$intr')"))
{
    $sqlfj=mysqli_query($link,"select * from tb_cqnu_note where title='".$tit."'");
    $infofj=mysqli_fetch_object($sqlfj);
    $noteid=$infofj->noteid;
    echo $userid;
    echo $noteid;
    echo $status;//发布（公开）或保存（私密）
    echo $date;
    $fb_fen = 10;
    mysqli_query($link,"insert into tb_note_publish(userid,noteid,time) values('$userid','$noteid','$date')");
    mysqli_query($link,"insert into tb_jifen_detail(userid,describex,type,fen,time) values('$userid','发布笔记/答案','1','$fb_fen','$date')");
    echo "OK";
}
else{
    echo "NO";
}
?>