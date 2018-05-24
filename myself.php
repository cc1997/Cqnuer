<meta charset="utf-8">
<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
include_once("conn/conn.php");
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
        <div style="float: right;font-size:12px;padding:10px 10px 0 0;height:100%;white-space:nowrap;">

            <button type="button" class="btn btn-default btn-xs" title="数据库&数据关系" data-html="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="db_cqnuer（总数据库）<br>tb_cqnu_jifen|tb_jifen_detail（积分表与积分明细表连接）<br>以及收藏表、发布表。" style="float:right;">
            当前调用数据库状况<span class="glyphicon glyphicon-menu-down"></span>
            </button>
            
        </div>
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
                <li>
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
                <li class="activebar"><a href="myself.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION["logined"]?>的个人中心</a></li>
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
                        <h3 style='color:red;'>积分明细 <small>| 积分都去哪了</small></h3><br>
                        <?php $sqljf=mysqli_query($link,"select time,b.describex as miaoshu,maxfen,fen from tb_jifen_detail a JOIN tb_cqnu_jifen b ON a.type=b.type where userid='$_SESSION[logined]' order by time desc");$infojf=mysqli_fetch_object($sqljf);
                        do{
                        ?>
                        <div style="margin-bottom:10px;">您在 <?php echo $infojf->time ?> 进行了 <a><?php echo $infojf->miaoshu?></a> 操作 <?php if($infojf->fen>0){echo "获得了";}else{echo "扣除了";}?> <?php echo $infojf->fen?> 分 <small>| 该操作最大获得积分为：<?php echo $infojf->maxfen ?></small></div>
                        <?php 
                        }while($infojf=mysqli_fetch_object($sqljf));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 myImg">
                        <div class="col-md-6"></div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h3 style='color:red;'>我的收藏 <small>| 笔记/答案</small></h3>
                            <table class="table table-hover">
                                <thead>
                                    <th>笔记id</th>
                                    <th>标题</th>
                                    <th>简介</th>
                                    <th>收藏时间</th>
                                </thead>
                                <tbody>
                                    <?php $sqlsc=mysqli_query($link,"select a.noteid,a.title,a.intro,b.time FROM tb_cqnu_note a
                                    JOIN tb_note_sc b
                                    ON a.noteid=b.noteid
                                    WHERE userid='$_SESSION[logined]'");
                                    $infosc=mysqli_fetch_object($sqlsc);
                                    do{
                                    ?>
                                    <tr>
                                        <td><?php echo $infosc->noteid ?></td>
                                        <td><?php echo $infosc->title ?></td>
                                        <td><?php echo $infosc->intro ?></td>
                                        <td><?php echo $infosc->time ?></td>
                                    </tr>
                                    <?php 
                                    }while($infosc=mysqli_fetch_object($sqlsc));
                                    ?>
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 myImg">
                        <div class="col-md-6"></div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h3 style='color:red;'>我的发布 <small>| 笔记/帮帮</small></h3>
                            <table class="table table-hover">
                                <thead>
                                    <th>笔记id</th>
                                    <th>标题</th>
                                    <th>简介</th>
                                    <th>发布时间</th>
                                </thead>
                                <tbody>
                                    <?php $sqlfb=mysqli_query($link,"select a.noteid,a.title,a.intro,b.time FROM tb_cqnu_note a
                                    JOIN tb_note_publish b
                                    ON a.noteid=b.noteid
                                    WHERE userid='$_SESSION[logined]'");
                                    $infofb=mysqli_fetch_object($sqlfb);
                                    do{
                                    ?>
                                    <tr>
                                        <td><?php echo $infofb->noteid ?></td>
                                        <td><?php echo $infofb->title ?></td>
                                        <td><?php echo $infofb->intro ?></td>
                                        <td><?php echo $infofb->time ?></td>
                                    </tr>
                                    <?php 
                                    }while($infofb=mysqli_fetch_object($sqlfb));
                                    ?>
                                </tbody>
                            </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 myImg">
                        <div class="col-md-6"></div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h3>我的任务 <small>| 帮帮</small></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 myImg">
                        <div class="col-md-6"></div>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-lg-12">
                        <h3>最近浏览 <small>| 笔记/答案</small></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 myImg">
                        <div class="col-md-6">最近浏览需要加多一个浏览记录表</div>
                    </div>
                </div>

                <?php }?>

                <hr>

                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; CQNU 2018</p>
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
