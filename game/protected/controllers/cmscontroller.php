<?php

require_once "json/errorcode.php";
require_once "json/generalresult.php";
class CmsController extends CController
{
	public $module = null;

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->checkAuth();
	}

	public function actionIndex(){
		
	}
	
	public function checkAuth()
	{
		$url = $_SERVER["REQUEST_URI"];
		$urlParts = explode("/",$url);
		if(count($urlParts) == 3){
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$controller = $urlParts[1];
			$action = $urlParts[2];
			
			if(strcasecmp($controller, "cmsdataconfig") == 0){
				return;
			}
			
			if(strcasecmp($controller, "cmsuser") == 0){
				return;
			}
			
			$authCheck = new User();
			$hasAuthorize = $authCheck->hasCmsAuthorize($username, $password, $controller . "_" . $action);
			if($hasAuthorize != true){
				echo GeneralJson(constant('CODE_AUTHORIZE_DENY'),constant('DESC_AUTHORIZE_DENY'));
				exit;
			}
		}else{
			echo GeneralJson(constant('CODE_AUTHORIZE_DENY'),constant('DESC_AUTHORIZE_DENY'));
			exit;
		}
	}
	
	public function getConditionArray($condition){
		$result = explode(",",$condition);
	
		$realResult = array();
		foreach($result as $resultItem){
			if(strlen($resultItem) > 0){
				array_push($realResult, $resultItem);
			}
		}
	
		return $realResult;
	}

}