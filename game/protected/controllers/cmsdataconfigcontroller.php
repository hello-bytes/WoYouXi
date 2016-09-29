<?php

require_once "cmscontroller.php";
require_once 'game/protected/utils/catalogidnamemap.php';
class CmsDataConfigController extends CmsController
{
	public function actionGetCategory()
	{
		$category = new Category();
		echo GeneralSuccessJsonResult($category->getAllCategory());
	}
	
	public function actionGetCategoryEx()
	{
		$catalogMap = new CatalogIdNameMap();
		echo GeneralSuccessJsonResult($catalogMap->getData());
	}
	
	public function actionGetCategoryPageInfo()
	{
		$catalogId = intval($_POST["categoryid"]);
		if($catalogId > 0){	
			$statistical = new Statistical();
			$catalogInfo = $statistical->getCatalogGamePageInfo($catalogId);
			echo GeneralSuccessJsonResult($catalogInfo);	
		}else{
			echo GeneralJson(constant('CODE_ERROR_PARAM'),constant('CODE_ERROR_PARAM'));
		}
	}
	
	public function actionGetSubject()
	{
		$categoryId = intval($_POST['categoryid']);
		
		$subject = new Subject();
		echo GeneralSuccessJsonResult($subject->getSubjectByCategory($categoryId));
	}
	
	public function actionGetSubjectPageInfo()
	{
		$subjectId = intval($_POST['subjectid']);
		
		$staticsLoader = new Statistical();
		$staticsLoader->countPerPage = 7 * 48;
		$pageInfo = $staticsLoader->getSubjectGamePageInfo($subjectId);
		echo GeneralSuccessJsonResult($pageInfo);
	}
	
	public function actionGetGamePageinfo()
	{
		$gameLoader = new Game();
		$gameLoader->countPerPage = 1000;
		$pageinfo = $gameLoader->getAllGamePageInfo(1);
		echo GeneralSuccessJsonResult($pageinfo);
	}
	
	public function actionGetGamePage()
	{
		$gameLoader = new Game();
		$gameLoader->countPerPage = 1000;
		$pagedata = $gameLoader->getAllGamePage(1, intval($_POST["pageno"]));
		echo GeneralSuccessJsonResult($pagedata);
	}
	
	/**
	 * 取得视频分页的信息
	 */
	public function actionGetVideoPageInfo(){
		$videoId = intval($_POST['videoid']);
		
		if($videoId > 0){
			$videoLoader = new Op56Video();
			$pageinfo = $videoLoader->getVideoPageInfoByVTag($videoId);
			echo GeneralSuccessJsonResult($pageinfo);
		}else{
			echo GeneralJson(constant('CODE_ERROR_PARAM'),constant('CODE_ERROR_PARAM'));
		}
	}
	
	public function actionGetAllVideoPageinfo()
	{
		$videoLoader = new Op56Video();
		$videoLoader->countPerPage = 300;
		$pageinfo = $videoLoader->getPageInfo(1);
		echo GeneralSuccessJsonResult($pageinfo);
	}
	
	public function actionGetAllVideoPage()
	{
		$videoLoader = new Op56Video();
		$videoLoader->countPerPage = 300;
		$pagedata = $videoLoader->getPageData(1,intval($_POST["pageno"]));
		echo GeneralSuccessJsonResult($pagedata);
	}
	
	public function actionGetCacheConfig()
	{
		$filepath = dirname(dirname(dirname(dirname(__FILE__)))) . "/cache/config.json";
		if(file_exists($filepath)){
			$content = file_get_contents($filepath);
			
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ". filesize($filepath));
			Header("Content-Disposition: attachment; filename=" . "cacheconfig.json");
			echo $content;
		}else{
			echo "no config";
		}
		exit();
	}
}