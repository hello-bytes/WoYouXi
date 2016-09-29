<?php

require_once "cmscontroller.php";
class CmsSubjectController extends CmsController
{
	public function addSubject()
	{
		$categoryId = $_POST['categoryid'];
		$name = $_POST['name'];
		$descript = $_POST['descript'];
		
		$subject = new Subject();
		$subjectId = $subject->addSubject($categoryId,$name,$descript);
		if($subjectId > 0){
			echo GeneralSuccessJsonResult(array("subjectid"=>$subjectId));
		}else{
			echo GeneralJson(constant('CODE_UNKNOWN'),constant('DESC_UNKNOWN'));
		}
	}
}