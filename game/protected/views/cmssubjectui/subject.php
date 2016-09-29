<div>
<?php require_once 'game/protected/views/layouts/component/moduletitle.php'; ?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function saveSubject(){
	setOperator("save");
	submit("subjectFrom");
}
</script>

<?php 
function getName($subject){
	if($subject == null) {
		return "";
	}
	return $subject['name'];
}

function getDescript($subject){
	if($subject == null) {
		return "";
	}
	return $subject['descript'];
}
?>

<?php if( count($_POST) > 0 && $errorcode == 0 ) { ?>
<div style="margin:100px auto 0px auto;width:400px;">
	<p style="font-size:40px;font-weight:bold;color:#354B66">
		栏目保存成功
	</p>
	<a href="/cmssubjectui">点击此处查看所有栏目</a>
</div>
<?php }else{ ?>
<form id="subjectFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="javascript:saveSubject();">保存</a>
			<a class="link_button" href="/cmssubjectui">返回</a>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>

<div style="margin:20px auto 0px auto;width:400px;">
<?php if($catalogs != null) {?>
<label class="login_label">栏目名称：</label>
<select id="subjectIdSelector" name="subjectIdSelector">
	<?php foreach( $catalogs as $catalog ){ ?>
	<option value="<?php echo $catalog['id']; ?>"><?php echo $catalog['name']; ?></option>
	<?php } ?>
</select>
<?php } ?>

<label class="login_label">专题名称：</label>
<input name="name" id="name" type="text" class="login_edit" value="<?php echo getName($subject); ?>"></input>

<label class="login_label">专题描述：</label>
<textarea name="descript" style="display: block;" cols="53" rows="5"><?php echo getDescript($subject); ?></textarea>

<input type="button" class="login_submit_button" onclick="saveSubject();" value="保存">
<div style="clear:both;"></div>
</div>
<?php } ?>



</div>