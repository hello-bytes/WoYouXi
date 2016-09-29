<?php

require_once "SQLProtect.php";
class Feedback extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'feedback';
	}
	
	
	public function addFeedback($contact, $desc){
		$contact = my_addslash($contact);
		$desc = my_addslash($desc);
		$sql = "insert into feedback(descript,contact,create_time) values('";
		$sql = $sql . $desc . "','" . $contact . "',now())";
		
		$sql = str_replace("delete","|delete|",$sql);
		$sql = str_replace("select","|select|",$sql);
		$sql = str_replace("drop","|drop|",$sql);
		$sql = str_replace("truncate","|truncate|",$sql);
		
		$this->runSql($sql);
	}
}