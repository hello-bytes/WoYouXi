<div>
<?php //require_once 'game/protected/views/layouts/component/toolbar.php'; ?>
<?php require_once 'game/protected/views/layouts/component/moduletitle.php'; ?>
<?php //print_r($catalogs); ?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function deleteSubject(){
	setOperator("delete");
	submit("subjectFrom");
}
</script>

<form id="subjectFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="/cmstools/deletegame">删除游戏</a>
			<a class="link_button" href="/cmstools/deletecache">删除缓存URL对应的云存储与RUNTIME</a>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>
</form>

<?php 
if(strcasecmp($tool, "index") == 0 ){
	require_once 'main.php';
}else if(strcasecmp($tool, "deletegame") == 0 ){
	require_once 'deletegame.php';
}else if(strcasecmp($tool, "deleteurlcache") == 0 ){
	require_once 'deleteurlcache.php';
}


?>

</div>
