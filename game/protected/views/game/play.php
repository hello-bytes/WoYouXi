<?php if($game == null) { gotoerrorpage(); return; } ?>

<?php
if($gamemeta["width"] > 670){
	require_once "play_big.php";
	return;
}
?>

<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/common.php'; ?>

<?php if(CACHE_CMS == false){ ?>
<div style="margin-top:10px;margin-bottom:10px;height:90px;border: 1px solid #c8dff0;position: relative;background:#fff;" class="div_full_row">
<script type="text/javascript"><?php echo getAdvJs(14); ?></script>
</div>
<?php } ?>

<script type="text/javascript" src="/game/assets/swfobject/swfobject.js"></script>
<script type="text/javascript" src="/game/assets/js/gamepage.js?ver=1.0.0.1002"></script>
<script type="text/javascript">
    swfobject.registerObject("woyouxi_game", "9.0.115", "/game/assets/swfobject/expressInstall.swf");
</script>
<div id="adv_gp_1" class="div_full_row" style="background:#fff;margin-bottom:5px;overflow:hidden;">
</div>
<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;">
	<div style="height:35px;width:100%;border-bottom:1px solid #cfe1ef;padding-left:10px;">
		<h1 style="padding:0px;margin:0px;height:33px;line-height:33px;font-size:20px;font-weight:bold;float:left;"><?php echo $game["name"]; ?></h1>
		<?php if($game['gsize'] > 1024 * 1024){ ?>
		<span style="float:left;font-size:12px;color:#F37521;height:32px;line-height:32px;">&nbsp;&nbsp;&nbsp;&nbsp;游戏较大（<?php echo getSizeText($game['gsize']); ?>），请您耐心等待游戏加载完毕!</span>
		<?php }else{ ?>
		<?php } ?>
		<div style="float:right;width:200px">
		<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
		</div>
	</div>
	<?php
		$displayWidth = $gamemeta["width"];
		$displayHeight = $gamemeta["height"];
		if($displayWidth > 0 && $displayHeight > 0){
			$displayHeight = (670 * $displayHeight) / $displayWidth;
			$displayWidth = 670;
		}else if($displayWidth == 0 || $displayHeight == 0){
			$displayWidth = 670;
			$displayHeight = 502;
		}
	 ?>
	<div>
		<div style="width:670px;float:left;border-right:1px solid #cfe1ef;" id="woyouxi_game_wrap">
			<div class="flashloadingbar" id="flashloadingbar"><div id="flashprogressbar" style="overflow:hidden;"><span></span></div></div>
			<div style="position:relative;margin:10px auto 10px auto;width:<?php echo $displayWidth; ?>px;height:<?php echo $displayHeight; ?>px;" id="woyouxi_game_content">
				<div id="swfloading" style="z-index:1;display:block;position:absolute;width:<?php echo $displayWidth; ?>px;height:<?php echo $displayHeight; ?>px;top:0px;left:0px;font-size:25px;font-weight:bold;color:#000;background:#4AC5FE;">
					<p id="advtimer" style="margin:5px 0px;padding:0px;font-size:12px;color:#fff;text-align:center;">广告剩余时间 6秒</p>
					<p style="margin:5px 0px;padding:0px;text-align:center;color:#f00;">您的游戏正在加载...</p>
				</div>
				<div id="woyouxi_game" name="woyouxi_game" >
				<p style="font-size:25px;font-weight:bold;color:#000;">您需要安装安装 Adobe Flash Player才能玩此游戏</p>
				<p><a href="http://www.adobe.com/go/getflashplayer">
                 <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
				</div>
			</div>
		</div>
		<div style="float:right;width:309px;_width:305px;height:100%;overflow:hidden;" id="woyouxi_game_right">
			<div style="height:48px;border-top:0px solid #cfe1ef;padding:0px;margin:0px;">
				<ul style="list-style: none;padding:0px;margin:0px;">
					<li id="modtab1" class="modtab modtab_current" style="width:103px;_width:101px;" onclick="onTabClick('modtab1','tabcontent1');">
						<span class="tabs_txt">操作方法</span>
					</li>
					<li id="modtab2" class="modtab" style="width:103px;_width:101px;" onclick="onTabClick('modtab2','tabcontent2');">
						<span class="tabs_txt">相似游戏</span>
					</li>
					<li id="modtab3" class="modtab" style="width:103px;_width:101px;" onclick="onTabClick('modtab3','tabcontent3');">
						<span class="tabs_txt">相关视频</span>
					</li>
				</ul>
			</div>
			<div style="height:445px;width:100%;position:relative;border-top:0px solid #cfe1ef;padding:0px;margin:0px;">
				<div id="tabcontent1" style="display:block;position:absolute;top:0px;left:0px;padding-left:5px;overflow:hidden;">
					<p style="font-size:14px;"><?php echo $game['guide'] ?></p>
				</div>
				<div id="tabcontent2" style="display:none;position:absolute;top:0px;left:0px;overflow:hidden;">
				<?php require_once "game/protected/views/uiparts/relativegames.php"; ?>
				</div>
				<div id="tabcontent3" style="display:none;position:absolute;top:0px;left:0px;overflow:hidden;">
				<?php require_once "game/protected/views/uiparts/relativevideo.php"; ?>
				</div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div style="height:90px;border-top:1px solid #cfe1ef;">
		<div style="height:70px;background:#f1f9fd;" class="game_toolbar">
			<a href="javascript:replay();" class="replay" id="replay" title="重玩"><em></em>重玩</a>
			<a target="_blank" href="/game/fs?gameurl=<?php echo $gamemeta["swfurl"]; ?>&name=<?php echo $game["name"]; ?>" class="full-screen" id="full" title="全屏"><em></em>全屏</a>
			<a href="javascript:biggerGame(<?php echo $gamemeta["width"]; ?>,<?php echo $gamemeta["height"]; ?>);" class="enlarge" id="zoomIn" title="放大"><em></em>放大</a>
			<a href="javascript:smallerGame(<?php echo $gamemeta["width"]; ?>,<?php echo $gamemeta["height"]; ?>);" class="narrow" id="zoomOut" title="缩小"><em></em>缩小</a>
			<a href="javascript:copyToClipboard('http://www.woyouxi.net/game/play?gameid=<?php echo $game['id']; ?>');alert('已复制成功，现在可以发送给您的好友了!');" class="share" id="sendToFriends" title="发给好友"><em></em>发给好友</a>
			<div style="clear:both"></div>
		</div>
		<div style="float:left;width:309px;height:90px;padding:0px 0px;border-left:1px solid #cfe1ef;">
			<?php require_once "game/protected/views/uiparts/advs/game_below_rightbutton.php"; ?>
		</div>
		<div style="float:right;width:309px;height:90px;border-left:1px solid #cfe1ef;overflow:hidden;">
			<div style="height:50px;background:#50AFD1;margin-bottom:2px;margin-left:1px;margin-right:1px;">
				<a target="_blank" href="http://www.codingsky.com" style="display:block;color:#fff;font-size:15pt;height:50px;line-height:50px;text-align:center;">学习网站编程</a>
			</div>
			<div style="height:35px;margin-left:1px;">
				<div style="float:left;width:152px;height:35px;background:#648272;margin-right:2px;">
					<a target="_blank" href="http://www.codingsky.com" style="display:block;color:#fff;font-size:15pt;height:35px;line-height:35px;text-align:center;">PHP程序员</a>
				</div>
				<div style="float:left;width:152px;height:35px;background:#648272;">
				<a target="_blank" href="http://www.codingsky.com" style="display:block;color:#fff;font-size:15pt;height:35px;line-height:35px;text-align:center;">C++程序员</a>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		
		<div style="clear:both;"></div>
	</div>
