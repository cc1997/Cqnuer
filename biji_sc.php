<?php
header("Content-Type: text/html;charset=utf-8");
include_once("conn/conn.php");
session_start();
date_default_timezone_set("Asia/Chongqing");
$bjId=$_POST["bjId"];
$userId=$_SESSION["logined"];
$date=strtotime("now");
$date=date("Y-m-j H:i:s");
$state=1;
$sqlx=mysqli_query($link,"select * from tb_note_sc where userid='$userId' and noteid='$bjId' ");
$infox=mysqli_fetch_object($sqlx);

if($infox->userid==''){
    if(mysqli_query($link,"insert into tb_note_sc(userid,noteid,time) values('$userId','$bjId','$date')"))
    {
        echo "收藏成功，可以到个人中心查看[我的收藏]";
    }
    else{
        echo "NO";
    }
}else{
    if(mysqli_query($link,"delete from tb_note_sc where userid='$userId' and noteid='$bjId' "))
    {
        echo "取消收藏成功！";
    }
    else{
        echo "NOdel";
    }
}
?>