<?php

/**
 * 这个表只是供CMS管理缓存用
 * @author shishengyi
 *
 */

class Cache extends CActiveRecord
{
	public $countPerPage = 100;
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'cache';
	}
	
	public function clearDBStatus(){
	}
	
	public function getCachePageInfo($isCache,$urlText){
		$sql = "select count(*) as totalcount from cache where 1=1";
		if($isCache >= 0){
			$sql = $sql . " and iscached = " . $isCache;	
		} 
		
		if(strlen($urlText) > 0){
			$sql = $sql . " and cacheurl LIKE \"%" . addslashes($urlText) . "%\"";
		}
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
		
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getCachePage($isCache,$urlText,$order,$pageno){
		$sql = "select * from cache where 1=1";
		if($isCache >= 0){
			$sql = $sql . " and iscached = " . $isCache;	
		} 
		
		if(strlen($urlText) > 0){
			$sql = $sql . " and cacheurl LIKE \"%" . addslashes($urlText) . "%\"";
		}
		
		if($order == 0){
			$sql = $sql . " order by create_time ";
		}
		
		$sql = $sql . " limit " . ($pageno * $this->countPerPage) . "," . $this->countPerPage;
		//echo $sql;
		$result = $this->querySql($sql);
		
		
		return $result; 
	}
	
	public function getAllCache(){
		$sql = "select * from cache where iscached = 1";
		$result = $this->querySql($sql);
		return $result; 
	}
	
	public function getAllUnCachedId(){
		$sql = "select id from cache where iscached = 0";
		$result = $this->querySql($sql);
		return $result; 
	}
	
	public function getAllCacheOnlyName(){
		$sql = "select cacheurl from cache where iscached = 1";
		$result = $this->querySql($sql);
		return $result; 
	}
	
	public function setCacheStatus($cacheUrl, $cacheStatus){
		$sql = "update cache set iscached = " . $cacheStatus;
		if($cacheStatus == 1){
			$sql = $sql .  ", cache_time=now() "; 
		}
		$sql = $sql . " where cacheurl = '" . addslashes($cacheUrl). "'";
		$this->runSql($sql);
	}
	
	public function setCacheStatusById($cacheId, $cacheStatus){
		$sql = "update cache set iscached = " . $cacheStatus;
		if($cacheStatus == 1){
			$sql = $sql .  ", cache_time=now() "; 
		}
		$sql = $sql .  " where id = " . $cacheId;
		
		$this->runSql($sql);
	}
	
	public function setAllCacheStatus($cacheStatus){
		$sql = "update cache set iscached = " . $cacheStatus;
		$this->runSql($sql);
	}
	
	public function getCaches($ids){
		$sql = "select * from cache where ";
		$sqlCondition = "";
		foreach($ids as $id){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " id = " . $id;
			}else{
				$sqlCondition = $sqlCondition . " or id = " . $id;	
			}
		}
		return $this->querySql($sql . $sqlCondition);
	}
	
	public function isCacheUrlExist($url){
		$sql = "select count(*) as totalcount from cache where cacheurl = '" . addslashes($url) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]['totalcount'] > 0;
		}
		return false;
	}
	
	public function addCacheUrl($urls){
		foreach($urls as $url){
			if($this->isCacheUrlExist($url) == false){
				$sql = "insert into cache(cacheurl,create_time) values('" . addslashes($url) . "',now())";
				$this->runSql($sql);
			}
		}
	}
	
	public function clearCacheUrls(){
		$sql = "TRUNCATE TABLE cache";
		$this->runSql($sql);
	}
}