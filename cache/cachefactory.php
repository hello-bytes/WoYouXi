<?php 

require_once 'game/protected/utils/OssSdk/WebOssHelper.php';
require_once 'game/protected/utils/HttpClient.class.php';

$cacheSuccess = false;

$readCache = true;
$requestURI = $_SERVER['REQUEST_URI'];
if(strpos($requestURI,"nocache=1") > 0){
	$readCache = false;
}

$nocacheUrlPrefixArr = array( "/game", "/adv", "/log","/video/play","/video/showall","/site/top","/search" );
foreach($nocacheUrlPrefixArr as $nocacheUrlPrefix){
	if(strlen($requestURI) > strlen($nocacheUrlPrefix)){
		$prefix = substr($requestURI,0, strlen($nocacheUrlPrefix));
		if($nocacheUrlPrefix == $prefix){
			$readCache = false;
		}
	}
}

if($readCache){
	//check local runtime cache
	$pageCacheKey = $requestURI;
	$pageCacheKey = str_replace("/","__",$pageCacheKey);
	$pageCacheKey = str_replace("?","##",$pageCacheKey);
	
	$needAppendDot = true;
	
	if(strrchr($pageCacheKey,".html")==".html"){
		$needAppendDot = false;
	}
	
	if($needAppendDot){
		$pageCacheKey = $pageCacheKey . ".html";
	}
	
	//$pageCacheKey = $pageCacheKey . ".html";
	$runtimeCacheFile = dirname(__FILE__) . "//runtime3//" . $pageCacheKey;
	if(file_exists($runtimeCacheFile)){
		$readCache = false;
		$cacheSuccess = true;
		
		echo file_get_contents($runtimeCacheFile);
		exit();
	}
}


if($readCache){	
	//直接从云存储找缓存
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
	
	$object = global_get_cachedir() . $requestURI;
	//echo $object;
	if (is_oss_file_exist($object)){
		$error = false;
		$content = get_oss_file_content($object);
		if($content == null || strlen($content) == 0  ){
			$error = true;
		}else if(strlen($content) < 150 && substr($content,0,1) == "{" ){
			$bcsJson = json_decode( $content,true );
			if($bcsJson != null && $bcsJson["Error"] != null && $bcsJson["Error"]["code"] > 0){
				$error = true;
			}
		}
		
		if($error == false){
			//写入到本地的缓存，下次直接从缓存中读取
			if(file_exists($runtimeCacheFile) == false){
				file_put_contents($runtimeCacheFile , $content);
			}
			
			echo $content;
			$cacheSuccess = true;
			exit();
		}
		
		if($error == true){
			//require_once "game/protected/utils/log.php"; 
			//WriteLog_Warning("Exception : Cache Exception！");
		}
	}
}
