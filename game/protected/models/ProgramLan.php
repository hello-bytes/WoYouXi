<?php

class ProgramLan extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'programlans';
	}
	
	public function getAllProgramLan()
	{
		$result = $this->querySql("select id, name from " .  $this->tableName() . ";");
		return $result;
	}
}