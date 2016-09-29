<?php require_once 'game/protected/views/layouts/component/crumbs.php'; ?>
<?php require_once 'game/protected/utils/common.php'; ?>

<?php
function getTopCss($currentid,$pageid){
	if($currentid == $pageid){
		return "about_link_selected";
	}else{
		return "about_link";
	}
}
function getTopTabCss($day){
	$queryDay = 1;
	if(array_key_exists("day", $_GET)){
		$queryDay = intval($_GET['day']);
	}
	
	if($queryDay == $day){
		return "toptab toptab_select";
	}
	return "toptab";
}
function getTopData($pageid,$alldata){
	$queryDay = 1;
	if(array_key_exists("day", $_GET)){
		$queryDay = intval($_GET['day']);
	}
}
function getGameTime($time){
	$phptime = strtotime($time);
	//$pos = strpos($time," "); 
	return date("Y-m-d",$phptime);
}
?>

<div class="div_full_row" style="margin-top:10px;">
	<div class="gamebox" style="border:solid 1px #c8dff0;overflow:hidden;">
		<div>
			<span style="font: 700 15px/30px microsoft yahei,arial;padding:0px 19px;border-top: 2px solid #71befd;height:36px;float: left;color: #4e4e4e;margin-top:-1px;">游戏风云版</span>
			<div style="clear:both;"></div>
		</div>
		<div style="overflow:hidden;padding:5px 10px 10px 18px;">
			<span style="font-size:14px;">游戏风云版向您展示小伙伴们最近正在玩的小游戏，以百万级用户的游戏数据做为基础，代表了目前最火的小游戏。</span>
		</div>
	</div>
</div>

<div class="div_full_row_transparent" style="margin-top:10px;">
	<div style="float:left;width:188px;border:solid 1px #ccc;border-bottom:0px;background:#fff;">
		<ul style="padding:0px;margin:0px;">
			<?php foreach( $catalogs as $catalog ) { ?>
			<li style="list-style:none;padding:0px;margin:0px;">
				<div style="height:45px;border-bottom:solid 1px #ccc;text-align:center;">
					<a href="/site/top/<?php echo $catalog["id"]; ?>_1.html" class="<?php echo getTopCss($catalog["id"],$currentcatalogid); ?>" style="display:inline-block;line-height:45px;height:45px;" href="#"><?php echo $catalog['name']; ?></a>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>

	<div style="float:left;margin-left:12px;width:770px;background:#fff;border:solid 1px #ccc;">
		<div style="">
			<ul style="padding:0px;margin:0px;list-style:none;">
				<li class="<?php echo getTopTabCss(1); ?>"><a href="/site/top/<?php echo $currentcatalogid; ?>_1.html">今日最火</a></li>
				<li class="<?php echo getTopTabCss(7); ?>"><a href="/site/top/<?php echo $currentcatalogid; ?>_7.html">7天以内</a></li>
				<li class="<?php echo getTopTabCss(30); ?>"><a href="/site/top/<?php echo $currentcatalogid; ?>_30.html">30天以内</a></li>
				<li class="<?php echo getTopTabCss(-1); ?>"><a href="/site/top/<?php echo $currentcatalogid; ?>_-1.html">总版单</a></li>
				<li class="toptab" style="width:365px;border-right:0px;"></li>
				<div style="clear:both;"></div>
			</ul>
		</div>
		<div class="rank-list-box">
			<ul class="rank-list">
			<li style="padding:0px 0px 0px 33px;height:30px;line-height:30px;">
				<span style="display:inline-block;width:65px;">图标</span>
				<span style="display:inline-block;width:163px;">名称</span>
				<span style="display:inline-block;width:97px;">游戏大小</span>
				<span style="display:inline-block;width:97px;">播放次数</span>
				<span style="display:inline-block;width:100px;">介绍</span>
			</li>
			
			<?php $maxcount = count($data) > 50 ? 50 : count($data); ?>
			<?php for($index = 0;$index < $maxcount; $index++){ ?>
			<?php $item = $data[$index]; ?>
			<li style="padding: 12px 9px 11px 33px;overflow:hidden;">
				<em class="em<?php echo $index+1; ?>"><?php echo $index+1; ?></em>
				<a target="_blank" href="/game/<?php  echo $item["id"]; ?>.html" class="img_app_link" title="<?php  echo $item["name"]; ?>">
					<img errorimg="/game/assets/img/nogameicon.png" class="fixie_border_img" data="<?php  echo converResUrl($item["gicon"]); ?>" width="60" height="60" alt="<?php echo $item["name"]; ?>">
					<span class="img_app_60_2"></span>
				</a>
				<div style="float:left;width:165px;">
					<a target="_blank" href="/game/<?php echo $item["id"]; ?>.html" class="link_black" style="overflow: hidden;margin:0px;padding:0px;height:30px;line-height:30px;font-size:18px;display:inline-block;"><span><?php  echo $item["name"]; ?></span></a><br/>
					<span>上传时间:<?php echo getGameTime($item['create_time']);//echo date("Y-m-d",$item['create_time']); ?></span>
				</div>
				<div style="float:left;width:100px;">
					<span><?php echo getSizeText($item["gsize"]); ?></span>
				</div>
				<div style="float:left;width:100px;">
					<span><?php echo $item["playcount"]; ?></span>
				</div>
				<div style="float:left;width:290px;height:60px;overflow:hidden;">
					<span><?php echo strlen($item["introduce"]) == 0 ? "暂无介绍" : $item["introduce"]; ?></span>
				</div>
				<div style="clear:both;"></div>
			</li>
			<?php } ?>
			<div style="clear:both;"></div> 
			</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>