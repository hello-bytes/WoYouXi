<?php

require_once "cmscontroller.php";
class CmsUserController extends CmsController
{
	public function actionLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$user = new User();
		$loginResult = $user->cmsLogin($username,$password);
		if($loginResult == 0){
			$role = $user->getRoleInfo($username);
			$auths = $user->getAuths($username);
			echo GeneralSuccessJsonResult(array(
						"logincode" => $loginResult,
						"auths" => $auths,
						"role" => $role,
					));
		}else{
			echo GeneralSuccessJsonResult(array(
					"logincode" => $loginResult,
					"auths" => array(),
					));
		}
	}
}