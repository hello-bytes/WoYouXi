<meta http-equiv="content-type" content="text/html;charset=utf-8">
<?php
require_once dirname(dirname(__FILE__)).'/Open.php';
$css='cDElM0RwMSUyNnAyJTNEcDIlMjZvbiUzRG9uJTI2b24lM0RvbiUyNm9uJTNEb24lMjZwbyUzRHBvJTI2bCUzRGNuJTI2YyUzRHA4JTI2aSUzRDE';
$sid = 'a_test_sid';
//$fields = 'title,content,tags';
$fields = 'title,content,tags';
$rurl = '';
$ourl = '';
$params = array(
    'fields'=>$fields,
    'sid'=>$sid,
    'css'=>$css,
    //'rurl'=>$rurl,
    //'ourl'=>$ourl,
);  
?>
<br>以下是测试upload的demo<br><br>
<iframe scrolling="no" frameborder="0" src="<?php echo Open::GetPluginApi('Video/Diyupload',$params);?>" id="theatre-panel" style="height: 928px; width: 1000px;"></iframe>
