<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php
require_once dirname(dirname(__FILE__)).'/Open.php';
$sid = 'a_test_sid';
$ts = time();
$rurl = 'http://app.open.56.com/p.php';
$ourl = 'http://app.open.56.com/p.php';
$params = array(
            'sid'=>$sid,
			'ts'=>$ts,
            'rurl'=>$rurl,
            'ourl'=>$ourl,
);  
$action = file_get_contents(Open::GetPluginApi('Video/CustomPost',$params));
?>
<br>以下是测试upload的demo<br><br>
<div id="info_box_easy">
    <p class="f14">视频信息</p>
	<form enctype="multipart/form-data" method="post" action="<?php echo $action;?>">
	<input type="hidden" name="sid" value="<?php echo $sid;?>">
	<input type="hidden" name="rurl" value="<?php echo $rurl;?>">
	<input type="hidden" name="ourl" value="<?php echo $ourl;?>">
    <table class="oup_general_tb0" width="100%">
        <tbody>
		    <tr><td width="40">视频文件</td><td><input type="file" id="Filedata" name="Filedata"></td></tr>
            <tr><td width="40">标题</td><td><input type="text" name="subject" id="subject" value="标题"></td></tr>
            <tr><td valign="top">简介</td><td><textarea name="content" id="content" cols="30" rows="10" class="oup_full_input clicked">简介</textarea></td></tr>
            <tr><td width="40">Tags【逗号隔开】</td><td><input type="text" class="oup_full_input" id="tag" name="tag" value="标签0,标签1,标签2"></td></tr>
			<tr><td width="40"><input type="submit" class="btn" value="开始上传"></td></tr>
        </tbody>
    </table>
    </form>
</div>
