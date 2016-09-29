<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Channel 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Channel extends ApiAbstract
{
	/**
	* @description 获得频道的视频
	* 
	* @access public
	*	$params=array('cid'=>$cid, 'page'=>$page, 'num'=>$num);
    *$cid = '68', $page = '1', $num = '20'
	* @param string $cid
	* @param string $page
	* @param string $num
	* @return json
	*/
	public function Get($params){
		$url=$this->domain.'/video/channel.json';
		return self::getHttp($url,$params);
    }
}
