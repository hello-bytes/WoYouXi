<?php

require_once "cmscontroller.php";
require_once 'game/protected/utils/bcshelper.php';

class CmsUploadController extends CmsController
{
	public function actionIndex(){
		$imageName = $_FILES['image']['name'];
		$imageFile = $_FILES['image']['tmp_name'];
		$folder = "";
		if(key_exists("folder", $_POST)){
			$folder = $_POST["folder"];
		}
		move_attachments_bcs_fileupload($imageName,$folder, $imageFile,false);
	}
}