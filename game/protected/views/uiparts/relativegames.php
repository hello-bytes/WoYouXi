<?php 
$relativecount = $relativesubjects == null ? 0 : count($relativesubjects);  
$newtopcount = $newtopgame == null ? 0 : count($newtopgame);
if($relativecount + $newtopcount == 0){ ?>
<div style="margin-left:10px;"><p style="font-size:14px;color:#000;">没有找到相关游戏！</p></div>
<?php }else{ ?>
<ul class="game_piclist">
	<?php $max = count($relativesubjects) > 9 ? 9 : count($relativesubjects); ?>
	<?php for($i = 0;$i < $max;$i++){ ?>
	<li style="padding: 16px 8px 8px 0;<?php if( ($i + 1) % 3 == 0 ){ echo "padding-right: 0;"; } ?>">
		<a class="link_black" target="_blank" href="/game/<?php echo $relativesubjects[$i]['id']; ?>.html" title="<?php echo $relativesubjects[$i]['name']; ?>">
			<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $relativesubjects[$i]['name']; ?>" data="<?php echo converResUrl($relativesubjects[$i]['gicon']); ?>">
				<span class="game-txt"><?php echo $relativesubjects[$i]['name']; ?></span>
		</a>
	</li>
	<?php } ?>
	
	<?php 
		$needAppendNew = false;
		$left = $max - 9;
		if($left < 0){
			$left = 9 - $max;
			$needAppendNew = true; 
			
			$left = $left <= count($newtopgame) ?  $left : count($newtopgame);
		}
		if($needAppendNew && $left > 0){
			for($i = 0; $i < $left;$i++){
				?>
				<li style="padding: 16px 8px 8px 0;<?php if( ($max + $i + 1) % 3 == 0 ){ echo "padding-right: 0;"; } ?>">
					<a class="link_black" target="_blank" href="/game/<?php echo $newtopgame[$i]['id']; ?>.html" title="<?php echo $newtopgame[$i]['name']; ?>">
						<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $newtopgame[$i]['name']; ?>" data="<?php echo converResUrl($newtopgame[$i]['gicon']); ?>">
						<span class="game-txt"><?php echo $newtopgame[$i]['name']; ?></span>
					</a>
				</li>
				<?php 
			}
		}
	?>	
</ul>
<?php } ?>