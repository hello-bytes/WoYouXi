1、文件结构说明
| | |~demo/  // 该文件夹存放一些实用例子
| | | |~plugin/ // plugin 上传插件例子
| | | | |-custom.php
| | | | |-customEasy.php
| | | | `-upload.php
| | | |-Example.php // 一个简单入门例子
| | | `-Open.php  // 该文件封装了所有接口的使用方法
| | |+User/   //存放 属于User类的接口
| | |+Video/ //存放 属于Video类的接口
| | |-ApiAbstract.php // 接口基类
| | `-conf.php //配置文件，修改appkey等信息

2、配置你的个人配置
return array(
    'is_developer'=>true, // 必改，是否打开php错误提示，正式环境下这个记得改为false
    'appkey'      =>'',   // 必改，你在56开发平台下应用对应的appKey
    'secret'      =>'',   // 必改，你在56开发平台下应用对应的secret
    'domain'      =>'http://oapi.56.com', // 默认，无需更改
    'token'       =>'',   // 可选，在某些接口需要使用到token是写入，token的获取方式http://dev.56.com/wiki/doc-view-7.html
    'test_user_id'=>'',   // 可选，需要传入个人user id是传入，可作测试使用
    );

3、一个简单的接口使用例子
<?php
//引入封装好所有接口的使用方法类文件
require_once dirname(__FILE__).'/Open.php';
$params = array(
    'cid'=>2,
    'page'=>1,
    'num'=>10,
);
// 参数不传入的话，使用demo里的数据
Open::Video_Hot($params);

4、附接口总览

4.1、数据类：
    User_UserVideos //获取用户的上传的视频
	
    User_UserProfile //获取用户的个人信息
	
    User_UserComment //获得用户的评论或视频的评论
	
    User_AppVideos //获取应用上传的视频
	
    Video_GetVideoInfo //获取视频信息
	
    Video_Search //根据关键字获取搜索结果
	
    Video_Update //获取更新视频信息的接口
	
    Video_Channel //获得频道的视频
	
    Video_Recommend //获得推荐频道的视频

    Video_Hot //获得56网首页热门的视频
	
    Video_RecAlbum //获得56网昨天或某天的推荐的相册视频

    Video_Delete //删除视频

    Album_Info // 视频专辑接口(新)

    User_AppUserVideos //获取某应用下某用户的视频列表(新)

    Video_Mobile // 手机客户端视频播放地址(新)

    User_AppProfile	 //获取应用信息(新)

    User_App2Videos	 获取当前应用上传视频列表(新)

    Video_CustomPost //视频上传接口Post方式,56核心合作用户可用

    Video_All //所有56视频列表 http://video.56.com/

    Video_Opera //获取56自制剧集

4.2、上传类：
SDK/demo/plugin/
├── customEasy.php // 简易上传类，仅需提交视频即可
├── custom.php	// 定制上传类，可自定义上传框样式，上传视频同时需要填写标题、描述、标签
└── upload.php  // 简陋上传类，上传视频同时需要填写标题、描述、标签
└── diyupload.php  //自定义上传样式组件(加强版，可控标题等显示)(新) 
└── CustomPost.php  //视频上传接口Post方式,56核心合作用户可用(新) 


如您在使用该SDK上遇到任何问题，请联系Louis email:zixing.li@renren-inc.com QQ:838431609
56网开放平台QQ群 233921452
开放平台首页 http://dev.56.com/
开发者手册 http://dev.56.com/developers.html
创建我的应用 http://dev.56.com/wiki/basic-addapp.html
开放平台wiki http://dev.56.com/wiki/
