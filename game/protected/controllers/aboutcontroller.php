<?php

require_once "defaultcontroller.php";
class AboutController extends DefaultController
{
	public function actionUs(){
		$this->render("about",array(
					"title" => "关于我游戏",
					"key" => "us",
			));
	}
	
	public function actionContactUs(){
		$this->render("about",array(
					"title" => "联系我们",
					"key" => "contactus",
			));
	}
	
	public function actionLawNotice(){
		$this->render("about",array(
					"title" => "法律声明",
					"key" => "lawnotice",
			));
	}
	
	public function actionAdAndCooperation(){
		$this->render("about",array(
					"title" => "刊登广告和寻求其他合作",
					"key" => "ad",
			));
	}
	
	public function actionLinks(){
		$this->render("about",array(
					"title" => "友情链接(排名不分先后)",
					"key" => "links",
			));
	}
	
	public function actionUpload(){
		$this->render("about",array(
					"title" => "用户上传",
					"key" => "upload",
			));
	}
	
	public function actionAdvise(){
		if( array_key_exists("advisedesc", $_POST)){
			$advise = $_POST['advisedesc'];
			$contact = "";
			if(array_key_exists("contact", $_POST)){
				$contact = $_POST['contact'];
			}
			
			$feedback = new Feedback();
			$feedback->addFeedback($contact,$advise);
		}
		
		$this->render("about",array(
					"title" => "建议或意见",
					"key" => "advise",
			));
	}
	
	public function actionuploadnotice(){
		$this->render("about",array(
					"title" => "上传需知",
					"key" => "uploadnotice",
			));
	}
	
}