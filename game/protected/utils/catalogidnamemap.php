<?php

class CatalogIdNameMap {
	private $idnameMap = null;
	public function getData(){
		if($this->idnameMap == null){
			$this->idnameMap = array(
				array("id" => 1, "name" => "dongzuo","text" => "动作"),
				array("id" => 2, "name" => "yundong","text" => "体育"),
				array("id" => 3, "name" => "yizhi","text" => "益智"),
				array("id" => 4, "name" => "sheji","text" => "射击"),
				array("id" => 5, "name" => "yule","text" => "娱乐"),
				array("id" => 6, "name" => "maoxian","text" => "冒险"),
				array("id" => 7, "name" => "qipai","text" => "棋牌"),
				array("id" => 8, "name" => "celue","text" => "策略"),
				//array("id" => 9, "name" => "nvsheng","text" => "女生"),
				array("id" => 10, "name" => "xiuxiang","text" => "休闲"),
				array("id" => 11, "name" => "zhuangban","text" => "装扮"),
				array("id" => 12, "name" => "ertong","text" => "儿童"),
				array("id" => 13, "name" => "jingying","text" => "经营"),
				//array("id" => 14, "name" => "guoguang","text" => "过关"),
				//array("id" => 15, "name" => "wangye","text" => "网页游戏"),
				/*array("id" => 16, "name" => "ertong"),
				array("id" => 17, "name" => "ertong"),
				array("id" => 18, "name" => "ertong"),*/
				);
		}
		return $this->idnameMap;
	}
	
	public function getNameFromId($id){
		$data = $this->getData();
		foreach($data as $category){
			if($category["id"] == $id){
				return $category["name"];
			}
		}
		return "";
	}
	
	public function getTextFromId($id){
		$data = $this->getData();
		foreach($data as $category){
			if($category["id"] == $id){
				return $category["text"];
			}
		}
		return "";
	}
	
	public function getUrlById($id){
		$name = $this->getNameFromId($id);
		if(strlen($name) > 0){
			return "/catalog/" . $name;
		}
		return "";
	}
	
	//public function getAllData()
	//{
		//return $this->idnameMap;
	//}
}