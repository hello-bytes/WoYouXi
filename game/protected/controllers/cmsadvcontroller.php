<?php

require_once "cmsuicontroller.php";
require_once "game/protected/utils/bcshelper.php";
class CmsAdvController extends CmsUIController
{
	public function actionIndex(){
		
		$siteAdvLoader = new SiteAdv();
		
		$errorInfo = "";
		if(count($_POST) > 0){
			if(key_exists("operator", $_POST)){
				$operator = $_POST["operator"];
				if(strcasecmp($operator, "savemainbanner") == 0){
					//print_r($_POST);
					if($_POST["image_width"] > 0 && $_POST["image_height"] > 0 && 
							strlen($_POST["imageurl"]) > 0 && strlen($_POST["gotourl"]) > 0){
						//echo "begin save";
						if( $siteAdvLoader->setAdv(1,$_POST["imageurl"],$_POST["image_width"],$_POST["image_height"],$_POST["gotourl"]) ){
							$strJson = json_encode(array(
								"imageurl" => $_POST["imageurl"],
								"image_width" => $_POST["image_width"],
								"image_height" => $_POST["image_height"],
								"gotourl" => $_POST["gotourl"],
									));
									//echo $strJson;
							move_attachments_bcs_fileupload("swjoy_banner.json", "adv" , $strJson ,true);
							//echo "success";
						}else{
						}
					}else{
						//参数不合法
						$errorInfo = "参数不合法,图片url,宽，高都得设置！";
					}
				}else if(strcasecmp($operator, "clearmainbanner") == 0){
					$siteAdvLoader->deleteAdv(1);
				}
			}
		}
		
		$bannerAdv = $siteAdvLoader->getAdvByType(1);
		//echo $errorInfo;
		$this->render("index",array(
				"errorinfo" => $errorInfo,
				"banneradv" => $bannerAdv,
				"moduletitle" => "广告位管理-首面banner",
				));
	}
}