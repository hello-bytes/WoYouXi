<?php

require_once "defaultcontroller.php";
class LogController extends DefaultController
{
	public function actionGameLog(){
		$gameid = intval($_GET["gameid"]);
		$accesstype = intval($_GET["accesstype"]);
		
		$gameLog = new GameLog();
		$gameLog->addLog($gameid, $accesstype);
		
	}
	
	public function actionvideolog(){
		$videoid = intval($_GET["videoid"]);
		
		$videoLog = new Op56Video();
		$videoLog->addVideoCount($videoid);
	}
}