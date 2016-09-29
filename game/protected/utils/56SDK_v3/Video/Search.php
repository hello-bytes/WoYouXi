<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Search 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Search extends ApiAbstract
{
	/*
	* @description 根据关键字获取搜索结果
	*   $params = array(
	*       'keyword'=> $keyword,  //要查找的关键字
	*       'c'=>1,
	*       't'=>'month', 时间，默认为month
	*       's'=>1,
	*       'page'=>1,     当前页数
	*       'rows'=>$rows, 10 每页显示多少个
	*    );  
	* @param $keyword 主要的字段，关键字搜索，其他的默认即可
	* @link  /video/search.json
	* @return json
	*/
	public function  Get($params){
		$url=$this->domain.'/video/search.json';
		return self::getHttp($url,$params);
	}
}
