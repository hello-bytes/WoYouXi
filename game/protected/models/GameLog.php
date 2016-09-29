<?php

require_once "SQLProtect.php";
class GameLog extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'game_log';
	}
	
	public function addLog($gameid, $accesstype){
		$gameid = intval($gameid);
		$accesstype = intval($accesstype);
		$sql = "insert into game_log(gameid,access_type,access_time) values(";
		$sql = $sql . $gameid . "," . $accesstype . ",now())";
		$this->runSql($sql);
	}
}