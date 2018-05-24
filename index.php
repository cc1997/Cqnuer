<meta charset="utf-8">
<?php
header ( "Content-type: text/html; charset=utf-8" ); //设置文件编码格式
include_once("conn/conn.php");
session_start();
if($_SESSION["logined"]==""){
	echo "<script>window.location.href = 'index.html'</script>";
}
$sqlJiFen=mysqli_query($link,"select userid,sum(fen) as totaljf FROM tb_jifen_detail where userid='$_SESSION[logined]'");
$infojf=mysqli_fetch_object($sqlJiFen);
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
     .img-responsive{height:200px;width:100%;margin-bottom: 0px;}
     .myImg{padding:10px;}
     .myContent{border:1px solid black; box-shadow:5px 5px 5px grey;padding:10px;}
     .myTitle{font-size:18px;font-weight:bold;margin-bottom:5px;}
     .myGift{border:1px solid black;box-shadow:3px 3px 3px black;}
     .giftName{text-align:center;border-bottom:2px solid #eee}
     .giftGet{text-align:center;color:#aaa;cursor:pointer;}
     .giftGet:hover{background-color:#eee}
     @media (max-width:400px){
        .img-responsive{height:auto;width:100%;margin-bottom: 0px;}
        .myGift{border:1px solid black;box-shadow:3px 3px 3px black;margin-bottom:10px;}
     }
    </style>
</head>

<body>
    <?php include 'sidebar.php'?>
    <div id="page-content-wrapper">
            <div class="container-fluid">
            <?php if($_SESSION["logined"]==""){?><div><a href="#" onClick="javascript:showBg();">请登录后使用</a>(testid:cc pwd:1)</div>
            <?php }else{?>
                <div class="row">
                    <div class="col-lg-12">
                        <h3>积分奖品 <small> | 当前积分：<?php echo $infojf->totaljf ?><a href="myself.php"> | 查看明细</a></small></h3>
                        <ol class="breadcrumb">
                        <li class="active">
                        <input type="text">
                        <button class="btn btn-dark btn-sm">搜索奖品</button>
                        </li>
                        <li>
                        <button type="button" class="btn btn-danger btn-xs" title="操作提示" data-html="true"
                        data-container="body" data-toggle="popover" data-placement="bottom"
                        data-content="点击导航栏（左上角） 重师小助手 可唤出侧边栏和收起侧边栏" style="float:right;">
                        操作提示
                        </button>
                        </li>
                        </ol>
                    </div>
                </div>
                                
        
                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="col-md-3">
                            <div class="myGift">
                                <img class="img-responsive img-hover" src="img/tsg.jpg" alt="">
                                <div class="giftName">重师图书馆一日游</div>
                                <div data-toggle='modal' data-target='#myModaldel' class="giftGet">999积分可以兑换</div> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="myGift">
                                <img class="img-responsive img-hover" src="img/10img.jpg" alt="">
                                <div class="giftName">10元现金</div>
                                <div data-toggle='modal' data-target='#myModaldel' class="giftGet">200积分可以兑换</div> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="myGift">
                                <img class="img-responsive img-hover" src="img/50img.jpg" alt="">
                                <div class="giftName">50元现金</div>
                                <div  data-toggle='modal' data-target='#myModaldel' class="giftGet">700积分可以兑换</div> 
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="myGift">
                                <img class="img-responsive img-hover" src="img/100img.jpg" alt="">
                                <div class="giftName">100元现金</div>
                                <div data-toggle='modal' data-target='#myModaldel' class="giftGet">1500积分可以兑换</div>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

                <button class="btn btn-default input-group"  id="qiandao" style="width:100%" data-toggle="modal" data-target="#myModal">点此 签到 领积分 +2</button>
                
                <hr>

                <div class='row'>
                    <div class="col-lg-8">
                        <h3 style='color:green;'>积分细则<small> | 数据库 积分表</small></h3><br>
                            <table class="table table-hover">
                                <thead>
                                    <th>积分类型号</th>
                                    <th>该类型最大获得积分</th>
                                    <th>描述</th>
                                </thead>
                                <tbody>
                                    <?php $sqlx=mysqli_query($link,"select * from tb_cqnu_jifen");
                                    $infox=mysqli_fetch_object($sqlx);
                                    do{
                                    ?>
                                    <tr>
                                        <td><?php echo $infox->type ?></td>
                                        <td><?php echo $infox->maxfen ?></td>
                                        <td><?php echo $infox->describex ?></td>
                                    </tr>
                                    <?php 
                                    }while($infox=mysqli_fetch_object($sqlx));
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    <div class='col-lg-4' style='padding:20px;'>
                        积分表：定义了获取积分的途径、类型、最大获得分值及其描述，在使用网站时应 注意符合规则
                    </div>
                </div>

                <hr>

                <?php }?>

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
                $('.modal-body.qianD').html(tipStr);
            }
        });
    })
    </script>
    
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModaldel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    小贴士
                </h4>
            </div>
            <div class="modal-body">
                您的积分尚且不足以兑换该礼品，继续努力哦！
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    好的，我知道了
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    签到信息
                </h4>
            </div>
            <div class="modal-body qianD">
                非法签到
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    好的，我知道了
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
</body>

</html>
