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
			<a class="link_button" href="/cmssubjectui/addsubject">添加专题 </a>
			<a class="link_button" href="javascript:deleteSubject();">删除专题 </a>
		</div>
	</div>
	<div style="float:right;margin-right:5px;">
	</div>
	<div style="clear:both;"></div>
</div>

<div style="overflow-y:scroll;position:absolute;top:82px;bottom:0px;left:0px;right:0px;">
<?php foreach($catalogs as $catalog){ ?>
<p style="margin:17px 8px 5px 8px;color:#001B55;font-weight:bold;background:#E8EBEF;padding:5px;"><?php echo $catalog['name']; ?></p>
<?php if($catalog['subjects'] != null && count($catalog['subjects']) > 0){ ?>
<table width="98%" id="mytab"  border="1" class="t1">
  <thead>
  	<th width="5%"><input type="checkbox"></input></th>
    <th width="5%">ID</th>
    <th width="20%">名称</th>
    <th width="60%">描述</th>
  </thead>
  <?php foreach($catalog['subjects'] as $subject){ ?>
  <tr class="a1">
    <td><input type="checkbox" value="<?php echo $subject["id"]; ?>" id="selectedId" name="selectedId[]"></input></td>
    <td><?php echo $subject["id"]; ?></td>
    <td><a href="/cmssubjectui/editsubject?subjectid=<?php echo $subject["id"]; ?>"><?php echo $subject["name"]; ?></a></td>
    <td style="padding:5px;"><?php echo $subject["descript"]; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } ?>
<?php } ?>
</div>
</form>
</div>