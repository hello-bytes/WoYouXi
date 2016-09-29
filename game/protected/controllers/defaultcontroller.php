<?php

class CrumbItem
{
	public $name = "";
	public $url  = "";
}

class DefaultController extends CController
{
	public $module = null;
	public $crumbs = null;
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->layout = "default";
		
		$crumbItem = new CrumbItem();
		$crumbItem->url = "/";
		$crumbItem->name = "主页";
		$this->crumbs = array($crumbItem);
	}
	
	public function addCrumbItem($name,$url = "")
	{
		$crumbItem = new CrumbItem();
		$crumbItem->url = $url;
		$crumbItem->name = $name;
		array_push($this->crumbs, $crumbItem);
	}
	
	public function getCrumb()
	{
		return 	$this->crumbs;
	}
	
	public function actionIndex(){
		$this->render("index",null);
	}
	
	public function setAdvJs($ids = null){
		if(isSetGlobalAdvJs()) return;
		
		if($ids == null){
			$ids = array(2001,2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020);
		}
		
		$data = new DBData();
		setGlobalAdvJs($data->getUnseriDatas($ids));
	}
	
	/*public function loadModel()
	{
		if($this->_model === null)
		{
			if(isset($_GET['id']))
				$this->_model=Comment::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}*/
}