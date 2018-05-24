<?php
header("Content-Type: text/html; charset=utf-8");
ini_set('display_errors', false);

$ROOT = $_SERVER["DOCUMENT_ROOT"];
$width = 720;

foreach($_FILES as $file)
{
	$val = $file["tmp_name"];
	if($val!="" && is_uploaded_file($val))
	{
		if(!getimagesize($val))
		{
			unlink($val);
			showErr();
		}
		$path = getFileName($ROOT,$file["name"]);
		$fullPath = $ROOT.$path;

		move_uploaded_file($val,$ROOT.$path);
		img2thumb($fullPath,$fullPath,$width,$width,0,0);
		list($width,$height,$size)=getimagesize($fullPath);
		echo '{"data":{"error":false,"link":"'.$path.'","width":'.$width.'}}';
	}
	else
	{
		unlink($val);
		showErr();
	}
}

function showErr($msg="上传失败")
{
	echo '{"data":{"error":"'.$msg.'"}}';
	die();
}

function getFileName($ROOT,$fileName)
{
	$curPath = $_SERVER["SCRIPT_NAME"];
	$path = substr($curPath,0,strrpos($curPath,"/"));
	$path .= "/pic/". date("Y/m",time());
	createdir($ROOT.$path);
	$name = substr(md5(rand()."3s9-Z-dJ.a!".time()),8,16) .".".getExt($fileName);
	return $path ."/".$name;
}

function getExt($fileName)
{
	return strtolower(substr($fileName,strrpos($fileName,".")+1));
}


function createdir($path,$mode=0755)
{
	$path = $path;
	if (is_dir($path)){
		 return true;
	}
	else
	{ 
		$re=mkdir($path,$mode,true);
		if ($re)
		{
			return true;
		}
		else{
			return false;
		}
	 }
}

function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
{
    if(!is_file($src_img))
    {
        return false;
    }
    $ot = fileext($dst_img);
    $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
    $srcinfo = getimagesize($src_img);
    $src_w = $srcinfo[0];
    $src_h = $srcinfo[1];
    $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
    $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);
 
    $dst_h = $height;
    $dst_w = $width;
    $x = $y = 0;
 
    /**
     * 缩略图不超过源图尺寸（前提是宽或高只有一个）
     */
    if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
    {
        $proportion = 1;
    }
    if($width> $src_w)
    {
        $dst_w = $width = $src_w;
    }
    if($height> $src_h)
    {
        $dst_h = $height = $src_h;
    }
 
    if(!$width && !$height && !$proportion)
    {
        return false;
    }
    if(!$proportion)
    {
        if($cut == 0)
        {
            if($dst_w && $dst_h)
            {
                if($dst_w/$src_w> $dst_h/$src_h)
                {
                    $dst_w = $src_w * ($dst_h / $src_h);
                    $x = 0 - ($dst_w - $width) / 2;
                }
                else
                {
                    $dst_h = $src_h * ($dst_w / $src_w);
                    $y = 0 - ($dst_h - $height) / 2;
                }
            }
            else if($dst_w xor $dst_h)
            {
                if($dst_w && !$dst_h)  //有宽无高
                {
                    $propor = $dst_w / $src_w;
                    $height = $dst_h  = $src_h * $propor;
                }
                else if(!$dst_w && $dst_h)  //有高无宽
                {
                    $propor = $dst_h / $src_h;
                    $width  = $dst_w = $src_w * $propor;
                }
            }
        }
        else
        {
            if(!$dst_h)  //裁剪时无高
            {
                $height = $dst_h = $dst_w;
            }
            if(!$dst_w)  //裁剪时无宽
            {
                $width = $dst_w = $dst_h;
            }
            $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
            $dst_w = (int)round($src_w * $propor);
            $dst_h = (int)round($src_h * $propor);
            $x = ($width - $dst_w) / 2;
            $y = ($height - $dst_h) / 2;
        }
    }
    else
    {
        $proportion = min($proportion, 1);
        $height = $dst_h = $src_h * $proportion;
        $width  = $dst_w = $src_w * $proportion;
    }
 
    $src = $createfun($src_img);
    $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
    $white = imagecolorallocate($dst, 255, 255, 255);
    imagefill($dst, 0, 0, $white);
 
    if(function_exists('imagecopyresampled'))
    {
        imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    else
    {
        imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    }
    $otfunc($dst, $dst_img);
    imagedestroy($dst);
    imagedestroy($src);
    return true;
}
function fileext($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}
?>
