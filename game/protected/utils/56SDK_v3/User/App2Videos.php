<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
class User_App2Videos extends ApiAbstract
{
	/**
	* @description 获取当前应用上传视频列表(新)
	* @param page->页码，rows->每页显示多少
	* @link  /user/app2Videos.json 
	* @return json
	*/
	public function Get($params){
		$url = $this->domain.'/user/app2Videos.json';
		return self::getHttp($url,$params);
	}
}
