<?php

class Category extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'category';
	}
	
	public function getAllCategory()
	{
		$result = $this->querySql("select id, name, descript from " .  $this->tableName() . ";");
		return $result;
	}
	
	public function getCategoryInfo($categoryId)
	{
		$result = $this->querySql("select id, name, descript from " .  $this->tableName() . " where id = " . $categoryId);
		if($result != null){
			return $result[0];
		}
		return null;
	}
	
	public function getAllCatalogCount(){
		$result = $this->querySql("select count(id) as allcategorycount from category");
		if($result != null){
			return $result[0]['allcategorycount'];
		}
		return 0;
	}
	
	public function getGameCount($categoryId,$status = -1)
	{
		$sql = "select count(id) as allgamecount from game inner join category_game_relation on game.id = category_game_relation.game_id  where category_game_relation.category_id = " . $categoryId;
		if($status >= 0){
			$sql = $sql . " and status = " . $status;
		}
		$result = $this->querySql($sql);
		if($result != null){
			return $result[0]['allgamecount'];
		}
		return 0;
	}
	
	public function getGameCountBySubject($subjectId)
	{
		$result = $this->querySql("select count(id) as allgamecount from game_subject_relation  where subject_id = " . $subjectId);
		if($result != null){
			return $result[0]['allgamecount'];
		}
		return 0;
	}
	
	public function deleteCatalogs($catalogIds){
		$sql = "delete from category where ";
		 
		$sqlCondition = "";
		foreach ($catalogIds as $catalogId){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " id = " . $catalogId;
			}else{
				$sqlCondition = $sqlCondition . " or id = " . $catalogId;
			}
		}
		$this->runSql($sql . $sqlCondition);
	}
	
	public function addCatalog($name,$descript)
	{
		$sql = "insert into category(name,descript) values('";
		$sql = $sql . addslashes($name) . "','" . addslashes($descript) . "')";
		$this->runSql($sql . $sqlCondition);
	}
	
	public function updateCatalog($id, $name, $descript)
	{
		$sql = "update category set name = '" . addslashes($name) . "' , descript = '" . addslashes($descript) . "' where id = " . $id;
		echo $sql;
		$this->runSql($sql);
	}
}