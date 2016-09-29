<div>
<?php require_once 'game/protected/views/layouts/component/moduletitle.php'; ?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function saveGame(){
	setOperator("save");
	submit("gameFrom");
}
</script>

<?php 
function getGameField($data,$field,$default = ""){
	if($data == null) return $default;
	if( key_exists($field, $data) ){
		return $data[$field];
	}
	return $default;
}

function getName($catalog){
	if($catalog == null) {
		return "";
	}
	return $catalog['name'];
}

function getDescript($catalog){
	if($catalog == null) {
		return "";
	}
	return $catalog['descript'];
}
?>

<style type="text/css">
.left_column
{
width:200px;
text-align:right;
}
</style>

<?php if( count($_POST) > 0 && $errorcode == 0 ) { ?>
<div style="margin:100px auto 0px auto;width:400px;">
	<p style="font-size:40px;font-weight:bold;color:#354B66">
		游戏保存成功
	</p>
	<a href="/cmsgameui">点击此处查看所有栏目</a>
</div>
<?php }else{ ?>
<form id="gameFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="javascript:saveGame();">保存</a>
			<a class="link_button" href="/cmsgameui">返回</a>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>

<table style="width:600px;border:1px;margin:0px auto 0px auto;">
	<tr>
		<td class="left_column">
			<label class="login_label">名称：</label></td>
		<td>
			<input name="name" id="name" type="text" class="login_edit" value="<?php echo getGameField($game,"name"); ?>"></input>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">栏目：</label>
		</td>
		<td>
			<select id="t_catalogid" name="t_catalogid">
				<?php foreach( $catalogs as  $catalog){ ?>
				<option <?php if( $catalog['id'] == getGameField($game,"category")) echo "selected='selected'"; ?> value ="<?php echo $catalog['id']; ?>"><?php echo $catalog['name']; ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">大小：</label>
		</td>
		<td>
			<input name="gsize" id="gsize" type="text" class="login_edit" value="<?php echo getGameField($game,"gsize",0); ?>"></input>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">图标：</label>
		</td>
		<td>
			<input name="iconurl" id="iconurl" type="text" class="login_edit" value="<?php echo getGameField($game,"gicon"); ?>"></input>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">预览图：</label>
		</td>
		<td>
			<input name="previewimageurl" id="previewimageurl" type="text" class="login_edit" value="<?php echo getGameField($game,"previewimageurl"); ?>"></input>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">预览图宽：</label>
		</td>
		<td>
			<input name="previewimagewidth" id="previewimagewidth" type="text" class="login_edit" value="<?php echo getGameField($game,"previewimagewidth",0); ?>"></input>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">预览图高：</label>
		</td>
		<td>
			<input name="previewimageheight" id="previewimageheight" type="text" class="login_edit" value="<?php echo getGameField($game,"previewimageheight",0); ?>"></input>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">介绍：</label>
		</td>
		<td>
			<textarea name="introduce" id="introduce" rows="5" cols="53"><?php echo getGameField($game,"introduce"); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">如何玩：</label>
		</td>
		<td>
			<textarea name="guide" id="guide" rows="5" cols="53"><?php echo getGameField($game,"guide"); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">如何开始：</label>
		</td>
		<td>
			<textarea name="howtostart" id="howtostart" rows="5" cols="53"><?php echo getGameField($game,"hottostart"); ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="left_column">
			<label class="login_label">目标：</label>
		</td>
		<td>
			<textarea name="objective" id="objective" rows="5" cols="53"><?php echo getGameField($game,"objective"); ?></textarea>
		</td>
	</tr>
</table>

<?php } ?>
</div>