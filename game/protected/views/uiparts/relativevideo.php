<?php
if(function_exists(getVideoPlayUrl) == false){
function getVideoPlayUrl($video){
	return "/video/" . $video['id'] . ".html"; 
}
}
?>

<style>

</style>

<?php if($relativevideos == null || count($relativevideos) == 0){ ?>
<div style="margin-left:10px;"><p style="font-size:14px;color:#000;">没有找到相关视频！</p></div>
<?php }else{ ?>
<div>
	<ul style="padding:0px;margin:0px;">
		<?php $maxcount = count($relativevideos) > 5 ? 5 : count($relativevideos); ?>
		<?php //foreach($relativevideos as $video){ ?>
		<?php //for($index = 0;$index < 10;$index++){ ?>
		<?php for($index = 0;$index < $maxcount;$index++){ ?>
		<?php $relativevideoitem = $relativevideos[$index]; ?>
		<li style="list-style:none;padding:0px;margin:0px;">
			<div style="height:60px;width:308px;position:relative;padding:15px 5px 15px 5px;margin:0px;overflow:hidden;border-bottom:solid 1px #ccc;">
				<div style="float:left;width:100px;height:60px;">
					<a target="_blank" href="<?php echo getVideoPlayUrl($relativevideoitem); ?>" title="<?php echo $relativevideoitem['title']; ?>">
					<img class="fixie_border_img" style="width:100px;height:60px;" src="<?php echo $relativevideoitem['image_url']; ?>" alt="<?php echo $relativevideoitem['title']; ?>"></img>
					</a>
				</div>
				<div style="float:left;padding:0px;margin:0px 0px 0px 5px;width:180px;">
					<h3 class="album_v_title" style="padding:0px;margin:0px;font-size:15px;height:25px;line-height:25px;overflow:hidden;">
						<a target="_blank" style="padding:0px;margin:0px;height:30px;line-height:25px;display:inline-block;" href="<?php echo getVideoPlayUrl($relativevideoitem); ?>" title="<?php echo $relativevideoitem['title']; ?>" target="_blank">
							<?php echo $relativevideoitem['title']; ?>
						</a>
					</h3>
					<p style="padding:0px;margin:0px;font-size:12px;height:20px;overflow:hidden;">
					<?php echo $relativevideoitem['descript']; ?>
					</p>
					<p style="padding:0px;margin:0px;font-size:12px;height:15px;">
						<span style="display:inline-block;width:14px;height:15px;background:url(http://bcs.duapp.com/youxires/web/button_icons_v2.png) -232px -161px no-repeat;">
						<span style="height:15px;line-height:15px;padding-left:15px;"><?php echo $relativevideoitem['playcount'] ?></span>
						</span>
					</p>
				</div>
			</div>
		</li>
		<?php } ?>
		<?php //} ?>
	</ul>
</div>
<?php } ?>