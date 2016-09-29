<?php

require_once(dirname(__FILE__) . '/../framework/yii.php');
$config = dirname(__FILE__) . '/protected/config/main.php';

if(BAE_LOCAL_DEBUG){
	Yii::createWebApplication($config)->run();
}else{
try {
	Yii::createWebApplication($config)->run();
}catch (Exception $e){
	try{
		//gotoerrorpage();
		print_r($e);
	}catch(Exception $ex){
	}
}
?>
	
<?php  } ?>