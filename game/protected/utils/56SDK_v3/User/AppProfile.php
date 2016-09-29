<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * User_AppProfile 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class User_AppProfile extends ApiAbstract
{
	/**
	* @description 获取应用信息(新)
	* @link  /user/appProfile.json 
	* @return json
	*/
	public function Get($params){
		$url = $this->domain.'/user/appProfile.json';
		return self::getHttp($url,$params);
	}
}
