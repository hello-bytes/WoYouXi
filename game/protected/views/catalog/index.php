<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/page.php'; ?>

<?php
function getCatalogCurrentPage(){
	if(array_key_exists("page", $_GET)){
		return $_GET['page'];
	}
	return 1;
} 
 
function getSubjectUrl($id,$catalogname)
{
	$url = $_SERVER['REQUEST_URI'];
	$pos = strpos($url, "?");
	if($pos === false){
		
	}else{
		$url = substr($url, 0, $pos);	
	}
	$url = str_replace("/catalog", "", $url);
	//return $url .  "/subject/" . $id . "_0.html";
	return "/" . $catalogname .  "/subject/" . $id . "_0.html";
	 
	//return "/subject/" .$id . "_0.html";
}

function getOrder($catalogname,$order)
{
	if($order > 0){
		return "/" . $catalogname . "/" . $order . "_1.html";		
	}
	return "/catalog/" . $catalogname . "";
}

function getOrderVal()
{
	if(array_key_exists("order", $_GET)){
		return intval($_GET['order']);
	}else{
		return 0;
	}
}

function getOrderCss($order){
	if( key_exists("order", $_GET) ){
		if($_GET["order"] == $order){
			return "catalogtab_select";
		}else{
			return "catalogtab";
		}
	}
	return $order == 0 ? "catalogtab_select" : "catalogtab";
}
?>

<script type="text/javascript">
function showMoreSubject(){
	//alert("te");
	var obj = document.getElementById("subjectContainer");
	if(obj != null){
		obj.style.height ="auto";
	}
	var moreObj = document.getElementById("moreSubjectLi");
	if(moreObj != null){
		moreObj.parentNode.removeChild(moreObj);
	}
}
</script>

<div style="border:solid 1px #eee;margin-top:10px;height:90px;" class="div_full_row">
<script type="text/javascript"><?php echo getAdvJs(7); ?></script>
</div>


<?php require_once 'game/protected/views/uiparts/xiao_adv_tu.php'; ?>

<div style="margin-top:10px;border:solid 1px #C8DFF0;height:90px" class="div_full_row">
<script type="text/javascript"><?php echo getAdvJs(8); ?></script>
</div>

<?php if($showsubject == 1){ ?>
<div style="border:solid 1px #c8dff0;margin-top:10px;" class="div_full_row">
	<div>
		<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:30px;float: left;color: #4e4e4e;margin-top:-1px;">本类游戏专题</span>
		<div style="clear:both;"></div>
	</div>
	<?php $subjectItemIndex = 0; ?>
	<div id="subjectContainer" style="background:#fff;position:relative;<?php if(count($subjects) >= 25) echo "height:94px;" ?>overflow:hidden;">
		<ul class="subject_list" style="padding-top:0px;">
		<?php foreach($subjects as $subject) { ?>
		<?php $subjectItemIndex++; ?>
		<?php if($subjectItemIndex == 24 && count($subjects) >= 25){ ?>
		<li id="moreSubjectLi" style="background:none;padding-left:0px;padding-top:3px;">
			<a style="height:30px;width:97px;overflow:hidden;display:block;" href="javascript:showMoreSubject();">
				<img class="fixie_border_img" data="/game/assets/img/more_subject.gif"></img>
			</a>
		</li>
		<?php } ?>
		<?php if(strlen($subject['name']) > 0) { ?>
		<li>
			<a class="link_black" style="height:30px;width:97px;overflow:hidden;display:block;" href="<?php echo getSubjectUrl($subject['id'],$catalogname); ?>"><?php echo $subject['name']; ?></a>
		</li>
		<?php } ?>
		<?php } ?>
		</ul>
	</div>
</div>
<?php } ?>


<div style="margin-top:10px;border:1px solid #c8dff0;" class="div_full_row">
<script type="text/javascript"><?php echo getAdvJs(9); ?></script>
</div>


