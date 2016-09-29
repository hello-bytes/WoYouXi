<?php 
//$baseurl = "/subject?";
if( $baseurl == null ){
	return;
}

function getCurrentSort()
{
	//$sort = 0;
	//if(key_exists($_GET, "sort")){
		$sort = $_GET['sort'];
	//}
	return $sort == null ? 0 : $sort;
}

function getCurrentProgramLan()
{
	//$programLan = 0;
	//if(key_exists($_GET, "programlan")){
		$programLan = $_GET['programlan'];
	//}
	return $programLan == null ? 0 : $programLan;
}

function getJumpUrl( $programLan, $sort )
{
	return $baseurl . "?programlan=" . $programLan . "&sort=" . $sort;
}

function getJumpUrlByLan( $programLan )
{
	return getJumpUrl($programLan,getCurrentSort());
}

function getJumpUrlBySort( $sort )
{
	return getJumpUrl(getCurrentProgramLan(),$sort);
}

function getSortClass($index,$sort){
	return $index == $sort ? "classify_search_condition_active" : "classify_search_condition_normal";
}

function getUIClass($programLan)
{
	if(getCurrentProgramLan() == $programLan){
		return 'class="a_block"';
	}
	return "";
}

?>



<div class="top_first_banner">
	<div class="page_root_div">
		<div class="goodclassifynav_head" style="height:50px;">
			<span class="classify_search_condition_title">程序语言:</span>
			<div style="float:left;height:30px;width:290px;text-align:left;margin-top:10px;">
				<span>&nbsp;&nbsp;&nbsp;</span>
				<a <?php echo getUIClass(0); ?> href="<?php echo getJumpUrlByLan(0); ?>"><span style="height:30px;line-height:30px;">所有语言</span></a>
				<span>&nbsp;&nbsp;&nbsp;</span>
				<a <?php echo getUIClass(2); ?> href="<?php echo getJumpUrlByLan(2); ?>"><span style="height:30px;line-height:30px;">c++</span></a>
				<span>&nbsp;&nbsp;&nbsp;</span>
				<a <?php echo getUIClass(1); ?> href="<?php echo getJumpUrlByLan(1); ?>"><span style="height:30px;line-height:30px;">C#</span></a>
				<span>&nbsp;&nbsp;&nbsp;</span>
				<a <?php echo getUIClass(88888); ?> href="<?php echo getJumpUrlByLan(88888); ?>"><span style="height:30px;line-height:30px;">其它</span></a>
			</div>
			<div style="float:right;width:225px;">
				<span class="classify_search_condition_title" style="display:inline;">排序:</span>
				<ul class="classify_search_condition_ul" style="width:160px;height:30px;padding-left:10px;">
					<li><a href="<?php echo getJumpUrlBySort(0); ?>" class="<?php echo getSortClass(0,$sort); ?> classify_search_condition_first" style="width:77px;">最近更新</a></li>
					<li><a href="<?php echo getJumpUrlBySort(1); ?>" class="<?php echo getSortClass(1,$sort); ?> classify_search_condition_last" style="width:77px;">最多阅读</a></li>
				</ul>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
</div>

