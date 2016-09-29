<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Custom 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Custom extends ApiAbstract
{
	/**
	* @description 复杂上传组件地址
	* 
		$params=array('sid'=> $sid,'css'=> $css ,'rurl'=> $rurl,'ourl'=> $ourl);
	* @param $sid 第三方的应用的用户名
	* @param $css 获取的样式加密码
	* @param $rurl 失败时跳转的页面，获取返回信息
	* @param $ourl 成功时跳转的页面，获取返回信息
	* @return plugin
	*/
	public function Get($params){
		$url=$this->domain."/video/custom.plugin";
		//var_dump($url.'?'.self::signRequest($params));
		return $url.'?'.self::signRequest($params);
	}
}
