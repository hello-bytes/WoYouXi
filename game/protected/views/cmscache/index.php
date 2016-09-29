<div>
<?php 
require_once 'game/protected/views/layouts/component/moduletitle.php'; 
require_once 'game/protected/utils/common.php';

function getSearchText(){
	if(key_exists("search_text",$_POST)){
		return $_POST['search_text'];
	}
	return "";
}

function getSearchStatus(){
	if(key_exists("cache_status", $_POST) && $_POST["cache_status"] >= 0){
		return $_POST["cache_status"];
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
function deleteCache(){
	setOperator("delete");
	submit("cacheFrom");
}

function cacheSelect(){
	setOperator("cacheselect");
	submit("cacheFrom");
}

function clearCaches(){
	setOperator("clear");
	submit("cacheFrom");
}

function cacheAll(){
	setOperator("cacheall");
	submit("cacheFrom");
}

function search(){
	setOperator("search");
	submit("cacheFrom");
}

function deleteACache(id,file){
	setOperator("deleteacache");
	setParam1(file);
	setParam2(id);
	submit("cacheFrom");
}

function cacheAUrl(id,url){
	setOperator("cacheaurl");
	setParam1(url);
	setParam2(id);
	submit("cacheFrom");
}

function initCacheUrls(){
	setOperator("initcacheaurl");
	submit("cacheFrom");
}

function initSubjectUrls(){
	setOperator("initsubjectcacheaurl");
	submit("cacheFrom");
}



function clearCacheUrls(){
	setOperator("clearcacheaurl");
	submit("cacheFrom");
}

function writeCacheConfig(){
	setOperator("writecacheconfig");
	submit("cacheFrom");
}

function dlCacheConfig(){
	setOperator("downloadcacheconfig");
	submit("cacheFrom");
}
function clearRuntimeCache(){
	setOperator("clearruntimecache");
	submit("cacheFrom");
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


<form id="cacheFrom" method="post">
<input id="operator" name="operator" type="hidden"></input>
<input id="param1" name="param1" type="hidden"></input>
<input id="param2" name="param2" type="hidden"></input>
<div class="toolbarbg" style="width: 100%">
	<div style="float:left;margin-right:5px;">
		<div style="padding-top:7px;padding-left:5px;">
			<a class="link_button" href="javascript:initCacheUrls();">初始化缓存链接</a>
			<a class="link_button" href="javascript:initSubjectUrls();">初始化主题链接</a>
			<a class="link_button" href="javascript:clearRuntimeCache();">清空运行时缓存</a>
			<a class="link_button" href="javascript:cacheSelect()">缓存选中</a>
			<a class="link_button" href="javascript:deleteCache();">删除选中缓存</a>
			<a class="link_button" href="javascript:clearCaches();">清空缓存数据（包括数据库）</a>
			
			<!-- a class="link_button" href="javascript:dlCacheConfig();">下载缓存 </a>
			<a class="link_button" href="javascript:writeCacheConfig();">写入缓存配置 </a>
			<span>缓存配置是否存在：<span style="color:#ff0000;font-weight:bold;"></span></span -->
			<?php //echo $configexist == 0 ? "不存在" : "存在" ?>
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
	<span style="font-size:14px;">Cache 状态:</span>
	<select id="cache_status" name="cache_status">
		<option value ="-1">所有</option>
		<option value ="0">未缓存</option>
		<option value ="1">已缓存</option>
	</select>
	<span>&nbsp;&nbsp;</span>
	<span style="font-size:14px;">关键字:</span>
	<input type="text" id="search_text" name="search_text" value="<?php echo getSearchText(); ?>"></input>
	<input type="button" onclick="javascript:search();" value="搜索"></input>
</div>

<div style="overflow-y:scroll;position:absolute;top:130px;bottom:30px;left:0px;right:0px;">
<table width="98%" id="mytab"  border="1" class="t1">
  <thead>
  	<th width="5%"><input type="checkbox" id="headcheckbox" name="headcheckbox" onclick="onAllCheckedChange();"></input></th>
    <th width="5%">ID</th>
    <th width="30%">URL</th>
    <th width="30%">缓存路径</th>
    <th width="10%">缓存时间</th>
    <th width="20%">操作</th>
  </thead>
  <?php foreach($pagedata as $cache){ ?>
  <tr class="a1">
    <td><input type="checkbox" value="<?php echo $cache["id"]; ?>" id="selectedId" name="selectedId[]"></input></td>
    <td><?php echo $cache["id"]; ?></td>
    <td style="padding:5px;"><a href="<?php echo $cache["cacheurl"]; ?>"><?php echo $cache["cacheurl"]; ?></a></td>
    <td style="padding:5px;"><?php echo getCacheFileName($cache["cacheurl"]); ?></td>
    <td style="padding:5px;"><?php 
    if($cache["iscached"] == "1") 
    	echo  $cache["cache_time"];//echo date("Y-m-d H:i:s",filemtime(getCachePath($cache["cacheurl"])) );
    else
    	echo ""; 
    ?></td>
    <td style="padding:5px;">
    	<?php if($cache["iscached"] == "1"){ ?>
    	<?php 
    		$localfile = getCachePath($cache["cacheurl"]);
    		$localfile = str_replace("\\", "\\\\", $localfile);
    	?>
    	<a href="javascript:deleteACache('<?php echo $cache["id"]; ?>','<?php echo $localfile; ?>')">删除</a>
    	<?php }else{ ?>
    	<span>无</span>
    	<?php } ?>
    	<a href="javascript:cacheAUrl('<?php echo $cache["id"] ?>','<?php echo $cache["cacheurl"] ?>');">重新缓存</a>
    </td>
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
