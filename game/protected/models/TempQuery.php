<?php

class TempQuery extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'game';
	}
	
	public function getFlashUrls($page)
	{
		$sql = "select id,realgameurl as flashurl from game limit " . ($page * 500) . "," . (($page + 1) * 500);	
		return $this->querySql($sql);
	}
}