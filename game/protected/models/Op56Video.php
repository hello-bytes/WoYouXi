<?php

require_once "SQLProtect.php";
class Op56Video extends CActiveRecord
{
	private $countPerPage = 100;
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'op_56_video';
	}
	
	public function getVideoInfo($videoid){
		$sql = "select * from op_56_video where id = " . intval($videoid); 
		$result = $this->querySql($sql);		
		if(count($result) > 0 ){
			return $result[0]; 
		}
		return null;
	}
	
	public function getVideoTag($videoId){
		//$sql = "select * from op_56_video where id = " . intval($videoid);
	}
	
	public function addVideoCount($videoid){
		$sql = "update op_56_video set playcount = playcount + 1 where id =" . intval($videoid);
		$this->runSql($sql);
	}
	
	public function addVideo($vid,$title,$desc,$totaltime,$img,$mimg,$bimg,$opvideourl,$wyxvideourl){
		$sql = "insert into op_56_video(vid,title,totaltime,descript,img_url,img_url_m,img_url_b,video_url_ori,video_url_wyx,create_time,update_time) " . 
				" values('" . my_addslash($vid) . "','" . my_addslash($title) . "','" . intval($totaltime) . "','" . my_addslash($desc) . "','" . 
				my_addslash($img) . "','" . my_addslash($mimg) . "','" . my_addslash($bimg) . "','" . 
				my_addslash($opvideourl) . "','" . my_addslash($wyxvideourl) . "',now(),now())";
		$this->runSql($sql);
	}
	
	public function updateVideo($id,$vid,$title,$desc,$totaltime,$img,$mimg,$bimg,$opvideourl,$wyxvideourl){
		$sql = "update op_56_video set vid = '" . my_addslash($vid) . "',title='" . my_addslash($title) . "',totaltime=" . 
				intval($totaltime) . ",descript='" . my_addslash($desc) . "',img_url='" . my_addslash($img) . 
				"',img_url_m='" . my_addslash($mimg) . "',img_url_b='" . my_addslash($mimg) . "',video_url_ori='" . 
				my_addslash($opvideourl) . "' where id = " .  intval($id);
		$this->runSql($sql);
	}
	
	public function getPageData($status,$pageno){
		$sql = "select * from op_56_video where 1 = 1 ";
		if($status > 0){
			$sql = $sql . " and status = " . $status;
		}
		
		$sql = $sql . " limit " . $pageno * $this->countPerPage . "," . $this->countPerPage;
		
		return $this->querySql($sql);
	}
	
	public function getPageDataEx($status,$pageno){
		$sql = "select id from op_56_video where 1 = 1 ";
		if($status > 0){
			$sql = $sql . " and status = " . $status;
		}
		
		$sql = $sql . " limit " . $pageno * $this->countPerPage . "," . $this->countPerPage;
		
		return $this->querySql($sql);
	}
	
	public function getPageInfo($status){
		$totalCount = 0;
		$sql = "select count(*) as totalcount from op_56_video where 1 = 1 ";
		if($status > 0){
			$sql = $sql . " and status = " . $status;
		}
		
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			 $totalCount = $result[0]['totalcount'];
		}
		
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function clearVideoTag($videoId){
		$sql = "delete from video_vtag_relation where video_id = " . intval($videoId);
		$this->runSql($sql);
	}
	
	public function setVideoTag($videoId,$tagId){
		$sql = "insert into video_vtag_relation(video_id,vtag_id) values(" . intval($videoId) . "," . intval($tagId) . ")";
		$this->runSql($sql);
	}
	
	public function getTopVideo($count){
		$sql = "select * from op_56_video order by playcount desc limit 0, " . $count;
		return $this->querySql($sql);
	}
	
	public function getVideoRelatedGame($videoId){
		$sql = "select vtag_id from video_vtag_relation where video_id = " . intval($videoId);
		$result = $this->querySql($sql);
		if($result != null &&  count($result) > 0){
			//根据vtag_id找到游戏的ID
			//$sql = "select vtag_id from game_vtag_relation where vtag_id = " . intval($videoId);
			$sqlCondition = "";
			foreach($result as $resultItem){
				if(strlen($sqlCondition) == 0){
					$sqlCondition = $resultItem['vtag_id']; 
				}else{
					$sqlCondition = $sqlCondition . "," . $resultItem['vtag_id'];
				}
			}
			$sql = "select game.* from game_vtag_relation left join game on game_vtag_relation.game_id = game.id where vtag_id in (" . $sqlCondition . ")";
			return $this->querySql($sql);
		}
		return null;
	}
	
	public function getRelativeVideoPage($vtags){
		$totalCount = 0;
		
		if($vtags == null || count($vtags) == 0) {
			return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / 50) + 1,
				'countperpage' => 50
			);
		}
		
		$sqlCondition = "";
		foreach($vtags as $vtag){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = intval($vtag) . "";
			}else{
				$sqlCondition = $sqlCondition . "," . intval($vtag);
			}
		}
		
		$sql = "select count(*) as totalcount from video_vtag_relation left join op_56_video on video_vtag_relation.video_id = op_56_video.id where op_56_video.status = 1 and vtag_id in (" . $sqlCondition . ")";
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			$totalCount = $result[0]['totalcount'];
		}
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / 50) + 1,
				'countperpage' => 50
		);
	}
	
	public function getRelativeVideo($vtags,$page){
		if($vtags == null || count($vtags) == 0) return null;
		
		$sqlCondition = "";
		foreach($vtags as $vtag){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = intval($vtag) . "";
			}else{
				$sqlCondition = $sqlCondition . "," . intval($vtag);
			}
		}
		
		$sql = "select distinct op_56_video.* from video_vtag_relation left join op_56_video on video_vtag_relation.video_id = op_56_video.id where op_56_video.status = 1 and vtag_id in (" . $sqlCondition . ") order by op_56_video.id asc";
		$sql = $sql . " limit " . ($page * 50) . ", 50";
		return $this->querySql($sql);
		
		
		/*$sql = "select * from video_vtag_relation where vtag_id in (" . $sqlCondition . ")";
		//echo $sql;
		$sqlCondition = "";
		$videoids = $this->querySql($sql);
		if($videoids != null && count($videoids) > 0){
			foreach($videoids as $videoid){
				if(strlen($sqlCondition) == 0){
					$sqlCondition = intval($videoid['video_id']) . "";
				}else{
					$sqlCondition = $sqlCondition . "," . intval($videoid['video_id']);
				}
			} 
			
			if(strlen($sqlCondition) > 0 ){
				$sql = "select * from op_56_video where id in (" . $sqlCondition . ")";
				//echo $sql;
				return $this->querySql($sql);
			}
		}*/
		
		//return null;
	}
	
	public function getTopVideoByTag($tagid, $count){
		$sql = "select op_56_video.* from video_vtag_relation left join op_56_video on video_vtag_relation.video_id = op_56_video.id where op_56_video.status = 1 and vtag_id = " . intval($tagid) . " order by op_56_video.playcount desc limit 0," . $count;
		return $this->querySql($sql);
	}
	
	public function getLatestVideoByTag($tagid, $count){
		$sql = "select op_56_video.* from video_vtag_relation left join op_56_video on video_vtag_relation.video_id = op_56_video.id where op_56_video.status = 1 and vtag_id = " . intval($tagid) . " order by op_56_video.update_time desc limit 0," . $count;
		return $this->querySql($sql);
	}
	
	//给showall page用的，后期 要加排序
	public function getVideoPageInfoByVTag($vtagid){
		$totalcount = 0;
		$sql = "select count(*) as totalcount from video_vtag_relation left join op_56_video on op_56_video.id = video_vtag_relation.video_id where op_56_video.status = 1 and video_vtag_relation.vtag_id = " . intval($vtagid);
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			$totalcount = $result[0]['totalcount'];
		}
		
		return array(
				'totalcount' => (int)$totalcount,
				'pagecount' => (int)($totalcount / 52) + 1,
				'countperpage' => 52
			);
	}
	
	// 给showall page用的，后期 要加排序
	public function getVideoPageDataByVTag($vtagid,$pageno){
		$sql = "select op_56_video.* from video_vtag_relation left join op_56_video on op_56_video.id = video_vtag_relation.video_id where op_56_video.status = 1 and video_vtag_relation.vtag_id = " . intval($vtagid);
		$sql = $sql  . " limit " . ($pageno * 52) . " , 52";
		return $this->querySql($sql);
	}
	
	//public function getRelativeGame(){
		
	//}
}