<?php
require_once dirname(dirname(__FILE__)).'/ApiAbstract.php';
/**
 * Video_Delete 
 * 
 * @uses ApiAbstract
 * @package 
 * @copyright 56.com
 * @author Louis Li <email:zixing.li@renren-inc.com;QQ:838431609> 
 */
class Video_Delete extends ApiAbstract
{
    /**
     * @name Get 
     * @todo  delete a video
     * @author Louis 
     * 
     * @param string $params 
        $params = array(
            'vid'=>'NzAxOTI2MzM',
        );  
     * @access public
     * @return array
     */
	public function Get($params){
		$url=$this->domain."/video/delete.json";
		return self::getHttp($url,$params);
	}
}
