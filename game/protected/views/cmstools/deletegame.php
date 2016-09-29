<div style="margin:10px;">
<form id="subjectFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<p>请输入要删除的游戏的ID:</p>
<input id="gameid" name="gameid" type="text"></input>
<input id="deleteButton" name="deleteButton" value="删除" type="submit"></input>
</form>

<?php if($deleteid > 0){ ?>
	<p>游戏<?php echo $deleteid; ?>已经删除！</p>
<?php } ?>


</div>