<?php

require_once "defaultcontroller.php";
require_once "game/protected/utils/catalogidnamemap.php";
class CatalogController extends DefaultController
{
	public function processCatalog($catalogId,$catalogname){
		//查找所有的subjectid
		$subjectLoader = new Subject();
		$subjects = $subjectLoader->getSubjectByCategory($catalogId);
		
		//取得catalog的信息
		$catalog = new Category();
		$catalogInfo = $catalog->getCategoryInfo($catalogId);
		
		//统计信息
		$statistical = new Statistical();
		
		$pageInfo = $statistical->getCatalogGamePageInfo($catalogId);
		
		$currentPage = 0;
		if( key_exists("page", $_GET) && $_GET['page'] >= 1 ){
			$currentPage = $_GET['page'] - 1;
		}
		
		$order = 0;
		if(key_exists("order", $_GET) && $_GET["order"] == "1"){
			$order = 1;
		}
		
		$games = $statistical->getCatalogGamePage($catalogId, $order, $currentPage);
		
		$currenturl = $_SERVER['REQUEST_URI'];
		$currenturl = str_replace("?nocahce=1", "", $currenturl);
		
		$this->addCrumbItem($catalogInfo['name'], $currenturl);
		$this->addCrumbItem("共" . $pageInfo['totalcount'] . "个小游戏", "");
		
		$pdata = new DBData();
		$weekData = unserialize($pdata->getData($catalogId * 10 + 1));
		$monthData = unserialize($pdata->getData($catalogId * 10 + 2));
		$allData = unserialize($pdata->getData($catalogId * 10 + 3));
		
		$keywords = "";
		$maxcount = count($games) > 10 ? 10 : count($games);
		for($index = 0;$index < $maxcount;$index++){
			if(strlen($keywords) == 0){
				$keywords = $games[$index]['name'];
			}else{
				$keywords = $keywords . "," . $games[$index]['name'] . "";
			}
		}
		
		setGlobalTitle("小游戏分类 - " . $catalogInfo["name"]);
		if(strlen($keywords) > 0){
			setGlobalKeywords($catalogInfo["name"] . "," . $keywords);
		}else{
			setGlobalKeywords($catalogInfo["name"]);
		}
		setGlobalDescript("我游戏网之" . $catalogInfo["name"] . "小游戏,共" . $pageInfo['totalcount'] . "个小游戏,包括" . $keywords . "等");
		
		$pdataLoader = new DBData();
		$gaoxiaotu = $pdataLoader->getDataAndUnseri(1012);
		
		$this->setAdvJs(null);
			
		$this->render("index",array(
				"pageinfo" => $pageInfo,
				"games" => $games,
				"subjects" => $subjects,
				"topgames" => $allData,
				"weekgames" => $weekData,
				"monthgames" => $monthData,
				"crumb" => $this->getCrumb(),
				"catalogname" => $catalogname,
				"gaoxiaotu" => $gaoxiaotu,
				"showsubject" => true,//$catalogId >= 5 ? 0: 1,
				//"catalogname" => $catalogInfo["name"],
		));
	}
	
	public function processSubject($catalogId,$subjectId)
	{
		//查找所有的subjectid
		$subjectLoader = new Subject();
		$subject = $subjectLoader->getSubjectInfo(intval($subjectId));
		
		//取得catalog的信息
		$catalog = new Category();
		$catalogInfo = $catalog->getCategoryInfo($catalogId);
		
		$staticsLoader = new Statistical();
		
		$staticsLoader->countPerPage = 7 * 48;
		$pageInfo = $staticsLoader->getSubjectGamePageInfo($subjectId);
		
		$currentPage = 0;
		if( key_exists("page", $_GET) && $_GET['page'] > 1 ){
			$currentPage = $_GET['page'] - 1;
		}
		$order = 0;
		if(key_exists("order", $_GET) && $_GET["order"] == "1"){
			$order = 1;
		}
		$games = $staticsLoader->getSubjectGamePage($subjectId, $order, $currentPage);

		$catalogMap = new CatalogIdNameMap();
		
		$keywords = "";
		$maxcount = count($games) > 10 ? 10 : count($games);
		for($index = 0;$index < $maxcount;$index++){
			if(strlen($keywords) == 0){
				$keywords = $games[$index]['name'];
			}else{
				$keywords = $keywords . "," . $games[$index]['name'] . "";
			}
		}
		
		setGlobalTitle("小游戏专题-" . $subject["name"]);
		if(strlen($keywords) > 0){
			setGlobalKeywords($subject["name"] . "," . $keywords);
		}else{
			setGlobalKeywords($subject["name"]);
		}
		setGlobalDescript("我游戏网之小游戏专题-" . $subject["name"] . ",共" . $pageInfo['totalcount'] . "个小游戏,包括" . $keywords . "等");
		
		$this->addCrumbItem($catalogInfo['name'], $catalogMap->getUrlById($catalogInfo["id"]));
		$this->addCrumbItem($subject['name'], $_SERVER['REQUEST_URI']);
		$this->addCrumbItem("共&nbsp;" . $pageInfo['totalcount'] . "&nbsp;个小游戏", "");
		
		$subjectTopGame = $staticsLoader->getSubjectTopGameEx($subjectId,30);
		
		$pdataLoader = new DBData();
		$gaoxiaotu = $pdataLoader->getDataAndUnseri(1012);
		
		$this->setAdvJs(null);
		
		$this->render("subject",array(
				"pageinfo" => $pageInfo,
				"games" => $games,
				"topgames" => $subjectTopGame,
				"subject" => $subject,
				"crumb" => $this->getCrumb(),
				"gaoxiaotu" => $gaoxiaotu,
				"catalogname" => $catalogInfo["name"],
		));
	}
	
	private function smartProcess($id,$name = ""){
		if(key_exists("subjectid", $_GET) && $_GET['subjectid'] > 0){
			$this->processSubject($id,$_GET['subjectid']);
		}else{
			$this->processCatalog($id,$name);
		}
	}
	
	public function actiondongzuo(){
		$this->smartProcess(1,"dongzuo");
		/*if(key_exists("subjectid", $_GET) && $_GET['subjectid'] > 0){
			$this->processSubject(1,$_GET['subjectid']);
		}else{
			$this->processCatalog(1);
		}*/
	}
	
	public function actionyundong(){
		$this->smartProcess(2,"yundong");
	}
	
	public function actionyizhi(){
		$this->smartProcess(3,"yizhi");
	}
	
	public function actionsheji(){
		$this->smartProcess(4,"sheji");
	}
	
	public function actionyule(){
		$this->smartProcess(5,"yule");
	}
	
	public function actionmaoxian(){
		$this->smartProcess(6,"maoxian");
	}
	
	public function actionqipai(){
		$this->smartProcess(7,"qipai");
	}
	
	public function actioncelue(){
		$this->smartProcess(8,"celue");
	}
	
	public function actionnvsheng(){
		$this->smartProcess(9,"nvsheng");
	}
	
	public function actionxiuxiang(){
		$this->smartProcess(10,"xiuxiang");
	}
	
	public function actionzhuangban(){
		$this->smartProcess(11,"zhuangban");
	}
	
	public function actionertong(){
		$this->smartProcess(12,"ertong");
	}
	
	public function actionjingying(){
		$this->smartProcess(13,"jingying");
	}
	
	public function actionguoguang(){
		$this->smartProcess(14);
	}
	
	public function actionwangye()
	{
		$this->smartProcess(15);
	}
}