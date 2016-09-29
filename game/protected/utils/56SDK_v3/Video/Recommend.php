<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Recommend 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Recommend extends ApiAbstract
{
	/**
	* @description 获得推荐频道的视频
	* 
	* @access public
		$params=array('mid'=>$mid, 'page'=>$page, 'num'=>$num);
	* @param string $mid default 16
	* @param string $page default 1
	* @param string $num default 10
	* @return json
	*/
	public function Get($params){
		$url=$this->domain.'/video/recommend.json';
		return self::getHttp($url,$params);
	}
}
