<?php

require_once "SQLProtect.php";
class AdminLog extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'admin_log';
	}
	
	public function addLog($userid,$accessurl)
	{
		$sql = "insert into admin_log(userid,access_time,access_url) values(";
		$sql = $sql . intval($userid) . ",now(),'" . my_addslash($accessurl) . "')";
		//echo  $sql;
		$this->runSql($sql);
	}
}