<?php

class Platform extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'platforms';
	}
	
	public function getAllPlatFrom()
	{
		$result = $this->querySql("select id, name from " .  $this->tableName() . ";");
		return $result;
	}
}