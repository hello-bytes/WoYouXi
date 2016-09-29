<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='zh-CN' xml:lang='zh-CN' xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<title>瀑布流定位</title>
<link href="css/default/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://s1.56img.com/script/lib/jquery/jquery-1.4.4.min.js"></script>
</head>
<body><!--height: 1463px-->
<?php require_once 'nav.php'; ?> 
<div style="width: 1390px; visibility: visible;" id="wrap" class="wrap active">
   <script>
   var hots =0;
   var ent  =0;
   var ori  =0;
   var mtv  =0;
   var sport=0;
   var game =0;   
   </script>
   <div id="hot_0"></div>
   <div id="ent_0"></div>
   <div id="ori_0"></div>
   <div id="mtv_0"></div>
   <div id="sport_0"></div>
   <div id="game_0"></div>
    <?php 
    require_once(dirname(dirname(__FILE__)).'/Open.php');
    $params = array(
        'cid'=>2,
        'page'=>1,
        'num'=>10,
    );

    $dataArray = array(
        'hots' => 2,
        'ent' => 1,
        'ori' => 3,
        'mtv' => 14,
        'sport' => 26,
        'game' => 28,
        'car' => 10,
        'trip' => 27,
        'fun' => 4,
        );

    $typeNum = 0;
    foreach($dataArray as $type=>$cid):?>
   <?php 
    $params['cid'] = $cid;
    $data = Open::GetApi('Video/Hot',$params);
    foreach($data as $k=>$v){?>
   <div style="left:<?php echo 234*$typeNum;?>px; visibility: visible;<?php if($k>0){?>margin-top:15px;<?php }?>" class="mode popup_in" id="<?php echo $type.'_'.($k+1);?>" > 
       <p class="pic"><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><img src="<?php echo $v['bimg']; ?>" style="height: 156px;"></a></p>
       <h3 class="tit"><span><a href="http://dev.56.com/player.php?vid=<?php echo $v['vid'];?>" target="_blank"><?php echo $v['title'];?></a></span></h3>
       <p><b>描述：</b><?php echo $v['content'];?></p>
       <p><b>用户名：</b><?php echo $v['user_id'];?></p>
       <p><b>评论数：</b><?php echo $v['comments'];?></p>
   </div>
   <script>
       var <?=$type?> = <?=$type?> + $("#<?php echo $type.'_'.($k);?>").outerHeight(true);
    $("#<?php echo $type.'_'.($k+1);?>").css("top",<?=$type?>);
   </script>
   <?php }?>
    <?php $typeNum++;?>
    <?php endforeach;?>
          
</div>
    <div style="display:none">
      <script src='http://w.cnzz.com/c.php?id=30064212&l=3' language='JavaScript'></script>
    </div><!-- o_footer End-->
<div id="aaa1" style="display:none;position: fixed;width:400px;height:200px;background:#000;color:#fff;top:30%;left:50%"></div>
</body></html>
