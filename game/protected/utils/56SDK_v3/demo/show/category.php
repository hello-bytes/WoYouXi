<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='zh-CN' xml:lang='zh-CN' xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
   <title>56网开放平台--视频演示示例</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="./css/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="./css/custom.css" type="text/css" media="screen" />
    <link rel='stylesheet' id='fancybox-css'  href='./js/jquery.fancybox-1.3.4.css?ver=3.3.1' type='text/css' media='all' />
    <script type='text/javascript' src='./js/jquery.min.js?ver=3.3.1'></script>
    <script type='text/javascript' src='./js/jquery-ui-1.8.5.custom.min.js?ver=3.3.1'></script>
    <script type='text/javascript' src='./js/jquery.shortcodes.js?ver=3.3.1'></script>
    <script type='text/javascript' src='./js/jquery.jplayer.min.js?ver=3.3.1'></script>
    <script type='text/javascript' src='./js/jquery.easing.1.3.js?ver=3.3.1'></script>
    <script type='text/javascript' src='./js/jquery.masonry.min.js?ver=3.3.1'></script>
    <script type='text/javascript' src='./js/jquery.fancybox-1.3.4.pack.js?ver=3.3.1'></script>
<!-- END head -->
</head>
<?php require_once 'nav.php'; ?> 
<?php
    require_once(dirname(dirname(__FILE__)).'/Open.php');
    if(!isset($_GET['type']))
        $_GET['type'] = "today";
    $cat = $_GET['type'];
    $class = array('today'=>1,'ent'=>3,'art'=>4,'tv'=>5,'mtv'=>6,'mm'=>8,'show' => 9,'ori'=>39,'net'=>11,'fun' => 10,'record'=>12,'auto'=>13,'game'=>14,'girl' => 15,'baby'=>16);
    if(isset($class[$cat])){
        $params = array(
            'cid'=>$class[$cat],
            'page'=>1,
            'num'=>16,
        );
        $data = Open::GetApi('Video/Hot',$params);
    }
?>
    
