<?php

/**
 * SiteController is the default controller to handle user requests.
 */

require_once "defaultcontroller.php";
class SiteController extends DefaultController
{
	public function __construct($id,$module = null)
	{
		parent::__construct($id, $module);
		$this->layout = "default";
	}
	
	public function getTodayNewGameCount($queryCount){
		if($queryCount < 10){
			//取20到50的随机值
			srand((double)microtime()*1000000);
			return rand(20,50);
		}
		return $queryCount;
	}
	
	public function actionIndex()
	{
		$statistical = new Statistical();
		$newTopGame = $statistical->getOneMonthGlobalTop(84);
		//$newTopGame = $statistical->getGlobalTop(84);
		
		$newGame = $statistical->getNewTop(84);
		$allTopGame = $statistical->getAllGlobalTop(70);
		
		$rightTop = $statistical->getAllWeekTop(11);
		
		$todayGameCount = $this->getTodayNewGameCount(
						$statistical->getTodayNewGameCount());
						
		$this->setAdvJs(null);
						
		//$videoLoader = new Op56Video();
						
		//各个模块的排行版
		$catalogBlocks = array(
			array("id" => 1, "name" => "动作"),
			array("id" => 2, "name" => "体育"),
			array("id" => 3, "name" => "益智"),
			array("id" => 4, "name" => "射击"),
			array("id" => 5, "name" => "搞笑"),
			array("id" => 6, "name" => "冒险"),
			array("id" => 7, "name" => "棋牌"),
			array("id" => 8, "name" => "策略"),
			array("id" => 10, "name" => "休闲"),
			array("id" => 11, "name" => "装扮"),
				);
				
		$pdataLoader = new DBData();
		for($index = 0; $index < count($catalogBlocks); $index++){ 
			$dataid = intval($catalogBlocks[$index]['id']) * 10 + 1;
			$catalogBlocks[$index]['hotgame'] = unserialize($pdataLoader->getData($dataid));
		}
		$topicon = $pdataLoader->getDataAndUnseri(1000);
		$topVideos = $pdataLoader->getDataAndUnseri(1001);
		$topeightDuanzi = $pdataLoader->getDataAndUnseri(1010);
		$topStaticPic = $pdataLoader->getDataAndUnseri(1011);
		
		//db里没有这个缓存了，手动写几个，保证数据好看
		$topVideos = array(
			array(
				"image_url" => "/game/assets/img/videos/1.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频1"
			),
			array(
				"image_url" => "/game/assets/img/videos/2.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频2"
			),
			array(
				"image_url" => "/game/assets/img/videos/3.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频3"
			),
			array(
				"image_url" => "/game/assets/img/videos/4.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频4"
			),
			array(
				"image_url" => "/game/assets/img/videos/5.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频5"
			),
			array(
				"image_url" => "/game/assets/img/videos/6.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频6"
			),
			array(
				"image_url" => "/game/assets/img/videos/1.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频1"
			),
			array(
				"image_url" => "/game/assets/img/videos/2.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频2"
			),
			array(
				"image_url" => "/game/assets/img/videos/3.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频3"
			),
			array(
				"image_url" => "/game/assets/img/videos/4.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频4"
			),
			array(
				"image_url" => "/game/assets/img/videos/5.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频5"
			),
			array(
				"image_url" => "/game/assets/img/videos/6.jpg",
				"url" => "#",
				"playcount" => 10,
				"title" => "测试视频6"
			),
		);
		
		$this->layout = "default";
		$this->render("index",
				array(
						"newtopgame" => $newTopGame,//最新最好玩游戏的TAB
						"newgame" => $newGame,//新游戏列表
						"alltopgame" => $allTopGame,//经典游戏排行版
						"righttop" => $rightTop,//右侧的游戏排行版本
						"todayGameCount" => $todayGameCount,//今天更新的游戏数
						"catalogblocks" => $catalogBlocks,
						"topvideos" => $topVideos,
						"topicon" => $topicon,
						"topeightDuanzi" => $topeightDuanzi,
						"topStaticPic" => $topStaticPic
						)
				);
	}
	
