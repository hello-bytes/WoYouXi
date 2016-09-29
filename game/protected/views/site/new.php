<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/page.php'; ?>

<script src="/game/assets/js/page.js" type="text/javascript"></script>
<script type="text/javascript">
	//var pg = new showPages('pg');
	//pg.pageCount = 10;  // 定义总页数(必要)
	//pg.getPage();
	//g_currentPage = pg.page;
</script>

<div style="margin-top:10px;" class="div_full_row">
	<div class="block_head_darkblue" style="border: 1px solid #cfe1ee;">
		<strong style="margin-left:10px;float:left;">最火的新游戏</strong>
	</div>
	<div>
		<ul class="game_piclist">
			<?php $totalCount = 9 > count($newtopgame) ? count($newtopgame) : 9 ?>
			<?php for($i = 0;$i < $totalCount;$i++){ ?>
			<li style="padding: 9px 18px 8px 0;<?php if(($i + 1) % 9 == 0) echo "padding-right:0px;"; ?>">
				<a target="_blank" class="link_black" href="<?php echo "/game/index?gameid=" . $newtopgame[$i]['id']; ?>" title="<?php echo $newtopgame[$i]['name']; ?>">
					<img width="76" height="77" class="fixie_border_img" errorimg="/game/assets/img/nogameicon.png" alt="<?php echo $newtopgame[$i]['name']; ?>" data="<?php echo converResUrl($newtopgame[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $newtopgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>

<div style="margin-top:10px;margin-bottom:10px;" class="div_full_row">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- new_game_top -->
<ins class="adsbygoogle"
     style="display:inline-block;width:970px;height:90px"
     data-ad-client="ca-pub-3704961340020955"
     data-ad-slot="5785713625"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<div style="margin-top:10px;" class="div_full_row">
	<div class="block_head_darkblue" style="border: 1px solid #cfe1ee;">
		<strong style="margin-left:10px;float:left;">最新小游戏</strong>
	</div>
	<div style="border: 1px solid #cfe1ee;border-top:0px solid #cfe1ee;">
		<ul class="game_piclist">
			<?php $totalCount = 100 > count($newgame) ? count($newgame) : 100 ?>
			<?php for($i = 0;$i < $totalCount;$i++){ ?>
			<li style="padding: 9px 18px 8px 0;<?php if(($i + 1) % 9 == 0) echo "padding-right:0px;"; ?>">
				<a target="_blank" class="link_black" href="<?php echo "/game/index?gameid=" . $newgame[$i]['id']; ?>" title="<?php echo $newgame[$i]['name']; ?>">
					<img width="76" height="77" class="fixie_border_img" errorimg="/game/assets/img/nogameicon.png" alt="<?php echo $newgame[$i]['name']; ?>" data="<?php echo converResUrl($newgame[$i]['gicon']); ?>">
					<span class="game-txt"><?php echo $newgame[$i]['name']; ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
		<div style="text-align:center;padding-bottom:10px;">
			<?php
				$pager = new HtmlPage();
				$pager->setStaticMode(true);
				$pager->setPageInfo(10);
				echo $pager->printHtml("/site/new/"); 
			 ?>
				<script type="text/javascript">
				//var baseUrl = pg.createBaseUrl();
				//pg.printHtml(baseUrl);
				</script>
		</div>
	</div>
</div>

<div style="margin-top:10px;margin-bottom:10px;" class="div_full_row">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- new_game_bottom -->
<ins class="adsbygoogle"
     style="display:inline-block;width:970px;height:90px"
     data-ad-client="ca-pub-3704961340020955"
     data-ad-slot="7262446829"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>