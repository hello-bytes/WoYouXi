<?php

function global_get_cachedir(){
	return "woyouxi/caches/1/";
}

function global_get_cachedir_cms(){
	return "woyouxi/caches/2/";
}

function global_get_cachedir_ex(){
	return "cache/1";
}

function converResUrl($url){
	if(strpos($url, "http:") === false){
		//相对路径
		return "http://youxires.woyouxi.net" . $url;
	}
	return str_replace("bcs.pubbcsapp.com/youxires", "youxires.oss.aliyuncs.com", $url);
}

function converBaeResUrl($url){
	if(strpos($url, "http:") === false){
		//相对路径
		return "http://bcs.pubbcsapp.com/youxires" . $url;
	}
	$url = str_replace("youxires.oss-cn-hangzhou.aliyuncs.com", "bcs.duapp.com/youxires", $url);
	return str_replace("youxires.oss-cn-hangzhou.aliyuncs.com", "bcs.duapp.com/youxires", $url);
}

function gotoerrorpage(){
	echo "<html><head><META HTTP-EQUIV=\"refresh\" CONTENT=\"0;url=/exception.html\"></head><body></body></html>";
}

$global_title = null;
function setGlobalTitle($title)
{
	global $global_title;
	$global_title = $title;
}

$global_keywords = null;
function setGlobalKeywords($keywords)
{
	global $global_keywords;
	$global_keywords = $keywords;
}

$global_descript = null;
function setGlobalDescript($descrpit)
{
	global $global_descript;
	$global_descript = $descrpit;
}

$global_catalog = null;
function setGlobalCatalog($catalog)
{
	global $global_catalog;
	$global_catalog = $catalog;
}

function can_show_adv(){
	$filename = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/adv_hide_google.txt";
	return file_exists($filename) == false;
}

$globaladvjs = null;
function setGlobalAdvJs($advjs)
{
	global $globaladvjs;
	$globaladvjs = $advjs;
}

function isSetGlobalAdvJs(){
	global $globaladvjs;
	return $globaladvjs != null;
}

function getAdvJs($jsId){
	if($jsId < 2000) $jsId = $jsId + 2000;
	
	global $globaladvjs;
	if($globaladvjs == null || count($globaladvjs) == 0) return "";
	foreach( $globaladvjs as $jsitem  ){
		if(intval($jsitem["data_id"]) == intval($jsId)){
			return $jsitem["data_content"];
		}
	}
	return "";
}
