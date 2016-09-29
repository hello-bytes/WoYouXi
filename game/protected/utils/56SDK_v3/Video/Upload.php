<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Upload 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Upload extends ApiAbstract
{
	/**
	* @description 简易上传组件地址
	* 
	* @return plugin
	*/
	public function Get($params){
		$url=$this->domain."/video/upload.plugin";
		return $url.'?'.self::signRequest($params);
	}
}
