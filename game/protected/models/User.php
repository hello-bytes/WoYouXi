<?php

class User extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'users';
	}
	
	public function verifyUsernamePwd($username, $password){
		$sql = "select username,email,id from users where username = '" . addslashes($username) . "' and password = '" . addslashes($password) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return $result[0];
		}
		return null;
	}
	
	public function checkAuth($userId,$authModule){
		$sql = "select * from userrole inner join role_authorize on userrole.roleid = role_authorize.roleid " .
				" inner join authmoduleauth on authmoduleauth.authmoduleid = role_authorize.authitemid " .
				"where userrole.userid = " . $userId . " and  authmoduleauth.authitemname = '" . $authModule . "'";
			
		$result = $this->querySql($sql);
		return $result != null && count($result) > 0;
	}
	
	public function getUserRole($uerId){
		$sql = "select roleid from userrole where userid = " . $uerId;
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]['roleid'];
		}
		return -1;
	}
	
	public function getAuthModules($userId){
		$sql = "select authmoduleauth.authitemname from userrole inner join role_authorize on userrole.roleid = role_authorize.roleid " . 
    			" inner join authmoduleauth on authmoduleauth.authmoduleid = role_authorize.authitemid " .
    			"where userrole.userid = " . $userId;
		$result = $this->querySql($sql);
		echo $sql;
		return $result;
	}
	
	public function cmsLogin($username,$password){
		$userId = $this->getUserId($username,$password); 
		if($userId > 0){
			$role = $this->getUserRoleIdByUserId($userId);
			if($role > 1){
				return 0;
			}else{
				return 2;
			}
		}else{
			return 1;
		}
	}
	
	public function getAuths($userName){
		$sql = "select authmoduleauth.authitemname from userrole inner join role_authorize on userrole.roleid = role_authorize.roleid inner join users on users.id = userrole.userid inner join authmoduleauth on authmoduleauth.authmoduleid = role_authorize.authitemid where users.username = '" . addslashes($userName) . "'";
		return $this->querySql($sql);
	}
	
	public function getRoleInfo($userName){
		$sql = "select userrole.roleid ,role.rolename from userrole inner join users on users.id = userrole.userid inner join role on role.role_realid = userrole.roleid where users.username = '" . addslashes($userName) . "'";
		return $this->querySql($sql);
	}
	
	public function getUserId($userName,$password)
	{
		$sql = "select id from users where users.username = '" . addslashes($userName) . "' and users.password = '" . 
					addslashes($password) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) > 0){
			return $result[0]['id'];
		}
	}
	
	/**
	 * 读取用户的角色ID
	 */
	public function getUserRoleIdByUsername($userName)
	{
		$sql = "select roleid from users inner join userrole on userrole.userid = users.id where users.name = '" . addslashes($userName) . "'";
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]['roleid'];
		}
		return -1;
	}
	
	/**
	 * 读取用户的角色ID
	 */
	public function getUserRoleIdByUserId($userId)
	{
		$sql = "select roleid from users inner join userrole on userrole.userid = users.id where users.id = " . $userId;
		$result = $this->querySql($sql);
		if($result != null && count($result) == 1){
			return $result[0]['roleid'];
		}
		return -1;
	}
	
	/**
	 * 判断是不是管理员用户
	 */
	public function isCmsUser($userName)
	{
		return $this->getUserRoleId($userName) > 1;
	}
	
	/**
	 * 超级用户具有一切权限，包括权限的给予及收回
	 */
	public function isSuperUser($userName){
		return $this->getUserRoleIdByUsername($userName) == 2;
	}
	
	/**
	 * 
	 * @param string $userName
	 * @param string $password
	 */
	public function checkLogin($userName,$password){
		return $this->getUserId($userName,$password) > 0;
	}
	
	/**
	 * 判断某一个用户对某一个权限模块是否有权限
	 * @param string $username
	 * @param string $authModule
	 */
	public function hasCmsAuthorize($userName,$password,$authModule)
	{
		$userId = $this->getUserId($userName,$password);
		if($userId <= 0) { return false;}
		
		$roleId = $this->getUserRoleIdByUserId($userId);
		if($roleId < 2){
			return false;
		}else if($roleId = 2){
			return true;
		}else{
			$sql = "select * from userrole inner join role_authorize on userrole.roleid = role_authorize.roleid " . 
    			" inner join authmoduleauth on authmoduleauth.authmoduleid = role_authorize.authitemid " .
    			"where userrole.userid = " . $userId . " and  authmoduleauth.authitemname = '" . $authModule . "'";
			$result = $this->querySql($sql);
			return $result != null && count($result) > 0;
		}
	}
}