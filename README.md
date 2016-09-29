这个是几年前帮一朋友做的小游戏网站，整个网站体系其实还包括CMS,爬虫，静态化。现在网站已经不再运营了，所以将代码释放出来。本代码针对线上运营代码稍稍做了改动，比如去掉了各类广告位，去掉了一些敏感信息(比如账号信息)等

## 示例站点 与效果图：

查看示例站点，可以前往：
[http://woyouxi.shishengyi.pub](http://woyouxi.shishengyi.pub)

整体界面效果如下图所示:
![我游戏](https://github.com/shishengyi/WoYouXi/raw/master/readme/woyouxi_screenshot.png)

> 很多图片显示成默认的游戏手柄是因为运营时，先使用了百度的云存储，后来又改用阿里的云存储，停止运营后，百度的账号就再没有充值，从而使得资源被释放了


## 部署
以下以在Apache2下，部署到/var/www/woyouxi为例，说明部署过程。整个部署网站还是很简单的。
1，数据库
数据库的表结构配置可以在此处下载

2，配置站点(Apache2需开启mod_rewrite)：
```
<VirtualHost *:80>
	ServerName woyouxi.shishengyi.pub
	ServerAlias woyouxi.shishengyi.pub

	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/demosite/woyouxi/
	<Directory /var/www/demosite/woyouxi/>
		AllowOverride All
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/woyouxi_error.log
	CustomLog ${APACHE_LOG_DIR}/woyouxi_access.log combined
</VirtualHost>
```

3，下载代码 & 做必要的初始化
```
cd /var/www/woyouxi
git clone https://github.com/shishengyi/WoYouXi.git
chmod -R 777 game/protected/runtime
```

<br/><br/>

现在，可以试着访问站点了。
