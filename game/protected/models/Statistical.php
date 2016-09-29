<?php

class Statistical extends CActiveRecord
{
	private $countPerPage = 336;
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'game';
	}
	
	/**
	 * 取最近一个月总分排名的前70
	 */
	public function getGlobalTop($topCount = 70){
		$sql = "select * from game where DATE_SUB(CURDATE(),  INTERVAL 4 MONTH) <= date(update_time) and status = 1 order by playcount desc limit 0 ," . $topCount;
		return $this->querySql($sql);
	}
	
	/*
	 * 取最近一个月总分排名的前20
	 * */
	public function getOneMonthGlobalTop($topCount = 20){
		$sql = "select * from game where DATE_SUB(CURDATE(),  INTERVAL 100 MONTH) <= date(update_time) and status = 1 order by playcount desc limit 0 ," . $topCount;
		return $this->querySql($sql);
	}
	
	/**
	 * 取一个月前，总分排名前$topCount的
	 */
	public function getAllGlobalTop($topCount){
		$sql = "select * from game where DATE_SUB(CURDATE(),  INTERVAL 10 MONTH) <= date(update_time) and status = 1 order by playcount desc limit 0 ," . $topCount;
		return $this->querySql($sql);
	}
	
	/**
	 * 取最新的若干游戏
	 */
	public function getNewTop($topCount){
		//$sql = "select * from game where DATE_SUB(CURDATE(),  INTERVAL 4 MONTH) <= date(update_time) and status = 1 order by update_time desc limit 0 ," . $topCount;
		$sql = "select * from game where status = 1 order by update_time desc limit 0 ," . $topCount;
		return $this->querySql($sql);
	}
	
	/**
	 * 分页取最新的若干游戏
	 */
	public function getNewTopByPage($pageno, $pagepercount){
		$sql = "select * from game where status = 1 order by update_time desc limit " . ($pageno * $pagepercount) . "," . $pagepercount;
		return $this->querySql($sql);
	}
	
	public function getAllWeekTop($topCount = 17){
		//$sql = "select game.*,category.name as categoryname,category.id as catalogid from game inner join category on game.category = category.id where DATE_SUB(CURDATE(),  INTERVAL 1 MONTH) <= date(update_time) and status = 1 order by playcount desc limit 0 ," . $topCount;
		//echo $sql;
		$sql = "select id,name,gicon,category from game where DATE_SUB(CURDATE(),  INTERVAL 10 MONTH) <= date(update_time) and status = 1 order by playcount desc limit 0 ," . $topCount;
		return $this->querySql($sql);
	}
	
	public function getCatalogTopGame($catalogId,$topCount)
	{
		$sql = "select * from game where category = " . $catalogId . " and status = 1 order by playcount desc limit 0," . $topCount;
		return $this->querySql($sql);
	}
	
	public function getSubjectTopGame($subjectId,$topCount)
	{
		$sql = "select * from game inner join game_subject_relation on game.id = game_subject_relation.game_id where game_subject_relation.subject_id =" . intval($subjectId) . " order by playcount desc limit 0," . $topCount;
		return $this->querySql($sql);
	}
	
	public function getSubjectTopGameEx($subjectId,$topCount)
	{
		$sql = "select * from game_subject where subject_id =" . intval($subjectId) . " order by hotindex desc limit 0," . $topCount;
		return $this->querySql($sql);
	}
	
	//给Game的category提供查询服务
	public function getCatalogGamePage($categoryId, $order, $pageNo)
	{
		$sql = "select * from game where category = " . $categoryId . " and status = 1 ";
		if($order == 0){
			$sql = $sql . " order by update_time desc ";
		}else if($order == 1){
			$sql = $sql . " order by playcount desc";
		}
		
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		
		return $this->querySql($sql);
	}
	
	//给Game的category提供查询服务
	public function getCatalogGamePageInfo($categoryId)
	{
		$sql = "select count(*) as totalcount from game where category = " . $categoryId . " and status = 1 ";
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
		
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	//给Game的category提供查询服务
	public function getSubjectGamePage($subjectId, $order, $pageNo)
	{
		$sql = "select * from game_subject where subject_id = " . intval($subjectId);
		if($order == 0){
			$sql = $sql . " order by update_time";
		}else if($order == 1){
			$sql = $sql . " order by hotindex";
		}
		
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		
		return $this->querySql($sql);
	}
	
	//给Game的category提供查询服务
	public function getSubjectGamePageInfo($subjectId)
	{
		$sql = "select count(*) as totalcount from game_subject where subject_id = " . intval($subjectId);
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
		
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getTodayNewGameCount(){
		$sql = "select count(*) as newcount from game where DATE_SUB(CURDATE(),  INTERVAL 2 DAY) <= date(create_time) and status = 1";
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1 ){
			return  $result[0]['newcount'];
		}
		return 0;
	}
}