<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';

/**
 * Video_Mobile 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Mobile extends ApiAbstract
{
	/**
	* @description 获取视频信息
	* 
		$params=array('vid'=>$flvid);
	* @param $flvid 56视频的flvid
	* @link /video/mobile.json
	* @return json
	*/
	public function Get($params){
		$url=$this->domain.'/video/mobile.json';
		return self::getHttp($url,$params);
	}
}
