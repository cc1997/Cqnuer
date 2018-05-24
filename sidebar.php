<div class="indexTitle" >
        <img src="./img/cqnux.png" style="float: left;margin:4px 0 0 4px;width:40px;"> 
        <a href="#menu-toggle" class="menu-toggle">重师小助手</a>
        <div style="float: right;font-size:12px;padding:10px 10px 0 0;height:100%;white-space:nowrap;">
            <button type="button" class="btn btn-danger btn-xs" title="操作提示" data-html="true"
            data-container="body" data-toggle="popover" data-placement="bottom"
            data-content="点击导航栏左边（网页左上角） <b>重师小助手</b> 可唤出侧边栏" style="float:right;">
            -----操作提示-----
            </button>
        </div>
    </div>
    <div id="wrapper" style="padding-top: 50px;" >

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="activebar">
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
                <li><a href="myself.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION["logined"]?>的个人中心</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;&nbsp;退出登陆</a></li>
                <?php }?>
            </ul>
            <button class="btn btn-primary menu-toggle" style="position:absolute;bottom:70px;right:10px;">收起</button>
        </div>

    </div>   