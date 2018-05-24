<meta charset="utf-8">
<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
include_once("conn/conn.php");
session_start();
date_default_timezone_set("Etc/GMT-8");
function count_days($a,$b){
    $a_dt = getdate($a);
    $b_dt = getdate($b);
    $a_new = mktime(12, 0, 0, $a_dt['mon'], $a_dt['mday'], $a_dt['year']);
    $b_new = mktime(12, 0, 0, $b_dt['mon'], $b_dt['mday'], $b_dt['year']);
    return round(abs($a_new-$b_new)/86400);
}
if($_SESSION["logined"]==""){
	echo "<script>window.location.href = 'index.php'</script>";
}
$sqlJiFen=mysqli_query($link,"select userid,sum(fen) as totaljf FROM tb_jifen_detail where userid='$_SESSION[logined]'");
$infojf=mysqli_fetch_object($sqlJiFen);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
     .myImg{padding:10px;transition:.5s all ease-in;}
     .myContent{border:1px solid black; box-shadow:5px 5px 5px grey;padding:10px;}
     .myTitle{font-size:18px;font-weight:bold;margin-bottom:5px;}
     .boxShow{height:0;overflow:hidden;transition:1s all ease-in-out;}
     .boxRealShow{height:500px;overflow:hidden;transition:1s all ease-in-out;}
     .myTail{border-top:1px solid #eee;padding-top:5px;}
     .sjBtn{float:right;cursor:pointer;}
     .redBtn{color:red;}
     .xTitle{cursor:pointer;}
     .myImgSmall{width:0;height:0;border:0px solid black;}
     .rangeClass{position:absolute;background-color:#eee;border:1px solid black;z-index:10;list-style-type:none;padding:5px;margin:3px 0 0 20px;opacity:0;height:0;overflow:hidden;transition:.5s all ease-in-out}
     .rangeClass li{display:block;background-color:#fff;margin-bottom:5px;cursor:pointer;font-size:14px;padding:5px;}
     .rangeClass li:hover{background-color:#f99;}
     .rangeClass2{position:absolute;background-color:#eee;border:1px solid black;z-index:10;list-style-type:none;padding:5px;margin:3px 0 0 20px;opacity:1;height:150px}
     .myWenzi{padding:20px;}
     #txImg{height:180px;width:150px;}
    </style>
</head>

<body>
    <div class="indexTitle" >
        <img src="./img/cqnux.png" style="float: left;margin:4px 0 0 4px;width:40px;"> 
        <a href="#menu-toggle" class="menu-toggle">重师小助手</a>
        <div style="float: right;font-size:12px;padding:10px 10px 0 0;height:100%;">
            <button id="5" type="button" class="btn btn-xs" title="数据库&数据关系" 
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="db_cqnuer|tb_cqnu_user|(用户关系)" style="float:right;">
            当前调用数据库状况<span class="glyphicon glyphicon-menu-down"></span>
            </button>
            <div>made</div> 
        </div>
        <div style="float: right"></div>
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
                <li class="activebar">
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
                        <h2>个人设置&nbsp;<small>|&nbsp;修改信息 / 账号安全 / 绑定手机</small></h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 myImg" >
                        <div class="myContent">
                            <div class="myTitle"><a href="biji.php" style="line-height:28px;padding-left:7px;"><b style="font-size:25px;color:#666;">基本信息</b></a>
                                <a style="float:right;cursor:pointer;" class="xTags" title="帮不到忙"><span class="glyphicon glyphicon-pushpin"></span></a>
                            </div>
                            <hr>
                            <div class="myWenzi">
                                <form action="">
                                <div class="row">
                                <div class="col-md-4">
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <img src="img/cqnux.png" id='txImg' alt="">
                                        <input id="zp" type="file" >
                                    </div>
                                    <div class="col-md-6">
                                        <b>修改头像：</b><br><br>
                                        1.尽量使用真实相片<br><br>
                                        2.上传后可预览<br><br>
                                        3.请不要上传暴力/色情的照片...<br><br>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="input-group-addon"  >
                                            用户名
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="cc" disabled>
                                    </div>
                                    <div class="col-md-6" >
                                        <span class="input-group-addon"  style="background-color:lightblue;color:white;font-weight:bold"  >
                                            邮<span style="opacity:0">—</span>箱
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="slepox@126.com">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <span class="input-group-addon"   >
                                            积<span style="opacity:0">—</span>分
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="<?php echo $infojf->totaljf?>" disabled>
                                    </div>
                                    <div class="col-md-6" >
                                        <span class="input-group-addon"  style="background-color:lightblue;color:white;font-weight:bold"  >
                                            手<span style="opacity:0">—</span>机
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="18875032861">
                                    </div>
                                </div>
                                <br>
                                <div class="" >
                                    <input type="submit"  class="btn btn-info form-control" value="确 认 修 改">
                                    <br><br>
                                    <input type="reset"  class="btn btn-info form-control" value="重 写">
                                </div>
                                
                                </form>
                                <hr>
                                <?php 
                                $sqlt=mysqli_query($link,"select * from tb_jifen_detail where userid='$userid' and type='0' order by time desc limit 1");
                                $infot=mysqli_fetch_object($sqlt);
                                if($infot->time==""){
                                ?>
                                <button class="btn btn-default input-group"  id="qiandao" style="width:100%" data-toggle="modal" data-target="#myModal">点此 签到 领积分 +2</button>
                                <?php
                                }else{
                                ?>
                                <button class="btn btn-default input-group" id="qiandao" style="width:100%" disabled>今日已签到</button>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="myTail">
                                &nbsp;
                                <div class="sjBtn" ><span class="glyphicon glyphicon-copyright-mark"></span>&nbsp;重庆师范大学2015级计算机科学与技术</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 myImg" >
                        <div class="myContent">
                            <div class="myTitle"><a href="biji.php" style="line-height:28px;padding-left:7px;"><b style="font-size:25px;color:#666;">安全</b></a>
                                <a style="float:right;cursor:pointer;" class="xTags" title="帮不到忙"><span class="glyphicon glyphicon-pushpin"></span></a>
                            </div>
                            <hr>
                            <div class="myWenzi">
                                <form action="">
                                    <div class="input-group">
                                        <span class="input-group-addon"  style="background-color:lightblue;color:white;font-weight:bold"   >
                                            原密码
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="">
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"  style="background-color:lightgreen;color:white;font-weight:bold"   >
                                            新密码
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="">
                                    </div><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"  style="background-color:lightgreen;color:white;font-weight:bold"   >
                                            确认密码
                                        </span>
                                        <input id="upusn" type="text" class="form-control" value="">
                                    </div><br>
                                    <input type="submit"  class="btn btn-info form-control" value="确 认 修 改">
                                </form>
                            </div>
                            <div class="myTail">
                                &nbsp;
                                <div class="sjBtn" ><span class="glyphicon glyphicon-copyright-mark"></span>&nbsp;重庆师范大学2015级计算机科学与技术</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    签到消息
                                </h4>
                            </div>
                            <div class="modal-body">
                                在这里添加一些文本
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                </button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
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

    $(".xTags").each(function(){
        $(this).click(function(e) {
            alert($(this).parent().parent().parent().attr("id"));
            bjDivId=$(this).parent().parent().parent().attr("id");$(this).parent().parent().parent().toggleClass("myImgSmall");
            $(this).parent().parent().parent().css({"padding":"0px","border":"0px"});//消除样式 by hxc
            $(this).parent().parent().css({"padding":"0px","box-shadow":"0 0 0","border":"0px"});//消除样式 hxc
            $(this).parent().parent().text('');
        });
    });

    $("#rangeBtn").click(function(e) {
        $("#xRange").toggleClass("rangeClass2");
    });

    //动态显示图片
    $("#zp").change(function(){
        var objUrl = getObjectURL(this.files[0]) ;
        console.log("objUrl = "+objUrl) ;
        if (objUrl) 
        {
        $("#txImg").attr("src", objUrl);
        $("#txImg").removeClass("hide");
        }
    })

    function getObjectURL(file) 
    {
        var url = null ;
        if (window.createObjectURL!=undefined) 
        { 
        url = window.createObjectURL(file) ;
        }
        else if (window.URL!=undefined) 
        {
        url = window.URL.createObjectURL(file) ;
        } 
        else if (window.webkitURL!=undefined) 
        {
        url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
    //动态显示图片（上传）

    $("#qiandao").click(function(e){
        $.ajax({
            url:"qiandao.php",//请求地址
            type:"POST",//提交的方式
            dataType:"HTML", //返回类型
            success:function(data){
                arrx=data.split('/');
                qianState=arrx[0];
                qianTimes=arrx[1];
                qianTime=arrx[2];
                if(qianState=='OK'){
                    tipStr='签到成功！<br>您已经签到共计 <b>'+qianTimes+'</b> 次<br>您本次签到时间为: <b>'+qianTime+'</b>';
                }else if(qianState=='NO'){
                    tipStr='签到失败，您已于 <b>'+qianTimes+'</b> 签到<br>明天0点后再来吧~';
                }else{
                    tipStr='签到非法！';
                }
                $('.modal-body').html(tipStr);
            }
        });
    })
    </script>
    

</body>

</html>
