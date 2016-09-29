<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * User_UserVideos 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class User_UserVideos extends ApiAbstract
{

	/**
	* @description 获取用户的上传的视频
	* 
    * $params=array('userid'=>$userid,'access_token'=>$token,'s'=>'time','page'=>1,'rows'=>10);
	* @param $userid 用户在56网站的user_id或视频的flvid
	* @param $token oauth2认证后的令牌
	* @link  /user/userVideos.json 
	* @return json
	*/
	public function Get($params){
		$url=$this->domain.'/user/userVideos.json';
		return self::getHttp($url,$params);
	}
}
