<?php

class GameMeta extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'game_meta';
	}
	
	public function lastInsertId()
	{
		$result = $this->querySql("select LAST_INSERT_ID()");
		$records = array_values($result[0]);
		return $records[0];
	}
	
	public function addGameMeta($gameid,$url,$sourceurl,$width,$height,$params,$gsize,$playver){
		$sql = "insert into game_meta(gameid,width,height,gsize,param,sourceurl, swfurl,playerver) values(" . $gameid . "," .
				$width . "," . $height . "," . $gsize . ",'" . addslashes($params) . "','" . addslashes($sourceurl) . "','" .  
				addslashes($url) .  "','" . addslashes($playver) . "')";
		$this->runSql($sql);
		
		return $this->lastInsertId();
	}
	
	public function getGameMeta($gameid){
		$sql = "select * from game_meta where gameid = " . intval($gameid);
		$games = $this->querySql($sql);
		if($games != null && count($games) > 0){
			return $games[0];
		}
		return null;
	}
	
	public function isGameDataExist($gameId){
		$sql = "select count(*) as metacount from game_meta where gameid = " . intval($gameId);
		$gameMetaCount = $this->querySql($sql);
		if($gameMetaCount != null && count($gameMetaCount) > 0){
			return $gameMetaCount[0]['metacount'] > 0;
		}
		return false;
	}
	
	
}