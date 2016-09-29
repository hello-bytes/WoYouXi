<?php if($video == null) { gotoerrorpage(); return; } ?>

<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/common.php'; ?>

<?php $currentvideoid = $_GET['videoid']; ?>

<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;">
	<div style="height:35px;width:100%;border-bottom:1px solid #cfe1ef;padding-left:10px;">
		<span style="font-size:20px;font-weight:bold;float:left;"><?php echo $video["title"]; ?></span>
		<div style="float:right;width:200px">
		<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
		</div>
	</div>
	<?php
		$displayWidth = 670;
		$displayHeight = 502;
		/*$displayWidth = $gamemeta["width"];
		$displayHeight = $gamemeta["height"];
		if($displayWidth > 0 && $displayHeight > 0){
			$displayHeight = (640 * $displayHeight) / $displayWidth;
			$displayWidth = 640;
		}else if($displayWidth == 0 || $displayHeight == 0){
			$displayWidth = 640;
			$displayHeight = 480;
		}(*/
		$playurl = "http://player.56.com/3000004030/open_" . $video['vid'] . ".swf"; 
	 ?>
	<div>
		<div style="width:670px;float:left;border-right:1px solid #cfe1ef;" id="woyouxi_game_wrap">
			<div style="position:relative;margin:0px auto 0px auto;width:<?php echo $displayWidth; ?>px;height:<?php echo $displayHeight; ?>px;" id="woyouxi_game_content">
				<embed src='<?php echo $playurl; ?>' 
				type='application/x-shockwave-flash' 
				allowFullScreen='true' 
				width='100%' height='100%' allowNetworking='all' wmode='opaque' allowScriptAccess='always'></embed>
			</div>
		</div>
		<div style="float:right;width:309px;height:100%;overflow:hidden;" id="woyouxi_game_right">
			<div style="height:48px;border-top:0px solid #cfe1ef;padding:0px;margin:0px;">
				<ul style="list-style: none;padding:0px;margin:0px;">
					<li id="modtab1" class="modtab modtab_current" style="width:103px;" onclick="onTabClick('modtab1','tabcontent1');">
						<span class="tabs_txt">相关视频</span>
					</li>
					<li id="modtab2" class="modtab" style="width:103px;" onclick="onTabClick('modtab2','tabcontent2');">
						<span class="tabs_txt">热门视频</span>
					</li>
					<li id="modtab3" class="modtab" style="width:103px;" onclick="onTabClick('modtab3','tabcontent3');">
						<span class="tabs_txt">相关游戏</span>
					</li>
				</ul>
			</div>
			<div style="height:445px;width:100%;position:relative;border-top:0px solid #cfe1ef;padding:0px;margin:0px;">
				<div id="tabcontent1" style="display:block;position:absolute;top:0px;left:0px;">
				<?php require "game/protected/views/uiparts/relativevideo.php"; ?>
				</div>
				<div id="tabcontent2" style="display:none;position:absolute;top:0px;left:0px;">
				<?php $tempRelativeVideos = $relativevideos; $relativevideos = $topvideo; ?>
				<?php require "game/protected/views/uiparts/relativevideo.php"; ?>
				<?php $relativevideos = $tempRelativeVideos; ?>
				</div>
				<div id="tabcontent3" style="display:none;position:absolute;top:0px;left:0px;">
				<?php require_once "game/protected/views/uiparts/relativegames.php"; ?>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<?php
function getVideoCurrentPage(){
	if(array_key_exists("page", $_GET)){
		return $_GET['page'];
	}
	return 1;
} 
?>

<script src="/game/assets/js/page.js" type="text/javascript"></script>
<script type="text/javascript">
	var pg = new showPages('pg');
	pg.pageCount = <?php echo $pageinfo['pagecount']; ?>;  // 定义总页数(必要)
	pg.getPage();
	g_currentPage = pg.page;
</script>
<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;">
	<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
		<div>
			<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">专辑内其它视频:</span>
			<span style="font: 300 15px/30px microsoft yahei,arial;padding:0px 19px;height:36px;float: right;color: #4e4e4e;">第<?php echo getVideoCurrentPage(); ?>页,共<?php echo $pageinfo['pagecount']; ?>页</span>
			<div style="clear:both;"></div>
		</div>
		<div>
			<?php if($relativevideos == null || count($relativevideos) == 0){ ?>
			<div style="margin-left:10px;"><p style="font-size:14px;color:#000;">没有找到其它视频！</p></div>
			<?php }else{ ?>
			<div style="width:100%;">
			<ul style="list-style:none;margin:0px;padding:0px 0px 0px 11px;">
			<?php foreach($relativevideos as $relativevideo){ ?>
			<li style="float:left;margin:0px 10px 8px 10px;list-style:none;">
				<div style="position:relative;width:140px;height:115px;text-align:center;">
					<div style="border:1px solid #ddd;<?php if($relativevideo['id'] == $currentvideoid){ echo "background:#1389DF;"; } ?>" class="movieborder">
						<a href="/video/<?php echo $relativevideo['id']; ?>.html">
							<img class="fixie_border_img" style="width:130px;height:78px;padding-top:5px;" data="<?php echo $relativevideo['image_url']; ?>" alt="<?php echo $relativevideo['title']; ?>"></img>
						</a>
					</div>				
					<a class="link_gray" href="/video/<?php echo $relativevideo['id']; ?>.html"><p style="padding:0px;margin:0px;overflow:hidden;height:30px;line-height:30px;"><?php echo $relativevideo['title']; ?></p></a>
				</div>
			</li>
			<?php } ?>
			<div style="clear:both;"></div>
			<?php } ?>
			</ul>
			</div>
			<div style="width:100%;margin-bottom:10px;text-align:center">
				<script type="text/javascript">
				var baseUrl = pg.createBaseUrl();
				pg.printHtml(baseUrl);
				</script>
			</div>
		</div>
	</div>
</div>

<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;">
	<div style="padding:10px;">
		<p class="game_introduce_title" style="margin:0px;padding:0px;">视频简介:</p>
		<p style="font-size:14px;"><?php echo $video['descript'] ?></p>
	</div>
</div>

<div class="div_full_row" style="background:#fff;padding:0px 10px 0px 10px;width:958px;margin-top:10px;border:solid 1px #cfe1ef;">
<!-- Duoshuo Comment BEGIN -->
<div class="ds-thread" data-thread-key="<?php echo "56video_" . $video['vid']; ?>" data-title="<?php echo $video['title']; ?>" data-image="<?php echo $video['image_url']; ?>"></div>
<script type="text/javascript">
var duoshuoQuery = {short_name:"woyouxi"};
(function() {
	var ds = document.createElement('script');
	ds.type = 'text/javascript';ds.async = true;
	ds.src = 'http://static.duoshuo.com/embed.js';
	ds.charset = 'UTF-8';
	(document.getElementsByTagName('head')[0] 
	|| document.getElementsByTagName('body')[0]).appendChild(ds);
})();
</script>
<!-- Duoshuo Comment END -->
</div>

<script type="text/javascript">
var url = "/log/videolog?videoid=" + getQueryStringByName("videoid");
request(url,function(responseText){
});
</script>