<div style="margin-top:10px;" class="div_full_row_transparent">
	<div style="float:left;width:671px;border:solid 1px #F2F2F2;background:#fff;">
		<div style="width:671px;background:#fff;">
			<div style="float:left;margin-top:-1px;height:32px;line-height:32px;border-top:2px solid #ccc;">
				<div class="<?php echo getOrderCss(0); ?>">
					<a style="color:#4E4E4E;font-size:14px;font-weight:bold;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="<?php echo getOrder($catalogname,0); ?>">最近更新</a>
				</div>
				<div class="<?php echo getOrderCss(1); ?>">
					<a style="color:#4E4E4E;font-size:14px;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="<?php echo getOrder($catalogname,1); ?>">最多人玩</a>
				</div>
			</div>
			<div style="float:right;margin-top:-1px;height:32px;line-height:32px;">
			<span style="color:#4E4E4E;font-size:14px;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="<?php echo getOrder($catalogname,1); ?>">第<?php echo getCatalogCurrentPage(); ?>页，共<?php echo $pageinfo['pagecount']; ?>页</span>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div>
			<ul class="game_piclist">
			<?php $totalCount = 336 > count($games) ? count($games) : 336 ?>
			<?php for($i = 0;$i < $totalCount;$i++){ ?>
			<li style="<?php if( ($i + 1) % 7 == 0 ){ echo "padding-right: 0;"; } else { echo "padding-right: 3px;"; }  ?>">
				<a target="_blank" class="link_black" href="<?php echo "/game/" . $games[$i]['id']; ?>.html" title="<?php echo $games[$i]['name']; ?>">
					<img width="76" height="77" class="fixie_border_img" errorimg="/game/assets/img/nogameicon.png" alt="<?php echo $games[$i]['name']; ?>" data="<?php echo converResUrl($games[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $games[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
		<div style="text-align:center">
		<?php
		$pager = new HtmlPage();
		$pager->setStaticMode(true);
		//echo $pager->getPage();
		$pager->setPageInfo($pageinfo['pagecount']);
		echo $pager->printHtml("/" . $catalogname . "/" . getOrderVal() . "_"); 
		?>
		</div>
		</div>
	</div>
	<div style="float:right;width:290px;border:solid 1px #c8dff0;background:#fff;">
		<div style="height:33px;border-top:0px solid #cfe1ef;padding:0px;margin:0px;">
			<ul style="list-style: none;padding:0px;margin:0px;">
				<li id="modtab1" class="modtab modtab_current" style="width:96px;height:30px;" onclick="onTabClick('modtab1','tabcontent1');">
					<span class="tabs_txt" style="margin-top:5px;">本周排行版</span>
				</li>
				<li id="modtab2" class="modtab" style="width:96px;border-left:1px solid #ccc;height:30px;" onclick="onTabClick('modtab2','tabcontent2');">
					<span class="tabs_txt" style="margin-top:5px;">本月排行版</span>
				</li>
				<li id="modtab3" class="modtab" style="width:96px;border-left:1px solid #ccc;height:30px;" onclick="onTabClick('modtab3','tabcontent3');">
					<span class="tabs_txt" style="margin-top:5px;">游戏总版单</span>
				</li>
			</ul>
		</div>
		<div style="position:relative;padding:0px;margin:0px;border:0px solid #c8dff0;border-top:0px;height:2460px;">
			<div id="tabcontent1" style="display:block;position:absolute;top:0px;left:1px;width:290px;">
				<ul class="rank-list">
					<?php $maxcount = count($weekgames) > 30 ? 30 : count($weekgames); ?>
					<?php for( $index = 0;$index < $maxcount;$index++ ){ ?>
					<?php $currentGame =  $weekgames[$index] ;?>
					<?php //for($i = 1;$i < 31;$i++){ ?>
					<li style="padding: 9px 9px 9px 9px;">
						<a href="/game/<?php echo $currentGame['id']; ?>.html" class="img_app_link" title="<?php echo $currentGame['name']; ?>"><img class="fixie_border_img" errorimg="/game/assets/img/nogameicon.png" src="<?php echo converResUrl($currentGame['gicon']); ?>" width="60" height="60" alt="<?php echo $currentGame['name']; ?>"><span class="img_app_60_2"></span></a>
						<div style="float:left;margin-top:10px;width:194px;">
							<a href="/game/<?php echo $currentGame['id']; ?>.html" class="link_black" style="overflow: hidden;margin:0px;padding:0px;height:20px;line-height:20px;display:block;"><span><?php echo $currentGame['name']; ?></span></a>
							<span><?php echo $currentGame['playcount']; ?>&nbsp;次</span>
						</div>
						<div style="clear:both;"></div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div id="tabcontent2" style="display:none;position:absolute;top:0px;left:1px;">
				<ul class="rank-list">
					<?php $maxcount = count($monthgames) > 30 ? 30 : count($monthgames); ?>
					<?php for( $index = 0;$index < $maxcount;$index++ ){ ?>
					<?php $currentGame =  $monthgames[$index] ;?>
					<?php //for($i = 1;$i < 31;$i++){ ?>
					<li style="padding: 9px 9px 9px 9px;">
						<a href="/game/<?php echo $currentGame['id']; ?>.html" class="img_app_link" title="<?php echo $currentGame['name']; ?>"><img class="fixie_border_img" errorimg="/game/assets/img/nogameicon.png" src="<?php echo converResUrl($currentGame['gicon']); ?>" width="60" height="60" alt="<?php echo $currentGame['name']; ?>"><span class="img_app_60_2"></span></a>
						<div style="float:left;margin-top:10px;width:194px;">
							<a href="/game/<?php echo $currentGame['id']; ?>.html" class="link_black" style="overflow: hidden;margin:0px;padding:0px;height:20px;line-height:20px;display:block;"><span><?php echo $currentGame['name']; ?></span></a>
							<span><?php echo $currentGame['playcount']; ?>&nbsp;次</span>
						</div>
						<div style="clear:both;"></div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div id="tabcontent3" style="display:none;position:absolute;top:0px;left:1px;">
				<ul class="rank-list">
					<?php $maxcount = count($topgames) > 30 ? 30 : count($topgames); ?>
					<?php for( $index = 0;$index < $maxcount;$index++ ){ ?>
					<?php $currentGame =  $topgames[$index] ;?>
					<?php //for($i = 1;$i < 31;$i++){ ?>
					<li style="padding: 9px 9px 9px 9px;">
						<a href="/game/<?php echo $currentGame['id']; ?>.html" class="img_app_link" title="<?php echo $currentGame['name']; ?>"><img class="fixie_border_img" errorimg="/game/assets/img/nogameicon.png" src="<?php echo converResUrl($currentGame['gicon']); ?>" width="60" height="60" alt="<?php echo $currentGame['name']; ?>"><span class="img_app_60_2"></span></a>
						<div style="float:left;margin-top:10px;width:194px;">
							<a href="/game/<?php echo $currentGame['id']; ?>.html" class="link_black" style="overflow: hidden;margin:0px;padding:0px;height:20px;line-height:20px;display:block;"><span><?php echo $currentGame['name']; ?></span></a>
							<span><?php echo $currentGame['playcount']; ?>&nbsp;次</span>
						</div>
						<div style="clear:both;"></div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>



<?php 

//subject.gif

