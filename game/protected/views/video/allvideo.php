<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/common.php'; ?>
<?php require_once 'game/protected/utils/page.php'; ?>

<?php
function getTopCss($currentid,$pageid){
	if($currentid == $pageid){
		return "about_link_selected";
	}else{
		return "about_link";
	}
}
function getTopTabCss($day){
	$queryDay = 1;
	if(array_key_exists("day", $_GET)){
		$queryDay = intval($_GET['day']);
	}
	
	if($queryDay == $day){
		return "toptab toptab_select";
	}
	return "toptab";
}
function getTopData($pageid,$alldata){
	$queryDay = 1;
	if(array_key_exists("day", $_GET)){
		$queryDay = intval($_GET['day']);
	}
}
function getGameTime($time){
	$phptime = strtotime($time);
	return date("Y-m-d",$phptime);
}

function getCurrentVideoTag($currentid,$tags){
	foreach ($tags as $tag){
		if($tag['id'] == $currentid){
			return $tag; 
		}
	}
	return null;
}
?>

<script src="/game/assets/js/page.js" type="text/javascript"></script>

<div class="div_full_row" style="margin-top:10px;">
	<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
		<div>
			<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">热播视频</span>
			<div style="clear:both;"></div>
		</div>
		<div style="overflow:hidden;padding:5px 10px 10px 18px;">
			<span style="font-size:14px;">我们为您收集了目前网络上火得发黑的动画，动漫，游戏视频等。</span>
		</div>
	</div>
</div>

<div class="div_full_row_transparent" style="margin-top:10px;">
	<div style="float:left;width:188px;border:solid 1px #ccc;border-bottom:0px;background:#fff;">
		<ul style="padding:0px;margin:0px;">
			<?php foreach( $videotags as $videotag ) { ?>
			<li style="list-style:none;padding:0px;margin:0px;">
				<div style="height:45px;border-bottom:solid 1px #ccc;text-align:center;">
					<a href="/video/showall/<?php echo $videotag["id"]; ?>.html" class="<?php echo getTopCss($videotag["id"],$currentvideoid); ?>" style="display:inline-block;line-height:45px;height:45px;" href="#"><?php echo $videotag['name']; ?></a>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
	
	<?php $currenttag = getCurrentVideoTag($currentvideoid,$videotags); ?>

	<div style="float:left;margin-left:12px;width:770px;background:#fff;border:solid 1px #ccc;">
		<div class="rank-list-box" style="padding-top:0px;">
			<div style="height:40px;border-bottom:solid 1px #ccc;">
				<div style="float:left;margin:0px;padding-left:15px;">
					<span style="display:inline-block;height:40px;line-height:40px;font-size:16px;color:#000;"><?php echo $currenttag['name']; ?></span>
				</div>
				<div style="float:right;padding-right:15px;">
				<span style="display:inline-block;height:40px;line-height:40px;font-size:13px;color:#000;">共有<?php echo $pageinfo['totalcount']; ?>个视频，分<?php echo $pageinfo['pagecount']; ?>页显示</span>
				</div>
				<div style="clear:both;"></div>
			</div>
			
			<ul style="list-style:none;margin:0px;padding:10px 0px 0px 11px;">
			<?php $maxcount = count($pagedata) > 52 ? 52 : count($pagedata); ?>
			<?php for($index = 0;$index < $maxcount; $index++){ ?>
			<?php $item = $pagedata[$index]; ?>
			
			<li style="float:left;margin:0px 13px 13px 13px;list-style:none;">
				<div style="position:relative;width:160px;height:127px;text-align:center;">
					<div style="border:1px solid #ddd;" class="movieborder">
						<a href="/video/<?php echo $item['id']; ?>.html">
							<img class="fixie_border_img" style="width:150px;height:90px;padding-top:5px;" data="<?php echo $item['image_url']; ?>" alt="<?php echo $item['title']; ?>"></img>
						</a>
					</div>				
					<a class="link_gray" href="/video/<?php echo $item['id']; ?>.html"><p style="padding:0px;margin:0px;overflow:hidden;height:30px;line-height:30px;"><?php echo $item['title']; ?></p></a>
				</div>
			</li>
			<?php } ?>
			<div style="clear:both;"></div>
			</ul>
			<div style="clear:both;"></div>
			<div style="text-align:center;margin-bottom:10px;margin-top:10px;">
				<?php
				$pager = new HtmlPage();
				$pager->setStaticMode(true);
				$pager->setPageInfo($pageinfo['pagecount']);
				echo $pager->printHtml("/video/showall/" . $_GET["videotagid"] . "/");  
				 ?>
				<script type="text/javascript">
				//var baseUrl = pg.createBaseUrl();
				//pg.printHtml(baseUrl);
				</script>
			</div>
			
		</div>
	</div>
	<div style="clear:both;"></div>
</div>