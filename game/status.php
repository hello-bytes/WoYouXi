<?php

//App::uses('Auth', 'Model');
//App::uses('AppModel', 'Model');

class LoginUser{
	private $userId;
	private $userName;
	private $email;
	private $roleId;
	private $entry;
	private $modules;
	
	public function getUserId(){
		return $this->userId;
	}
	
	public function setUserId($userId){
		$this->userId = $userId;
	}
	
	public function getUserName(){
		return $this->userName;
	}
	
	public function setUserName($userName){
		$this->userName = $userName;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getUserRoleId(){
		return $this->roleId;
	}
	
	public function setUserRoleId($roleId){
		$this->roleId = $roleId;
	}
	
	public function setEntry($entry){
		$this->entry = $entry;
	} 
	
	public function getEntry(){
		return $this->entry;
	}

	public function getModules(){
		return $this->modules;
	} 
	
	public function setModules($modules){
		$this->modules = $modules;
	} 
	
	public function checkModules($module){
		if($this->modules == null) return false;
		foreach($this->modules as $authModule){
			if(strcmp($authModule['authitemname'] , $module) == 0){
				return true;
			}
		}
		return false;
	}
}

function logout()
{
	$_SESSION['current_user'] = null;
	session_destroy();
}

function getLoginUser(){
	if(key_exists('current_user',$_SESSION)){
		return unserialize($_SESSION['current_user']);
	}else{
		return null;
	}
}

function getLoginUserId(){
	if(key_exists('current_user',$_SESSION)){
		$loginUser = unserialize($_SESSION['current_user']);
		return $loginUser->getUserId();
	}else{
		return -1;
	}
}

function isLogined(){
	return getLoginUser() != null;
}

function setLoginUser($userInfo,$entry,$roleId,$modules = null){
	$loginUser = new LoginUser();
	$loginUser->setUserId($userInfo['userid']);
	$loginUser->setEmail($userInfo['email']);
	$loginUser->setUserName($userInfo['username']);
	$loginUser->setEntry($entry);
	$loginUser->setUserRoleId($roleId);
	$loginUser->setModules($modules);
	//从数据库中得到用户的角色
	//$auth = new Auth();
	//$loginUser->setUserRoleId($auth->getUserRole($userInfo['userid']));
	
	//echo $loginUser->getUserRoleId();
	
	$_SESSION['current_user'] = serialize($loginUser);
	return null;
}

