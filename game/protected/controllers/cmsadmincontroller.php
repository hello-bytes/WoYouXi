<?php 

require_once "cmsuicontroller.php";
class CmsAdminController extends CmsUIController
{
	public function actionIndex(){
		//取得总栏目数，总专题数，总游戏数
		$catalogLoader = new Category();
		$catalogCount = $catalogLoader->getAllCatalogCount();
		
		$subjectLoader = new Subject();
		$subjectCount = $subjectLoader->getAllSubjectCount();
		
		$gameLoader = new Game();
		$gameCount = $gameLoader->getAllGameCount();
		
		$this->render("index",array(
				"catalogcount" => $catalogCount,
				"subjectcount" => $subjectCount,
				"gamecount" => $gameCount,
				));
	}
	
	private function writeLoginData($userInfo,$roleId,$modules){
		setLoginUser($userInfo,2, $roleId, $modules);
	}
	
	public function actionLogin(){
		$this->layout = "blank";
		
		$loginErrorCode = 0;
		
		if(count($_POST) > 0){
			$username = $_POST['username'];
			$password = $_POST['hidepwd'];
			$checkCode =  $_POST['checkcode'];
			if(strtoupper($checkCode) != strtoupper($_SESSION["VerifyCode"]))
			{
				//echo "verify code is failure..";
				$loginErrorCode = 2;
			}
			else
			{
				$userCheck = new User();
				$result = $userCheck->verifyUsernamePwd($username,$password);
				if($result != null){
					$roleId = $userCheck->getUserRole($result['id']);
					$modules = $userCheck->getAuthModules($result['id']);
					if($roleId >= 2){
						$loginErrorCode = 0;
							
						$this->writeLoginData($result,$roleId,$modules);
							
						$this->redirect("/cmsadmin");
					}else{
						$loginErrorCode = 3;
					}
				}else{
					$loginErrorCode = 1;
				}
			}	
		}
		
		$this->render("login",array(
				"loginErrorCode" => $loginErrorCode,
				));
	}
	
	public function actionLogout(){
		logout($userInfo,2, $roleId);
		$this->redirect("/cmsadmin/login");
	}
}