<?php

require_once "SQLProtect.php";
class VideoTag extends CActiveRecord
{
	private $countPerPage = 100;
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'videotag';
	}
	
	public function getPageData($pageno){
		$sql = "select * from videotag where 1 = 1 ";
		//if($status > 0){
			//$sql = $sql . " and status = " . $status;
		//}
		
		$sql = $sql . " limit " . (intval($pageno) * $this->countPerPage) . "," . $this->countPerPage;
		
		return $this->querySql($sql);
	}
	
	public function getPageInfo(){
		$totalCount = 0;
		$sql = "select count(*) as totalcount from videotag where 1 = 1 ";
		//if($status > 0){
			//$sql = $sql . " and status = " . $status;
		//}
		
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			 $totalCount = $result[0]['totalcount'];
		}
		
		return array(
				'totalcount' => (int)$totalCount,
				'pagecount' => (int)($totalCount / $this->countPerPage) + 1,
				'countperpage' => $this->countPerPage
		);
	}
	
	public function deleteTag($tagId){
		$sql = "delete from videotag where id=" . intval($tagId);
		$this->runSql($sql);
	}
	
	public function addTag($name,$descript){
		$sql = "insert into videotag(name,descript) values('" . my_addslash($name) . "','" . my_addslash($descript) . "')";
		$this->runSql($sql);
	}
	
	public function updateTag($tagId,$name,$descript){
		$this->deleteTag($tagId);
		$this->addTag($name,$descript);
	}
	
	public function getTagInfo($tagId){
		$sql = "select * from videotag where id = " . intval($tagId);
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return $result[0];
		}
		return null;
	}
	
	public function getVTagsByVideoId($videoId){
		$sql = "select * from video_vtag_relation left join videotag on video_vtag_relation.vtag_id = videotag.id where videotag.tagtype = 0 and video_vtag_relation.video_id = " . intval($videoId);
		return $this->querySql($sql);
	}
	
	public function getTags(){
		$sql = "select * from videotag";
		return $this->querySql($sql);
	}
}