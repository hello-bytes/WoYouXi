<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php
require_once dirname(dirname(__FILE__)).'/Open.php';
$sid = 'a_test_sid';
$params = array(
    'sid'=>$sid,
);  
?>
<br>以下是测试upload的demo<br><br>
<iframe scrolling="no" frameborder="0" src="<?php echo Open::GetPluginApi('Video/Upload',$params);?>" id="theatre-panel" style="height: 928px; width: 1000px;"></iframe>
