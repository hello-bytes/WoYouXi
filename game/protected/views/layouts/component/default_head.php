<?php 
function getTitle()
{
	global $global_title;
	if($global_title == null || strlen($global_title) == 0){
		return "我游戏网|http://www.woyouxi.net";
	}else{
		return $global_title . "  -  我游戏网|http://www.woyouxi.net";
	}
}

function getPageKeywords()
{
	global $global_keywords;
	if($global_keywords == null || strlen($global_keywords) == 0){
		return "我游戏 我游戏网 单机游戏 小游戏  网页游戏 植物大战僵尸 保卫萝卜";
	}else{
		return $global_keywords;
	}
}

function getPageDescript()
{
	global $global_descript;
	if($global_descript == null || strlen($global_descript) == 0){
		return "我游戏网是小游戏专业网站,免费为你提供小游戏大全,双人小游戏,连连看小游戏,植物大战僵尸,保卫萝卜等最新小游戏。";
	}else{
		return $global_descript;
	}
}
?>
<head>
	<meta http-equiv="Content-Language" content="zh-CN" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="keywords" content="<?php echo getPageKeywords(); ?>" />
	<meta name="description" content="<?php echo getPageDescript(); ?>" />
	<link rel="shortcut icon" href="/favicon.ico"/>
	<title><?php echo getTitle(); ?></title>
	
	<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->clientScript->minScriptCreateGroup(
	array(
	Yii::app()->basePath . '/../assets/js/minifun.js'
	)); ?>"></script>
	<link rel="stylesheet" charset="utf-8" type="text/css" href="<?php echo Yii::app()->clientScript->minScriptCreateGroup(
		array(
			Yii::app()->basePath . '/../assets/css/main.css',
			Yii::app()->basePath . '/../assets/css/sytuiguang.css',
			Yii::app()->basePath . '/../assets/css/indeximageturn.css' 
			)); ?>"></link>
</head>