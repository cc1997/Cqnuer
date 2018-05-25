<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
include_once("../conn/conn.php");
if($_SESSION["loginx"]==""){
	echo "<script>alert('请通过正确方式登录');window.location.href = 'index.php'</script>";
}
$sql=mysqli_query($link,'select a.*,b.userid,b.time FROM tb_cqnu_note a
left JOIN tb_note_publish b
on a.noteid=b.noteid');
$info=mysqli_fetch_object($sql);
?>
<!DOCTYPE html>
<html>
    <title>小助手后台</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
    </head>
    <body>
        <table class="table table-hover">
            <caption>笔记信息表</caption>
            <thead>
                <tr>
                    <th>文章id</th>
                    <th>文章标题</th>
                    <th>文章简介</th>
                    <th>文章内容</th>
                    <th>发布用户</th>
                    <th>发布时间</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                do{
                ?>
                <tr>
                    <td><?php echo $info->noteid?></td>
                    <td><?php echo $info->title?></td>
                    <td><?php echo $info->intro?></td>
                    <td><?php echo '略' ?></td>
                    <td><?php echo $info->userid?></td>
                    <td><?php echo $info->time?></td>
                </tr>
                <?php
                }while($info=mysqli_fetch_object($sql));
                ?>
            </tbody>
        </table><hr>
        <div>
            <a href="guanli.php"><button class='btn btn-primary'>管理用户</button></a>
            <a href="guanlibiji.php"><button class='btn btn-primary'>管理笔记</button></a>
            <a href="guanlihelp.php"><button class='btn btn-primary'>管理帮帮</button></a>
            <a href="logout.php"><button class='btn btn-danger'>退出</button></a>
        </div>
    </body>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script>
        function sexTraslate(xStr){
            if(xStr=='1'){
                return '男';
            }else{
                return '女';
            }
        }
    </script>
</html>