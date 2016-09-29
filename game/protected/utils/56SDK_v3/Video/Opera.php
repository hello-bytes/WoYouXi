<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Opera 
 * 
 * available mid
人人那些事儿 6891
大笑一方 6897
微播江湖 6268
娱乐快报 6363
音乐下午茶 6361
红人汇 6581
大话奥运 6552 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Opera extends ApiAbstract
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
		$url=$this->domain.'/video/opera.json';
		return self::getHttp($url,$params);
    }
}
