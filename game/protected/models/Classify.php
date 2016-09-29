<?php

class Classify extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'classifys';
	}
	
	public function getAllClassify()
	{
		$result = $this->querySql("select id, name from " .  $this->tableName() . ";");
		return $result;
	}
}