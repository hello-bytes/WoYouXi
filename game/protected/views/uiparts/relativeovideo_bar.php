<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;">
	<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
		<div>
			<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">相关视频:</span>
			<div style="clear:both;"></div>
		</div>
		<div style="">
			<?php if($relativevideos == null || count($relativevideos) == 0){ ?>
			<div style="margin-left:10px;"><p style="font-size:14px;color:#000;">没有找到相关视频！</p></div>
			<?php }else{ ?>
			<ul style="list-style:none;margin:0px;padding:0px 0px 0px 11px;">
			<?php $maxCount = count($relativevideos) > 18 ? 18 : count($relativevideos); ?>
			<?php for($i = 0; $i < $maxCount; $i++){ ?>
			<?php //for($i = 0;$i < 20;$i++){ ?>
			<?php $relativevideo = $relativevideos[$i]; ?>
			<li style="float:left;margin:0px 10px 8px 10px;list-style:none;">
				<div style="position:relative;width:140px;height:115px;text-align:center;">
					<div style="border:1px solid #ddd;<?php if($relativevideo['id'] == $currentvideoid){ echo "background:#1389DF;"; } ?>" class="movieborder">
						<a href="/video/<?php echo $relativevideo['id']; ?>.html">
							<img style="width:130px;height:78px;padding-top:5px;" data="<?php echo $relativevideo['image_url']; ?>" alt="<?php echo $relativevideo['title']; ?>"></img>
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
	</div>
</div>