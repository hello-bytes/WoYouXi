<?php 
$height = 310; 
$relativecount = $relativesubjects == null ? 0 : count($relativesubjects);  
$newtopcount = $newtopgame == null ? 0 : count($newtopgame);
if($relativecount + $newtopcount > 9){
	$height = 310;
}else if ($relativecount + $newtopcount > 0){
	$height = 186;
}else{
	$height = 85;
}
?>
<?php
$realBarTitle = "";
if ($barTitle == null){
	$realBarTitle = "您可能还喜欢：";
}else{
	$realBarTitle = $barTitle;
}
 ?>
<div class="div_full_row gamebox" style="height:<?php echo $height; ?>px;border:solid 1px #c8dff0;overflow:hidden;margin-top:10px;margin-bottom:10px;">
	<div>
		<span style="font:700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;"><?php echo $realBarTitle; ?></span>
		<div style="clear:both;"></div>
	</div>
	<?php if($relativecount + $newtopcount == 0){  ?>
	<div style="margin-left:20px;"><p style="font-size:14px;color:#000;">没有找到相关游戏！</p></div>
	<?php }else{ ?>
	<div style="overflow:hidden;">
		<ul class="game_piclist">
			<?php $max = count($relativesubjects) > 18 ? 18 : count($relativesubjects); ?>
			<?php for($i = 0;$i < $max;$i++){ ?>
			<li style="padding: 9px 18px 8px 0;<?php if( ($i + 1) % 9 == 0 ){ echo "padding-right: 0;"; } ?>">
				<a class="link_black" target="_blank" href="/game/<?php echo $relativesubjects[$i]['id']; ?>.html" title="<?php echo $relativesubjects[$i]['name']; ?>">
					<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $relativesubjects[$i]['name']; ?>" data="<?php echo converResUrl($relativesubjects[$i]['gicon']); ?>">
						<span class="game-txt"><?php echo $relativesubjects[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$needAppendNew = false;
				$left = $max - 18;
				if($left < 0){
					$left = 18 - $max;
					$needAppendNew = true;
					$left = $left <= count($newtopgame) ?  $left : count($newtopgame); 
				}
				if($needAppendNew && $left > 0){
					for($i = 0; $i < $left;$i++){
				?>
				<li style="padding: 9px 18px 8px 0;<?php if( ($max + $i + 1) % 9 == 0 ){ echo "padding-right: 0;"; } ?>">
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
	</div>
	<?php } ?>
</div>