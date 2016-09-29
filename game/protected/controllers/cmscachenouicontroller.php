<?php

require_once "cmscontroller.php";
require 'game/protected/utils/common.php';
require_once 'game/protected/utils/HttpClient.class.php';
require 'game/protected/utils/catalogidnamemap.php';

require_once 'game/protected/utils/OssSdk/WebOssHelper.php';

class CmsCacheNoUIController extends CmsController
{
	private function isCacheConfigExist(){
		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		return file_exists($filepath) ? 1 : 0;
	}
	
	public function actionIsConfigExist()
	{
		$configExist = $this->isCacheConfigExist();
		echo GeneralSuccessJsonResult(array("hasconfig" => $configExist));
	}
	
	private function cache($cacheId,$cacheUrl){
		if( BAE_LOCAL_DEBUG ){
			echo "debug version can not cache, or server will ...";
			return;
		}
		
		$nocachecontrol = "";
		if( strpos($cacheUrl, "?") == false ){
			$nocachecontrol = "?nocache=1";
		}else{
			$nocachecontrol = "&nocache=1";
		}
		
		if($cacheUrl == null) return;
		$pageContents = "";
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
	
	private function caches($ids){
		if(count($ids) == 0) return;
		$cacheLoader = new Cache();
		$caches = $cacheLoader->getCaches($ids);
		foreach($caches as $cache){
			$this->cache($cache['id'],$cache['cacheurl']);
		}
	}
	
	public function actionGetUnCacheId()
	{
		$cacheLoader = new Cache();
		$cacheIds = $cacheLoader->getAllUnCachedId();
		echo GeneralSuccessJsonResult($cacheIds);
	}
	
	public function actionCacheIds()
	{
		$ids = $this->getConditionArray($_POST["ids"]);
		$this->caches($ids);
		echo GeneralSuccessJsonResult(null);
	}
	
	public function actionHasCacheConfig()
	{
		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		if(file_exists($filepath)){
			echo GeneralSuccessJsonResult(array("hasconfig" => 1));
		}else{
			echo GeneralSuccessJsonResult(array("hasconfig" => 0));
		}
	}
	
	public function actionBuildConfig()
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
		
		echo GeneralSuccessJsonResult(null);
	}
	
}