	public function actionNew()
	{
		$pageno = 0;
		if(array_key_exists("page", $_GET)){
			$pageno = intval($_GET['page']);
			$pageno = $pageno -1;
			$pageno = $pageno < 0 ? 0 : $pageno; 
		}
		
		$statistical = new Statistical();
		$newGames = $statistical->getNewTopByPage($pageno,99);
		$newtopgame = $statistical->getOneMonthGlobalTop(9);
		
		setGlobalTitle("我游戏网最近为您添加的游戏");
		$keywords = "";
		$maxcount = count($newGames) > 10 ? 10 : count($newGames);
		for($index = 0;$index < $maxcount;$index++){
			if(strlen($keywords) == 0){
				$keywords = $newGames[$index]['name'];
			}else{
				$keywords = $keywords . "," . $newGames[$index]['name'] . "";
			}
		}
		setGlobalKeywords($keywords);
		setGlobalDescript("我游戏网最近为您添加的小游戏,包括" . $keywords . "等");
		
		$this->setAdvJs(null);
		
		$this->layout = "default";
		$this->render("new",
				array(
						"newgame" => $newGames,
						"newtopgame" => $newtopgame,
						)
				);
	}
	
	private function getDataType($catalog){
		$queryDay = 1;
		if(array_key_exists("day", $_GET)){
			$queryDay = intval($_GET['day']);
		}
		$offset = 1;//默认加1是7天的
		if($queryDay == 30){
			$offset = 2;
		}else if($queryDay == 1){
			$offset = 4;
		}else if($queryDay == -1){
			$offset = 3;
		}
		
		return intval($catalog) * 10 + $offset;
	}
	
	public function actionTop(){
		$catalogId = 0;
		if(array_key_exists("catalog", $_GET)){
			$catalogId = $_GET["catalog"];
		}
		$catalogId = intval($catalogId);
		
		$this->setAdvJs(null);
		
		$catalogBlocks = array(
			array("id" => 0, "name" => "所有游戏"),
			array("id" => 1, "name" => "动作"),
			array("id" => 2, "name" => "体育"),
			array("id" => 3, "name" => "益智"),
			array("id" => 4, "name" => "射击"),
			array("id" => 5, "name" => "搞笑"),
			array("id" => 6, "name" => "冒险"),
			array("id" => 7, "name" => "棋牌"),
			array("id" => 8, "name" => "策略"),
			array("id" => 10, "name" => "休闲"),
			array("id" => 11, "name" => "装扮"),
				);
		$pdataLoader = new DBData();
		for($index = 0; $index < count($catalogBlocks); $index++){
			if(intval($catalogBlocks[$index]['id']) == $catalogId){
			}
		}
		
		$dataid = $this->getDataType($catalogId); 
		$data = unserialize($pdataLoader->getData($dataid));
		
		setGlobalTitle("我游戏网小游戏TOP版");
		$keywords = "";
		$maxcount = count($catalogBlocks);
		for($index = 0;$index < $maxcount;$index++){
			if(strlen($keywords) == 0){
				$keywords = $catalogBlocks[$index]['name'];
			}else{
				$keywords = $keywords . "," . $catalogBlocks[$index]['name'] . "";
			}
		}
		setGlobalKeywords($keywords);
		setGlobalDescript("我游戏网的小游戏TOP版,包括" . count($catalogBlocks) . "个分类:" . $keywords . "");
				
		$statistical = new Statistical();
		$this->render("top",array(
				"catalogs" => $catalogBlocks,
				"data" => $data, 
		  		"currentcatalogid" => $catalogId,
			));
	}
	
	public function actionError(){
		$statistical = new Statistical();
		
		$allTopGame = $statistical->getAllGlobalTop(18);
		$newTopGame = $statistical->getOneMonthGlobalTop(18);
		
		setGlobalTitle("404了？异常了？你懂的！");
		$maxcount = count($allTopGame) > 10 ? 10 : count($allTopGame);
		for($index = 0;$index < $maxcount;$index++){
			if(strlen($keywords) == 0){
				$keywords = $allTopGame[$index]['name'];
			}else{
				$keywords = $keywords . "," . $allTopGame[$index]['name'] . "";
			}
		}
		setGlobalKeywords($keywords);
		setGlobalDescript($keywords . "等");
		
		
		$this->render("exception",array(
				"newtopgame" => $newTopGame,
		  		"allnewgame" => $allTopGame,
			));
	}
	
	public function actionTest(){
		$statistical = new Statistical();
		
		$allTopGame = $statistical->getAllGlobalTop(18);
		$newTopGame = $statistical->getOneMonthGlobalTop(18);
		
		$this->render("test",array(
			"newtopgame" => $newTopGame,
		  		"allnewgame" => $allTopGame,
			));
	}
}
