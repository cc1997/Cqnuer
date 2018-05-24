<?php include_once("conn/conn.php");session_start();?>
<?php 
$myId = $_SESSION['logined'];
$otherId = $_POST['otherId'];
if($myId==$otherId){
    echo "YOURSELF";exit;
}else{
    $sqlm=mysqli_query($link,"select * from tb_cqnu_user where name = '$myId' ");
    $infom=mysqli_fetch_object($sqlm);
    $sqlo=mysqli_query($link,"select * from tb_cqnu_user where name = '$otherId' ");
    $info=mysqli_fetch_object($sqlo);
    echo $infom->name.'/'.$infom->sexual.'/'.$infom->email.'/'.$infom->phonenum.'/'.$infom->createtime.'/'.$info->name.'/'.$info->sexual.'/'.$info->email.'/'.$info->phonenum.'/'.$info->createtime;
}