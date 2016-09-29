<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Language" content="zh-CN" />
		<title>我游戏 管理系统</title>
		<link rel="shortcut icon" href="/game/assets/cms/img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/game/assets/cms/cms.default.css?ver=123"></link>
		<link rel="stylesheet" type="text/css" href="/game/assets/cms/table.style.css?ver=123"></link>
		<script type="text/javascript">
			String.prototype.trim = function() { return  this.replace(/^\s+|\s+$/g, ''); }
		</script>
	</head>
<?php 

/**
 * 模块划分:
 * 1,购买服务
 * 2,查看订单
 * 3,子用户管理
 */
$secondSegment = "";
$requestUrl = $_SERVER["REQUEST_URI"];
$requestSegments = explode("/", $requestUrl);

$firstSegment = "";
if(count($requestSegments) >= 2){
	$firstSegment = $requestSegments[1];
	
	$questSegments = explode("?", $firstSegment);
	$firstSegment = $questSegments[0];
} 

if(count($requestSegments) > 2){
	$secondSegment = $requestSegments[2];

	$secondQuestSegments = explode("?", $secondSegment);
	$secondSegment = $secondQuestSegments[0];
}

function getSecLinkColor($secondSegment,$currentSecItem){
	if(strcasecmp($secondSegment, $currentSecItem) == 0){
		return "color:#B11118;";
	}
	return "";
}

function getNavBarClassName($urlSegment,$navBarItem){
	if(strcasecmp($navBarItem, $urlSegment) == 0 ){
		return "outlookbaritem_selected";
	}
	return "outlookbaritem";
}

function getNavBarColor($urlSegment,$navBarItem){
	if(strcasecmp($navBarItem, $urlSegment) == 0 ){
		return "color:#ffffff";
	}
	return "color:#354b66";
}

?>
	<body style="margin:0px;padding:0px;background:#F2F2F3;color:#666;">
		<?php require_once 'component/cms.topbar.php'; ?>
		<div id="main_content_div" class="" style="width:100%;background:#fff;position:relative;">
			<div id="left_div" style="position:absolute;width:200px;left:0px;top:0px;background:#E8EBEF;border-right:solid 1px #B0BAC6;">
				<ul class="outlookbar">
					<li class="<?php echo getNavBarClassName($firstSegment,"cmsadmin"); ?>">
						<a class="outlookbaritem_link" href="/cmsadmin" style="<?php echo getNavBarColor($firstSegment,"cmsadmin") ?>">本站概况</a>
					</li>
					<li class="<?php echo getNavBarClassName($firstSegment,"cmscatalog"); ?>">
						<a class="outlookbaritem_link" href="/cmscatalog" style="<?php echo getNavBarColor($firstSegment,"cmscatalog") ?>">栏目管理</a>
					</li>
					<li class="<?php echo getNavBarClassName($firstSegment,"cmssubjectui"); ?>">
						<a class="outlookbaritem_link" href="/cmssubjectui" style="<?php echo getNavBarColor($firstSegment,"cmssubjectui") ?>">专题管理</a>
					</li>
					<li class="<?php echo getNavBarClassName($firstSegment,"cmsgameui"); ?>">
						<a class="outlookbaritem_link" href="/cmsgameui" style="<?php echo getNavBarColor($firstSegment,"cmsgameui") ?>">游戏管理</a>
					</li>
					<li class="<?php echo getNavBarClassName($firstSegment,"cmscache"); ?>">
						<a class="outlookbaritem_link" href="/cmscache" style="<?php echo getNavBarColor($firstSegment,"cmscache") ?>">缓存管理</a>
					</li>
					<li class="<?php echo getNavBarClassName($firstSegment,"cmstools"); ?>">
						<a class="outlookbaritem_link" href="/cmstools" style="<?php echo getNavBarColor($firstSegment,"cmstools") ?>">小工具大全</a>
					</li>
					<li class="<?php echo getNavBarClassName($firstSegment,"cmsadv"); ?>">
						<a class="outlookbaritem_link" href="/cmsadv" style="<?php echo getNavBarColor($firstSegment,"cmsadv") ?>">广告位管理</a>
					</li>
				</ul>
			</div>
			<div id="right_div" style="position:absolute;left:200px;top:0px;background:#ffffff">
				<?php echo $content; ?>
			</div>
		</div>
		<?php //require_once 'component/cms.foot.php'; ?>
	</body>
	<script type="text/javascript">
		function onWindowResize(){
			var objLeftDiv = document.getElementById("left_div");
			var objRightDiv = document.getElementById("right_div");
			//var objContentDiv = document.getElementById("main_content_div");
			if(objLeftDiv != null && objRightDiv != null){
				var windowWidth = document.documentElement.clientWidth;
				var windowHeight = document.documentElement.clientHeight;
	
				var divHeight = windowHeight - 100;
				objLeftDiv.style.height = divHeight + "px";
				objRightDiv.style.height = divHeight + "px";
				//objContentDiv.style.height = divHeight + "px";
	
				objRightDiv.style.width = (windowWidth - 201) + "px";
				
				//objLeftDiv.style.height = (windowHeight - 100) + "px";
				//alert(objLeftDiv.height);
			}
		}

		function getUrlAddress(){
			var currentPageUrl = "";
			if(typeof this.href === "undefined"){
				currentPageUrl = document.location.toString().toLowerCase();
			}else{
				currentPageUrl = this.href.toString().toLowerCase();
			}
		}

		var container = document.getElementById("main_content_div");
		if(container != null){
			if (document.all){
				container.attachEvent('onresize',onWindowResize);
			}else{
				window.addEventListener('resize', onWindowResize, false);
			}
		}
		onWindowResize();
	</script>
</html>