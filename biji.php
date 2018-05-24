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

    <script src="nicEdit.js"></script>
    <script type="text/javascript">
    <!--
    bkLib.onDomLoaded(function() {
        new nicEditor({iconsPath : 'nicEditorIcons.gif'}).panelInstance('intro');
    });
    -->
    </script><!--编辑器nicEdit-->


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
     .boxRealShow{height:500px;overflow:scroll;transition:1s all ease-in-out;}
     .myTail{}
     .scBtn{float:right;cursor:pointer;}
     .zanBtn{float:right;cursor:pointer;}
     .redBtn{color:red;}
     .xTitle{cursor:pointer;}
     .myImgBig{width:100%;}
     .myWenzi{height:100px;overflow:hidden;}
     .myWenzi img{width:100%}
     .addNote{width:100%;margin-top:5px;}
    </style>
</head>

<body>
    <div class="indexTitle" >
        <img src="./img/cqnux.png" style="float: left;margin:4px 0 0 4px;width:40px;"> 
        <a href="#menu-toggle" class="menu-toggle">重师小助手</a>
        <div style="float: right;font-size:12px;padding:10px 10px 0 0;height:100%;white-space:nowrap;">
            <button type="button" class="btn btn-default btn-xs" title="数据库&数据关系" data-html="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="db_cqnuer（总数据库）<br>tb_cqnu_note|cqnu_note_zan| cqnu_note_sc<br>(笔记关系|点赞关系|收藏关系) 表间连接<br>Tips:添加笔记可获取积分(本页未调用积分表和获取积分表)" style="float:right;">
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
    </div>
    <div id="wrapper" style="padding-top: 50px;" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;&nbsp;首页</a>
                </li>
                <li class="activebar">
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
                        <h3>笔记 <small>| 答案分享 / 笔记分享</small></h3>
                        <ol class="breadcrumb">
                            <li class="active" style="width:100%">

                                <input id="bjName" type="text" style="width:60%" placeholder="在此输入笔记/答案名（如：习题1-2）支持模糊查询和空格多条件查询">
                                <button class="btn btn-info btn-sm" onclick="bjFind();"><span class="glyphicon glyphicon-search"></span>&nbsp;查找笔记</button>
                                <button class="btn btn-dark btn-xs tips"></button>
                                <button class="btn btn-primary btn-sm addNote"><span class="glyphicon glyphicon-pencil"></span>&nbsp;添加新笔记（弹出）</button>
                                
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row boxShow" id="richBox">
                    <div class="col-lg-12">
                            <div class="input-group">
                                <span class="input-group-addon"><b>标题</b></span>
                                <input type="text" id="title" class="form-control noteTitle" placeholder="在此输入标题" style="width:50%;">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon"><b>简介</b></span>
                                <textarea name="简介" id="" rows="2" class="form-control noteIntro" style="width:50%"></textarea>
                            </div>
                            <br>
                            <textarea name="intro" id="intro" style="height:250px;width:1000px;" ></textarea>
                            <hr>
                        <div style="margin-bottom:10px;">
                            <button class="btn btn-success btn-sm fabu" onclick="publicNote()"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;发布新内容</button>
                            <button class="btn btn-warning btn-xs" onclick="SaveNote()"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span>&nbsp;保存</button>
                            <button class="btn btn-warning btn-xs" onclick="yulan()">预览</button>
                            <button class="btn btn-warning btn-xs" onclick="a()">html</button>
                        </div>
                    </div>
                    <hr>
                </div>
                <!--编辑器nicEdit-->

                <div class='btnBox'>
                    <button class="btn btn-default btn-sm tipFinder">显示全部</button>
                    <button class="btn btn-default btn-sm tipFinder">高数Ⅰ</button> 
                    <button class="btn btn-default btn-sm tipFinder">高数Ⅱ</button>
                    <button class="btn btn-default btn-sm tipFinder">计算机组成原理</button>
                    <button class="btn btn-default btn-sm tipFinder">线性代数</button> 
                    <button class="btn btn-default btn-sm tipFinder">大学物理</button> 
                </div>
                <div class="row" id="bijiShowBox">
                    
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

                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>Copyright &copy; CQNU 2018</p>
                            <div id="stateBox">
                                <input type="hidden" id="pageNum" val="0">
                                <input type="hidden" id="bigBjId" val="">
                            </div>
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

        bjFind();

    });
    function bjFind(){
        
        var bjName=$("#bjName").val();

        $.ajax({
            url:"biji_ajax.php",//请求地址
            data:{bjName:bjName},//提交的数据
            type:"POST",//提交的方式
            dataType:"HTML", //返回类型 TEXT字符串 JSON XML
            success:function(data){
                $("#bijiShowBox").html(data);
            }
        });
    }

    function a(){
        var x=document.getElementsByClassName("nicEdit-main")[0].innerHTML;
        alert(x);
    }    
    flagAdd=true;
    $(".addNote").click(function(e) {
        if(!flagAdd){
            $(this).html('<span class="glyphicon glyphicon-pencil"></span>&nbsp;添加新笔记（弹出）');
            flagAdd=true;
        }else{
            $(this).html('<span class="glyphicon glyphicon-pencil"></span>&nbsp;再次点击收回');
            flagAdd=false;
        }
        $("#richBox").toggleClass("boxRealShow");
        $('.tips').text('富文本编辑器使用nicEdit 特此声明');
    });

    $(".tipFinder").click(function(e){
        tempStr=$(this).text();
        if(tempStr=='显示全部') {
            $("#bjName").val('');
        }else{
            $("#bjName").val(tempStr);
        }
        
        bjFind();
    })

    $('body').on("click",".scBtn",function(){//by cqnu hxc 用on挂在到body上，避免ajax取页面前js已经加载完毕导致失效 
            flagSc=$(this).hasClass("redBtn");//true时表示已经收藏，执行取消收藏的操作，false时相反 by cqnu hxc
            //alert($(this).parent().children("em#bjId").text());//获取当前笔记的id 方便ajax传参 和修改页面对应参数 by cqnu hxc
            bjId=$(this).parent().children("em#bjId").text();
            scUri="#scNum"+bjId;
            userId="<?php $_SESSION["logined"]?>";
            $(this).toggleClass("redBtn");
            if(flagSc){
                temp=parseInt($(scUri).text())-1;
                $(scUri).text(temp);
            }else{
                temp=parseInt($(scUri).text())+1;
                $(scUri).text(temp);
            }
            $.ajax({
                url:"biji_sc.php",//请求地址
                data:{bjId:bjId,userId:userId},//提交的数据
                type:"POST",//提交的方式
                dataType:"HTML", //返回类型 TEXT字符串 JSON XML
                success:function(data){
                    alert(data);
                }
            });
    });

    $('body').on("click",".zanBtn",function(){
            flagZan=$(this).hasClass("redBtn");//true时表示已经赞，执行取消赞的操作，false时相反 by cqnu hxc
            //alert($(this).parent().children("em#bjId").text());//获取当前笔记的id 方便ajax传参 和修改页面对应参数 by cqnu hxc
            bjId=$(this).parent().children("em#bjId").text();
            zanUri="#zanNum"+bjId;
            userId="<?php $_SESSION["logined"]?>";
            $(this).toggleClass("redBtn");
            if(flagZan){
                temp=parseInt($(zanUri).text())-1;
                $(zanUri).text(temp);
            }else{
                temp=parseInt($(zanUri).text())+1;
                $(zanUri).text(temp);
            }
            $.ajax({
                url:"biji_zan.php",//请求地址
                data:{bjId:bjId,userId:userId},//提交的数据
                type:"POST",//提交的方式
                dataType:"HTML", //返回类型 TEXT字符串 JSON XML
                success:function(data){
                    alert(data);
                }
            });
    });

    var flage=true;
    $('body').on("click",".xTitle",function(){
            //alert($(this).parent().parent().parent().attr("id"));
            bjDivId=$(this).parent().parent().parent().attr("id");
            $(this).parent().parent().parent().toggleClass("myImgBig");//加类名
            $('.myImgBig').children().children("div.myWenzi").css('height','auto');
            if(flage){//隐藏
                $(".myImg").not(".myImgBig").hide();
                flage=false;
                $.ajax({
                    url:"biji_content_ajax.php",//请求地址
                    data:{bjId:bjDivId},//提交的数据
                    type:"POST",//提交的方式
                    dataType:"HTML", //返回类型 TEXT字符串 JSON XML
                    success:function(data){
                        $('.myImgBig').children().children("div.myWenzi").html(data);
                    }
                });
            }else{
                $(".myImg").show();
                flage=true;
                $.ajax({
                    url:"biji_content_ajax.php",//请求地址
                    data:{bjId:bjDivId,x:1},//提交的数据
                    type:"POST",//提交的方式
                    dataType:"HTML", //返回类型 TEXT字符串 JSON XML
                    success:function(data){
                        $("#"+bjDivId).children().children("div.myWenzi").html(data);
                        $("#"+bjDivId).children().children("div.myWenzi").css('height','100px');
                    }
                });
                var cw=document.body.clientWidth;
                if(cw<=991){//小屏幕上 一个div一行 仅减去标题高度
                    locTop = $("#"+bjDivId).offset().top-50;
                }else{//大屏幕上 三个div一行 两种情况
                    if((bjDivId%3)==1){
                        locTop = $("#"+bjDivId).offset().top-50;//每行开头
                    }else{
                        locTop = $("#"+bjDivId).offset().top-300;
                    }
                }
                $( "body" ).animate( {scrollTop : locTop  },1000 );
            }
            
    });

    function publicNote()
    {
    var title=document.getElementsByClassName("noteTitle")[0].value;
    var intro=document.getElementsByClassName("noteIntro")[0].value;
    var content=document.getElementsByClassName("nicEdit-main")[0].innerHTML;
    var idx=$('#title').val();
    var author="<?php $_SESSION["logined"]?>";
    //第二步：验证数据，这里需要从数据库调数据，我们就用到了ajax
    $.ajax({
    url:"biji_public.php",//请求地址
    data:{title:title,intro:intro,content:content,status:0,author:author},//提交的数据
    type:"POST",//提交的方式
    dataType:"TEXT", //返回类型 TEXT字符串 JSON XML
        success:function(data){
        //开始之前要去空格，用trim()
            if(data.trim()=="OK"){
                alert("发布成功，您可以修改或删除该笔记");
                window.location.href="biji.php";
            }else if(data.trim()=="NO"){
                alert("发布失败，请检查:\n1.是否输入标题\n2.内容是否为空"); 
            }else if(data.trim()=="NO1"){
                alert("发布失败，已存在相同的标题的笔记");
            }else{
                alert(data.trim());
            }
            }
        })
    }
    
    $( ".backTop" ).click(function(){
        $( "body" ).animate( {scrollTop : 0  },1000 );
    });
    </script>
    

</body>

</html>
