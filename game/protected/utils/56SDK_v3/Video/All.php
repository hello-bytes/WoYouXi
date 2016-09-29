<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_All 
 * @todo get video list from http://video.56.com 
 *  
 * @param $type
 * @param $t
 * @param $c
 * @param $page
 * @param $rows
 * 
 type:	
 hot为最多观看，
 ding为最多推荐，
 new为最新发布，
 share为最多引用，
 comment为最多评论
 t:
 today今日，
 week本周，
 month本月
 c:	
 3=>'原创', 
 26=>'游戏',
 1=>'娱乐', 
 34=>'亲子', 
 28=>'汽车', 
 27=>'旅游', 
 11=>'女性', 
 14=>'体育', 
 8=>'动漫',  
 10=>'科教', 
 2=>'资讯', 
 39=>'财富',
 40=>'科技',
 41=>'音乐',
 0=>'所有',
 4=>'搞笑',
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_All extends ApiAbstract
{
    /**
     * @name Get 
     * @todo  
     * @author Louis 
     * 
     * @param string $params 
     * @access public
     * @return array
     */
	public function Get($params){
		$url=$this->domain.'/video/all.json';
		return self::getHttp($url,$params);
    }
}
