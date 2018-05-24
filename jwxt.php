<meta charset="utf-8">
<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
session_start();
if($_SESSION["logined"]==""){
	echo "<script>window.location.href = 'index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no shrink-to-fit=no"><!--手机上按输入框不放大-->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>重师小助手</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <style>
     .indexTitle{position:fixed;z-index:2;width:100%;overflow:hidden;height:50px;display:block;border:1px solid #000;background-color: #fff;color:#000;font-size: 30px;line-height:48px;}
     .indexTitle a{overflow:hidden;color:#000;padding-left:10px;}
     .indexTitle a:link{text-decoration:none;}
	 a{text-decoration:none;}
	 a:hover{text-decoration: none;}
     .img-responsive{width:100%;margin-bottom: 20px;}
     .myImg{padding:10px;}
     .myContent{border:1px solid black; box-shadow:5px 5px 5px grey;padding:10px;}
     .myTitle{font-size:18px;font-weight:bold;margin-bottom:5px;}
    </style>
</head>

<body>
    <div class="indexTitle" >
        <img src="./img/cqnux.png" style="float: left;margin:4px 0 0 4px;width:40px;"> 
        <a href="#menu-toggle" class="menu-toggle">重师小助手</a>
        <div style="float: right;font-size: 12px;">made by hexuchao</div>
    </div>
    <div id="wrapper" style="padding-top: 50px;" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;&nbsp;首页</a>
                </li>
                <li>
                    <a href="biji.php"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;笔记</a>
                </li>
                <li>
                    <a href="help.php"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;&nbsp;帮帮</a>
                </li>
                <li>
                    <a href="xianzhi.php"><span class="glyphicon glyphicon-yen"></span>&nbsp;&nbsp;&nbsp;闲置</a>
                </li>
                <li class="activebar">
                    <a href="jwxt.php"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;&nbsp;课表</a>
                </li>
                <li>
                    <a href="setting.php"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;&nbsp;设置</a>
                </li>
                <?php
	            if($_SESSION["logined"]==""){
                ?>
                <li><a href="#" onClick="javascript:showBg();">注册/登录</a></li>
                <?php 
                }else{
                ?>
                <li><a href="myself.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION["logined"]?>的个人中心</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;&nbsp;退出登陆</a></li>
                <?php }?>
            </ul>
            <button class="btn btn-primary menu-toggle" style="position:absolute;bottom:70px;right:10px;">收起</button>
        </div>

    </div>   
    <div id="page-content-wrapper">
            <div class="container-fluid">
            <?php if($_SESSION["logined"]==""){?><div><a href="#" onClick="javascript:showBg();">请登录后使用</a>(testid:cc pwd:1)</div>
            <?php }else{?>
                <div class="row">
                    <div class="col-lg-12">
                        <h3>课表<small> | 爬取教务系统（还在测试...）</small></h3>
                    </div>
                </div>
                                
        
                <div class="row">
                    <div class="col-md-12 myImg">
                       <?php require 'catch.php'?>
                    </div>
                </div>
 
                <?php }?>

                <hr>

                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; CQNU 2017</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
    $(".menu-toggle").click(function(e) {
        $("#wrapper").toggleClass("toggled");
    });

    $(function () { 
        $("[data-toggle='popover']").popover();
    });
    </script>
    

</body>

</html>
