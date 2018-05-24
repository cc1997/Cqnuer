<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
include_once("conn/conn.php");
date_default_timezone_set("Etc/GMT-8");
function count_days($a,$b){
    $a_dt = getdate($a);
    $b_dt = getdate($b);
    $a_new = mktime(12, 0, 0, $a_dt['mon'], $a_dt['mday'], $a_dt['year']);
    $b_new = mktime(12, 0, 0, $b_dt['mon'], $b_dt['mday'], $b_dt['year']);
    return round(abs($a_new-$b_new)/86400);
}
$date=strtotime("now");
$userid=$_SESSION['logined'];
$sqlt=mysqli_query($link,"select * from tb_jifen_detail where userid='$userid' and type='0' order by time desc limit 1");
$infot=mysqli_fetch_object($sqlt);
if($infot->time!=""){
    $str=$infot->time;
    $str=strtotime($str);
    //$str2=$date-$str;//点击时间-上次签到时间（上次通过签到加积分时间）= 时差 //时差>24小时（86400秒）可以签，else不可以
    //$x=floor($str2/86400);
    $x = count_days($date,$str);//改为到前一天零点的时间差值，
    if($x<0){echo "NO/$infot->time/";exit;}
    if($x==0){echo "NO/$infot->time/";exit;}//一天没过完，到x==1过完。
    if($x>=1){
        $sqlc=mysqli_query($link,"select count(*) as cnt from tb_jifen_detail where userid='$userid' and type='0'");//计签到数
        $infoc=mysqli_fetch_object($sqlc);
        $cnt=$infoc->cnt+1;
        $date=date("Y-m-j H:i:s");
        $fb_fen = 2;
        mysqli_query($link,"insert into tb_jifen_detail(userid,describex,type,fen,time) values('$userid','签到','0','$fb_fen','$date')");//签
        echo "OK/$cnt/$date";
    }
}
else{
$date=date("Y-m-j H:i:s");
$fb_fen = 2;
mysqli_query($link,"insert into tb_jifen_detail(userid,describex,type,fen,time) values('$userid','签到','0','$fb_fen','$date')");//签
echo "OK/0/$date";
}
?>