<?php
  error_reporting(0);
  $vid = isset($_GET['vid']) ? trim($_GET['vid']) : "Njg5MjQxMjI";
  $appid = isset($_GET['appkey']) ? trim($_GET['appkey']) : "";

  //use sdk
  require_once(dirname(dirname(__FILE__)).'/Open.php');
  $params = array(
      'vid'=>$vid,
  );
  $data = Open::GetApi('Video/GetVideoInfo',$params);

  if(isset($data[0]))
      $rst = $data[0];

  $title = isset($rst['title']) ? $rst['title'] : '56网好看的无广告视频！';
  $tags = isset($rst['tag']) ? $rst['tag'] : '56网好看的无广告视频！';
  $image = isset($rst['bimg']) ? $rst['bimg'] : $rst['img'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="56网开放平台,<?php echo $title;?>" name="keywords">
<meta content="php by qingzhang.su 2012.06.13" name="author">
<style>
.player {
    position: relative;
    text-align: left;
    width: 600px;
    margin: 0 auto;
}
</style>
</head>
<body>
<?php require_once 'nav.php'; ?> 
<div class="player">     
    <embed src='http://player.56.com/<?=$appid?>/open_<?php echo $vid;?>.swf' flashvars='ban_ad=on&ban_top_panel=on&ban_share_btn=on&ban_over_panel=on&auto_start=on&' type='application/x-shockwave-flash' allowFullScreen='true' width='680' height='510' allowNetworking='all' wmode='opaque' allowScriptAccess='always'>

<!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
        <a class="bds_qzone"></a>
        <a class="bds_tsina"></a>
        <a class="bds_tqq"></a>
        <a class="bds_renren"></a>
        <span class="bds_more">更多</span>
        <a class="shareCount"></a>
    </div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=640750" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
    //在这里定义bds_config
    var bds_config = {'bdText':'<?php echo $title;?>','bdPic':'<?php echo $image;?>','bdDesc':'<?php echo $tags.",".$title;?>'};
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
</script>
<!-- Baidu Button END -->

</div>
<div style="display:none">
      <script src='http://w.cnzz.com/c.php?id=30064212&l=3' language='JavaScript'></script>
</div><!-- o_footer End-->
</body>
</html>
