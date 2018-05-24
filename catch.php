<?php
header("Content-type:text/html;charset=gb2312");
$act='';
define('SCRIPT_ROOT',dirname(__FILE__).'/');
if (isset($_REQUEST['act'])) {
   $act = trim($_REQUEST['act']);
}
$user = '2015051603030';//用户名
$password = '528973cc';//密码
$preUrl="http://jwxt.cqnu.edu.cn/default2.aspx";//3hxasyqvrdsu3c454m3knqa4共24位随机码
$header = get_headers($preUrl, 1);
$str1 = $header['Location'];
$sjm = substr($str1,2,24);
switch($act)
{
    case 'login':
      // 获取验证码
      $code = trim($_REQUEST['code']);
      // $loginParams为curl模拟登录时post的参数
      $loginParams['__VIEWSTATE'] = 'dDwxNTMxMDk5Mzc0Ozs+0dbGnJRfodnwcyljRAYkCZ+BCO0=';//xqd
      $loginParams['__EVENTTARGET'] = 'xqd';
      $loginParams['xnd'] = '2017-2018';
      $loginParams['xqd'] = '2';
      $loginParams['RadioButtonList1'] = '学生';
      $loginParams['TextBox1'] = '';
      $loginParams['TextBox2'] = $password;
      $loginParams['txtUserName'] = $user;
      $loginParams['Button1'] = '';
      $loginParams['lbLanguage'] = '';
      $loginParams['hidPdrs'] = '';
      $loginParams['hidsc'] = '';
      $loginParams['txtSecretCode'] = $code;
      // $cookieFile 为加载验证码时保存的cookie文件名 
      $cookieFile = SCRIPT_ROOT.'cookie.tmp';
      // $targetUrl curl 提交的目标地址
      

      $targetUrl = 'http://jwxt.cqnu.edu.cn/(hwxg1f55pmbgka55i35qzlvu)/default2.aspx';  
      // 参数重置
      $content = curlLogin($targetUrl, $cookieFile, $loginParams);
      echo $content;
      break;
    case 'authcode':
      // Content-Type 验证码的图片类型
      header('Content-Type:image/png charset=gb2312');
      showAuthcode('http://jwxt.cqnu.edu.cn/(hwxg1f55pmbgka55i35qzlvu)/CheckCode.aspx');
      exit;
     break;
}


function curlLogin($url, $cookieFile, $loginParams)
{   
    $loginParams2['__EVENTARGUMENT'] = '';
    $loginParams2['__VIEWSTATE'] = 'dDwxNTMxMDk5Mzc0Ozs+l9HjA5coWDJtBJ1zNu6YGlVsbgk=';//
    $loginParams2['__EVENTTARGET'] = 'xqd';
    $loginParams2['xnd'] = '2017-2018';
    $loginParams2['xqd'] = '1';
    $user = '2015051603030';//用户名
    $password = '528973cc';//密码
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_COOKIEFILE, $cookieFile); //同时发送Cookie
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);//设定返回的数据是否自动显示
    curl_setopt($ch, CURLOPT_HEADER, 0);//设定是否显示头信 息
    curl_setopt($ch, CURLOPT_NOBODY, false);//设定是否输出页面 内容
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $loginParams); //提交查询信息
    curl_exec($ch);//返回结果
    curl_close($ch); //关闭
    $curl2=curl_init('http://jwxt.cqnu.edu.cn/(hwxg1f55pmbgka55i35qzlvu)/xskbcx.aspx?xh='.$user);
    curl_setopt ($curl2,CURLOPT_REFERER,'http://jwxt.cqnu.edu.cn/(hwxg1f55pmbgka55i35qzlvu)/xs_main.aspx?xh='.$user.'#a');
    curl_setopt($curl2, CURLOPT_COOKIEFILE, $cookieFile); 
     curl_setopt($curl2, CURLOPT_HEADER, false); 
     curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true); 
     curl_setopt($curl2, CURLOPT_TIMEOUT, 20); 
     curl_setopt($curl2, CURLOPT_AUTOREFERER, true); 
     curl_setopt($curl2, CURLOPT_FOLLOWLOCATION, true); 
     //curl_setopt($curl2, CURLOPT_POSTFIELDS, $loginParams2); //提交查询信息
     $en_contents=mb_convert_encoding( curl_exec($curl2),'utf-8', array('Unicode','ASCII','GB2312','GBK','UTF-8')); 
     preg_match_all('/<span id="Label[^>]*>(.*)<\/span>/isU',$en_contents,$out);
     var_dump($out);
     $student = explode('：', $out[1][6]);
     $studentInfo[0] = $student[1];
     $student = explode('：', $out[1][5]);
     $studentInfo[1] = $student[1];
     $student = explode('：', $out[1][2]);
     $studentInfo[2] = substr(trim($student[1]), 0,4);
     var_dump($studentInfo);
     preg_match_all('/<table id="Table1"[\w\W]*?>([\w\W]*?)<\/table>/',$en_contents,$out);
     $table = $out[0][0]; 
     preg_match_all('/<td [\w\W]*?>([\w\W]*?)<\/td>/',$table,$out);
     $td = $out[1];
     $length = count($td);
     //获得课程列表
     for ($i=0; $i < $length; $i++) {
       $td[$i] = str_replace("<br>", "", $td[$i]);
       $reg = "/{(.*)}/";
       if (!preg_match_all($reg, $td[$i], $matches)) {
         unset($td[$i]);
       }
     }
     $td = array_values($td); //将课程列表数组重新索引
     $tdLength = count($td);
     //将课表转换成数组形式
     echo "<pre>";
     var_dump($td);
     curl_close($curl2);
}

/**
 * 加载目标网站图片验证码
 * string $authcode_url 目标网站验证码地址
 */
function showAuthcode( $authcode_url )
{
    $cookieFile = SCRIPT_ROOT.'cookie.tmp';
    $ch = curl_init($authcode_url);
    curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $content =curl_exec($ch);
    var_dump($cookieFile);
    curl_close($ch);
}
?>
<iframe src="?act=authcode" style='width: 100px; height:40px ' frameborder=0 ></iframe>
<form>
<input type="hidden" name="act" value="login">
<input type="text" name="code" />
<input type="submit" name="Button1" >
<input name="hidPdrs" id="hidPdrs" type="hidden" size="5" />
<input name="hidsc" id="hidsc" type="hidden" size="5" />
</form>
教务系统重定向的随机码：<?php var_dump($sjm)?>