<div>
<?php //require_once 'game/protected/views/layouts/component/toolbar.php'; ?>
<?php require_once 'game/protected/views/layouts/component/moduletitle.php'; ?>
<?php //print_r($catalogs); ?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function deleteCatalog(){
	setOperator("delete");
	submit("catalogFrom");
}
</script>

<form id="catalogFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="/cmscatalog/addcatalog">添加栏目</a>
			<a class="link_button" href="javascript:deleteCatalog();">删除栏目</a>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>


<table width="98%" id="mytab"  border="1" class="t1">
  <thead>
  	<th width="5%"><input type="checkbox"></input></th>
    <th width="5%">ID</th>
    <th width="20%">名称</th>
    <th width="60%">描述</th>
  </thead>
  <?php foreach($catalogs as $catalog){ ?>
  <tr class="a1">
    <td><input type="checkbox" value="<?php echo $catalog["id"]; ?>" id="selectedId" name="selectedId[]"></input></td>
    <td><?php echo $catalog["id"]; ?></td>
    <td><a href="/cmscatalog/editcatalog?catalogid=<?php echo $catalog["id"]; ?>"><?php echo $catalog["name"]; ?></a></td>
    <td><?php echo $catalog["descript"]; ?></td>
  </tr>
  <?php } ?>
</table>

</form>
</div>