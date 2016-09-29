<?php

require_once "SQLProtect.php";
class Game extends CActiveRecord
{
	public $countPerPage = 100;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function lastInsertId()
	{
		$result = $this->querySql("select LAST_INSERT_ID()");
		$records = array_values($result[0]);
		return $records[0];
	}
	
	public function tableName()
	{
		return 'game';
	}
	
	public function getTopWeekGame(){
		
	}
	
	public function getAllGameCount(){
		$result = $this->querySql("select count(id) as allgamecount from game");
		if($result != null){
			return $result[0]['allgamecount'];
		}
		return 0;
	}
	
	public function getMaxGameId(){
		$result = $this->querySql("select max(id) as maxgameid from game");
		if($result != null){
			return $result[0]['maxgameid'];
		}
		return 0;
	}
	
	public function setGameStatusById($startid,$endid,$status){
		$sql = "update game set status = " .  intval($status) . " where id >= " . intval($startid) . " and id <= " . intval($endid);
		$this->runSql($sql);
	}
	
	public function addGame($name,$ename,$categoryid,$gsize,$gicon,$guide,$hottostart,$objective,
					$introduce,$previewImageUrl,$previewImageWidth,$previewImageHeight,$sourceurl,$realgameurl){
		$sql = "insert into game(name,ename,category,gsize,gicon,guide,hottostart,objective,create_time,update_time,introduce,previewimageurl,previewimagewidth,previewimageheight,sourceurl,realgameurl) values(";
		$sqlInsertVal = "'" . addslashes($name) . "','" . addslashes($ename) . "'," . $categoryid . "," . $gsize . 
						",'" . addslashes($gicon) . "','" . addslashes($guide) . "','" . addslashes($hottostart) . "','" . 
						addslashes($objective) . "',now(),now(),'" .
						addslashes($introduce) . "','" . addslashes($previewImageUrl) . "','" . 
						$previewImageWidth . "','" . $previewImageHeight . "','" . addslashes($sourceurl) . "','" . addslashes($realgameurl) . "')";
		
		$result = $this->runSql($sql . $sqlInsertVal);
		return $this->lastInsertId();
	}
	
	public function updateGame($gameId, $name,$ename,$categoryid,$gsize,$gicon,$guide,$hottostart,$objective,
			$introduce,$previewImageUrl,$previewImageWidth,$previewImageHeight){
		$sql = "update game set  name='" . addslashes($name) . "',category=" . $categoryid . ",gsize='". $gsize . 
				"',gicon='" . addslashes($gicon) . "',guide='". addslashes($guide) ."',hottostart='". addslashes($hottostart) ."',objective='" . 
				addslashes($objective) . "',introduce='" . addslashes($introduce) . "',previewimageurl='". addslashes($previewImageUrl) ."',previewimagewidth=" . 
				$previewImageWidth . ",previewimageheight=" . $previewImageHeight . " where id = " . $gameId;
	
		$result = $this->runSql($sql);
		return $result;
	}
	
