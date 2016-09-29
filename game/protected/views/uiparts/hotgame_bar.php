<div class="gamebox" style="height:440px;border:solid 1px #c8dff0;overflow:hidden;">
	<div>
		<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">最新增加</span>
		<div style="clear:both;"></div>
	</div>
	<div style="overflow:hidden;">
		<ul class="game_piclist">
			<?php $max = count($hotgame) > 18 ? 72 : count($hotgame); ?>
			<?php for($i = 0;$i < $max;$i++){ ?>
			<li style="<?php if( ($i + 1) % 9 == 0 ){ echo "padding-right: 0;"; } ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $hotgame[$i]['id']; ?>.html" title="<?php echo $hotgame[$i]['name']; ?>">
					<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $hotgame[$i]['name']; ?>" data="<?php echo converResUrl($hotgame[$i]['gicon']); ?>">
						<span class="game-txt"><?php echo $hotgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>