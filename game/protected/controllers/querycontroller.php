<?php

require_once 'game/protected/utils/bcshelper.php';
require_once 'game/protected/utils/HttpClient.class.php';
class QueryController extends CController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}
	
	public function actionQueryBcs(){
		$objectPath = $_GET["bcs"];
		if (is_bcs_object_exist($objectPath)){ 
			echo "1";
			return;
		}
		echo "0";
	}
}