	public function getGamePageInfoByCategory($categoryId, $status){
		$sql = "select count(*) as totalcount from game inner join category_game_relation on game.id = category_game_relation.game_id where category_game_relation.category_id = " . $categoryId;
		//$sql = "select count(*) as totalcount from game where category = " . $categoryId;
		if($status >= 0){
			$sql = $sql . " and status = " . intval($status);
		}
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
		
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getGamePageByCatetory($categoryId, $status, $order, $pageNo){
		$sql = "select * from game inner join category_game_relation on game.id = category_game_relation.game_id where category_game_relation.category_id = " . intval($categoryId);
		if($status >= 0){
			$sql = $sql . " and status = " . intval($status);
		}
		
		if($order == 0){
			$sql = $sql . " order by update_time";
		}else if($order == 1){
			$sql = $sql . " order by hotindex";
		}
		
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		//echo $sql;
		return $this->querySql($sql);
	}
	
	public function getGamePageInfoBySubject($subjectId, $status){
		$sql = "select count(*) as totalcount from game inner join game_subject_relation on game.id = game_subject_relation.game_id where subject_id =  " . $subjectId;
		if($status >= 0){
			$sql = $sql . " and status = " . $status;
		}
	
		//echo $sql;
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
	
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getGamePageBySubject($subjectId, $status, $order, $pageNo){
		$sql = "select * from game inner join game_subject_relation on game.id = game_subject_relation.game_id where subject_id =  " . $subjectId;
		if($status >= 0){
			$sql = $sql . " and status = " . $status;
		}
	
		if($order == 0){
			//$sql = $sql . " order by update_time";
		}else if($order == 1){
			//$sql = $sql . " order by hotindex";
		}
	
		$sql = $sql . " limit " . ($pageno * $this->countPerPage) . "," . $this->countPerPage;
		return $this->querySql($sql);
	}
	
	public function getAllGamePageInfo($status){
		$sql = "select count(*) as totalcount from game ";
		if($status >= 0){
			$sql = $sql . " where status = " . $status;
		}
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
	
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getAllGamePage( $status, $pageNo){
		$sql = "select game.id as gameid from game";
		if($status >= 0){
			$sql = $sql . " where status = " . $status;
		}
		
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		return $this->querySql($sql);
	}
	
	public function getGamePageInfo($catalogId, $subjectId, $status,$text){
		$sql = "select count(*) as totalcount from game inner join game_subject_relation on game.id = game_subject_relation.game_id where 1 = 1 ";
		if($status >= 0){
			$sql = $sql . " and status = " . $status;
		}
		
		if($catalogId > 0){
			$sql = $sql . " and category = " . $catalogId;
		}
		
		if($subjectId > 0){
			$sql = $sql . " and game_subject_relation.subject_id = " . $subjectId;
		}
		
		if(strlen($text) > 0){
			$sql = $sql . " and name LIKE '%" . addslashes($text)  . "%'";
		}
	
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
	
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getGamePage($catalogId, $subjectId, $status,$text, $order, $pageNo){
		$sql = "select *,game.id as gameid from game inner join game_subject_relation on game.id = game_subject_relation.game_id where 1=1 ";
		if($status >= 0){
			$sql = $sql . " and status = " . $status;
		}
		
		if($catalogId > 0){
			$sql = $sql . " and category = " . $catalogId;
		}
		
		if($subjectId > 0){
			$sql = $sql . " and game_subject_relation.subject_id = " . $subjectId;
		}
		
		if(strlen($text) > 0){
			$sql = $sql . " and name LIKE '%" . addslashes($text)  . "%'";
		}
	
		if($order == 0){
			$sql = $sql . " order by update_time";
		}else if($order == 1){
			$sql = $sql . " order by hotindex";
		}else if($order == 2){
			$sql = $sql . " order by playcount desc";
		}
	
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		return $this->querySql($sql);
	}
	
	public function getGamePageEx($catalogId, $subjectId, $status,$text, $order, $pageNo){
		$sql = "select game.id as gameid from game inner join game_subject_relation on game.id = game_subject_relation.game_id where 1=1 ";
		if($status >= 0){
			$sql = $sql . " and status = " . $status;
		}
		
		if($catalogId > 0){
			$sql = $sql . " and category = " . $catalogId;
		}
		
		if($subjectId > 0){
			$sql = $sql . " and game_subject_relation.subject_id = " . $subjectId;
		}
		
		if(strlen($text) > 0){
			$sql = $sql . " and name LIKE '%" . addslashes($text)  . "%'";
		}
	
		if($order == 0){
			$sql = $sql . " order by update_time";
		}else if($order == 1){
			$sql = $sql . " order by hotindex";
		}else if($order == 2){
			$sql = $sql . " order by playcount desc";
		}
	
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		return $this->querySql($sql);
	}
	
	public function getGamePageByText($text,$pageNo){
		$pageNo = intval($pageNo);
		if(strlen($text) == 0) return null;
		
		$text = my_addslash($text);
		$sql = "select *,game.id as gameid from game where  status = 1 ";
		$sql = $sql . " and name LIKE '%" . $text  . "%'";
		$sql = $sql . " order by playcount desc";
	
		$sql = $sql . " limit " . ($pageNo * $this->countPerPage) . "," . $this->countPerPage;
		
		return $this->querySql($sql);
	}
	
	public function getGamePageInfoByText($text){
		if(strlen($text) == 0) return null;
		
		$text = my_addslash($text);
		
		$sql = "select count(*) as totalcount from game where  status = 1 ";
		$sql = $sql . " and name LIKE '%" . $text  . "%'";
		
		$result = $this->querySql($sql);
		$totalCount = $result[0]['totalcount'];
	
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function getGameInfo($gameId)
	{
		$gameId = intval($gameId);
		$sql = "select * from game where id = " .  $gameId;
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return $result[0];
		}
		return null;
	}
	
	public function deleteGame($gameIds){
		$sql = "delete from game where ";
			
		$sqlCondition = "";
		foreach ($gameIds as $gameId){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " id = " . intval($gameId);
			}else{
				$sqlCondition = $sqlCondition . " or id = " . intval($gameId);
			}
		}
		$this->runSql($sql . $sqlCondition);
	}
	
	public function deleteGameWithStatics($gameIds){
		$sql = "delete from game where ";
			
		$sqlCondition = "";
		foreach ($gameIds as $gameId){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " id = " . intval($gameId);
			}else{
				$sqlCondition = $sqlCondition . " or id = " . intval($gameId);
			}
		}
		$this->runSql($sql . $sqlCondition);
		
		try {
			$sql = "delete from game_category where ";
			$this->runSql($sql . $sqlCondition);
			
			$sql = "delete from game_subject where ";
			$this->runSql($sql . $sqlCondition);
		}catch (Exception $ex){
			
		}
	}
	
	public function setAllGameStatus($status){
		$sql = "update game set status = " . intval($status);
		//echo $sql;
		$this->runSql($sql);
	}
	
	public function setGameStatus($gameIds,$status){
		$sql = "update game set status = " . $status . " where ";
			
		$sqlCondition = "";
		foreach ($gameIds as $gameId){
			if(strlen($sqlCondition) == 0){
				$sqlCondition = " id = " . intval($gameId);
			}else{
				$sqlCondition = $sqlCondition . " or id = " . intval($gameId);
			}
		}
		$this->runSql($sql . $sqlCondition);
	}
	
	public function addPlayCount($gameId){
		$sql = "update game set playcount = playcount + 1 where id = " . intval($gameId);
		$this->runSql($sql);
	}
	
	public function getRelativeGame($subjectId){
		$sql = "select * from game_subject where subject_id = " . intval($subjectId) . " order by hotindex desc";
		$result = $this->querySql($sql);
		return $result; 
	}
	
	public function getGameSubject($gameId){
		$sql = "select subject_id from game_subject where id = " . intval($gameId);
		$result = $this->querySql($sql);
		if($result != null){
			//查询subject信息
			$sqlCondition = "";
			foreach($result as $subjectId){
				if(strlen($sqlCondition) > 0){
					$sqlCondition = $sqlCondition . " or id=" . intval($subjectId['subject_id']);
				}else{
					$sqlCondition = " id = " . intval($subjectId['subject_id']);
				}
			}
			if(strlen($sqlCondition) > 0){
				return $this->querySql("select * from subject where " . $sqlCondition);
			}
		}
		return null;
	}
	
}