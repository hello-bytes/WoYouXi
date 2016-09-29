<?php

if(BAE_LOCAL_DEBUG){
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'WoYouXi',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	//ZaDlTrbPjVHCVdEZoyng
	//'defaultController'=>'si',

	// application components
	'components'=>array(
		'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
			),
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:host=127.0.0.1;dbname=mdxqodgrgupbsxqkgkrq',
			'connectionString' => 'mysql:host=127.0.0.1;dbname=bae_pub',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '111111',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
        	'rules'=>array(
        		'game/<gameid:\d+>'=>array('game/index','urlSuffix'=>'.html'),
        		'game/play/<gameid:\d+>'=>array('game/play','urlSuffix'=>'.html'),
        		'video/<videoid:\d+>'=>array('video/play','urlSuffix'=>'.html'),
        		'video/showall/<videotagid:\d+>'=>array('video/showall','urlSuffix'=>'.html'),
        		'video/showall/<videotagid:\d+>/<page:\d+>'=>array('video/showall','urlSuffix'=>'.html'),
        		'yizhi/<order:\d+>_<page:\d+>'=>array('catalog/yizhi','urlSuffix'=>'.html'),
        		'dongzuo/<order:\d+>_<page:\d+>'=>array('catalog/dongzuo','urlSuffix'=>'.html'),
        		'yundong/<order:\d+>_<page:\d+>'=>array('catalog/yundong','urlSuffix'=>'.html'),
        		'sheji/<order:\d+>_<page:\d+>'=>array('catalog/sheji','urlSuffix'=>'.html'),
        		'yule/<order:\d+>_<page:\d+>'=>array('catalog/yule','urlSuffix'=>'.html'),
        		'maoxian/<order:\d+>_<page:\d+>'=>array('catalog/maoxian','urlSuffix'=>'.html'),
        		'qipai/<order:\d+>_<page:\d+>'=>array('catalog/qipai','urlSuffix'=>'.html'),
        		'celue/<order:\d+>_<page:\d+>'=>array('catalog/celue','urlSuffix'=>'.html'),
        		'xiuxiang/<order:\d+>_<page:\d+>'=>array('catalog/xiuxiang','urlSuffix'=>'.html'),
       		 	'zhuangban/<order:\d+>_<page:\d+>'=>array('catalog/zhuangban','urlSuffix'=>'.html'),
        		'ertong/<order:\d+>_<page:\d+>'=>array('catalog/ertong','urlSuffix'=>'.html'),
        		
        		'yizhi/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/yizhi','urlSuffix'=>'.html'),
        		'dongzuo/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/dongzuo','urlSuffix'=>'.html'),
        		'yundong/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/yundong','urlSuffix'=>'.html'),
        		'sheji/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/sheji','urlSuffix'=>'.html'),
        		'yule/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/yule','urlSuffix'=>'.html'),
        		'maoxian/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/maoxian','urlSuffix'=>'.html'),
        		'qipai/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/qipai','urlSuffix'=>'.html'),
        		'celue/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/celue','urlSuffix'=>'.html'),
        		'xiuxiang/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/xiuxiang','urlSuffix'=>'.html'),
       		 	'zhuangban/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/zhuangban','urlSuffix'=>'.html'),
        		'ertong/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/ertong','urlSuffix'=>'.html'),
        
        		'yizhi/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/yizhi','urlSuffix'=>'.html'),
        		'dongzuo/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/dongzuo','urlSuffix'=>'.html'),
        		'yundong/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/yundong','urlSuffix'=>'.html'),
        		'sheji/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/sheji','urlSuffix'=>'.html'),
        		'yule/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/yule','urlSuffix'=>'.html'),
        		'maoxian/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/maoxian','urlSuffix'=>'.html'),
        		'qipai/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/qipai','urlSuffix'=>'.html'),
        		'celue/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/celue','urlSuffix'=>'.html'),
        		'xiuxiang/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/xiuxiang','urlSuffix'=>'.html'),
       		 	'zhuangban/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/zhuangban','urlSuffix'=>'.html'),
        		'ertong/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/ertong','urlSuffix'=>'.html'),
        
        		'site/new/<page:\d+>'=>array('site/new','urlSuffix'=>'.html'),
        		'site/top/<catalog:\d+>_<day:\d+>'=>array('site/top','urlSuffix'=>'.html'),
        
        		'<controller:\w+>/<action:\w+>/<page:\d+>'=>'<controller>/<action>',
        	),
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'clientScript'=>array(
				'class'=>'application.extensions.minScript.components.ExtMinScript',
				
			),
	),
	
	'controllerMap'=>array(
		'min'=>array(
			'class'=>'application.extensions.minScript.controllers.ExtMinScriptController',
			
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
}else{
	return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'WoYouXi',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	//ZaDlTrbPjVHCVdEZoyng
	//'defaultController'=>'si',

	// application components
	'components'=>array(
		'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
			),
		// uncomment the following to use a MySQL database
		'db'=>array(
			//'connectionString' => 'mysql:host=svridx64ddc063d.mysql.duapp.com;port=10039;dbname=svridx64ddc063d',
			'connectionString' => 'mysql:host=woyouxi1.mysql.rds.aliyuncs.com;port=3306;dbname=woyouxi',
			'emulatePrepare' => true,
			//'username' => 'bae',
			//'password' => '2aELEySjaMgaNZT1WFyqddXPEXDhUSrI',
			'username' => 'shishengyi',
			'password' => 'newdbnewhope',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
        	'rules'=>array(
        		'game/<gameid:\d+>'=>array('game/index','urlSuffix'=>'.html'),
        		'game/play/<gameid:\d+>'=>array('game/play','urlSuffix'=>'.html'),
        		'video/<videoid:\d+>'=>array('video/play','urlSuffix'=>'.html'),
        		'video/showall/<videotagid:\d+>'=>array('video/showall','urlSuffix'=>'.html'),
        		'video/showall/<videotagid:\d+>/<page:\d+>'=>array('video/showall','urlSuffix'=>'.html'),
        		'yizhi/<order:\d+>_<page:\d+>'=>array('catalog/yizhi','urlSuffix'=>'.html'),
        		'dongzuo/<order:\d+>_<page:\d+>'=>array('catalog/dongzuo','urlSuffix'=>'.html'),
        		'yundong/<order:\d+>_<page:\d+>'=>array('catalog/yundong','urlSuffix'=>'.html'),
        		'sheji/<order:\d+>_<page:\d+>'=>array('catalog/sheji','urlSuffix'=>'.html'),
        		'yule/<order:\d+>_<page:\d+>'=>array('catalog/yule','urlSuffix'=>'.html'),
        		'maoxian/<order:\d+>_<page:\d+>'=>array('catalog/maoxian','urlSuffix'=>'.html'),
        		'qipai/<order:\d+>_<page:\d+>'=>array('catalog/qipai','urlSuffix'=>'.html'),
        		'celue/<order:\d+>_<page:\d+>'=>array('catalog/celue','urlSuffix'=>'.html'),
        		'xiuxiang/<order:\d+>_<page:\d+>'=>array('catalog/xiuxiang','urlSuffix'=>'.html'),
       		 	'zhuangban/<order:\d+>_<page:\d+>'=>array('catalog/zhuangban','urlSuffix'=>'.html'),
        		'ertong/<order:\d+>_<page:\d+>'=>array('catalog/ertong','urlSuffix'=>'.html'),
        		
        		'yizhi/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/yizhi','urlSuffix'=>'.html'),
        		'dongzuo/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/dongzuo','urlSuffix'=>'.html'),
        		'yundong/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/yundong','urlSuffix'=>'.html'),
        		'sheji/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/sheji','urlSuffix'=>'.html'),
        		'yule/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/yule','urlSuffix'=>'.html'),
        		'maoxian/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/maoxian','urlSuffix'=>'.html'),
        		'qipai/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/qipai','urlSuffix'=>'.html'),
        		'celue/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/celue','urlSuffix'=>'.html'),
        		'xiuxiang/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/xiuxiang','urlSuffix'=>'.html'),
       		 	'zhuangban/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/zhuangban','urlSuffix'=>'.html'),
        		'ertong/subject/<subjectid:\d+>_<order:\d+>'=>array('catalog/ertong','urlSuffix'=>'.html'),
        
        		'yizhi/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/yizhi','urlSuffix'=>'.html'),
        		'dongzuo/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/dongzuo','urlSuffix'=>'.html'),
        		'yundong/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/yundong','urlSuffix'=>'.html'),
        		'sheji/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/sheji','urlSuffix'=>'.html'),
        		'yule/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/yule','urlSuffix'=>'.html'),
        		'maoxian/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/maoxian','urlSuffix'=>'.html'),
        		'qipai/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/qipai','urlSuffix'=>'.html'),
        		'celue/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/celue','urlSuffix'=>'.html'),
        		'xiuxiang/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/xiuxiang','urlSuffix'=>'.html'),
       		 	'zhuangban/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/zhuangban','urlSuffix'=>'.html'),
        		'ertong/subject/<subjectid:\d+>_<order:\d+>/<page:\d+>'=>array('catalog/ertong','urlSuffix'=>'.html'),
        
        		'site/new/<page:\d+>'=>array('site/new','urlSuffix'=>'.html'),
        		'site/top/<catalog:\d+>_<day:\d+>'=>array('site/top','urlSuffix'=>'.html'),
        
        		'<controller:\w+>/<action:\w+>/<page:\d+>'=>'<controller>/<action>',
        	),
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'clientScript'=>array(
				'class'=>'application.extensions.minScript.components.ExtMinScript',
				
			),
	),
	
	'controllerMap'=>array(
		'min'=>array(
			'class'=>'application.extensions.minScript.controllers.ExtMinScriptController',
			
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
			);
}
