<script type="text/javascript" src="/game/assets/swfobject/swfobject.js"></script>
<script type="text/javascript" src="/game/assets/js/gamepage.js?ver=1.0.0.1001"></script>
<script type="text/javascript">
    swfobject.registerObject("woyouxi_game", "9.0.115", "/game/assets/swfobject/expressInstall.swf");
</script>

<div style="height:100%;width:100%;">
	<div id="woyouxi_game" name="woyouxi_game"></div>
	<script type="text/javascript">
		var flashvars = {
		  name1: "我游戏",
		};
		var params = {
		  menu: "false"
		  //allowFullScreen,"true"  
		};
		var attributes = {
		};

		swfobject.embedSWF("<?php echo $gameUrl; ?>", "woyouxi_game", "100%", "100%", "9.0.0","expressInstall.swf", flashvars, params, attributes);
	</script>
</div>