<?php

require_once "cmscontroller.php";
class CmsGameMetaController extends CmsController
{
	public function actionAddGameMeta()
	{
		$url = $_POST['woyouxiurl'];
		$sourceurl = $_POST['url'];
		$width = $_POST['width'];
		$height = $_POST['height'];
		$params = $_POST['param'];
		$gsize = $_POST['flashsize'];
		$gameid = $_POST['gameid'];
		
		$playver = "";
		if (key_exists("playerver", $_POST)){
			$playver = $_POST["playerver"];
		}
		
		$gameMetaSaver = new GameMeta();
		$gameMetaid = $gameMetaSaver->addGameMeta($gameid,$url,$sourceurl, $width, $height, $params, $gsize, $playver);
		
		if($gameMetaid > 0){
			echo GeneralSuccessJsonResult(array("gameid"=>$gameMetaid));
		}else{
			echo GeneralJson(constant('CODE_UNKNOWN'),constant('DESC_UNKNOWN'));
		}
	}
}