<?php

require_once "defaultcontroller.php";
//require_once "game/protected/utils/log.php";
require_once "game/protected/utils/catalogidnamemap.php";
class GameController extends DefaultController
{
	public function actionIndex(){
		if(key_exists("gameid", $_GET)){
			$gameId = $_GET['gameid'];
			
			$gameLoader = new Game();
			$gameInfo = $gameLoader->getGameInfo($gameId);
			
			if($gameInfo == null){
				$this->render("index",array(
					"game" => null,
				));
				return;
			}
			
			setGlobalTitle($gameInfo["name"]);
			setGlobalKeywords($gameInfo["name"]);
			setGlobalDescript("我游戏网为您提供" . $gameInfo["name"] . "," . $gameInfo["introduce"]);
			
			//取得catalog的信息
			$catalog = new Category();
			$catalogInfo = $catalog->getCategoryInfo($gameInfo['category']);
			
			$catalogMap = new CatalogIdNameMap();
			setGlobalCatalog($catalogMap->getNameFromId($catalogInfo["id"]));
			
			$this->addCrumbItem($catalogInfo['name'], $catalogMap->getUrlById($catalogInfo["id"]));
			$this->addCrumbItem($gameInfo['name'], $_SERVER['REQUEST_URI']);
			
			$gameLoader->addPlayCount($gameId);
			$subjects = $gameLoader->getGameSubject($gameId);
			
			$this->setAdvJs(null);
			
			//读取相关游戏
			$relativesubjects = null;
			if($subjects!=null&&count($subjects)>0){
				$relativesubjects = $gameLoader->getRelativeGame($subjects[0]['id']);
			}
			
			//读取Top排行版的游戏
			$newTopGame = null;
			if($relativesubjects == null || count($relativesubjects) < 18){
				//$statistical = new Statistical();
				//$newTopGame = $statistical->getOneMonthGlobalTop(18);
			}
			
			//读取相关视频
			//$gameVideoTag = new  GameVideoTag();
			//$relativevideos = $gameVideoTag->getVideoByGameId($gameId);
			
			$this->render("index",array(
					"game" => $gameInfo,
					"catalog" => $catalogInfo,
					"crumb" => $this->getCrumb(),
					"gamesubjects" => $subjects,
					"relativesubjects" => $relativesubjects,
					"newtopgame" => $newTopGame,
					//"relativevideos" => $relativevideos,
			));
		}
	}
	
	private function getSwfMd5($url){
		return str_replace("http://bcs.duapp.com/youxires/flash/", "", $url);
	}
	
	private function isRelativePath($url){
		if(strpos($url, "http:") === false){
			return true;
		}
		return false;
	}
	
	public function actionPlay(){
		if(key_exists("gameid", $_GET)){
			$gameId = $_GET['gameid'];
			
			$gameMetaLoader = new GameMeta();
			$gameMetaInfo = $gameMetaLoader->getGameMeta($gameId);
			
			$gameLoader = new Game();
			$gameInfo = $gameLoader->getGameInfo($gameId);
			
			setGlobalTitle($gameInfo["name"]);
			setGlobalKeywords($gameInfo["name"]);
			setGlobalDescript("我游戏网为您提供" . $gameInfo["name"] . "," . $gameInfo["introduce"]);
			
			$swfMd5 = $this->getSwfMd5($gameMetaInfo['swfurl']);
			
			$ossFile = new OssSwfFile();
			if($this->isRelativePath($gameMetaInfo['swfurl']) == false && $ossFile->isFileExist($swfMd5)){
				$gameMetaInfo["swfurl"] = "http://youxires.woyouxi.net/flash/" . $swfMd5;
			}else if($this->isRelativePath($gameMetaInfo['swfurl']) == true){
				$gameMetaInfo["swfurl"] = converResUrl($gameMetaInfo["swfurl"]);
			}
			
			//取得catalog的信息
			$catalog = new Category();
			$catalogInfo = $catalog->getCategoryInfo($gameInfo['category']);
			
			$catalogMap = new CatalogIdNameMap();
			
			$this->addCrumbItem($catalogInfo['name'], $catalogMap->getUrlById($catalogInfo["id"]));
			$this->addCrumbItem($gameInfo['name'], $_SERVER['REQUEST_URI']);
			
			$subjects = $gameLoader->getGameSubject($gameId);
			
			$relativesubjects = null;
			if($subjects!=null&&count($subjects)>0){
				$relativesubjects = $gameLoader->getRelativeGame($subjects[0]['id']);
			}
			
			$newTopGame = null;
			if($relativesubjects == null || count($relativesubjects) < 18){
				$statistical = new Statistical();
				$newTopGame = $statistical->getOneMonthGlobalTop(18);
			}
			
			$gameVideoTag = new GameVideoTag();
			$relativevideos = $gameVideoTag->getVideoByGameId($gameId);
			
			$pdataLoader = new DBData();
			$gaoxiaotu = $pdataLoader->getDataAndUnseri(1012);
			
			$this->setAdvJs(null);
			
			$this->render("play",array(
					"gamemeta" => $gameMetaInfo,
					"game" => $gameInfo,
					"crumb" => $this->getCrumb(),
					"relativesubjects" => $relativesubjects,
					"newtopgame" => $newTopGame,
					"relativevideos" => $relativevideos,
					"gaoxiaotu" =>  $gaoxiaotu,
			));
		}
	}
	
	public function actionFs(){
	if(key_exists("gameurl", $_GET) &&  key_exists("name", $_GET)) {
			$this->layout = "swf";
			$gameUrl = $_GET['gameurl'];
			
			$this->render("fullscreen",array(
					"gameUrl" => $gameUrl,
					"name" => $_GET['name'],
			));
		}else{
			$this->redirect("http://www.woyouxi.net");
		}
	}
}




