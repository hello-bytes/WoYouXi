<?php require_once 'game/protected/utils/common.php'; ?>
<script src="/game/assets/js/page.js" type="text/javascript"></script>
<?php if($pageinfo != null){ ?>
<script type="text/javascript">
	var pg = new showPages('pg');
	pg.pageCount = <?php echo $pageinfo['pagecount']; ?>;  // 定义总页数(必要)
	pg.getPage();
	g_currentPage = pg.page;
</script>
<?php } ?>
<?php 
function getGameTime($time){
	$phptime = strtotime($time);
	return date("Y-m-d",$phptime);
}
?>

<div style="margin-top:10px;background:#fff;border:solid 1px #ccc;" class="div_full_row_transparent" >
	<form method="get" style="margin-left:20px;margin-top:20px;margin-bottom:20px;">
		<div class="searchedit" style="float:left;padding:0px;margin:0px;">
			<input id="text" name="text" tabindex="0" class="input_key" value="<?php echo $searchtext; ?>" maxlength="80" />
		</div>
		&nbsp;
      	<input type="submit" value="搜索一下" class="s_btn" style="padding:0px;margin:0px;"/>
		
		<span style="display:inline-block;margin-left:20px;height:30px;line-height:30px;">热搜：</span>
		<?php foreach($hotsearchbartext as $barText){ ?>
		<a href="<?php echo $barText['url']; ?>"><span style="display:inline-block;cursor:pointer;margin-left:5px;height:30px;line-height:30px;"><?php echo $barText['text']; ?></span></a>
		<?php } ?>
		<div style="clear:both;"></div>
	</form>
	
	<div style="margin-top:20px;">
		<div style="float:left;width:680px">
			<?php if($pagedata == null || count($pagedata) == 0){ ?>
			<?php $pagedata = $newgame; ?>
			<div style="padding:0px;margin:0px 0px 0px 20px;">
				<?php if($searchtext == null || strlen($searchtext) == 0){ ?>
				<p style="color:#f00;font-size:16px;">您可以在输入框中输入您想要的游戏名称进行搜索，以下是是我们最近为您精挑细选的游戏：</p>
				<?php }else{ ?>
				<p style="color:#f00;font-size:16px;"><span style="font-weight:bold;">没有找到您想要的游戏，</span><span style="color:#000;">我们为您推荐以下新游戏，这些游戏都是我们精挑细选的：</span></p>
				<?php } ?>				
			</div>
			<?php } ?>
			<ul style="list-style:none;padding:0px;margin:0px 0px 0px 20px;">
				<?php foreach($pagedata as $pageitem){ ?>
				<li style="display:block;height:90px;padding:10px 0px 10px 0px;border-bottom: 1px dotted #ccc;">
					<a target="_blank" href="/game/index?gameid=<?php echo $pageitem["gameid"] == null ? $pageitem["id"] : $pageitem["gameid"]; ?>" class="img_app_link" title="<?php  echo $pageitem["name"]; ?>">
						<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" data="<?php  echo converResUrl($pageitem["gicon"]); ?>" width="76px" height="77px" alt="<?php echo $pageitem["name"]; ?>">
					</a>
					<div style="float:left;width:570px;">
						<div>
							<a target="_blank" href="/game/index?gameid=<?php echo $pageitem["gameid"] == null ? $pageitem["id"] : $pageitem["gameid"]; ?>" style="overflow: hidden;margin:0px;padding:0px;display:inline-block;float:left;"><?php  echo $pageitem["name"]; ?></a>
							<span style="float:left;padding-left:30px;">时间：<?php echo getGameTime($pageitem["create_time"]); ?></span>
							<div style="clear:both;"></div>
						</div>
						<div style="height:37px;overflow:hidden;">
							<span><?php echo strlen($pageitem["introduce"]) == 0 ? "暂无介绍" : $pageitem["introduce"]; ?></span>
						</div>
						<div style="height:20px;overflow:hidden;">
							<span style="height:20px;line-height:20px;">游戏次数：<?php echo $pageitem["playcount"]; ?></span>
						</div>
					</div>
					<div style="clear:both;"></div>
				</li>
				<?php } ?>
				<div style="clear:both;"></div>
			</ul>
			<?php if($pageinfo != null){ ?>
			<div style="text-align:center;margin-top:20px;margin-bottom:20px;">
				<script type="text/javascript">
				var baseUrl = pg.createBaseUrl();
				pg.printHtml(baseUrl);
				</script>
			</div>
			<?php } ?>
		</div>
		<div style="float:left;margin-left:10px;width:290px">
			<div class="gamebox" style="height:840px;width:200px;margin-left:60px;border:solid 1px #ccc;overflow:hidden;">
				<div style="height:30px;overflow:hidden;border-bottom:solid 1px #ccc;">
					<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;height:36px;float:left;color: #4e4e4e;margin-top:-1px;">最火游戏</span>
					<div style="clear:both;"></div>
				</div>
				<div style="overflow:hidden;">
					<ul class="game_piclist" style="height:800px;overflow:hidden;">
					<?php $max = count($newtopgame) > 12 ? 12 : count($newtopgame); ?>
					<?php for($i = 0;$i < $max;$i++){ ?>
					<li style="padding: 9px 0px 8px 0px;width:88px;<?php if( ($i + 1) % 2 == 0 ){ echo "padding-right: 0;"; } ?>">
						<a class="link_black" target="_blank" href="/game/index?gameid=<?php echo $newtopgame[$i]['id']; ?>" title="<?php echo $newtopgame[$i]['name']; ?>">
							<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $newtopgame[$i]['name']; ?>" data="<?php echo converResUrl($newtopgame[$i]['gicon']); ?>">
							<span class="game-txt"><?php echo $newtopgame[$i]['name']; ?></span>
						</a>
					</li>
					<?php } ?>
					</ul>
				</div>
			</div>
			
			<div class="gamebox" style="width:200px;margin-left:60px;margin-top:20px;border:solid 1px #ccc;overflow:hidden;">
				<div style="height:30px;overflow:hidden;border-bottom:solid 1px #ccc;">
					<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;height:30px;float: left;color: #4e4e4e;margin-top:-1px;">热搜排行榜</span>
					<div style="clear:both;"></div>
				</div>
				
				<div style="overflow:hidden;">
					<ul class="searchtext-list" style="overflow:hidden;list-style:none;padding:0px 0px 0px 10px;margin:0px;">
						<?php $index = 1; ?>
						<?php foreach($hotsearchtext as $searchtext) { ?>
						<li style="position:relative;height:25px;line-height:25px;border-bottom: 1px dotted #ccc;">
							<span style="display:inline-block;width:20px;"><?php echo $index; ?></span>
							<a href="<?php echo $searchtext['url']; ?>"><span><?php echo $searchtext['text']; ?></span></a>
						</li>
						<?php $index++; ?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>	
</div>