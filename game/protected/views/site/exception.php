<div style="margin-top:10px;border: 1px solid #c8dff0;text-align:center;" class="div_full_row">
<p style="font:700 15px/30px microsoft yahei,arial;color:#f00;font-family: Arial,Helvetica Neue,Helvetica,Arial,sans-serif;">额，出错了？您要玩的游戏找不到？</p>
</div>


<?php $relativesubjects = $newtopgame; ?>
<?php $barTitle = "最近您的小伙伴们都在玩这些游戏:"; ?>
<?php require "game/protected/views/uiparts/relativegame_bar.php"; ?>

<?php $relativesubjects = $allnewgame; ?>
<?php $barTitle = "最近我们新添加了以下游戏:"; ?>
<?php require "game/protected/views/uiparts/relativegame_bar.php"; ?>

<script type="text/javascript">
function getHomeLink(){
	if(isSW()) {
		document.write("<a href=\"http://123.swjoy.com\">http://123.swjoy.com</a>");
	}else{
		document.write("<a href=\"http://www.woyouxi.net\">http://www.woyouxi.net</a>");
	}	
}
</script>

<div style="margin-top:10px;border: 1px solid #c8dff0;text-align:center;" class="div_full_row">
<p style="font:700 15px/30px microsoft yahei,arial;font-family: Arial,Helvetica Neue,Helvetica,Arial,sans-serif;">更多内容，您可以访问:&nbsp;<script type="text/javascript">getHomeLink();</script></p>
</div>