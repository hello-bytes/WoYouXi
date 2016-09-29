<?php 

require_once "json/errorcode.php";
require_once "json/generalresult.php";
class CmsUIController extends CController
{
	public $module = null;

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->layout = "cms";
		
		$this->checkSession();
		$this->writeLog();
	}
	
	public function writeLog(){
		$adminLog = new AdminLog();
		$currentLoginUser = getLoginUser();
		if($currentLoginUser != null){
			$adminLog->addLog($currentLoginUser->getUserId(),$_SERVER['REQUEST_URI']);
		}else{
			$adminLog->addLog(0, $_SERVER['REQUEST_URI']);
		}
	}

	public function actionIndex(){

	}
	
	public function checkSession(){
		//echo "check session";
		//LoginUser 
		$canContinue = false;
		$currentLoginUser = getLoginUser();
		if($currentLoginUser == null || 
				$currentLoginUser->getUserRoleId() < 2){
			//判断是不是登陆的
			$url = $_SERVER['REQUEST_URI'];
			if(strpos($url,"/cmsadmin/login") === false ){
			}else{
				$canContinue = true;
			}
		}else{
			if($currentLoginUser != null && $currentLoginUser->getUserRoleId() >= 2){
				$canContinue = true;
			}	
		}
		if($canContinue == false){
			$this->redirect("/cmsadmin/login");
		}
	}

	public function checkAuth()
	{
		$url = $_SERVER["REQUEST_URI"];
		$urlParts = explode("/",$url);
		//print_r($urlParts);
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