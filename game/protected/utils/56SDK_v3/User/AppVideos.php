<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * User_AppVideos 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class User_AppVideos extends ApiAbstract
{
	/**
	* @description 获取应用上传的视频
	* 
	* @param 获得该appid下所有上传的视频
	* @param s->按时间排序，page->页码，rows->每页显示多少
	* @link  /user/appVideos.json 
	* @return json
	*/
	public function Get($params){
		$url = $this->domain.'/user/appVideos.json';
		return self::getHttp($url,$params);
	}
}
