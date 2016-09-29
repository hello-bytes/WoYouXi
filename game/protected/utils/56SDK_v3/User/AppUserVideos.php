<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * User_AppUserVideos 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class User_AppUserVideos extends ApiAbstract
{
	/**
	* @description 获取某应用下某用户的视频列表(新) 
	* @param sid->第三方的用户标识，字符串型。，page->页码，rows->每页显示多少
	* @link  /user/appUserVideos.json 
	* @return json
	*/
	public function Get($params){
		$url = $this->domain.'/user/appUserVideos.json';
		return self::getHttp($url,$params);
	}
}
