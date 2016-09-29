<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Update 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Update extends ApiAbstract
{
	/**
	* @description 获取更新视频信息的接口
	* 
		$params=array('vid'=>$flvid,'title'=>$title,'desc'=>$desc,'tag'=>$tag);
	* @param $flvid 56视频的flvid
	* @param $title 56视频的名称
	* @param $desc  56视频的名称的描述
	* @param $tag   56视频的标签
	* @link  /video/update.json
	* @return json
	*/
	public function Get($params){
		$url=$this->domain.'/video/update.json';
		return self::getHttp($url,$params);
	}
}
