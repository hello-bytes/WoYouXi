<?php 
	$loginUser = getLoginUser();
	if($loginUser == null) {
		//return; 
	}
?>

<script type="text/javascript">
function onEditProfile()
{
	var objFrame = document.getElementById("mainFrame");
	if(objFrame != null){
		objFrame.src = "/users/profile";
	}
	
	try
	{
		//resetClass();
	}
	catch(err){
	}
}
</script>

<div class="gj_cms_banner" style="height:66px;overflow:hidden;">
	<div id="gj_tophead" class="gj_banner_content">
		<!-- div style="float:left;width:200px;height:60px;">
			<img style="margin-top:0px;" src="/game/assets/cms/cms_logo.gif" alt="" />
		</div-->
		<div style="float:left;width:600px;height:66px;margin-left:10px;">
			<span style="height:66px;line-height:66px;font-size:40px;color:#fff;">我游戏管理员控制中心</span>
		</div>
		<div style="float:right;height:66px;margin-left:10px;margin-top:10px;">
			<span style="height:23px;line-height:23px;font-size:12px;color:#fff;"><?php echo $loginUser->getUserName(); ?>（<?php echo $loginUser->getEmail(); ?>）</span>
			<br/>
			<a class="topbar_personal_link" href="javascript:onEditProfile();"><span style="height:23px;line-height:23px;font-size:12px;color:#fff;">设置 </span></a>
			<span style="height:23px;line-height:23px;font-size:12px;color:#fff;">&nbsp;|&nbsp;</span>
			<a class="topbar_personal_link" href="/cmsadmin/logout"><span style="height:23px;line-height:23px;font-size:12px;color:#fff;">注销 </span></a>
		</div>
		<div style="clear:both"></div>
	</div>
</div>