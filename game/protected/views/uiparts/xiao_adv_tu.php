<?php if( $gaoxiaotu != null){ ?>
<div style="border:solid 1px #eee;margin-top:10px;" class="div_full_row">
	<div>
		<span style="font:700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:30px;float: left;color: #4e4e4e;margin-top:-1px;">精选搞笑图</span>
		<div style="clear:both;"></div>
	</div>
	<div style="height:140px;overflow:hidden;padding:10px 0px 10px 10px;overflow:hidden;width:968px;" class="div_full_row">
		<ul style="padding:1px;margin:0px 0px 0px 0px;" class="gj_content_imagetext">
		<?php foreach($gaoxiaotu as $pictureItem){ ?>
		<li style="float:left;margin:0px 12px 8px 12px;list-style:none;">
			<div style="position:relative;">
				<a target="_blank" href="<?php echo $pictureItem["url"]; ?>" style="display:block;margin:0px;padding:0px;width:165px;height:95px;text-align:center;">
					<img class="fixie_border_img" style="width:165px;height:95px;padding-top:0px;" data="<?php echo $pictureItem['image_url']; ?>" alt="<?php echo $pictureItem['title']; ?>"></img>
				</a>
				<a style="text-align:center;width:165px;cursor:pointer;font-size:11pt;" class="link_black" target="_blank" href="<?php echo $pictureItem["url"]; ?>"><p style="padding:0px;margin:0px;overflow:hidden;height:30px;line-height:30px;"><?php echo $pictureItem['title']; ?></p></a>
			</div>
		</li>
		<?php } ?>
		</ul>
	</div>
</div>
<?php } ?>