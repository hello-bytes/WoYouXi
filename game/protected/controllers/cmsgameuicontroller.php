<?php

require_once "cmsuicontroller.php";
class CmsGameUIController extends CmsUIController
{
	private function getSearchCatalogId(){
		if(key_exists("search_catalog", $_POST) && $_POST["search_catalog"] >= 0){
			return $_POST["search_catalog"];
		}
		return -1;
	}
	
	private function getSearchSubjectId(){
		if(key_exists("subjectid", $_POST) && $_POST["subjectid"] >= 0){
			return $_POST["subjectid"];
		}
		return -1;
	}
	
	private function getSearchStatus(){
		if(key_exists("search_status", $_POST) && $_POST["search_status"] >= 0){
			return $_POST["search_status"];
		}
		return -1;
	}
	
	private function getPage(){
		if(key_exists("page", $_GET) && $_GET["page"] >= 0){
			return $_GET["page"];
		}
		return 1;
	}
	
	private function getSearchText(){
		if(key_exists("search_text", $_POST)){
			return $_POST["search_text"];
		}
		return "";
	}
	
	public function actionIndex(){
		if(array_key_exists("operator", $_POST)){
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "delete") == 0){
				//删除所有选中的ID
				if(array_key_exists("selectedId", $_POST)){
					$selectedGameIds = $_POST['selectedId'];
		
					$gameDeleter = new Game();
					$gameDeleter->deleteGame($selectedGameIds);
				}
			}else if(strcasecmp($operator, "setstatus") == 0){
				if(array_key_exists("selectedId", $_POST)){
					$selectedGameIds = $_POST['selectedId'];
				
					$gameDeleter = new Game();
					$gameDeleter->setGameStatus($selectedGameIds,$_POST["set_status"]);
				}
			}else if(strcasecmp($operator, "setallstatus") == 0){
				//if(array_key_exists("selectedId", $_POST)){
					//$selectedGameIds = $_POST['selectedId'];
					$this->setAllGameStatus($_POST["set_all_status"]);
					//$gameDeleter = new Game();
					//$gameDeleter->setAllGameStatus($_POST["set_all_status"]);
				//}
			}else if(strcasecmp($operator, "offline") == 0){
				if(array_key_exists("selectedId", $_POST)){
					$selectedGameIds = $_POST['selectedId'];
					
					$gameDeleter = new Game();
					$gameDeleter->setGameStatus($selectedGameIds,0);
				}
			}
		}
		
		$gameLoader = new Game();
		$pageInfo = $gameLoader->getGamePageInfo($this->getSearchCatalogId(),
					$this->getSearchSubjectId(),$this->getSearchStatus(),$this->getSearchText());
		$page = $gameLoader->getGamePage($this->getSearchCatalogId(),
					$this->getSearchSubjectId(),$this->getSearchStatus(),$this->getSearchText(),
					1,$this->getPage()-1);
		
		$catalogLoader = new Category();
		$catalogs = $catalogLoader->getAllCategory();
		
		$this->render("index",array(
				"pageinfo" => $pageInfo,
				"pagedata" => $page,
				"catalogs" => $catalogs,
				"currentpage" => $this->getPage(),
				"moduletitle" => "游戏管理",
		));
	}
	
	private function setAllGameStatus($status){
		//每次更新2万条，
		$gameSaver = new Game();
		$maxGameId = $gameSaver->getMaxGameId();
		for($index = 0;$index < $maxGameId;$index += 20000){
			$gameSaver->setGameStatusById($index,$index + 20000,$status);
		}
	}
	
	private function saveGame($update){
		$name = $_POST['name'];
		$introduce = $_POST['introduce'];
		$guide = $_POST['guide'];
		$gsize = $_POST['gsize'];
		$gicon = $_POST['gicon'];
		$previewimageurl = $_POST['previewimageurl'];
		$previewimagewidth = $_POST['previewimagewidth'];
		$previewimageheight = $_POST['previewimageheight'];
		$howtostart = $_POST['hottostart'];
		$objective = $_POST['objective'];
		$catalogid = $_POST['t_catalogid'];
		
		$sourceurl = "";
		if( key_exists("sourceurl", $_POST) ){
			$sourceurl = $_POST['sourceurl'];
		}
		
		$realgameurl = "";
		if( key_exists("realgameurl", $_POST) ){
			$realgameurl = $_POST['realgameurl'];
		}
		
		$gameSaver = new Game();
		if($update){
			$gameSaver->updateGame($_GET['gameid'] ,$name, "", $catalogid, $gsize, $gicon, $guide, $hottostart, $objective, $introduce, $previewImageUrl, $previewimagewidth, $previewimageheight);
		}else{
			$gameSaver->addGame($name, "", $catalogid, $gsize, $gicon, $guide, $hottostart, $objective, $introduce, $previewImageUrl, $previewimagewidth, $previewimageheight,$sourceurl,$realgameurl);
		}
	}
	
	public function actionaddGame(){
		$catalogLoader = new Category();
		$catalogs = $catalogLoader->getAllCategory();
		
		if(array_key_exists("operator", $_POST)){
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "save") == 0){
				if(count($_POST) > 0){
					$this->saveGame(false);
				}
			}
		}
		
		$this->render("game",array(
				"moduletitle" => "增加游戏",
				"catalogs" => $catalogs,
				"game" => null,
		));
	}
	
	public function actioneditGame(){
		$catalogLoader = new Category();
		$catalogs = $catalogLoader->getAllCategory();
		
		$gameLoader = new Game();
		$game = $gameLoader->getGameInfo($_GET['gameid']);
		
		if(array_key_exists("operator", $_POST)){
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "save") == 0){
				if(count($_POST) > 0){
					$this->saveGame(true);
				}
			}
		}
		
		$this->render("game",array(
				"moduletitle" => "修改游戏",
				"catalogs" => $catalogs,
				"game" => $game,
		));
	}
}