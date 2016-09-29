<?php
//example:获得56网首页热门的视频,Open.php封装了目前56所有可用的接口
$ss = '{"result":"1","errormsg":"\u5220\u9664\u6210\u529f\uff01"}';
print_r(json_decode($ss,true));
exit;
require_once dirname(__FILE__).'/Open.php';
$params = array(
    'cid'=>2,
    'page'=>1,
    'num'=>10,
);
print_r(Open::Video_Hot($params));
?>
