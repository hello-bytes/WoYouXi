<?php

require_once "defaultcontroller.php";
class VideoController extends DefaultController
{
	//游戏TAG,国内经典，日本经典，热门视频是特殊的TAG
	//建立TAG下所属数据时，只需给某一个其它TAG中的一集即可，比如蜡笔小新做为日本经典，只需要从蜡笔小新第一部，第二部中各选第一集，指定其TAG为日本经典即可。
	//但如果是相关性不那么明显的，没有先后顺序的视频，则可以指定多个，比如游戏TAG下，就算都是玩鸟视频，则也可以指定多个玩鸟视频给游戏视频，因为他们之间不存在先后顺序
	//
	public function actionindex(){
		$gameVideoTagId = 30;
		$happyVideoTagId = 31;
		$hotVideoTagId = 29;
		$civilVideoId = 32;
		$japanVideoId = 33;
		
		$videoLoader = new Op56Video();
		
		$topVideos = $videoLoader->getTopVideo(13);
		
		//取得热门的视频
		$hotVideos = $videoLoader->getLatestVideoByTag($hotVideoTagId,6);
		
		//游戏达人
		$gameVideos = $videoLoader->getLatestVideoByTag($gameVideoTagId, 6);
		
		//搞笑视频
		$happyVideos = $videoLoader->getLatestVideoByTag($happyVideoTagId, 6);
		
		//取得国产精品视频
		$civilVideos = $videoLoader->getLatestVideoByTag($civilVideoId, 6);
		
		//取得日本精品视频
		$japanVideos = $videoLoader->getLatestVideoByTag($japanVideoId, 6);
		
		$statistical = new Statistical();
		$newgame =  $statistical->getAllGlobalTop(15);
		
		//取得殴美视频
		
		//$hotVideos = $gameVideos;
		$this->render("index",array(
			"hotvideos" => $hotVideos,
			"gamevideos" => $gameVideos,
			"happyvideos" => $happyVideos,
			"topvideoname" => $topVideos,
			"civilvideos" => $civilVideos,
			"japanvideos" => $japanVideos,
			"newgame" => $newgame,
			));
	}
	
	public function getPage(){
		if(array_key_exists("page", $_GET)){
			return intval($_GET['page']) - 1;
		}
		return 0;
	}
	
	public function actionPlay(){
		if(array_key_exists("videoid", $_GET) == false){
			gotoerrorpage();
			exit;
		}
		
		$videoid = $_GET['videoid'];
		
		$videoTagLoader = new VideoTag();
		$vTags = $videoTagLoader->getVTagsByVideoId($videoid);
		$vTagIds = array();
		if($vTags != null && count($vTags) > 0){
			$index = 0;
			foreach($vTags as $vTag){
				$vTagIds[$index] = $vTag['id'];
				$index++;
			}
		}
		
		$videoLoader = new Op56Video();
		$topVideo = $videoLoader->getTopVideo(5);
		$video = $videoLoader->getVideoInfo($videoid);
		
		$pageinfo = $videoLoader->getRelativeVideoPage($vTagIds);
		$relativeVideos = $videoLoader->getRelativeVideo($vTagIds,$this->getPage());
		
		//找相关游戏
		$relativeGames = $videoLoader->getVideoRelatedGame($videoid);
		
		$this->render("play",array(
			"video" => $video,
			"topvideo" => $topVideo,
			"relativevideos" => $relativeVideos,
			"relativesubjects" => $relativeGames,
			"pageinfo" => $pageinfo,
				));
	}
	
	public function actionShowAll(){
		$currentvideoid = 30; 
		if(array_key_exists("videotagid", $_GET)){
			$currentvideoid = intval($_GET["videotagid"]);
		}
		
		$gameVideoTagId = 30;
		$happyVideoTagId = 31;
		$hotVideoTagId = 29;
		$civilVideoId = 32;
		$japanVideoId = 33;
		$videoTags = array(
			array("id" => $hotVideoTagId, "name" => "热门视频"),
			array("id" => $gameVideoTagId, "name" => "游戏视频"),
			array("id" => $happyVideoTagId, "name" => "搞笑视频"),
			array("id" => $civilVideoId, "name" => "国产经典动漫"),
			array("id" => $japanVideoId, "name" => "日产经典动漫"),
		);
		
		$videoLoader = new Op56Video();
		$pageinfo = $videoLoader->getVideoPageInfoByVTag($currentvideoid);
		$pagedata = $videoLoader->getVideoPageDataByVTag($currentvideoid,$this->getPage());
		$this->render("allvideo",array(
			"videotags" => $videoTags,
			"currentvideoid" => $currentvideoid,
			"pageinfo" => $pageinfo,
			"pagedata" => $pagedata,
				));
	}
}