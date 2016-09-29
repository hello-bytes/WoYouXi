<?php 

require_once "cmsuicontroller.php";
class CmsCatalogController extends CmsUIController
{
	public function actionIndex(){
		if(array_key_exists("operator", $_POST)){
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "delete") == 0){
				//删除所有选中的ID
				if(array_key_exists("selectedId", $_POST)){
					$selectedCatalogId = $_POST['selectedId'];

					$catalogDeleter = new Category();
					$catalogDeleter->deleteCatalogs($selectedCatalogId);
				}
			}
		}
		
		$catalogLoader = new Category();
		$catalogs = $catalogLoader->getAllCategory();
		
		$this->render("index",array(
				"catalogs" => $catalogs,
				"moduletitle" => "栏目管理",
				));
	}
	
	public function actionAddCatalog(){
		$catalog = null;
		
		$moduletitle = "增加一个新的栏目";
		$errorcode = 0;
		if(array_key_exists("operator", $_POST)){
			$moduletitle = "";
			$operator = $_POST["operator"];
			if(strcasecmp($operator, "save") == 0){
				$name = $_POST["name"];
				$descript = $_POST["descript"];
				
				if(strlen($name) > 0){
					$catalogLoader = new Category();
					$catalogLoader->addCatalog($name,$descript);
				}else{
					$errorcode = 1;
				}
			}
		}
		
		$this->render("catalog",array(
				"errorcode" => $errorcode,
				//"catalog" => $catalog,
				"moduletitle" => $moduletitle,
		));
	}
	
	public function actionEditCatalog(){
		
		$errorcode = 0;
		$catalogId = $_GET['catalogid'];
		if($catalogId > 0){
			if(array_key_exists("operator", $_POST)){
				$operator = $_POST["operator"];
				if(strcasecmp($operator, "save") == 0){
					$name = $_POST["name"];
					$descript = $_POST["descript"];
			
					if(strlen($name) > 0 ){
						$catalogLoader = new Category();
						$catalogLoader->updateCatalog($catalogId,$name,$descript);
					}else{
						$errorcode = 1;
					}
				}
			}
		}
		
		$catalogLoader = new Category();
		$catalog = $catalogLoader->getCategoryInfo($catalogId);
	
		$this->render("catalog",array(
				"errorcode" => $errorcode,
				"catalog" => $catalog,
				"moduletitle" => "增加栏目",
		));
	}
}