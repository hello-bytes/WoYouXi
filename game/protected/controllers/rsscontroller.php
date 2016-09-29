<?php

require_once "game/protected/utils/rssgenerator.php";
class RssController extends CController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->layout = "blank";
	}
	
	private function saveRssToXml($filePath){
		$rss = new RSS("我游戏网", "http://www.woyouxi.net", "小游戏专业网站,免费为你提供小游戏大全,双人小游戏,连连看小游戏,植物大战僵尸,保卫萝卜等最新小游戏。");
		
		//查询时间
		$statistical = new Statistical();
		$newGame = $statistical->getNewTop(60);
		
		foreach($newGame as $result){
			$rss->AddItem($result["name"], "/game/index?gameid=" . $result["id"], $result["introduce"], $result["update_time"]);
		}
		
		$rss->BuildRSS();
		$rss->SaveToFile($filePath);
	}
	
	public function actionIndex()
	{
		$needRefresh = true;
		$filePath = dirname(dirname(dirname(dirname(__FILE__))));
		$filePath = $filePath . "/cache/htmls/rss_codingsky.xml";
		if(file_exists($filePath)){
			if(time() - filemtime($filePath) < 24 * 3600 ){
				$needRefresh = false;
			}
		}
		
		if($needRefresh){
			$this->saveRssToXml($filePath);
		}
		
		echo file_get_contents($filePath);
	}
	
	
}