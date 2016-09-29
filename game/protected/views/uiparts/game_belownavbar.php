<div class="div_full_row gamebox" style="width:978px;overflow:hidden;border:solid 1px #ccc;border-top:0px;">
	<div style="overflow:hidden;">
		<ul style="padding:0px;margin:0px;list-style:none;">
			<?php $max = count($topicon) > 12 ? 12 : count($topicon); ?>
			<?php for($i = 0;$i < $max;$i++){ ?>
			<li style="float:left;margin:7px 8px 0px <?php if($i == 0){ echo "12"; }else{ echo "8";} ?>px;padding:0px;width:65px;height:80px;<?php if( ($i + 1) % 9 == 0 ){ echo "padding-right: 0;"; } ?>">
				<a class="link_black" target="_blank" href="<?php echo $topicon[$i]['url']; ?>" title="<?php echo $topicon[$i]['name']; ?>">
					<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="65px" height="50px" alt="<?php echo $topicon[$i]['name']; ?>" src="<?php echo converResUrl($topicon[$i]['gicon']); ?>">
					<span style="text-align:center;display:inline-block;width:65px;" class="game-txt"><?php echo $topicon[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>