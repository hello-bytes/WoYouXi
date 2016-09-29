<?php

require_once "cmsuicontroller.php";
class CmsSubjectUIController extends CmsUIController
{
	public function actionIndex(){
		if(array_key_exists("operator", $_POST)){
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "delete") == 0){
				//删除所有选中的ID
				if(array_key_exists("selectedId", $_POST)){
					$selectedSubjectIds = $_POST['selectedId'];
		
					$subjectDeleter = new Subject();
					$subjectDeleter->deleteSubject($selectedSubjectIds);
				}
			}
		}
		
		$subjectLoader = new Subject();
		$catalogLoader = new Category();
		$catalogs = $catalogLoader->getAllCategory();
		for($index = 0;$index < count($catalogs);$index++){
			$catalogs[$index]['subjects'] = $subjectLoader->getSubjectByCategory($catalogs[$index]['id']);
		}
		
		$this->render("index",array(
				"catalogs" => $catalogs,
				"moduletitle" => "专题管理管理",
		));
	}
	
	public function actionAddSubject(){
		$catalog = null;
	
		$moduletitle = "增加一个新的专题";
		$errorcode = 0;
		if(array_key_exists("operator", $_POST)){
			$moduletitle = "";
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "save") == 0){
				$name = $_POST["name"];
				$descript = $_POST["descript"];
	
				if(strlen($name) > 0){
					$catalogLoader = new Subject();
					$catalogLoader->addSubject($_POST['subjectIdSelector'],$name,$descript);
				}else{
					$errorcode = 1;
				}
			}
		}
		
		$catalogLoader = new Category();
		$catalogs =  $catalogLoader->getAllCategory();
	
		$this->render("subject",array(
				"errorcode" => $errorcode,
				"catalogs" => $catalogs,
				"moduletitle" => $moduletitle,
		));
	}
	
	public function actionEditSubject(){
		$errorcode = 0;
		$subjectId = $_GET['subjectid'];
		if($subjectId > 0){
			if(array_key_exists("operator", $_POST)){
				$operator = $_POST["operator"];
				if(strcasecmp($operator, "save") == 0){
					$name = $_POST["name"];
					$descript = $_POST["descript"];
						
					if(strlen($name) > 0 ){
						$catalogLoader = new Subject();
						$catalogLoader->updateSubject($subjectId,$name,$descript);
					}else{
						$errorcode = 1;
					}
				}
			}
		}
	
		$subjectLoader = new Subject();
		$subject = $subjectLoader->getSubjectInfo($subjectId);
	
		$this->render("subject",array(
				"errorcode" => $errorcode,
				"subject" => $subject,
				"catalogs" => null,
				"moduletitle" => "增加栏目",
		));
	}
	
}