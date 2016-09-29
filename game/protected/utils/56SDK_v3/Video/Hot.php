<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Hot 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Hot extends ApiAbstract
{
	/**
	* @description default:获得56网首页热门的视频
	* 
	* @access public
    * @param $paramsarray('cid'=>$cid, 'page'=>$page, 'num'=>$num);
	* @param string $cid default 2
	* @param string $page default 1
	* @param string $num default 10
	* @return json
	*/
    public function Get($params){
		$url=$this->domain.'/video/hot.json';
		return self::getHttp($url,$params);
	}
}
