<?php
include_once("conn/conn.php");
session_start();
$uid=$_POST["uid"];
$pwd=$_POST["pwd"];
$sql=mysqli_query($link,"select * from tb_cqnu_user where name='".$uid."' and password='".$pwd."'");
$info=mysqli_fetch_object($sql);
if($info==true)
{
 $_SESSION['logined'];
 $_SESSION['logined']=$uid;
 echo"OK";
}
else{
 echo"NO";
}
?>