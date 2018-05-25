<?php
include_once("../conn/conn.php");
session_start();
$uid=$_POST["uid"];
$pwd=$_POST["pwd"];
$sql=mysqli_query($link,"select * from tb_cqnu_admin where adminname='".$uid."' and adminpwd='".$pwd."'");
$info=mysqli_fetch_object($sql);
if($info==true)
{
 $_SESSION['loginx'];
 $_SESSION['loginx']=$uid;
 echo"OK";
}
else{
 echo"NO";
}
?>