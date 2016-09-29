<?php 
require_once 'game/protected/views/layouts/component/moduletitle.php'; 
require_once 'game/protected/utils/common.php';
?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function saveAdv(){
	setOperator("savemainbanner");
	submit("advFrom");
}

function clearAdv(){
	setOperator("clearmainbanner");
	submit("advFrom");
}

function cacheAdv(){
	setOperator("cacheadv");
	submit("advFrom");
}

</script>

<form id="advFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="javascript:saveAdv();">保存</a>
			<a class="link_button" href="javascript:clearAdv();">删除首页Banner</a>
			<a class="link_button" href="javascript:cacheAdv();">缓存广告</a>
			<a class="link_button" href="/cmsadmin">取消</a>
			
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>

<table>
	<tr>
		<td>跳转地址：</td>
		<td><input style="width:500px;" type="text" id="gotourl" name="gotourl" value="<?php if($banneradv != null) echo $banneradv['gotourl']; ?>"></input></td>
	</tr>
	<tr>
		<td>图片地址：</td>
		<td><input style="width:500px;" type="text" id="imageurl" name="imageurl" value="<?php if($banneradv != null) echo $banneradv['imageurl']; ?>"></input></td>
	</tr>
	<tr>
		<td>图片宽度：</td>
		<td><input style="width:200px;" type="text" id="image_width" name="image_width" value="<?php if($banneradv != null) echo $banneradv['width']; ?>"></input>&nbsp;&nbsp;*banner的最大宽度为：770px</td>
	</tr>
	<tr>
		<td>图片高度：</td>
		<td><input style="width:200px;" type="text" id="image_height" name="image_height" value="<?php if($banneradv != null) echo $banneradv['height']; ?>"></input>&nbsp;&nbsp;*banner的最大高度为：80px</td>
	</tr>
	<tr></tr>
</table>

<?php
if(strlen($errorinfo) > 0) {
?>
<span style="color:#f00;"><?php echo  $errorinfo; ?></span>
<?php } ?>
</form>