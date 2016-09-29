<div>
<?php require_once 'game/protected/views/layouts/component/moduletitle.php'; ?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function saveCatalog(){
	setOperator("save");
	submit("catalogFrom");
}
</script>

<?php 
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

<?php if( count($_POST) > 0 && $errorcode == 0 ) { ?>
<div style="margin:100px auto 0px auto;width:400px;">
	<p style="font-size:40px;font-weight:bold;color:#354B66">
		栏目保存成功
	</p>
	<a href="/cmscatalog">点击此处查看所有栏目</a>
</div>
<?php }else{ ?>
<form id="catalogFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="javascript:saveCatalog();">保存</a>
			<a class="link_button" href="/cmscatalog">返回</a>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>

<div style="margin:20px auto 0px auto;width:400px;">
<?php if($catalogs == null){ ?>
<label class="login_label">栏目名称：</label>
<input name="name" id="name" type="text" class="login_edit" value="<?php echo getName($catalog); ?>"></input>
<?php } ?>

<label class="login_label">栏目描述：</label>
<textarea name="descript" style="display: block;" cols="53" rows="5"><?php echo getDescript($catalog); ?></textarea>

<input type="button" class="login_submit_button" onclick="saveCatalog();" value="保存">
<div style="clear:both;"></div>
</div>
<?php } ?>



</div>