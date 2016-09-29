<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
class Video_Diyupload extends ApiAbstract
{
	/**
	* @description Diy复杂上传组件地址
	* 
		$params=array('fields'=>'title,content,tags','sid'=> $sid,'css'=> $css ,'rurl'=> $rurl,'ourl'=> $ourl);
	* @param $fields自定义选项  
	* @param $sid 第三方的应用的用户名
	* @param $css 获取的样式加密码
	* @param $rurl 失败时跳转的页面，获取返回信息
	* @param $ourl 成功时跳转的页面，获取返回信息
	* @return plugin
	*/
	public function Get($params){
		$url=$this->domain."/video/diyupload.plugin";
		return $url.'?'.self::signRequest($params);
	}
}
