<?php include_once("conn/conn.php");session_start();?>
<?php 
$bjId=$_POST['bjId'];
$sqlg=mysqli_query($link,"select * from tb_cqnu_note where noteid = '$bjId' ");
$infog=mysqli_fetch_object($sqlg);
if(!isset($_POST['x'])){
    echo $infog->content;
}else{
    echo $infog->intro;
}