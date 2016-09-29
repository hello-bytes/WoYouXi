<div style="margin-top:10px;border: 1px solid #c8dff0;text-align:center;" class="div_full_row">
<p style="font:700 15px/30px microsoft yahei,arial;color:#f00;font-family: Arial,Helvetica Neue,Helvetica,Arial,sans-serif;">额，这是测试页面哈！</p>
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

<script type="text/javascript">
     document.write('<a style="display:none!important" id="tanx-a-mm_53771660_6102968_21596920"></a>');
     tanx_s = document.createElement("script");
     tanx_s.type = "text/javascript";
     tanx_s.charset = "gbk";
     tanx_s.id = "tanx-s-mm_53771660_6102968_21596920";
     tanx_s.async = true;
     tanx_s.src = "http://p.tanx.com/ex?i=mm_53771660_6102968_21596920";
     tanx_h = document.getElementsByTagName("head")[0];
     if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
</script>