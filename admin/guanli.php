<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
include_once("../conn/conn.php");
if($_SESSION["loginx"]==""){
	echo "<script>alert('请通过正确方式登录');window.location.href = 'index.php'</script>";
}
$sql=mysqli_query($link,'select * from tb_cqnu_user');
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
    <script type="text/javascript" src="http://counter.sina.com.cn/ip/" charset="gb2312"></script>       <!--获取接口数据，注意charset -->
    <script type="text/javascript"> 
    alert("IP地址："+ILData[0]+"<br />"+"地址类型："+ILData[2]+"<br />"+"地址类型："+ILData[4]+"<br />");
    </script>
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