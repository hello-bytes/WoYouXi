<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * User_UserComment 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class User_UserComment extends ApiAbstract
{
	/**
	* @description 获得用户的评论或视频的评论
	* 
    * $params=array('tid'=>$tid,'access_token'=>$token,'type'=> $type,'page'=>1,'rows'=>10, 'pct'=> $pct);
    * $tid = 'onesec', $type = 'user', $pct = 1
    * @param $tid 用户在56网站的user_id或视频的flvid
	* @param $type user/flv
	* @param $token oauth2认证后的令牌
	* @param $pct  1为普通视频 3是相册视频
	* @return json
	*/
	public function Get($params){
		$url=$this->domain.'/user/userComments.json';
		return self::getHttp($url,$params);
	}
}
