<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/page.php'; ?>

<?php 

function getOrder($order)
{
	$url = $_SERVER['REQUEST_URI'];
	$result = explode("/",$url);
	if($result != null && count($result) > 0){
		return "/" . $result[1] . "/subject/" . $_GET["subjectid"] . "_" . $order . ".html";
	}
	return "";
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

function getPageBase()
{
	$order = 0;
	if(array_key_exists("order", $_GET)){
		$order = intval($_GET['order']);
	}
	
	$url = $_SERVER['REQUEST_URI'];
	$result = explode("/",$url);
	//print_r($result);
	if($result != null && count($result) > 0){
		return "/" . $result[1] . "/subject/" . $_GET["subjectid"] . "_" . $order . "/";
	}
	return "";
}


?>

<div style="border:solid 1px #eee;margin-top:10px;height:90px;" class="div_full_row">
<script type="text/javascript"><?php echo getAdvJs(10); ?></script>
</div>

<?php require_once 'game/protected/views/uiparts/xiao_adv_tu.php'; ?>

<div style="margin-top:10px;border:solid 1px #c8dff0;background:#fff;" class="div_full_row">
	<div style="line-height:30px;padding:5px;background:#fff">
		<span style="font-size:18px;font-weight:bold;"><?php echo $subject['name']; ?>小游戏专题:</span>
		<span style="font-size:14px;"><?php echo $subject['descript']; ?></span>
	</div>
</div>


<div style="margin-top:10px;border:1px solid #c8dff0;height:90px;" class="div_full_row">
<script type="text/javascript"><?php echo getAdvJs(11); ?></script>
</div>


<?php
function getSubjectCurrentPage(){
	if(array_key_exists("page", $_GET)){
		return $_GET['page'];
	}
	return 1;
} 
?>

<div style="margin-top:10px;" class="div_full_row_transparent">
	<div style="float:left;width:671px;border:solid 1px #c8dff0;background:#fff;">
		<div style="width:671px;background:#fff;">
			<div style="float:left;margin-top:-1px;height:32px;line-height:32px;border-top:2px solid #ccc;">
				<div class="<?php echo getOrderCss(0); ?>">
					<a style="color:#4E4E4E;font-size:14px;font-weight:bold;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="<?php echo getOrder(0); ?>">最近更新</a>
				</div>
				<div class="<?php echo getOrderCss(1); ?>">
					<a style="color:#4E4E4E;font-size:14px;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="<?php echo getOrder(1); ?>">最多人玩</a>
				</div>
			</div>
			<div style="float:right;margin-top:-1px;height:32px;line-height:32px;">
				<span style="color:#4E4E4E;font-size:14px;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="<?php echo getOrder(1); ?>">第<?php echo getSubjectCurrentPage(); ?>页，共<?php echo $pageinfo['pagecount']; ?>页</span>
			</div>
			<div style="clear:both;"></div>
		</div>
		<div>
			<ul class="game_piclist">
			<?php $i = 1 ?>
			<?php foreach($games as $game){ ?>
			<?php //for($i = 1;$i < 7 * 48+1;$i++){ ?>
			<li style="<?php if( ($i + 1) % 7 == 0 ){ echo "padding-right: 0;"; } else { echo "padding-right: 3px;"; }  ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $game['id']; ?>.html" title="<?php echo $game['name']; ?>">
					<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $game['name']; ?>" src="<?php echo converResUrl($game['gicon']); ?>">
					<span class="game-txt"><?php echo $game['name']; ?></span>
				</a>
			</li>
			<?php $i++; ?>
			<?php } ?>
			</ul>
			<div style="text-align:center">
				<?php
				$pager = new HtmlPage();
				$pager->setStaticMode(true);
				$pager->setPageInfo($pageinfo['pagecount']);
				echo $pager->printHtml(getPageBase());  
				 ?>
			</div>
		</div>
	</div>
	<div style="float:right;width:290px;border:solid 1px #c8dff0;">
		<div class="rank-tab-hzw">
				<span>最火&nbsp;</span><span style="font-size:16px;font-weight:bold;"><?php echo $subject['name']; ?></span><span>&nbsp;小游戏</span>
		</div>
		<div class="rank-list-box">
			<ul class="rank-list">
				<?php $index = 1; ?>
				<?php foreach($topgames as $game) { ?>
				<?php //for($i = 1;$i < 31;$i++){ ?>
				<li style="padding: 9px 9px 9px 9px;">
					<a href="/game/<?php echo $game['id']; ?>.html" target="_blank" class="img_app_link" title="<?php echo $game['name']; ?>"><img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" src="<?php echo converResUrl($game['gicon']); ?>" width="60" height="60" alt="<?php echo $game['name']; ?>"><span class="img_app_60_2"></span></a>
					<div style="float:left;margin-top:10px;width:165px;">
						<a href="/game/<?php echo $game['id']; ?>.html" target="_blank" class="link_black" style="overflow: hidden;margin:0px;padding:0px;height:20px;line-height:20px;display:block;"><span><?php echo $game['name']; ?></span></a>
						<span><?php echo $game['hotindex']; ?>&nbsp;次</span>
					</div>
					<div style="clear:both;"></div>
				</li>
				<?php $index++; ?>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>