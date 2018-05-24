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
     .myImg{padding:10px;transition:.5s all ease-in;}
     .myContent{border:1px solid black; box-shadow:5px 5px 5px grey;padding:10px;}
     .myTitle{font-size:18px;font-weight:bold;margin-bottom:5px;}
     .myWenzi{height:80px;overflow:hidden;}
     .boxShow{height:0;overflow:hidden;transition:1s all ease-in-out;}
     .boxRealShow{height:500px;overflow:hidden;transition:1s all ease-in-out;}
     .myTail{border-top:0px solid #eee;padding-top:5px;}
     .sjBtn{float:right;cursor:pointer;}
     .redBtn{color:red;}
     .xTitle{cursor:pointer;}
     .myImgSmall{width:0;height:0;border:0px solid black;}
     .rangeClass{position:absolute;background-color:#eee;border:1px solid black;z-index:10;list-style-type:none;padding:5px;margin:3px 0 0 20px;opacity:0;height:0;overflow:hidden;transition:.5s all ease-in-out}
     .rangeClass li{display:block;background-color:#fff;margin-bottom:5px;cursor:pointer;font-size:14px;padding:5px;}
     .rangeClass li:hover{background-color:#f99;}
     .rangeClass2{position:absolute;background-color:#eee;border:1px solid black;z-index:10;list-style-type:none;padding:5px;margin:3px 0 0 20px;opacity:1;height:150px}
     #helpLoc{width:70%;margin-right:10px;}
     #findBtn{width:20%;}
     .inputTitlecc{
        border:1px solid #666;float:left;line-height:24px;background-color:#ccc;border-radius:5px 0 0 5px;padding-left:5px;
     }
     @media(max-width:400px){
        #helpLoc{width:100%;}
        #findBtn{width:100%;}
     }
    </style>
</head>

<body>
    <div class="indexTitle" >
        <img src="./img/cqnux.png" style="float: left;margin:4px 0 0 4px;width:40px;"> 
        <a href="#menu-toggle" class="menu-toggle">重师小助手</a>
        <div style="float: right;font-size:12px;padding:10px 10px 0 0;height:100%;">
            <button type="button" class="btn btn-xs" title="数据库&数据关系" 
            data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"
            data-content="db_cqnuer|tb_cqnu_help|(帮帮表)<br>表中多添加了一项属性：价值(即每个求助的交易积分)" style="float:right;">
            当前调用数据库状况<span class="glyphicon glyphicon-menu-down"></span>
            </button>
            <button type="button" class="btn btn-success btn-xs" title="网站制作" data-html="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="网站作者：贺旭超<br>指导老师：戴政国<br><br>为了兼容移动端调<br>了很多，<br>欢迎使用移动端！" style="float:right;">
            个人声明<span class="glyphicon glyphicon-menu-down"></span>
            </button>
            <button type="button" class="btn btn-danger btn-xs" title="二维码（生成自图联网）" data-html="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="<img src='img/ercode.png' style='width:100%'><br><button class='form-control'>abcd.dev.dxdc.net/db2/</button><hr><button class='form-control'>Bootstrap框架 / 可在移动端访问</button>" style="float:right;">
            <span class="glyphicon glyphicon-qrcode"></span>&nbsp;手机访问&nbsp;&nbsp;
            </button>
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
                <li class="activebar">
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
                        <h3>帮帮&nbsp;<small>|&nbsp;懒人神器 / 顺手帮忙 / 赚取积分</small></h3>
                        <ol class="breadcrumb">
                            <li class="active">
                                <button class="btn btn-danger btn-sm" id='needHelp' data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-hand-right"></span>&nbsp;请求帮助</button>
                                <button class="btn btn-info btn-xs" onclick='toHelpType(2)'><span class="glyphicon glyphicon-gift"></span>&nbsp;取快递</button>
                                <button class="btn btn-info btn-xs" onclick='toHelpType(3)'><span class="glyphicon glyphicon-cutlery"></span>&nbsp;带餐食</button>
                                <button class="btn btn-info btn-xs" onclick='toHelpType(5)'><span class="glyphicon glyphicon-credit-card"></span>&nbsp;充水电费</button>
                                <button class="btn btn-info btn-xs" onclick='toHelpType(4)'><span class="glyphicon glyphicon-education"></span>&nbsp;辅导学习</button>
                                <a href=""><button class="btn btn-info btn-xs">全部</button></a>
                                <input id="helpType" type="hidden" value="5"><!--帮助类型1，2，3，4，5-->
                            </li>
                            <li>
                                <button class="btn btn-primary btn-xs" id="rangeBtn">搜索排序<span class="glyphicon glyphicon-menu-down" style="padding-left:5px;"></span></button>
                                <ul id="xRange" class="rangeClass">
                                    <li onclick='toHelpTime("jf1")'>按积分从多到少排序</li>
                                    <li onclick='toHelpTime("jf2")'>按积分从少到多排序</li>
                                    
                                    <li onclick='toHelpTime("sj1")'>按时间从近到远排序</li>
                                    <li onclick='toHelpTime("sj2")'>按时间从远到近排序</li>
                                </ul>
                            </li>
                            <li style='font-size:12px;'>
                                当前查询状态: <b id='stateTime'>按时间从近到远排序</b> | <b id='stateType'>全部</b> | <b id='stateLoc'>不限</b>
                            </li>
                            <li>
                                <button type="button" class="btn btn-xs btn-default" title="小提示" 
                                data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"
                                data-content="点击 奖励 即可获取对方信息并接任务<br>点击 叉叉 即可忽略任务" style="float:right;">
                                使用提示<span class="glyphicon glyphicon-menu-down"></span>
                                </button>
                            </li>
                            <br><br>
                            <div class="input-group">
                                <span class="input-group-addon" style="background-color:#ccc;"  >
                                    位置
                                </span>
                                <input id="helpLoc" type="text" class="form-control"  placeholder="(例如:输入商业街，可顺路帮取快递)"><!--帮助位置-->
                                <button id="findBtn"  type="submit" class="btn btn-primary" >找一找</button>
                            </div>
                        </ol>
                    </div>
                </div>
                                
        
                <div class="row" id="helpShowBox">

                </div>

                <hr>

                <!-- Pagination -->
                <div class="row text-center">
                    <div class="col-lg-12">
                        <ul class="pagination">
                            <li>
                                <a class='backTop' href="#">&laquo;返回顶部&raquo;</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->
                <?php }?>

                <hr>

                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    请求帮助
                                </h4>
                            </div>
                            <form action="help_public.php" method='post'>
                                <div class="modal-body">
                                    
                                        <div class='inputTitlecc'>标<span style='opacity:0;'>——</span>题：</div>
                                            <input name='titleHelp' id='titleHelp' type="text"><br><br>
                                        <div class='inputTitlecc'>类<span style='opacity:0;'>——</span>型：</div>
                                            <select name="helpTypeSelect" id="helpTypeSelect" style='height:26px'>
                                                <option value="2">取快递</option>
                                                <option value="3">带餐食</option>
                                                <option value="4">辅导学习</option>
                                                <option value="5">充水电费</option>
                                            </select>
                                            <br><br>
                                        <div class='inputTitlecc' style="border-radius:5px 5px 0 0;">简单说明：</div>
                                            <textarea class="form-control" name='introHelp' id='introHelp' id="" rows="5"></textarea><br>
                                        <div class='inputTitlecc'>时<span style='opacity:0;'>——</span>间：</div>
                                            <input type="text" name='timeHelpS' id='timeHelpS'> 到 <input type="text" name='timeHelpE' id='timeHelpE'><br><em style='font-size:12px;'>格式例如：2018-01-24 18:00:00</em><br><br>
                                        <div class='inputTitlecc'>开始位置：</div>
                                            <input type="text" name='startHelp' id='startHelp' placeholder='如：北门商业街'><br><br>
                                        <div class='inputTitlecc'>到达位置：</div>
                                            <input type="text" name='endHelp' id='endHelp' placeholder='如：清风苑'><br><br>
                                        <div class='inputTitlecc'>奖<span style='opacity:0;'>——</span>赏：</div>
                                            <input type="text" name='valueHelp' id='valueHelp' placeholder='如：20'><br><em style='font-size:12px;'>超过该类型求助的最大分值将无法添加数据（如取快递最大50分）</em>
                                    
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value='发布'>
                                    <input type="reset" class="btn btn-sm" value='重写'>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">关闭</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    确认帮忙
                                </h4>
                            </div>
                            <div class="modal-body">
                                <div class='row'>
                                    <div class='col-xs-6'>
                                        您的信息：<br>
                                        id号：<span id='meId'></span><br>
                                        性别：<span id='meSex'></span><br>
                                        邮箱：<span id='meEmail'></span><br>
                                        电话：<span id='meTel'></span><br>
                                        注册时间：<span id='meTime'></span><br>
                                    </div>
                                    
                                    <div class='col-xs-6'>
                                        发布者信息：<br>
                                        id号：<span id='oId'></span><br>
                                        性别：<span id='oSex'></span><br>
                                        邮箱：<span id='oEmail'></span><br>
                                        电话：<span id='oTel'></span><br>
                                        注册时间：<span id='oTime'></span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                </button>
                                <button id='confirmHelp' type="button" class="btn btn-danger">
                                    确认接受
                                </button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>

                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; CQNU 2018</p>
                            <input id='helpTypeRec' type="hidden" value=''>
                            <input id='helpTimeRec' type="hidden" value=''>
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

        helpFind();

    });
    function helpFind(){
        
        var helpLoc=$("#helpLoc").val();
        var helpTimeRec=$('#helpTimeRec').val();
        var helpTypeRec=$('#helpTypeRec').val();

        $.ajax({
            url:"help_ajax.php",//请求地址
            data:{helpLoc:helpLoc,helpTimeRec:helpTimeRec,helpTypeRec:helpTypeRec},//提交的数据
            type:"POST",//提交的方式
            dataType:"HTML", //返回类型 TEXT字符串 JSON XML
            success:function(data){
                $("#helpShowBox").html(data);
            }
        });
    }
    $('#findBtn').click(function(e){
        $('#stateLoc').text($("#helpLoc").val());
        helpFind();
    });

    function toHelpType(x){
        $('#helpTypeRec').val(x);
        if(x=='2')
            $('#stateType').text('取快递');
        else if(x=='3')
            $('#stateType').text('带餐食');
        else if(x=='4')
            $('#stateType').text('辅导学习');
        else
            $('#stateType').text('充水电费');
        helpFind();
    }
    function toHelpTime(x){
        if(x=='jf1')
            $('#stateTime').text('按积分从多到少排序');
        else if(x=='jf2')
            $('#stateTime').text('按积分从少到多排序');
        else if(x=='sj2')
            $('#stateTime').text('按时间从远到近排序');
        else
            $('#stateTime').text('按时间从近到远排序');
        $("#xRange").toggleClass("rangeClass2");
        $('#helpTimeRec').val(x);
        helpFind();
    }

    $('body').on("click",".xTags",function(e) {
            alert($(this).parent().parent().parent().attr("id"));
            bjDivId=$(this).parent().parent().parent().attr("id");$(this).parent().parent().parent().toggleClass("myImgSmall");
            $(this).parent().parent().parent().css({"padding":"0px","border":"0px"});//消除样式 by hxc
            $(this).parent().parent().css({"padding":"0px","box-shadow":"0 0 0","border":"0px"});//消除样式 hxc
            $(this).parent().parent().text('');
    });//$('#needHelp').

    $('body').on('click','#agreeHelp',function(e){
        otherId=$(this).parent().parent().children('div#otherId').children('a').text();

        $.ajax({
            url:"help_confirm.php",//请求地址
            data:{otherId:otherId},//提交的数据
            type:"POST",//提交的方式
            dataType:"HTML", //返回类型 TEXT字符串 JSON XML
            success:function(data){
                if(data=='YOURSELF'){
                    $("#confirmHelp").attr('disabled','disabled');
                    alert('您就是这条求助的发布者，不能帮自己噢！换条试试！');
                }else{
                    $("#confirmHelp").removeAttr('disabled');
                    arrUserInfo=data.split('/');
                    $('#meId').text(arrUserInfo[0]);
                    $('#meSex').text(sexTraslate(arrUserInfo[1]));
                    $('#meEmail').text(arrUserInfo[2]);
                    $('#meTel').text(arrUserInfo[3]);
                    $('#meTime').text(arrUserInfo[4]);
                    $('#oId').text(arrUserInfo[5]);
                    $('#oSex').text(sexTraslate(arrUserInfo[6]));
                    $('#oEmail').text(arrUserInfo[7]);
                    $('#oTel').text(arrUserInfo[8]);
                    $('#oTime').text(arrUserInfo[9]);
                }
            }
        });
    });

    $("#rangeBtn").click(function(e) {
        $("#xRange").toggleClass("rangeClass2");
    });

    function sexTraslate(xStr){
        if(xStr=='1'){
            return '男';
        }else{
            return '女';
        }
    }

    $( ".backTop" ).click(function(){
        $( "body" ).animate( {scrollTop : 0  },1000 );
    });
    </script>
    

</body>

</html>
