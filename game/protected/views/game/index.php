<?php if($game == null) { gotoerrorpage(); return; } ?>
<?php require_once 'game/protected/utils/common.php'; ?>
<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>

<?php 
$catalogMap = new CatalogIdNameMap();
//$this->addCrumbItem($catalogInfo['name'], $catalogMap->getUrlById($catalogInfo["id"]));
?>
<div style="margin-top:10px;border: 1px solid #c8dff0;position: relative;background:#fff;" class="div_full_row">
	<div class="game_slide">
		<div style="height:225px;margin:10px auto;width: 300px;">
            <a target="_self" href="#">
            	<img class="fixie_border_img" width="300px" height="225px" data="<?php echo converResUrl($game['previewimageurl']); ?>" alt="<?php echo $game['name']; ?>">
			</a>
		</div>
		<?php if(CACHE_CMS == false){ ?>
		<div style="height:250px;margin:20px auto;width:300px;">
		<script type="text/javascript"><?php echo getAdvJs(19); ?></script>
		</div>
		<div style="margin-top:10px;height:250px;margin:20px auto;width: 300px;">
		<script type="text/javascript"><?php echo getAdvJs(20); ?></script>
		</div>
		<?php } ?>
	</div>
	
	<div class="game_main" style="overflow:hidden;">
		<div class="tit"><h1><?php echo $game['name']; ?></h1></div>
		<ul class="game_param">
            <li><strong class="icon">类型：</strong><a href="<?php echo $catalogMap->getUrlById($catalog["id"]); ?>" target="_blank"><?php echo $catalog['name']; ?></a></li>
            <li style="margin-left:16px;"><strong>大小：</strong><?php echo getSizeText($game['gsize']); ?></li>
            <li><strong>游戏次数：</strong><?php echo $game['playcount']; ?></li>        
            <div style="clear:both;"></div>
         </ul>
         <ul class="game_param">
            <li><strong>上线时间：</strong><?php echo $game['update_time']; ?></li>
            <li style="width:610px;"><strong>专题：</strong>
            	<?php if($gamesubjects != null){ ?>
            	<?php foreach($gamesubjects as $subject){ ?>
            	<a target="_blank" href="/catalog/<?php echo $catalogMap->getNameFromId($catalog["id"]); ?>?subjectid=<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></a>
            	<?php }} ?>
            </li>      
            <div style="clear:both;"></div>
         </ul>
         <div class="game_start" style="height:105px;overflow:hidden;">
         	<a class="gamestartbutton" target="_self" href="/game/play/<?php echo $game["id"]; ?>.html">开始游戏</a>
         	
         	<div style="float:right;">
         		<span style="float:left;font-size:12px;height:28px;line-height:28px;">发现了好玩的小游戏？快与小伙伴们分享吧：</span>
         		<div style="float:left;" class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
         	</div>
         </div>
         <div style="border-top: 1px dotted #ccc;margin-top:10px;overflow:hidden;">
         	<p class="game_introduce_title"><?php echo $game['name'] ?>游戏简介:</p>
         	<p style="font-size:14px;"><?php echo $game['introduce'] ?></p>
         </div>
         
         <div style="border-top: 1px dotted #ccc;margin-top:10px;overflow:hidden;">
         	<p class="game_introduce_title">如何开始:</p>
         	<p style="font-size:14px;"><?php echo $game['hottostart'] ?></p>
         </div>
         <div style="border-top: 1px dotted #ccc;margin-top:10px;overflow:hidden;">
         	<p class="game_introduce_title">操作说明:</p>
         	<p style="font-size:14px;"><?php echo $game['guide'] ?></p>
         </div>
         <div style="border-top: 1px dotted #ccc;margin-top:10px;overflow:hidden;">	
         	<p class="game_introduce_title">游戏目标:</p>
         	<p style="font-size:14px;"><?php echo $game['objective'] ?></p>
         </div>
	</div>
	<div style="clear:both;"></div>
</div>

<?php if(CACHE_CMS == false){ ?>
<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;">
</div>
<?php } ?>

<?php require_once "game/protected/views/uiparts/relativegame_bar.php"; ?>

<script type="text/javascript">
var url = "/log/gamelog?accesstype=1&gameid=" + getQueryStringByName("gameid");
request(url,function(responseText){
});
</script>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"我发现了一个好玩的游戏，大家快来速速转观","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

<div class="div_full_row" style="padding:10px;width:960px;">
<!-- Duoshuo Comment BEGIN -->
<div class="ds-thread" data-thread-key="<?php echo $game['id']; ?>" data-title="<?php echo $game['name']; ?>" data-image="<?php echo $game['gicon']; ?>"></div>
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
