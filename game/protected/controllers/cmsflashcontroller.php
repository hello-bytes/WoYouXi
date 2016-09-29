<?php

require_once "cmscontroller.php";
class CmsFlashController extends CmsController
{
	public function actionGetAllUrl()
	{
		$page = $_POST["page"];
		
		$tempQuery = new TempQuery();
		$results = $tempQuery->getFlashUrls($page);
		
		if(count($results) > 0){
			echo GeneralSuccessJsonResult($results);	
		}else{
			echo GeneralJson("1","1");
		}
	}
}