</div>

<?php if(CACHE_CMS == false){ ?>
<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;height:90px;">

</div>
<?php } ?>

<?php require_once 'game/protected/views/uiparts/xiao_adv_tu.php'; ?>

<div class="div_full_row" style="background:#fff;border:1px solid #cfe1ef;margin-top:10px;">
	<div style="padding:10px;">
		<p class="game_introduce_title" style="margin:0px;padding:0px;">游戏简介:</p>
		<p style="font-size:14px;"><?php echo $game['introduce'] ?></p>
	</div>
	
	<div style="padding:10px;">
		<p class="game_introduce_title" style="margin:0px;padding:0px;">如何开始:</p>
		<p style="font-size:14px;"><?php echo $game['hottostart'] ?></p>
	</div>
</div>

<script type="text/javascript">
	var flashvars = { name1: "我游戏" };
	var params = { menu: "false",wmode:"transparent",allowNetworking:"internal",AllowScriptAccess:"none" };
	var attributes = { };
	var g_FlashUrlOk = true;
	var g_AdvTime = 0;

	function checkHideAdv(){
		var obj = document.getElementById("swfloading");
		if(obj != null && g_FlashUrlOk == true && g_AdvTime <= 0){
			obj.style.display = "none";
		}

		if(g_FlashUrlOk == false && g_AdvTime <= 0 &&  obj != null){
			obj.innerHTML = "您要的游戏我们暂时找不到了~~~，<br/>玩会其它的游戏吧！";
			obj.style.display = "block";
			
			var flash = document.getElementById("woyouxi_game");
			if(flash != null){
				flash.style.display = "none";
			}
		}
	}

	function onSwfLoadFinish(success,id,ref){
		checkHideAdv();
	}
	swfobject.embedSWF("<?php echo $gamemeta["swfurl"]; ?>", "woyouxi_game", "<?php echo $displayWidth; ?>", "<?php echo $displayHeight; ?>", "9.0.0","expressInstall.swf", flashvars, params, attributes,onSwfLoadFinish);

	/*var g_flashintervalId = setInterval(function(){
		var obj = document.getElementById("advtimer");
		if(obj != null){
			obj.innerHTML = "广告剩余时间 " + g_AdvTime + "秒";
			g_AdvTime--;
			if(g_AdvTime <= 0){
				g_AdvTime = 0;
			}
		}

		if(g_AdvTime <= 0){
			clearInterval(g_flashintervalId);
			checkHideAdv();
		}
	}, 1000);*/

	var refreshLoadingTimer = setInterval("refreshLoadingValue()",800);
	function refreshLoadingValue() {
	    var mFlash = document.getElementById("woyouxi_game");
	    var divIng = document.getElementById("flashprogressbar");
	    if(mFlash != null){
		    try{
		    	var objTagName = mFlash.tagName.toUpperCase();
			    if(objTagName.indexOf("OBJECT") >= 0){
			    	var tempValue = mFlash.PercentLoaded();
				    if(divIng != null){
				    	divIng.style.width = tempValue + "%";
					    //divIng.innerHTML = "加载进度：" + tempValue + "%";
					    if (tempValue == 100) {
					    	var divLoading = document.getElementById("flashloadingbar");
					    	if(divLoading != null){
					    		divLoading.style.display="none";
						    }
					        clearInterval(refreshLoadingTimer);
					    }
				    }
			    }
			}catch(e){
				clearInterval(refreshLoadingTimer);
			}
	    }
	}
	
