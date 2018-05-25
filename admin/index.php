<!DOCTYPE html>
<html>
    <title>小助手后台</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">
        <style>
            body{
                 margin:10% 20%;
                 background-color:#eee;
            }
            .input-group{
            margin:10px 0px;//输入框上下外边距为10px,左右为0px
            }
            h3{
            padding:5px;
            border-bottom:1px solid #ddd;//h3字体下边框
            }
            li{
            list-style-type:square;//列表项图标为小正方形
            margin:10px 0;//上下外边距是10px
            }
            em{//强调的样式
            color:#c7254e;
            font-style: inherit;
            background-color: #bbb;
            }
            @media(max-width:768px){
                body{
                 margin:0;
                 background-color:#eee;
                }
            }
        </style>
        
    </head>
    <body>
        <div class="row" style="margin-top:30px;">
            <div class="col-md-6" style="border-right:1px solid #ddd;">
                <div class="well col-md-10" style="background-color:#ccc;">
                <h3>用户登录</h3>
                    <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="用户名(cqnuer)" id="inusn" aria-describedby="sizing-addon1">
                    </div>
                    <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" placeholder="密码(000)" id="inpwd" aria-describedby="sizing-addon1">
                    </div>
                    <button type="submit" onclick="dl();" class="btn btn-danger btn-block">
                    登录
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <h3>
                <img src="../image/thinker-white-logo.png" alt="" style="margin-right:10px ">重师小助手管理后台
                </h3>
                <ul>
                <li>本站点仅限管理员登录</li>
                <li>请使用<em>管理员帐号</em>登录，申请管理员请联系本人<em>18875032861</em>。</li>
                </ul>
            </div>
        </div>
        <footer>
            <div class="row">
                <div style="text-align: center;" class="col-lg-12">
                    <p>Copyright &copy; CQNU 2018</p>
                </div>
            </div>
        </footer>
    </body>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script>
    function dl(){
        //第一步：取数据,这里用到了用户名和密码
        var uid=$("#inusn").val();
        var pwd=$("#inpwd").val();
        //第二步：验证数据，这里需要从数据库调数据，我们就用到了ajax
        $.ajax({
        url:"checkin.php",//请求地址
        data:{uid:uid,pwd:pwd},//提交的数据
        type:"POST",//提交的方式
        dataType:"TEXT", //返回类型 TEXT字符串 JSON XML
            success:function(data){
            //开始之前要去空格，用trim()
                if(data.trim()=="OK"){
                    window.location.href="guanli.php";
                }
                else if(data.trim()=="NO"){
                    alert("登陆失败")
                }else{
                    alert("Unknow!")
                }
            }
        })
    }
    </script>
</html>