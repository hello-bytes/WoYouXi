<?php

class Subject extends CActiveRecord
{
	private $countPerPage = 30;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'subject';
	}
	
	public function getAllSubjectCount(){
		$result = $this->querySql("select count(id) as allsubjectcount from subject ");
		if($result != null){
			return $result[0]['allsubjectcount'];
		}
		return 0;
	}
	
// 	public function addSubject($name,$descript)
// 	{
// 		$sql = "insert into subject(name,descript) values('";
// 		$sql = $sql . addslashes($name) . "','" . addslashes($descript) . "')";
// 		$this->runSql($sql . $sqlCondition);
// 	}
	
	public function updateSubject($id, $name, $descript)
	{
		$sql = "update subject set name = '" . addslashes($name) . "' , descript = '" . addslashes($descript) . "' where id = " . $id;
		//echo $sql;
		$this->runSql($sql);
	}
	
	public function getSubjectInfo($subjectId)
	{
		$sql = "select * from subject where id = " . intval($subjectId);
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return $result[0];
		}
		return null;
	}
	
	public function getSubjectByCategory($categoryId)
	{
		$sql = "select subject.id,subject.name,subject.descript from subject inner join category_subject_relation on subject.id = category_subject_relation.subject_id where category_subject_relation.category_id = " . $categoryId;
		$result = $this->querySql($sql);
		return $result;
	}
	
	public function addSubject($categoryId, $name, $descript)
	{
		if($categoryId > 0)
		{
			$sql = "insert into subject(name, descript) values(";
			$sqlValue = "'" . addslashes($name) . "','" . addslashes($descript) . "'";
			
			$sql = $sql . $sqlValue . ")";
			$result = $this->runSql($sql);
			
			//echo $sql;
			$result = $this->querySql("select LAST_INSERT_ID()");
			$records = array_values($result[0]);
			$subjectId = $records[0];
			//$subjectId = $this->lastInsertId();
			if($subjectId > 0)
			{
				$sql = "insert into category_subject_relation(subject_id, category_id) values(";
				$sqlValue = $subjectId . "," . $categoryId;
					
				$sql = $sql . $sqlValue . ")";
				$result = $this->runSql($sql);
				//echo $sql;
				
				return $subjectId;
			}
			
			return 0;
		}
	}
	
	public function setSubjectRelation($gameId,$subjectIds){
		foreach( $subjectIds as $subjectId ){
			$sql = "insert into game_subject_relation(game_id,subject_id) values(" . $gameId . "," . $subjectId . ")";
			$result = $this->runSql($sql);
		}
	}
	
	public function deleteSubject($subjectIds){
		$sql = "delete from subject where ";
			
		$sqlCondition = "";
		foreach ($subjectIds as $subjectId){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " id = " . $subjectId;
			}else{
				$sqlCondition = $sqlCondition . " or id = " . $subjectId;
			}
		}
		$this->runSql($sql . $sqlCondition);
		
		//清聊关系表中的关系
		$sql = "delete from game_subject_relation where ";
		$sqlCondition = "";
		foreach ($subjectIds as $subjectId){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " subject_id = " . $subjectId;
			}else{
				$sqlCondition = $sqlCondition . " or subject_id = " . $subjectId;
			}
		}
		$this->runSql($sql . $sqlCondition);
	}
	
}