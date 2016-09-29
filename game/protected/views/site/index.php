<?php 

require_once 'game/protected/config/cache/site.index.data.php';
require_once 'game/protected/utils/catalogidnamemap.php';

function getContentMargin($index)
{
	if($index % 2 == 0){
		return "margin-left:0px;";
	}
	return "margin-left:16px;";
}
?>

<div style="margin-top:10px;border:solid 1px #C8DFF0;" class="div_full_row">
	<?php $leftRowCount = 5;$rightRowCount = 5; ?>
	<div style="float:left;width:480px;background:#fff;" class="content">
		<?php $columnLineIndex = 0; ?>
		<?php for($index = 0;$index < $leftRowCount;$index++){ ?>
		<?php $columnline = $topCatalogs[$index] ?>
		<div class="column_line" style="<?php if($columnLineIndex % 2 != 0) echo "background:#F4FBFF;"; ?>">
			<div style="float:left;height:28px;line-height:28px;padding:0px;margin:0px;">
				<span class="column_line_head column_bk_<?php echo $columnline['style']; ?>">
					<a class="link_white" href="<?php echo $columnline['columnurl']; ?>"><?php echo $columnline['columnname'] ?></a>
				</span>
			</div>
			<div style="float:left;width:<?php echo $columnline['width']; ?>px;line-height:28px;height:28px;overflow:hidden;">
			<?php $subjectindex = 0; ?>
			<?php foreach($columnline['followdata'] as $columnFollowItem){ ?>
			<?php $subjectindex++; ?>
			<?php if($subjectindex > 19) break; ?>
			<a target="_blank" class="link_<?php if(strlen($columnFollowItem['color']) == 0) echo "black"; else echo $columnFollowItem['color']; ?>" style="margin-right:12px;" href="<?php echo $columnFollowItem['url']; ?>"><?php echo $columnFollowItem['name']; ?></a>
			<?php } ?>
			</div>
			<a target="_blank" style="line-height:28px;height:28px;float:right;margin-right:10px;" href="<?php echo $columnline['columnurl']; ?>" class="link_black">更多&gt;&gt;</a>
			<div style="clear:both;"></div>
		</div>
		<?php $columnLineIndex++; ?>
		<?php } ?>
	</div>
	<div style="margin-left:10px;float:left;width:480px;background:#fff;" class="content">
	<?php for($index = $leftRowCount;$index < $rightRowCount + $leftRowCount;$index++){ ?>
	<?php $columnline = $topCatalogs[$index] ?>
		<div style="float:left;height:28px;line-height:28px;padding:0px;margin:0px;">
				<span class="column_line_head column_bk_<?php echo $columnline['style']; ?>">
					<a class="link_white" href="<?php echo $columnline['columnurl']; ?>"><?php echo $columnline['columnname'] ?></a>
				</span>
			</div>
			<div style="float:left;width:<?php echo $columnline['width']; ?>px;line-height:28px;height:28px;overflow:hidden;">
			<?php $subjectindex = 0; ?>
			<?php foreach($columnline['followdata'] as $columnFollowItem){ ?>
			<?php $subjectindex++; ?>
			<?php if($subjectindex > 19) break; ?>
			<a target="_blank" class="link_<?php if(strlen($columnFollowItem['color']) == 0) echo "black"; else echo $columnFollowItem['color']; ?>" style="margin-right:12px;" href="<?php echo $columnFollowItem['url']; ?>"><?php echo $columnFollowItem['name']; ?></a>
			<?php } ?>
			</div>
			<a target="_blank" style="line-height:28px;height:28px;float:right;margin-right:10px;" href="<?php echo $columnline['columnurl']; ?>" class="link_black">更多&gt;&gt;</a>
			<div style="clear:both;"></div>
	<?php } ?>
	</div>
	<div style="float:left;width:970px;height:25px;background:#fff;" class="content">
		<?php $columnline = $topCatalogs[10] ?>
		<div style="float:left;height:28px;line-height:28px;padding:0px;margin:0px;">
				<span class="column_line_head column_bk_<?php echo $columnline['style']; ?>">
					<a class="link_white" href="<?php echo $columnline['columnurl']; ?>"><?php echo $columnline['columnname'] ?></a>
				</span>
			</div>
			<div style="float:left;width:<?php echo $columnline['width']; ?>px;line-height:28px;height:28px;overflow:hidden;">
			<?php $subjectindex = 0; ?>
			<?php foreach($columnline['followdata'] as $columnFollowItem){ ?>
			<?php $subjectindex++; ?>
			<?php if($subjectindex > 19) break; ?>
			<a class="link_<?php if(strlen($columnFollowItem['color']) == 0) echo "black"; else echo $columnFollowItem['color']; ?>" style="margin-right:12px;" href="<?php echo $columnFollowItem['url']; ?>"><?php echo $columnFollowItem['name']; ?></a>
			<?php } ?>
			</div>
			<a style="line-height:28px;height:28px;float:right;margin-right:10px;" href="<?php echo $columnline['columnurl']; ?>" class="link_black">更多&gt;&gt;</a>
			<div style="clear:both;"></div>
	</div>
	<div style="clear:both;"></div>
