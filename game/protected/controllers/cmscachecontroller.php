<?php

require_once "cmsuicontroller.php";
require 'game/protected/utils/common.php';
require_once 'game/protected/utils/HttpClient.class.php';
require 'game/protected/utils/catalogidnamemap.php';

require_once 'game/protected/utils/OssSdk/WebOssHelper.php';

class CmsCacheController extends CmsUIController
{
	private function isCache(){
		if(key_exists("cache_status", $_POST) && $_POST["cache_status"] >= 0){
			return $_POST["cache_status"];
		}
		return -1;
	}
	
	private function getSearchText(){
		if(key_exists("search_text", $_POST) && $_POST["search_text"] >= 0){
			return $_POST["search_text"];
		}
		return "";
	}
	
	private function getPage(){
		if(key_exists("page", $_GET) && $_GET["page"] >= 0){
			return $_GET["page"]-1;
		}
		return 0;
	}
	
	private function deleteFile($cacheId,$file){
		if (file_exists($file)){
			unlink($file);
			
			$cacheSaver = new Cache();
			$cacheSaver->setCacheStatusById($cacheId,0);
		}
	}
	
	private function isCacheConfigExist(){
		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		return file_exists($filepath);
	}
	
	private function cache($cacheId,$cacheUrl){
		//if( BAE_LOCAL_DEBUG ){
		//	echo "debug version can not cache, or server will ...";
			//return;
		//}
		
		if($cacheUrl == null) return;
		$pageContents = "";
		
		$nocachecontrol = "";
		if( strpos($cacheUrl, "?") == false ){
			$nocachecontrol = "?nocache=1";
		}else{
			$nocachecontrol = "&nocache=1";
		}
		
		if( BAE_LOCAL_DEBUG ){
			$pageContents = HttpClient::quickGet("http://123.gouliangli.cn" . $cacheUrl . $nocachecontrol);
		}else{
			$pageContents = HttpClient::quickGet("http://123.gouliangli.cn" . $cacheUrl . $nocachecontrol);
		}
		
		$localFile =  getCachePath($cacheUrl);
		$fp = fopen($localFile, "w+");
		if($fp != null){
			if ( is_writable($localFile) ){
				file_put_contents($localFile , $pageContents);
				
				//上传到BCS
				move_attachments_bcs_fileupload(getCacheFileName($cacheUrl),global_get_cachedir_ex(), $localFile,false);
				
				//往MYSQL中写入状态
				$cacheSaver = new Cache();
				$cacheSaver->setCacheStatusById($cacheId,1);
			}
			fclose($fp);
		}
	}
	
	private function clearAllCache(){
		//置数据库的状态
		$cacheClear = new Cache();
		$cacheClear->setAllCacheStatus(0);
		
		$dirPath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/htmls";
		$handle = opendir($dirPath);
		if($handle != null){
			while (false!==($item = readdir($handle))){
				if ( $item != "." && $item != ".." ){
					if ( is_dir( "$dirPath/$item" ) ) {
			   		}else{
						unlink( "$dirPath/$item");
			   		}
				}
			}
			closedir( $handle );
		}
	}
	
	private function deleteCaches($ids){
		if(count($ids) == 0) return;
		$cacheLoader = new Cache();
		$caches = $cacheLoader->getCaches($ids);
		foreach($caches as $cache){
			$this->deleteFile($cache['id'], getCachePath($cache['cacheurl']));
			
			$cacheLoader->setCacheStatusById($cache['id'], 0);
		}
	}
	
	private function caches($ids){
		if(count($ids) == 0) return;
		$cacheLoader = new Cache();
		$caches = $cacheLoader->getCaches($ids);
		foreach($caches as $cache){
			$this->cache($cache['id'],$cache['cacheurl']);
		}
	}
	
	private function initCacheUrls(){
		//主页，各个分类，
		$cacheLoader = new Cache();
		$cacheLoader->addCacheUrl(array("/"));
		
		$arrSubpageUrls = array();
		$statistical = new Statistical();
		
		//所有一级子目录
		$catalogMap = new CatalogIdNameMap();
		$catalogs = $catalogMap->getData();
		$catalogUrls = array();
		foreach($catalogs as $catalog){
			array_push($catalogUrls, "/catalog/" . $catalog["name"]);
			array_push($catalogUrls, "/catalog/" . $catalog["name"] . "?order=1");
			
			$pageInfo = $statistical->getCatalogGamePageInfo($catalog["id"]);
			if($pageInfo != null ){
				$count = $pageInfo["pagecount"];
				if($count >= 2){
					for ($index = 2;$index <= $count; $index++){
						array_push($arrSubpageUrls,"/catalog/" . $catalog["name"] . "?page=" . $index);
						array_push($arrSubpageUrls,"/catalog/" . $catalog["name"] . "?order=1&page=" . $index);
					}
				}
			}
		}
		$cacheLoader->addCacheUrl($catalogUrls);
		$cacheLoader->addCacheUrl($arrSubpageUrls);	
	}
	
