<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
include_once("../conn/conn.php");
if($_SESSION["loginx"]==""){
	echo "<script>alert('请通过正确方式登录');window.location.href = 'index.php'</script>";
}
$sql=mysqli_query($link,'select a.*,b.userid,b.time FROM tb_cqnu_help a
left JOIN tb_help_publish b
on a.helpid=b.helpid');
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
            <caption>帮帮信息表</caption>
            <thead>
                <tr>
                    <th>求助编号</th>
                    <th>求助类型</th>
                    <th>求助标题</th>
                    <th>求助内容</th>
                    <th>开始时间</th>
                    <th>截止时间</th>
                    <th>开始位置</th>
                    <th>结束位置</th>
                    <th>奖励积分</th>
                    <th>发布时间</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                do{
                ?>
                <tr>
                    <td><?php echo $info->helpid?></td>
                    <td><?php echo $info->typeid?></td>
                    <td><?php echo $info->title?></td>
                    <td><?php echo $info->content?></td>
                    <td><?php echo $info->starttime ?></td>
                    <td><?php echo $info->endtime ?></td>
                    <td><?php echo $info->startloc ?></td>
                    <td><?php echo $info->endloc ?></td>
                    <td><?php echo $info->helpvalue?></td>
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