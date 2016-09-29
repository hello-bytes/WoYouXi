<?php
class Noads 
{
     /*
     * 功能:从url得到ID
     */
    static public function getUrlId($url)
    {
        if(!strstr($url,'http'))
        {
            $id =self::flvDeId($url);
        }else
        {
            if(strstr($url,'v='))
            {
                $id  =explode('v=',trim($url));
                $id  =str_replace('.html','',$id[1]);
                $id  = self::flvDeId($id);
            }elseif(strstr($url,'v_'))
            {
                $id  =explode('v_',trim($url));
                $id  =str_replace('.html','',$id[1]);
                $id  = self::flvDeId($id);
            }elseif(strstr($url,'vid-')){
                $id  =explode('vid-',trim($url));
                $id  =str_replace('.html','',$id[1]);
                $id  = self::flvDeId($id);
            }elseif(strstr($url,'.html'))
            {
                $id  =explode('/id',trim($url));
                $id  =str_replace('.html','',$id[1]);
            }else{
                $id  =explode('id=',trim($url));
                $id  =explode('&',$id[1]);
                $id  =$id[0];
            }
        }
        return $id;
    }
    
    /*
     * 功能: 解密flvid
     * 参数: string BASE64
     * 返回: $id    FLVID
     */
    static public function flvDeId($id)
    {
        if(is_numeric($id))
        {
            return $id;
        }else
        {
            return (int)base64_decode($id);
        }
    }
}

if($_POST['submit']){
    $url   = trim($_POST['url']); 
    $url   = isset($url) ? urldecode($url) : "http://www.56.com/w12/play_album-aid-9906769_vid-NjkyODEzNTI.html";
    $vid   = Noads :: getUrlId($url);

}else{
    $vid  = 'NjkyODEzNTI';
}

//use sdk
require_once(dirname(dirname(__FILE__)).'/Open.php');
$params = array(
    'vid'=>$vid,
);
$data = Open::GetApi('Video/GetVideoInfo',$params);
if(isset($data[0]))
    $rst = $data[0];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>56视频无广告播放方法</title>
<meta name="keywords" content="本站主要为了生成56视频无广告播放视频地址,为方便大家调用56视频同时生成视频代码,视频地址,FLASH地址,网页代码等方式.">
<meta name="description" content="56视频,无广告视频,免广告,播放方法,视频,视频代码,视频地址,FLASH地址,网页代码">
<style>
    .player {position: relative;text-align: left;width: 680px;padding-left:350px;margin-top: 35px;}
    #bottom {position: relative;padding-left:350px; margin-top: 15px;padding-top:5px;}
</style>
</head><body>
<?php require_once 'nav.php'; ?> 
<div class="player">
    <form action="" method="post">
    输入56视频网址:<input name="url" type="text" value="" size="50"/>
    <input name="submit" type="submit" value="submit" />
    </form>
    <p></p>

    <embed src='http://player.56.com/3000000088/open_<?=$vid?>.swf' flashvars='ban_ad=on&ban_top_panel=on&ban_share_btn=on&ban_over_panel=on&auto_start=off&appid=3000000088' type='application/x-shockwave-flash' allowFullScreen='true' width='680' height='510' allowNetworking='all' wmode='opaque' allowScriptAccess='always'></embed>

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
    var bdText = '<?=$rst['title']?>';
    var bdPic  = '<?=$rst['bimg']?>';
    var bdDesc = '<?=$rst['desc']?>';
        //在这里定义bds_config
          var bds_config = {'bdText': bdText,'bdPic':bdPic,'bdDesc':bdDesc};
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
    </script>
<!-- Baidu Button END -->
</div>
<br>
<div id="bottom">
    <p><label>视频地址 ：</label><span><input type="text" id="input_video_url" value="http://dev.56.com/player.php?vid=<!--{$vid}-->" size="60"></span></p>
    <p><label>FLASH地址：</label><span><input type="text" id="input_swf_html" value="http://player.56.com/open_<!--{$vid}-->.swf" size="60"></span></p>
    <p><label>网页代码 ：</label><span><input type="text" value="&lt;embed src='http://player.56.com/3000000088/open_<!--{$vid}-->.swf' flashvars='ban_ad=on&ban_top_panel=on&ban_share_btn=on&ban_over_panel=on&auto_start=on&appid=3000000088'  type='application/x-shockwave-flash' allowFullScreen='true' width='680' height='510' allowNetworking='all' allowScriptAccess='always'&gt;&lt;/embed&gt;" id="input_bbs" size="60"></span></p>
    
    <p>使用方法:<br>
    1.打开56网找到您要调用的视频的网址,规则见第二条,找到后复制下来.<a href="http://www.56.com/?z.ofwho.com/" rel="nofollow" target="_blank">点此打开56网</a>
    <br><br>
    2.在第一行输入框中输入56视频地址:
    <br>如http://www.56.com/w33/play_album-aid-9896466_vid-NjkzMTM1NTM.html
    <br>或http://www.56.com/u55/v_NjkyNTc1NDA.html后点提交
    <br><br>
    3.复制生成的视频地址,FLASH地址,网页代码供您使用或调用.
    <br><br>
    4.分享已经生成的无广告视频地址
    <br><br>
    感谢支持:<a href="#" rel="nofollow" target="_blank">#</a></p>
</div>
<div style="display:none">
      <script src='http://w.cnzz.com/c.php?id=30064212&l=3' language='JavaScript'></script>
    </div>
</body></html>