	private function initSubjectCacheUrls(){
		$cacheLoader = new Cache();
		$subjectLoader = new Subject();
		$statistical = new Statistical();
		
		$arrSubjectPageUrls = array();
		
		$catalogMap = new CatalogIdNameMap();
		$catalogs = $catalogMap->getData();
		$catalogUrls = array();
		foreach($catalogs as $catalog){
			$subjects = $subjectLoader->getSubjectByCategory($catalog["id"]);
			foreach($subjects as $subject){
				$url = "/catalog/" . $catalog["name"] . "?subjectid=" . $subject["id"];
				array_push($arrSubjectPageUrls,$url);
				array_push($arrSubjectPageUrls,"/catalog/" . $catalog["name"] . "?subjectid=" . $subject["id"] . "&order=1");
				
				//找到每一个页面，然后加入
				$subjectPageInfo = $statistical->getSubjectGamePageInfo($subject["id"]);
				if($subjectPageInfo != null ){
					$count = $subjectPageInfo["pagecount"];
					
					if($count >= 2){
						for ($index = 2;$index <= $count; $index++){
							$url = "/catalog/" . $catalog["name"] . "?subjectid=" . $subject["id"] . "&page=" . $index;	
							array_push($arrSubjectPageUrls,$url);
							$url = "/catalog/" . $catalog["name"] . "?subjectid=" . $subject["id"] . "&order=1&page=" . $index;
							array_push($arrSubjectPageUrls,"/catalog/" . $catalog["name"] . "?order=1&page=" . $index);
						}
					}
				}
			}
		}
		//print_r($arrSubjectPageUrls);
		$cacheLoader->addCacheUrl($arrSubjectPageUrls);
	}
	
	private function clearCacheUrls(){
		$cacheLoader = new Cache();
		$cacheLoader->clearCacheUrls();
		
		$this->clearAllCache();
	}
	
	private function writeCacheConfig()
	{
		$cacheLoader = new Cache();
		$caches = $cacheLoader->getAllCacheOnlyName();

		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		$content = json_encode(array
			        ( 
			        	'urls' => $caches, 
			        ));
			        
		$fp = fopen($filepath, "w+");
		if($fp != null){
			if ( is_writable($filepath) ){
				file_put_contents($filepath , $content);
			}
			fclose($fp);
		}
	}
	
	private function getCacheUrls(){
		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		if(file_exists($filepath)){
			$content = file_get_contents($filepath);
			
			$data = json_decode($content, true);
			print_r($data["urls"]);
		}
	} 
	
	private function downloadCacheConfig()
	{
		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		if(file_exists($filepath)){
			$content = file_get_contents($filepath);
			
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ". filesize($filepath));
			Header("Content-Disposition: attachment; filename=" . "cacheconfig.json");
			echo $content;
		}else{
			echo "no config";
		}
		exit();
	}
	
	private function clearRuntimeCache(){
		$runtimedir = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/runtime";
		$handle = opendir($runtimedir);
		if($handle != null){
			while (false!==($item = readdir($handle))){
				if ( $item != "." && $item != ".." ){
					if ( is_dir( "$runtimedir/$item" ) ) {
			   		}else{
						unlink( "$runtimedir/$item");
			   		}
				}
			}
			closedir( $handle );
		}
		$this->clearAllCache();
	}
	
	public function actionIndex(){
		$cacheLoader = new Cache();
		
		if(array_key_exists("operator", $_POST)){
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "delete") == 0){
				//删除所有已选中的缓存
				$this->deleteCaches($_POST["selectedId"]);
			}else if(strcasecmp($operator, "cacheselect") == 0){
				$this->caches($_POST["selectedId"]);
			}else if(strcasecmp($operator, "clear") == 0){
				//清空所有缓存(直接清目录)
				$this->clearAllCache();
			}else if(strcasecmp($operator, "deleteacache") == 0){
				$param1 = $_POST["param1"];
				$cacheId = $_POST["param2"];
				$this->deleteFile($cacheId,$param1);
			}else if(strcasecmp($operator, "cacheaurl") == 0){
				$this->cache($_POST["param2"],$_POST["param1"]);
			}else if(strcasecmp($operator, "initcacheaurl") == 0){
				$this->initCacheUrls();
			}else if(strcasecmp($operator, "initsubjectcacheaurl") == 0){
				$this->initSubjectCacheUrls();
			}else if(strcasecmp($operator, "writecacheconfig") == 0){
				$this->writeCacheConfig();
			}else if(strcasecmp($operator, "downloadcacheconfig") == 0){
				$this->downloadCacheConfig();
			}else if( strcasecmp($operator, "clearruntimecache") == 0 ){
				$this->clearRuntimeCache();
			}
		}
		
		//$this->getCacheUrls();
		
		$pageInfo = $cacheLoader->getCachePageInfo($this->isCache(),$this->getSearchText());
		$pagedata =  $cacheLoader->getCachePage($this->isCache(),$this->getSearchText(),0,$this->getPage());
		
		$this->render("index",array(
				"pageinfo" => $pageInfo,
				"pagedata" => $pagedata,
		"configexist" => $this->isCacheConfigExist() ? 1 : 0
				));
	}
}