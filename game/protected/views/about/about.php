<!-- about -->
<style>
.navtabs
{
	margin:0px;
	padding:0px;
	border:solid 1px #ccc;
	list-style: none; 
}
.navtabs li {
text-align:center;
padding: 10px 20px;
text-align: center;
list-style: none;
color: #999;
border-bottom: 1px solid #ddd;
}


.about_title
{
margin-bottom: 20px;
padding-bottom: 10px;
border-bottom: 1px solid #eee;
font-weight: 700;
font-size: 16px;	
}
</style>
<?php
function getCss($keyval,$itemVal){
	if(strcasecmp($keyval, $itemVal) == 0){
		return "about_link_selected";
	}else{
		return "about_link";
	}
}
function isCurrentPage($keyval,$itemVal){
	if(strcasecmp($keyval, $itemVal) == 0){
		return true;
	}else{
		return false;
	}
}
?>
<div class="div_full_row" style="margin-top:20px;">
	<div style="float:left;width:300px;background:#fff;">
		<div style="height:31px;background:#1A90E2;">
			<span style="height:31px;line-height:31px;text-align:right;font-size:15px;font-weight:bold;color:#fff;" >&nbsp;&nbsp;&nbsp;&nbsp;了解我游戏</span>
		</div>
		<ul class="navtabs">
			<li><a class="<?php echo getCss($key,"us"); ?>" href="/about/us">关于我们</a></li>
			<li><a class="<?php echo getCss($key,"contactus"); ?>" href="/about/contactus">联系我们</a></li>
			<li><a class="<?php echo getCss($key,"lawnotice"); ?>" href="/about/lawnotice">版权说明</a></li>
			<li><a class="<?php echo getCss($key,"ad"); ?>" href="/about/adandcooperation">商务合作</a></li>
			<li><a class="<?php echo getCss($key,"upload"); ?>" href="/about/upload">用户上传</a></li>
			<li><a class="<?php echo getCss($key,"advise"); ?>" href="/about/advise">用户留言</a></li>
		</ul>
	</div>
	<div style="float:left;width:600px;padding:20px;margin-left:10px;border:solid 1px #ccc;background:#fff;">
		<h1 class="about_title"><?php echo $title; ?></h1>
		<?php if(isCurrentPage($key,"us")) { ?>
		<?php require 'us.php'; ?>
		<?php }else if(isCurrentPage($key,"contactus")){ ?>
		<?php require 'contactus.php'; ?>
		<?php }else if(isCurrentPage($key,"lawnotice")){ ?>
		<?php require 'law.php'; ?>
		<?php }else if(isCurrentPage($key,"ad")){ ?>
		<?php require 'ad.php'; ?>
		<?php }else if(isCurrentPage($key,"links")){ ?>
		<?php require 'links.php'; ?>
		<?php }else if(isCurrentPage($key,"upload")){ ?>
		<?php require 'upload.php'; ?>
		<?php }else if(isCurrentPage($key,"uploadnotice")){ ?>
		<?php require 'uploadnotice.php'; ?>
		<?php }else if(isCurrentPage($key,"advise")){ ?>
		<?php require 'advise.php'; ?>
		<?php } ?>
	</div>
	<div style="clear:both;"></div>
</div>