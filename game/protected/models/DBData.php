<?php

/*
 * ID说明：
 * catalogid * 10 + 1,为周数据，前50
 * catalogid * 10 + 2,为月数据，前50
 * catalogid * 10 + 3,为所有数据，前50
 * catalogid * 10 + 4,为今日数据，前50
 * 1000 : 顶部，导航栏下方，10个ICON数据
 * 1012 : 笑的搞笑图，广告
 * */

require_once "SQLProtect.php";
class DBData extends CActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'pdata';
	}
	
	public function isDataExist($dataid){
		$sql = "select * from pdata where data_id = " . intval($dataid);
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return true;
		}
		return false;
	}
	
	public function insertData($dataid, $data){
		$data = my_addslash($data);
		$dataid = intval($dataid);
		$sql = "insert into pdata(data_id,data_content) values(";
		$sql = $sql . $dataid . ",'" . $data . "')";
		
		$this->runSql($sql);
	}
	
	public function updateData($dataid, $data){
		$data = my_addslash($data);
		$dataid = intval($dataid);
		$sql = "update pdata set data_content = '";
		$sql = $sql . $data . "' where data_id=" . intval($dataid);
		
		$this->runSql($sql);
	}
	
	public function setData($dataid, $data){
		if($this->isDataExist($dataid)){
			$this->updateData($dataid, $data);
		}else{
			$this->insertData($dataid, $data);
		}
	}
	
	public function getData($dataid){
		//$contact = my_addslash($dataid);
		//$desc = my_addslash($desc);
		$sql = "select data_content from pdata where data_id = " . intval($dataid);
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return $result[0]['data_content'];
		}
		return null;
	}
	
	public function getDataAndUnseri($dataid){
		$sql = "select data_content from pdata where data_id = " . intval($dataid);
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return unserialize($result[0]['data_content']);
		}
		return null;
	}
	
	public function getUnseriDatas($dataids){
		$sql = "select data_id,data_content from pdata where ";//data_id = " . intval($dataid);
		$sqlCondition = "";
		foreach($dataids as $dataid){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = "data_id = " . intval($dataid);
			}else{
				$sqlCondition = $sqlCondition .  " or data_id = " . intval($dataid);
			}
		}
		
		$result = null;
		if(strlen($sqlCondition) > 0){
			$result = $this->querySql($sql . $sqlCondition);
			if($result != null && count($result) > 0){
				for($i = 0;$i < count($result);$i++){
					$result[$i]["data_content"] = unserialize($result[$i]['data_content']);
				}
			}
		}
		
		return $result;
	}
}