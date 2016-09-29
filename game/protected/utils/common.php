<?php


/**
 * @package     BugFree
 * @version     $Id: FunctionsMain.inc.php,v 1.32 2005/09/24 11:38:37 wwccss Exp $
 *
 *
 * Return part of a string(Enhance the function substr())
 *
 * @author                  Chunsheng Wang <wwccss@263.net>
 * @param string  $String  the string to cut.
 * @param int     $Length  the length of returned string.
 * @param booble  $Append  whether append "...": false|true
 * @return string           the cutted string.
 */
function sysSubStr($String,$Length,$Append = false)
{
	if (strlen($String) <= $Length )
	{
		return $String;
	}
	else
	{
		$I = 0;
		while ($I < $Length)
		{
			$StringTMP = substr($String,$I,1);
			if ( ord($StringTMP) >=224 )
			{
				$StringTMP = substr($String,$I,3);
				$I = $I + 3;
			}
			elseif( ord($StringTMP) >=192 )
			{
				$StringTMP = substr($String,$I,2);
				$I = $I + 2;
			}
			else
			{
				$I = $I + 1;
			}
			$StringLast[] = $StringTMP;
		}
		$StringLast = implode("",$StringLast);
		if($Append)
		{
			$StringLast .= "...";
		}
		return $StringLast;
	}
}

function ellipseSummar($text,$len,$moreurl){
	if(strlen($text) > $len * 3){
		return sysSubStr($text,($len - 5) * 3,false) . "...&nbsp;&nbsp;<a href='" . $moreurl . "'>更多</a>";
	}
	return $text;
}

function get_file_extension($file_name){
	$extend = pathinfo($file_name);
	$extend = strtolower($extend["extension"]);
	return $extend;
}

function getSource($url)
{
	if(strlen($url) == 0){
		return "我游戏";
	}else if(strpos($url,"cnblogs.com") > 0){
		return "博客园";
	}else if(strpos($url,"cppblog.com") > 0){
		return "C++博客";
	}else if(strpos($url,"blog.csdn.net") > 0){
		return "CSDN";
	}else if(strpos($url,"blog.51cto.com") > 0){
		return "51CTO.COM";
	}else{
		return "网络";
	}
}

function getSizeText($size){
	if($size < 1024){
		return round($size,2) . "字节"; 
	}else if($size < 1024 * 1024){
		return round(($size / 1024),2) . "KB"; 
	}else if($size < 1024 * 1024 * 1024){
		return round(($size / 1024 / 1024),2) . "MB"; 
	}else if($size < 1024 * 1024 * 1024 * 1024){
		return round(($size / 1024 / 1024 / 1024),2) . "GB";
	}
	return "";
}

function getTimeDurationText($timelen){
	$timelen = $timelen / 1000;
	$hours = round($timelen / 3600,0);
	$minute = ($timelen / 60) % 60;
	$second = $timelen % 60; 
	if($hours > 0){
		return $hours . " 小时 ".$minute." 分 ".$second." 秒 ";
	}else if($minute > 0){
		return $minute." 分 ".$second." 秒 ";
	}else{
		return $second." 秒";
	}
}

/**
 * 计算URL的缓存路径
 * @param string $url,相对网站根目录的路径
 */
function getCachePath($url){
	$requestURI = $url;
	
	$requestURI = str_replace("/","__",$requestURI);
	$requestURI = str_replace("?","##",$requestURI);
	
	$needAppendDot = true;
	$extend = pathinfo($requestURI);
	$extend = strtolower($extend["extension"]);
	if(strcmp($extend, "html") == 0){
		$needAppendDot = false;
	}
	
	if($needAppendDot){
		$requestURI = $requestURI . ".html";
	}
	
	$cacheFile = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/htmls/" . $requestURI;
	return $cacheFile;
}

function getCacheFileName($url){
	$requestURI = $url;
	
	$requestURI = str_replace("/","__",$requestURI);
	$requestURI = str_replace("?","##",$requestURI);
	
	$needAppendDot = true;
	$extend = pathinfo($requestURI);
	$extend = strtolower($extend["extension"]);
	if(strcmp($extend, "html") == 0){
		$needAppendDot = false;
	}
	
	if($needAppendDot){
		$requestURI = $requestURI . ".html";
	}
	
	
	//$cacheFile = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/htmls/" . $requestURI;
	return $requestURI;
}