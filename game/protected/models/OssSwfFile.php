<?php

class OssSwfFile extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'alioss_game';
	}
	
	public function isFileExist($md5)
	{
		$sql = "select id from alioss_game where swfmd5 = '" . addslashes($md5) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return true;
		}
		return false;
	}
}