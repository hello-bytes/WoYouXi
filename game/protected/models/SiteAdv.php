<?php

class SiteAdv extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'site_adv';
	}
	
	public function getAdvByType($advType)
	{
		$result = $this->querySql("select * from " .  $this->tableName() . " where advtype = " . $advType);
		if($result != null && count($result) == 1){
			return $result[0];
		}
		return null;
	}
	
	public function deleteAdv($advType)
	{
		$sql = "delete from site_adv where advtype=" . $advType;
		$this->runSql($sql);
	}
	
	public function setAdv($advType,$imageurl,$width,$height,$gotourl)
	{
		$this->deleteAdv($advType);
		$sql = "insert into site_adv(advtype,imageurl, width,height,gotourl) values(" . $advType . ",'" 
			. addslashes($imageurl) . "'," . $width . "," . $height . ",'" . $gotourl . "')";
		$this->runSql($sql);
		return true;
	}
}