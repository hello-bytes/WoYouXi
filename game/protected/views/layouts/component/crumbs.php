<?php if($crumb != null && count($crumb) > 1){ ?>
<div class="content" style="width:980px;padding:5px 0px 5px 0px;margin-top:0px;margin-bottom:10px;background:#fff;border:solid 1px #cfe1ee;border-top:0px;">
	<span>当前位置：</span>
	<?php $firstItem = true; ?>
	<?php foreach($crumb as $crumbitem){ ?>
		<?php if($firstItem == true){ ?>
			<?php $firstItem = false; ?>
		<?php } else { ?>
			<span>>&nbsp;&nbsp;</span>
		<?php } ?>
		<?php if(strlen($crumbitem->url) > 0 ){ ?>
			<a class="link_black" href="<?php echo $crumbitem->url; ?>"><?php echo $crumbitem->name; ?>&nbsp;&nbsp;</a>
		<?php }else{ ?>
			<span><?php echo $crumbitem->name; ?>&nbsp;&nbsp;</span>
		<?php } ?>
	<?php } ?>
</div>
<?php } ?>
