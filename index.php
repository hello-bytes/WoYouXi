<?php

define("CACHE_CMS", false);
define("BAE_LOCAL_DEBUG", true);

require_once($_SERVER['DOCUMENT_ROOT'].'/game/protected/utils/globalbase.php');

if(BAE_LOCAL_DEBUG){
	define('YII_DEBUG',true);
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
}else{
	define('YII_DEBUG',false);
	error_reporting(E_ERROR);	
}

session_start();

$webroot=dirname(__FILE__).'/game/index.php';
require_once($webroot);

?>