<!-- BEGIN body -->
<body class="home page page-id-5 page-template page-template-template-portfolio-php gecko layout-2cr">
    <!--BEGIN #bg-line-->
        <!-- BEGIN #container -->
        <div id="container" class="clearfix js-disabled">
            <!--BEGIN #content -->
            <div id="content">
        <!--BEGIN #sidebar .aside-->
        <div id="sidebar" class="aside">
            <div class="seperator clearfix">
                <div class="line"></div>
            </div>
            <div class="widget">
                <h3 class="widget-title">Category</h3>
                <ul id="filter">
                    <li  class="<?php echo ($_GET['type']=='today') ? 'current-menu-item ' :''?>cat-item cat-item-16"><a href="category.php?type=today" title="今日热点">今日热点</a></li>
                    <li  class="<?php echo ($_GET['type']=='ent') ? 'current-menu-item ' :''?>cat-item cat-item-17"><a href="category.php?type=ent" title="娱乐热点">娱乐热点</a></li>
                    <li  class="<?php echo ($_GET['type']=='art') ? 'current-menu-item ' :''?>cat-item cat-item-4"><a href="category.php?type=art" title="综艺">综艺</a></li>
                    <li  class="<?php echo ($_GET['type']=='tv') ? 'current-menu-item ' :''?>cat-item cat-item-3"><a href="category.php?type=tv" title="电视剧">电视剧</a></li>
                    <li  class="<?php echo ($_GET['type']=='mtv') ? 'current-menu-item ' :''?>cat-item cat-item-12"><a href="category.php?type=mtv" title="音乐">音乐</a></li>
                    <li  class="<?php echo ($_GET['type']=='mm') ? 'current-menu-item ' :''?>cat-item cat-item-13"><a href="category.php?type=mm" title="美女主播">美女主播</a></li>
                    <li  class="<?php echo ($_GET['type']=='show') ? 'current-menu-item ' :''?>cat-item cat-item-13"><a href="category.php?type=show" title="我秀主播">我秀主播</a></li>
                    <li  class="<?php echo ($_GET['type']=='ori') ? 'current-menu-item ' :''?>cat-item cat-item-13"><a href="category.php?type=ori" title="原创热点">原创热点</a></li>
                    <li  class="<?php echo ($_GET['type']=='net') ? 'current-menu-item ' :''?>cat-item cat-item-16"><a href="category.php?type=net" title="网络红人">网络红人</a></li>
                    <li  class="<?php echo ($_GET['type']=='fun') ? 'current-menu-item ' :''?>cat-item cat-item-17"><a href="category.php?type=fun" title="火星搞笑">火星搞笑</a></li>
                    <li  class="<?php echo ($_GET['type']=='record') ? 'current-menu-item ' :''?>cat-item cat-item-4"><a href="category.php?type=record" title="拍客记录">拍客记录</a></li>
                    <li  class="<?php echo ($_GET['type']=='auto') ? 'current-menu-item ' :''?>cat-item cat-item-3"><a href="category.php?type=auto" title="汽车">汽车</a></li>
                    <li  class="<?php echo ($_GET['type']=='game') ? 'current-menu-item ' :''?>cat-item cat-item-12"><a href="category.php?type=game" title="游戏">游戏</a></li>
                    <li  class="<?php echo ($_GET['type']=='girl') ? 'current-menu-item ' :''?>cat-item cat-item-13"><a href="category.php?type=girl" title="女性">女性</a></li>
                    <li  class="<?php echo ($_GET['type']=='baby') ? 'current-menu-item ' :''?>cat-item cat-item-13"><a href="category.php?type=baby" title="母婴">母婴</a></li>
                </ul>
            </div>
                        
            <!-- BEGIN #back-to-top -->
            <div id="back-to-top">
                <a href="#">
                    <span class="icon"><span class="arrow"></span></span>
                    <span class="text">Back to Top</span>
                </a>
            <!-- END #back-to-top -->
            </div>
        
        <!--END #sidebar .aside-->
        </div>		
        <!--BEGIN #primary .hfeed-->
        <div id="primary" class="hfeed">
           <!--BEGIN #masonry-->
            <div id="masonry-portfolio">     
            <!--循环的列表-->
            <?php if(!isset($data['err'])):?>
            <?php foreach($data as $v):?>
            <!--BEGIN-->
            <div class="post-646 portfolio type-portfolio status-publish hentry" id="post-646">
                <div class="post-thumb clearfix">
                <a title="<?=$v['title']?>" href="player.php?vid=<?=$v['vid']?>">
                    <img src="<?=$v['bimg']?>" alt="<?=$v['title']?>" width="270px" height="138px"/>
                    </a>
                </div>
                <div class="arrow"></div>	
                <h2 class="entry-title"><a href="player.php?vid=<?=$v['vid']?>"><?=$v['title']?></a></h2>
                <br>
                <div class="thumnail-comments">Comments:<?=$v['comments']?></div>
                <div class="thumnail-uploader">Uploader:<?=$v['user_id']?></div>
                <div class="entry-excerpt">
                    <div class="thumnail-date">Published on <?=date("Y-m-d",$v['public_time'])?></div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
            <!--BEGIN-->
            <!--END-->  
            </div>
            <!--/循环的列表-->
         </div>
            <!--END #masonry-->
        <!--END #primary .hfeed-->
        </div>
        <!-- END #content -->
</div>
<!-- END #container -->
        </div> 
    <!-- Theme Hook -->
    <script type='text/javascript' src='./js/jquery.custom.js?ver=1.0'></script>
<!--END body-->
</body>
<!--END html-->
</html>
<div style="display:none">
<script src='http://w.cnzz.com/c.php?id=30064212&l=3' language='JavaScript'></script>
</div><!-- o_footer End-->
