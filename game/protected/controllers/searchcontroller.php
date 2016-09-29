<?php

require_once "defaultcontroller.php";
class SearchController extends DefaultController
{
	private function getSearchText(){
		$text = "";
		if(array_key_exists("text", $_GET)){
			$text  = $_GET['text'];
		}
		return $text; 
	}
	
	private function getSearchPage(){
		$page = "1";
		if(array_key_exists("page", $_GET)){
			$page = $_GET['page'];
		}
		$pageno = intval($page) - 1;
		$pageno = $pageno < 0 ? 0 : $pageno;
		return $pageno; 
	}
	
	
	public function actionIndex(){
		$text = $this->getSearchText();
		
		$statistical = new Statistical();
		$newTopGame = $statistical->getOneMonthGlobalTop(84);
		$newGame = $statistical->getNewTop(50);
		
		$pageinfo = null;
		$pagedata = null;
		if(strlen($text) != 0){
			$gameLoader = new Game();
			$gameLoader->countPerPage = 50;
			$pageinfo = $gameLoader->getGamePageInfoByText($text);
			$pagedata = $gameLoader->getGamePageByText($text, $this->getSearchPage());
		}
		
		$hotSearchText = array(
			array("text" => "疯狂摩托","url" => "/search?text=疯狂摩托"),
			array("text" => "拳皇","url" => "/search?text=拳皇"),
			array("text" => "狙击手","url" => "/search?text=狙击手"),
			array("text" => "王者摩托","url" => "/search?text=王者摩托"),
			array("text" => "黑白棋","url" => "/search?text=黑白棋"),
			array("text" => "象棋","url" => "/search?text=象棋"),
			array("text" => "台球","url" => "/search?text=台球"),
			array("text" => "穿越火线","url" => "/search?text=穿越火线"),
			array("text" => "喜羊羊","url" => "/search?text=喜羊羊"),
			array("text" => "纸牌","url" => "/search?text=纸牌"),
			);
			
		$hotSearchBarText = array(
			array("text" => "生化火器","url" => "/search?text=生化火器"),
			array("text" => "爸爸去哪了","url" => "/search?text=爸爸去哪了"),
			array("text" => "找你妹","url" => "/search?text=找你妹"),
			array("text" => "天天爱消除","url" => "/search?text=天天爱消除"),
			);
		
		$this->render("result",array(
				"searchtext" => $text,
				"pageinfo" => $pageinfo,
				"pagedata" => $pagedata,
				"newgame" => $newGame,
				"newtopgame" => $newTopGame,
				"hotsearchtext" => $hotSearchText,
				"hotsearchbartext" => $hotSearchBarText
		));
	}	
}