<div>
<?php //require_once 'game/protected/views/layouts/component/toolbar.php'; ?>
<?php require_once 'game/protected/views/layouts/component/moduletitle.php'; ?>
<?php 

function getSearchText(){
	if(key_exists("search_text",$_POST)){
		return $_POST['search_text'];
	}
	return "";
}

function getSearchCatalogIdUI(){
	if(key_exists("search_catalog", $_POST) && $_POST["search_catalog"] >= 0){
		return $_POST["search_catalog"];
	}
	return -1;
}

function getSearchSubjectIdUI(){
	if(key_exists("subjectid", $_POST) && $_POST["subjectid"] >= 0){
		return $_POST["subjectid"];
	}
	return -1;
}

function getSearchStatusUI(){
	if(key_exists("search_status", $_POST) && $_POST["search_status"] >= 0){
		return $_POST["search_status"];
	}
	return -1;
}

function getPageUI(){
	if(key_exists("page", $_POST) && $_POST["page"] >= 0){
		return $_POST["page"];
	}
	return 1;
}

?>

<script src="/game/assets/cms/common.js?ver=1" type="text/javascript"></script>
<script type="text/javascript">
function deleteGame(){
	setOperator("delete");
	submit("gamesFrom");
}
function onlineGame(){
	setOperator("online");
	submit("gamesFrom");
}
function offlineGame(){
	setOperator("offline");
	submit("gamesFrom");
}

function search(){
	setOperator("search");
	submit("gamesFrom");
}

function onSetStatus()
{
	setOperator("setstatus");
	submit("gamesFrom");
}
function onSetAllStatus(){
	setOperator("setallstatus");
	submit("gamesFrom");
}
function onAllCheckedChange(){
	var headCheckBox = document.getElementById("headcheckbox");
	var checkboxarr = document.getElementsByTagName("input");
	if(checkboxarr == null){
	}else{
		for(var i=0; i < checkboxarr.length; i++){
			if(checkboxarr[i].type == "checkbox"){
				checkboxarr[i].checked = headCheckBox.checked;
			}
		}
	}
}

</script>

<script src="/game/assets/cms/page.js" type="text/javascript"></script>
<script type="text/javascript">
	var pg = new showPages('pg');
	pg.pageCount = <?php echo $pageinfo['pagecount']; ?>;  // 定义总页数(必要)
	pg.getPage();
	g_currentPage = pg.page;
</script>

<form id="gamesFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="/cmsgameui/addgame">添加游戏</a>
			<a class="link_button" href="javascript:deleteGame();">删除游戏</a>
			<select id="set_status" name="set_status" onchange="onSetStatus();">
				<option value ="-1" selected='selected'>设置选中游戏状态为...</option>
				<option value ="0">未上线</option>
				<option value ="1">已上线</option>
			</select>
			<select id="set_all_status" name="set_all_status" onchange="onSetAllStatus();">
				<option value ="-1" selected='selected'>设置数据库所有游戏状态为...</option>
				<option value ="0">未上线</option>
				<option value ="1">已上线</option>
			</select>
		</div>
	</div>
	<div style="float:right;margin-right:20px;padding-top:7px;padding-left:5px;">
		<span style="color:#fff;">当前第<?php echo $currentpage ?>页，共<?php echo $pageinfo['pagecount'] ?>页</span>
	</div>
	<div style="clear:both;"></div>
</div>

<!-- 设置搜索条件 -->
<div style="margin: 5px 8px 5px 8px;background:#ccc;padding:5px;">
	<span style="background:#f00;color:#fff;padding:5px;font-size:14px;">搜索条件</span>
	
	<span>&nbsp;&nbsp;&nbsp;</span>
	<span style="font-size:14px;">分类状态:</span>
	<select id="search_catalog" name="search_catalog">
		<option <?php if(getSearchCatalogIdUI() == $catalog['id']) echo "selected='selected'"; ?> value ="-1">所有栏目</option>
			<?php foreach( $catalogs as  $catalog){ ?>
			<option <?php if(getSearchCatalogIdUI() == $catalog['id']) echo "selected='selected'"; ?> value ="<?php echo $catalog['id']; ?>"><?php echo $catalog['name']; ?></option>
			<?php } ?>
	</select>
	<span>&nbsp;&nbsp;</span>
	
	<?php //echo getSearchStatusUI(); ?>
	<span style="font-size:14px;">在线状态</span>
	<select id="search_status" name="search_status">
		<option value ="-1" <?php if(getSearchStatusUI() == -1) echo "selected='selected'"; ?>>所有状态</option>
		<option value ="0" <?php if(getSearchStatusUI() == 0) echo "selected='selected'"; ?>>未上线</option>
		<option value ="1" <?php if(getSearchStatusUI() == 1) echo "selected='selected'"; ?>>已上线</option>
	</select>
	
	<span>&nbsp;&nbsp;</span>
	<span style="font-size:14px;">关键字:</span>
	<input type="text" id="search_text" name="search_text" value="<?php echo getSearchText(); ?>"></input>
	<input type="button" onclick="javascript:search();" value="搜索"></input>
</div>

<div style="overflow-y:scroll;position:absolute;top:130px;bottom:30px;left:0px;right:0px;">
<table width="98%" id="mytab"  border="1" class="t1">
  <thead>
  	<th width="5%"><input id="headcheckbox" name="headcheckbox" type="checkbox" onclick="onAllCheckedChange();"></input></th>
    <th width="5%">ID</th>
    <th width="13%">名称</th>
    <th width="7%">是否已上线</th>
    <th width="10%">大小</th>
    <th width="5%">播放次数</th>
    <th width="15%">图标</th>
    <th width="15%">预览图</th>
    <th width="15%">描述</th>
  </thead>
  <?php foreach($pagedata as $game){ ?>
  <tr class="a1">
    <td><input type="checkbox" value="<?php echo $game["gameid"]; ?>" id="selectedId" name="selectedId[]"></input></td>
    <td><?php echo $game["gameid"]; ?></td>
    <td style="padding:5px;"><a href="/cmsgameui/editgame?gameid=<?php echo $game["gameid"]; ?>"><?php echo $game["name"]; ?></a></td>
    <td style="padding:5px;"><?php echo $game["status"] == "0" ? "未上线" : "已上线"; ?></td>
    <td style="padding:5px;"><?php echo $game["gsize"]; ?></td>
    <td style="padding:5px;"><?php echo $game["playcount"]; ?></td>
    <td style="padding:5px;overflow:hidden;word-break:break-all;"><?php echo $game["gicon"]; ?></td>
    <td style="padding:5px;overflow:hidden;word-break:break-all;"><?php echo $game["previewimageurl"]; ?></td>
    <td style="padding:5px;"><?php echo $game["introduce"]; ?></td>
  </tr>
  <?php } ?>
</table>
</div>
<div style="text-align:center;position:absolute;bottom:0px;left:0px;right:0px;">
	<script type="text/javascript">
	var baseUrl = pg.createBaseUrl();
	pg.printHtml(baseUrl);
	</script>
</div>

</form>
</div>