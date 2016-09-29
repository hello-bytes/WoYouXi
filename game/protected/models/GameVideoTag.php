<?php

require_once "SQLProtect.php";
class GameVideoTag extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'game_vtag_relation';
	}
	
	public function getVideoTagByGameId($gameId){
		$sql = "select videotag.* from game_vtag_relation left join videotag on game_vtag_relation.vtag_id = videotag.id  where game_vtag_relation.game_id = " . intval($gameId);
		return $this->querySql($sql);
	}
	
	public function getVideoByGameId($gameId){
		$sql = "select * from game_vtag_relation where game_id = " . intval($gameId);
		$videoTags = $this->querySql($sql);
		if($videoTags!= null && count($videoTags) > 0){
			$sqlCondition = "";
			foreach($videoTags as $videoTag){
				if(strlen($sqlCondition) == 0){
					$sqlCondition = $videoTag['vtag_id'];
				}else{
					$sqlCondition = $sqlCondition . "," . $videoTag['vtag_id'];
				}
			}
			if(strlen($sqlCondition) > 0){
				$sql = "select op_56_video.* from video_vtag_relation left join op_56_video on video_vtag_relation.video_id = op_56_video.id where op_56_video.status = 1 and video_vtag_relation.vtag_id in (" . $sqlCondition . ")";
				return $this->querySql($sql);
			}
		} 
		return null;
	}
}