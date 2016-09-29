<?php

require_once "cmsuicontroller.php";
require_once 'game/protected/utils/bcshelper.php';
class CmsToolsController extends CmsUIController
{
	public function actionIndex(){
		$this->render("index",array(
			"tool" => "index",
			"moduletitle" => "小工具大全",
			));
	}
	
	public function actionDeletegame(){
		$deleteId = -1;
		if(key_exists("gameid", $_POST)){
			$id = $_POST["gameid"];
			$deleteId = $id;
			$gameDelete = new Game();
			$gameDelete->deleteGameWithStatics(array($id));
		}
		
		$this->render("index",array(
			"tool" => "deletegame",
			"deleteid" => $deleteId,
			"moduletitle" => "小工具大全 - 删除游戏",
			));
	}
	
	public function actiondeletecache(){
		if(key_exists("cacheurl", $_POST)){
			$cacheurl = $_POST["cacheurl"];
			
			$cacheurl = str_replace("/","__",$cacheurl);
			$cacheurl = str_replace("?","##",$cacheurl);
			$cacheurl = $cacheurl . ".html";
			
			//删除BSC的信息
			delete_bcs_object(global_get_cachedir() . $cacheurl);
			//delete_bcs_object("/cache/1/" . $cacheurl);
			//is_bcs_object_exist("/cache/1/" . $cacheurl);
			
			
			$runtimeCacheFile = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/runtime/" . $cacheurl;
			if(file_exists($runtimeCacheFile)){
				unlink($runtimeCacheFile);
			}
		}
		
		$this->render("index",array(
			"tool" => "deleteurlcache",
			"deleteid" => 0,
			"moduletitle" => "小工具大全 - 删除缓存",
			));
	}
}