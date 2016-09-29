<?php
$navbargames = array(
array("id" => 601187,"name" => "拳皇WingEX", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601187.jpg"),
array("id" => 601188,"name" => "龙珠激斗2.2", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601188.jpg"),
array("id" => 561281,"name" => "让子弹飞2", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/561281.jpg"),
array("id" => 601190,"name" => "可爱海贼王", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601190.jpg"),
array("id" => 601183,"name" => "冰火人爱之吻", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601183.jpg"),
array("id" => 601192,"name" => "森林冰火人6", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601192.jpg"),
array("id" => 601019,"name" => "DNF2.8", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601019.jpg"),
array("id" => 601187,"name" => "拳皇WingEX", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601187.jpg"),
array("id" => 601172,"name" => "中国象棋", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601172.jpg"),
array("id" => 601190,"name" => "可爱海贼王", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601190.jpg"),
array("id" => 601167,"name" => "美女麻将2", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/601167.jpg"),
array("id" => 561281,"name" => "让子弹飞2", "url" => "","gicon" => "http://youxires.woyouxi.net/website/themes/hzw/bargame/561281.jpg"),
//array("id" => 0,"name" => "", "url" => "","gicon" => ""),
//array("id" => 0,"name" => "", "url" => "","gicon" => ""),
//array("id" => 0,"name" => "", "url" => "","gicon" => ""),
); 
 ?>
 
 <?php

 $leftContent = array(
 	array("id" => 29, "name" => "热门视频","data" => $hotvideos ),
 	array("id" => 30, "name" => "游戏视频","data" => $gamevideos ),
 	array("id" => 31, "name" => "搞笑视频","data" => $happyvideos ),
 	array("id" => 32, "name" => "国产经典","data" => $civilvideos ),
 	array("id" => 33, "name" => "日本精品视频","data" => $japanvideos ),
 );
 
 ?>
 
<?php require_once 'game/protected/views/uiparts/game_belownavbar.php'; ?>

<div style="" class="div_full_row_transparent">
	<div style="float:left;width:680px;">
		<?php foreach($leftContent as $content){ ?>
		<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;height:380px;margin-top:10px;">
			<div>
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;"><?php echo $content['name']; ?></span>
				<a class="link_black" style="float:right;display:inline-block;margin-top:5px;margin-right:10px;" href="/video/showall/<?php echo $content["id"]; ?>.html">更多>></a>
				<div style="clear:both;"></div>
			</div>
			<div style="overflow:hidden;">
				<ul style="list-style:none;padding:0px;margin:0px 0px 0px 14px;">
					<?php $data = $content['data']; ?>
					<?php //print_r($data); ?>
					<?php foreach($data as $dataitem){ ?>
					<li style="float:left;list-style:none;width:200px;height:140px;padding:5px;">
						<div style="position:relative;">				
							<a style="position:relative;display:inline-block;width:200px;" href="/video/<?php echo $dataitem['id']; ?>.html">
								<img class="fixie_border_img" style="width:200px;height:120px;" data="<?php echo $dataitem['image_url_m']; ?>" alt="<?php echo $dataitem['title']; ?>"></img>
								<span  class="v_plyico"></span>
							</a>
							<a href="/video/<?php echo $dataitem['id']; ?>.html"><p style="padding:0px;margin:0px;height:20px;line-height:20px;overflow:hidden;"><?php echo $dataitem['title']; ?></p></a>
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		
	</div>
	<div style="float:left;width:288px;margin-left:10px;_margin-left:0px;">
		<div style="margin-top:10px;background:#fff;border:solid 1px #c8dff0;">
			<div style="height:30px;overflow:hidden;border-bottom:solid 1px #ccc;">
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;height:30px;float: left;color: #4e4e4e;margin-top:-1px;">视频排行榜</span>
				<div style="clear:both;"></div>
			</div>
					
			<div style="overflow:hidden;">
				<ul class="searchtext-list" style="overflow:hidden;list-style:none;padding:0px 0px 0px 10px;margin:0px;">
							<?php $index = 1; ?>
							<?php foreach($topvideoname as $videoname) { ?>
							<li style="position:relative;height:26px;line-height:25px;overflow:hidden;border-bottom: 1px dotted #ccc;">
								<span style="display:inline-block;width:20px;"><?php echo $index; ?></span>
								<a href="/video/<?php echo $videoname['id']; ?>.html"><span><?php echo $videoname['title']; ?></span></a>
							</li>
							<?php $index++; ?>
							<?php } ?>
						</ul>
			</div>
		</div>		
		
		<div style="padding:0px 20px 0px 20px;margin:10px 0px 0px 0px;height:250px;background:#fff;border:solid 1px #c8dff0;overflow:hidden;">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- index_rightbelow_newgame -->
<ins class="adsbygoogle"
     style="display:inline-block;width:250px;height:250px"
     data-ad-client="ca-pub-3704961340020955"
     data-ad-slot="7820850029"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
		</div>
		
		<!-- 显示Sohu视频排行版-->
		<div style="border:solid 1px #c8dff0;background:#fff;padding:0px 5px 0px 5px;margin-top:10px;">
			<iframe id="f" width="278px" height="350px" src= "http://info.lm.tv.sohu.com/c/0000000afe1f59ea9a9a81fc80f0005afb8b322ba94/10182.do" frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="yes" scrolling="NO"> </iframe>
		</div>
		
		<!-- 显示游戏 -->
		<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;margin-top:10px;">
			<div>
				<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">玩玩游戏</span>
				<div style="clear:both;"></div>
			</div>
			<div style="overflow:hidden;">
				<ul class="game_piclist" style="overflow:hidden;">
				<?php $max = count($newgame) > 15 ? 15 : count($newgame); ?>
				<?php for($i = 0;$i < $max;$i++){ ?>
				<li style="padding: 9px 0px 8px 0px;width:88px;<?php if( ($i + 1) % 3 == 0 ){ echo "padding-right: 0;"; } ?>">
					<a class="link_black" target="_blank" href="/game/<?php echo $newgame[$i]['id']; ?>.html" title="<?php echo $newgame[$i]['name']; ?>">
						<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" width="76" height="77" alt="<?php echo $newgame[$i]['name']; ?>" data="<?php echo converResUrl($newgame[$i]['gicon']); ?>">
						<span class="game-txt"><?php echo $newgame[$i]['name']; ?></span>
					</a>
				</li>
				<?php } ?>
				</ul>
			</div>
		</div>
	</div>
	
	<div style="clear:both;"></div>
</div>