</script>
<script type="text/javascript">
var objUrl = "<?php echo $gamemeta["swfurl"]; ?>";
if(objUrl.indexOf("bcs.duapp.com") > 0){
	objUrl = objUrl.replace("http://bcs.duapp.com/youxires","");
	request("/query/QueryBcs?bcs=" + objUrl,function(responseText){
		//g_FlashUrlOk = false;
		if (parseInt(responseText) == 0){
			var obj = document.getElementById("swfloading");
			if(obj != null){
				g_FlashUrlOk = false;
			}
		}
	});
}else{
}

/*function hidegp1(){
	var obj = document.getElementById("adv_gp_1");
	if(obj != null){
		obj.style.display = "none";
	}
}
request("/adv/getadv?pos=1",function(responseText){
	try{
		var objDiv = document.getElementById("adv_gp_1");
		if(objDiv != null){
			var obj = eval('(' + responseText + ')');
			var url = obj.url;
			if( obj.url == ""){
				hidegp1();
			}else{
				objDiv.style.width = "980px";
				objDiv.style.height = "32px";

				var iframe = document.createElement("iframe");
				iframe.src = url;
				iframe.frameborder = "0px";
				iframe.style.border = "0px";
				iframe.style.margin = "0px";
				iframe.style.padding = "0px";
				iframe.style.width = obj.width;
				iframe.style.height = obj.height;
				iframe.scrolling = "no";
				objDiv.appendChild(iframe);
			}
		}
	}catch(err){
		hidegp1();
	}
});*/


var url = "/log/gamelog?accesstype=2&gameid=" + getQueryStringByName("gameid");
request(url,function(responseText){
});
</script>
<?php require_once "game/protected/views/uiparts/relativegame_bar.php"; ?>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"我发现了一个好玩的游戏，大家快来速速转观","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

<div class="div_full_row" style="background:#fff;width:960px;padding:10px;margin-top:10px;">
<!-- Duoshuo Comment BEGIN -->
<div class="ds-thread" data-thread-key="<?php echo $game['id']; ?>" data-title="<?php echo $game['name']; ?>" data-image="<?php echo $game['gicon']; ?>"></div>
<script type="text/javascript">
var duoshuoQuery = {short_name:"woyouxi"};
(function() {
	var ds = document.createElement('script');
	ds.type = 'text/javascript';ds.async = true;
	ds.src = 'http://static.duoshuo.com/embed.js';
	ds.charset = 'UTF-8';
	(document.getElementsByTagName('head')[0] 
	|| document.getElementsByTagName('body')[0]).appendChild(ds);
})();
</script>
<!-- Duoshuo Comment END -->
</div>