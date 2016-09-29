<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
class Video_CustomPost extends ApiAbstract
{
	/**
	* @description CustomPost upload 地址
	* 
		$params=array('sid'=> $sid,'css'=> $css ,'rurl'=> $rurl,'ourl'=> $ourl);
	* @param $sid 第三方的应用的用户名
	* @param $css 获取的样式加密码
	* @param $rurl 失败时跳转的页面，获取返回信息
	* @param $ourl 成功时跳转的页面，获取返回信息
	* @return json 
	*/
	public function Get($params){
		$url=$this->domain."/video/customPost.json";
		return $url.'?'.self::signRequest($params);
	}
}
