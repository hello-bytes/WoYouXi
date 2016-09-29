<!DOCTYPE html>
<html>
	<?php require_once 'component/default_head.php'; ?>
	<?php require_once 'game/protected/config/cache/index.data.php'; ?>
	<?php 
		global $global_catalog;
		
		$requestUrl = $_SERVER["REQUEST_URI"];
		$requestSegments = explode("/", $requestUrl);
		$firstSegment = $requestSegments[1];
		
		$questSegments = explode("?", $firstSegment);
		$firstSegment = $questSegments[0];
		
		$secondSegment = "";
		if($global_catalog == null){
			if(count($requestSegments) > 2){
				$secondSegment = $requestSegments[2];
			
				$secondQuestSegments = explode("?", $secondSegment);
				$secondSegment = $secondQuestSegments[0];
			}
		}else{
			$secondSegment = $global_catalog;
		}
		
		
		function getSecLinkColor($secondSegment,$currentSecItem){
			if(strcasecmp($secondSegment, $currentSecItem) == 0){
				return "color:#B11118;";
			}
			return "";
		}
		
		function getNavBarClassName($firstSegment,$urlSegment,$navBarItem){
			if(strcasecmp("video", $firstSegment) == 0){
				return "navbar_item";
			}
			//echo $firstSegment .  "0-0" .  $navBarItem;
			if(strcasecmp("site", $navBarItem) == 0){
				if(strlen($urlSegment) == 0){
					return "navbar_item_selected";
				}
			}
			
			if(strcasecmp("index", $navBarItem) == 0){
				if(strlen($urlSegment) == 0){
					return "navbar_item_selected";
				}
			}
			
			if(strcasecmp($navBarItem, $urlSegment) == 0 ){
				return "navbar_item_selected";
			}
			
			return "navbar_item";
		}
		
		function getNavBarClassNameByFirst($urlSegment,$navBarItem){
			if(strcasecmp($navBarItem, $urlSegment) == 0 ){
				return "navbar_item_selected";
			}
			
			return "navbar_item";
		}
	 ?>
	<script type="text/javascript">
	function smartAddFavorite(){
		AddFavorite('http://www.woyouxi.net','我游戏网');
	}
	</script>
	<style type="text/css">
.ie6fixedTL{_position:absolute;_left:expression(eval(document.documentElement.scrollLeft));_top:expression(eval(document.documentElement.scrollTop))}
</style>
	<body style="margin:0px;padding:0px;background:#daf0fe url(http://youxires.oss.aliyuncs.com/website/themes/hzw/body-bg.jpg) no-repeat center 0px;color:#666;background-attachment: fixed;">
		<div id="top" class="top_bar_hzw ie6fixedTL">
			<div class="div_full_row">
				<div style="float:left;">
					<a style="height:30px;line-height:30px;color:#666" href="/">欢迎来到我游戏网, 最全的小游戏中心</a>
				</div>
				<div style="float:right;">
					<a style="height:30px;line-height:30px;color:#f60" href="/site/new/1.html">最新小游戏</a>
					&nbsp;&nbsp;&nbsp;
					<a style="height:30px;line-height:30px;color:#f60" href="/site/top">游戏风云版</a>
					&nbsp;&nbsp;&nbsp;
					<a style="height:30px;line-height:30px;color:#f60" href="/search">搜索游戏</a>
					&nbsp;&nbsp;&nbsp;
					<a style="height:30px;line-height:30px;color:#666" href="/about/advise">反馈意见</a>
					&nbsp;&nbsp;&nbsp;
					<a style="height:30px;line-height:30px;color:#666" href="/">返回主页</a>
					&nbsp;&nbsp;&nbsp;
					<a style="height:30px;line-height:30px;color:#666" href="javascript:smartAddFavorite();">添加到收藏夹</a>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="height:30px;"></div>
		<div class="top" style="display:none;" id="swhead">
			<div style="margin-top:12px;float:left;">
				<img src="http://youxires.bj.bcebos.com/web/sw/sw_logo.jpg" alt=""></img>
			</div>
			<div style="margin-left:0px;float:right;width:260px" id="swbanneradvleft">
				<a target="_blank" href="http://rz.kedou.com/">
					<img class="fixie_border_img" src="http://youxires.oss-cn-hangzhou.aliyuncs.com/adv/img/top_banner_right.jpg"></img>
				</a>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="top" style="display:none;" id="wyhead">
			<div style="margin-top:12px;float:left;">
				<img src="/game/assets/img/game_logo.png" alt=""></img>
			</div>
			<div style="clear:both;"></div>
		</div>
		<?php //} ?>
		<script type="text/javascript">
		document.getElementById("wyhead").style.display = "block";
		</script>
		
	
		<!-- 菜单 -->
		<div style="clear:both"></div>
		<div class="navbar_div" style="height:<?php echo $menuHeight; ?>px;margin-top:0px;padding:0px;">
			<div class="top_first_banner" style="height:40px;margin-top:0px;margin-bottom:0px;padding:0px;">
				<ul class="navbar_ul" style="">
					<?php foreach($columnArr as $column) { ?>
					<li class="<?php echo getNavBarClassName($firstSegment,$secondSegment,$column['catalogname']); ?>">
						<a href="/<?php echo $column['urlname']; ?>"><?php echo $column['name']; ?></a>
					</li>
					<?php } ?>
					<li class="<?php echo getNavBarClassNameByFirst($firstSegment,"video"); ?>" style="width:80px;">
						<a style="width:80px;background-position: -43px -120px;" href="/video">动漫视频</a>
					</li>
					<li class="navbar_item" style="width:80px;">
						<a target="_blank" style="width:80px;background-position: -43px -120px;" href="http://www.woxiu.com/jump.html?p=20119186&from=offsite&wp=1&sid=xxxooo">美女直播</a>
					</li>
					<li class="navbar_item" style="width:80px;">
						<a target="_blank" style="width:80px;font-weight:bold;background-position: -43px -120px;" href="http://www.huanlehui.net">开怀大笑</a>
					</li>
					<div style="clear:both"></div>
				</ul>
			</div>
		</div>
		
		<?php echo $content; ?>
		
		<?php require_once 'component/foot.php'; ?>
	</body>
</html>