</div>

<?php $catalogMap = new CatalogIdNameMap(); ?>
<div style="margin-top:10px;" class="div_full_row_transparent">
	<div style="float:left;width:671px;_width:674px;border:solid 1px #c8dff0;background:#fff;">
		<div class="block_head" style="_height:26px;_overflow:hidden;padding-left:0px;">
			<div style="float:left;margin:0px;padding:0px;_height:26px;_width:200px;_overflow:hidden;">
				<div id="newhotgamelisttab" class="catalogtab_select">
					<a style="color:#4E4E4E;font-size:14px;font-weight:bold;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="javascript:shownewhotgame();">最多人玩</a>
				</div>
				<div id="hotgamelisttab" class="catalogtab">
					<a style="color:#4E4E4E;font-size:14px;display:inline-block;height:30px;line-height:30px;padding:0px 14px 0px 14px;" href="javascript:shownewgame();">最新游戏</a>
				</div>
			</div>
			<div style="float:right;margin-right:5px;padding:0px;_height:26px;_overflow:hidden;">
				<a target="_blank" href="/site/new">
				<span style="line-height:27px;">今日更新&nbsp;</span>
				<span style="line-height:27px;font-size:18px;font-weight:bold;color:#f00;"><?php echo $todayGameCount; ?></span>
				<span style="line-height:27px;">&nbsp;款小游戏，快来看看</span>
				</a>
			</div>
			<div style="clear:both;"></div>
		</div>
		<ul id="newhotgamelist" class="game_piclist" style="display:block;">
			<?php $max = count($newtopgame) > 84 ? 84 : count($newtopgame); ?>
			<?php for($i = 0;$i < $max;$i++){ ?>
			<li style="<?php if( ($i + 1) % 7 == 0 ){ echo "padding-right: 0px;"; } else { echo "padding-right: 3px;"; } ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $newtopgame[$i]['id']; ?>.html" title="<?php echo $newtopgame[$i]['name']; ?>">
					<img backupimg="<?php echo converBaeResUrl($newtopgame[$i]['gicon']); ?>" errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $newtopgame[$i]['name']; ?>" data="<?php echo converResUrl($newtopgame[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $newtopgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
		<ul id="newgamelist" class="game_piclist" style="display:none;">
			<?php $max = count($newgame) > 84 ? 84 : count($newgame); ?>
			<?php for($i = 0;$i < $max;$i++){ ?>
			<li style="<?php if( ($i + 1) % 7 == 0 ){ echo "padding-right: 0px;"; } else { echo "padding-right: 3px;"; } ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $newgame[$i]['id']; ?>.html" title="<?php echo $newgame[$i]['name']; ?>">
					<img backupimg="<?php echo converBaeResUrl($newgame[$i]['gicon']); ?>" errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $newgame[$i]['name']; ?>" data="<?php echo converResUrl($newgame[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $newgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div style="float:right;margin-left:10px;width:291px;">
		<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
			<div>
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">热门视频</span>
				<div style="clear:both;"></div>
			</div>
			<div style="overflow:hidden;">
				<ul class="videolist" style="overflow:hidden;">
				<?php $max = count($topvideos) > 10 ? 10 : count($topvideos); ?>
				<?php for($i = 0;$i < $max;$i++){ ?>
				<?php $video = $topvideos[$i]; ?>
				<li style="">
					<div style="height:60px;padding:8px 0px 8px 5px;border-bottom:1px solid #ccc;overflow:hidden;">
						<img class="fixie_border_img" style="float:left;" width="100px" height="60px" alt="<?php echo $video['title']; ?>" data="<?php echo $video['image_url']; ?>">
						<div style="float:left;width:160px;height:60px;overflow:hidden;padding-left:5px;">
							<a target="_blank" href="<?php echo $video['url']; ?>"><?php echo $video['title']; ?></a>
							<br/>
							<span>播放次数：<?php echo $video['playcount']; ?></span>
						</div>
						<div style="clear:both;"></div>
					</div>
				</li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<div style="height:5px;"></div>
		<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
			<div>
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">内容区域</span>
				<div style="clear:both;"></div>
			</div>
			<div style="overflow:hidden;height:300px">
			</div>
		</div>
		
		<div style="height:5px;"></div>
		<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
			<div>
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">内容区域</span>
				<div style="clear:both;"></div>
			</div>
			<div style="overflow:hidden;height:300px">
			</div>
		</div>
		
		<div style="height:5px;"></div>
		<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
			<div>
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">广告区域</span>
				<div style="clear:both;"></div>
			</div>
			<div style="overflow:hidden;height:162px">
			</div>
		</div>
		
	</div>
	<div style="clear:both;"></div>
</div>

<?php $gamecount = count($newgame) > 50 ? 50 : count($newgame);  ?>
<div style="border:solid 1px #eee;margin-top:10px;" class="div_full_row">
	<div>
		<span style="font:700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">最新小游戏推荐</span>
		<a style="display:inline-block;float:right;margin-right:10px;margin-top:5px;" target="_blank" href="/site/new/1.html">为您列出了50款最新添加的游戏，点击查看所有</a>
		<div style="clear:both;"></div>
	</div>
	<ul class="game_piclist" style="padding:0px 0px 15px 10px;">
			<?php for($i = 0;$i < $gamecount;$i++){ ?>
			<li style="padding:5px 3px 5px 3px;">
				<a class="link_black" target="_blank" href="/game/<?php echo $newgame[$i]['id']; ?>.html" title="<?php echo $newgame[$i]['name']; ?>">
					<img backupimg="<?php echo converBaeResUrl($newgame[$i]['gicon']); ?>" errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $newgame[$i]['name']; ?>" data="<?php echo converResUrl($newgame[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $newgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
</div>

<div class="div_full_row_transparent">
<?php $index = 1; ?>
<?php foreach ( $catalogblocks as $catalogblock){ ?>
<?php $currentCatalogGames = $catalogblock['hotgame']; ?>
<div style="padding:0px;margin:0px;float:left;width:485px;margin-top:10px;margin-right:<?php echo $index % 2 == 0 ? "0px" : "10px;"; ?>;">
	<div class="gamebox" style="height:590px;border:solid 1px #eee;overflow:hidden;">
		<div>
			<span style="font:700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;"><?php echo  $catalogblock['name']; ?>小游戏</span>
			<a style="display:inline-block;float:right;margin-right:10px;margin-top:5px;" target="_blank" href="/catalog/<?php echo $catalogMap->getNameFromId($catalogblock["id"]); ?>">更多>></a>
			<div style="clear:both;"></div>
		</div>
		<div style="overflow:hidden;">
			<ul class="game_piclist" style="overflow:hidden;">
			<?php $max = count($currentCatalogGames) > 20 ? 20 : count($currentCatalogGames); ?>
			<?php //print_r($currentCatalogGames); ?>
			<?php for($i = 0;$i < $max; $i++){ ?>
			<li style="padding: 9px 0px 8px 0px;width:88px;<?php if( ($i + 1) % 5 == 0 ){ echo "padding-right: 0;"; } ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $currentCatalogGames[$i]['gameid']; ?>.html" title="<?php echo $currentCatalogGames[$i]['name']; ?>">
					<img backupimg="<?php echo converBaeResUrl($currentCatalogGames[$i]['gicon']); ?>" errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $currentCatalogGames[$i]['name']; ?>" data="<?php echo converResUrl($currentCatalogGames[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $currentCatalogGames[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
			</ul>
		</div>
	</div>
</div>
<?php $index++;} ?>
<div style="clear:both;"></div>
</div>

<div style="border:solid 1px #c8dff0;margin-top:10px;" class="div_full_row">
	<div>
		<span style="font:700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">经典游戏推荐</span>
		<div style="clear:both;"></div>
	</div>
	<ul class="game_piclist" style="padding:0px 0px 15px 20px;">
			<?php for($i = 0;$i < count($alltopgame);$i++){ ?>
			<li style="padding:9px 2px 8px 2px;<?php if( ($i + 1) % 5 == 0 ){ echo "padding-right: 0;"; } ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $alltopgame[$i]['id']; ?>.html" title="<?php echo $alltopgame[$i]['name']; ?>">
					<img backupimg="<?php echo converBaeResUrl($alltopgame[$i]['gicon']); ?>" errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $alltopgame[$i]['name']; ?>" data="<?php echo converResUrl($alltopgame[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $alltopgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
</div>


