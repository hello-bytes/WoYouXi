<?php

require_once 'game/protected/utils/bcshelper.php';
require_once 'game/protected/utils/HttpClient.class.php';
class AdvController extends CController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}
	
	public function actionGetSWBannerAdv()
	{
		$this->actionGetWebGame();
	}
	
	public function actionGetWebGame(){
		$filename = "game/protected/views/uiparts/slidegames.html";
		if(file_exists($filename)){
			echo file_get_contents($filename);	
		}else{
			echo "";
		}
	}
	
	public function actionGetAdvJs(){
		$advid = intval($_GET["id"]);
		if($advid > 0){
			$dataLoader = new  DBData();
			$data = $dataLoader->getDataAndUnseri($advid);
			echo $data;
		}
		echo "";
	}
	
}