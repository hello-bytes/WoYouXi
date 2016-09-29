<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_RecAlbum 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_RecAlbum  extends ApiAbstract
{
	/**
	* @description 获得56网昨天或某天的推荐的相册视频
	* 
	* @access public
		$params=array('day'=>20120705);
	* @param mixed $day
	* @return json|void
	*/
	public function Get($params){
		$url=$this->domain.'/video/recAlbum.json';
		return self::getHttp($url,$params);
	}

}
