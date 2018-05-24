<?php
include_once("conn/conn.php");
session_start();
$uid=$_POST["uid"];
$pwd=$_POST["pwd"];
$email=$_POST["email"];
$sql=mysqli_query($link,"select * from tb_cqnu_user where name='".$uid."'");
$info=mysqli_fetch_object($sql);
if($info==true)
{
 echo"NO";
}
else{
    if(mysqli_query($link,"insert into tb_cqnu_user(name,password,email,createtime) values('$uid','$pwd','$email',now())")){
        $_SESSION['logined'];
        $_SESSION['logined']=$uid;
        echo "OK";
    }else echo "X";
}
?>