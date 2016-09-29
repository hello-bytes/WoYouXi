<?php

require_once "cmscontroller.php";
class CmsGameController extends CmsController
{
	public function actionAddGame()
	{
		$name = $_POST['name'];
		$ename = $_POST['ename'];
		$categoryid = $_POST['categoryid'];
		$gsize = $_POST['gsize'];
		$gicon = $_POST['gicon'];
		$guide = $_POST['guide'];
		$hottostart = $_POST['hottostart'];
		$objective = $_POST['objective'];
		
		$introduce = $_POST['introduce'];
		$previewImageUrl = $_POST['previewimageurl'];
		$previewImageWidth = $_POST['previewimagewidth'];
		$previewImageHeight = $_POST['previewimageheight'];
		
		$sourceurl = "";
		if( key_exists("sourceurl", $_POST) ){
			$sourceurl = $_POST['sourceurl'];
		}

		$realgameurl = "";
		if( key_exists("realgameurl", $_POST) ){
			$realgameurl = $_POST['realgameurl'];
		}
		
		$gameSaver = new Game();
		$gameid = $gameSaver->addGame($name,$ename,$categoryid,$gsize,$gicon,$guide,$hottostart,$objective
				,$introduce,$previewImageUrl,$previewImageWidth,$previewImageHeight,$sourceurl,$realgameurl);
		
		$subjectCount = $_POST['subjectidcount'];
		if($subjectCount > 0){
			$subjectIds = array();
			for($index = 0;$index < $subjectCount; $index++){
				//$subjectKey = "subjectid" . $index;
				array_push($subjectIds, $_POST["subjectid_" . $index]);
			}
			
			if(count($subjectIds) > 0){
				$subjectSaver = new Subject();
				$subjectSaver->setSubjectRelation($gameid,$subjectIds);
			}
		}
		
		if($gameid > 0){
			echo GeneralSuccessJsonResult(array("gameid"=>$gameid));
		}else{
			echo GeneralJson(constant('CODE_UNKNOWN'),constant('DESC_UNKNOWN'));
		}
	}
}