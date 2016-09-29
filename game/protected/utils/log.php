<?php

require_once dirname(dirname(__FILE__)) . '/extensions/log/BaeLog.class.php';

function WriteLog_Fatal($info){
	try {
		$secret = array("user"=>"0L1kRm1BU8I65X5qdUa6xg9I","passwd"=>"2aELEySjaMgaNZT1WFyqddXPEXDhUSrI" );
		$log = BaeLog::getInstance($secret);
		if(NULL !=  $log)
		{
		   $log->setLogLevel(16);
		   $log->Fatal($info);
		}
	}
	catch (Exception $e){
		
	}
}

function WriteLog_Warning($info){
	try {
		$secret = array("user"=>"0L1kRm1BU8I65X5qdUa6xg9I","passwd"=>"2aELEySjaMgaNZT1WFyqddXPEXDhUSrI" );
		$log = BaeLog::getInstance($secret);
		if(NULL !=  $log){
		   $log->setLogLevel(16);
		   $log->Warning($info);
		}
	}
	catch (Exception $e){
		
	}
}

function WriteLog_Debug($info){
	try {
		$secret = array("user"=>"0L1kRm1BU8I65X5qdUa6xg9I","passwd"=>"2aELEySjaMgaNZT1WFyqddXPEXDhUSrI" );
		$log = BaeLog::getInstance($secret);
		if(NULL !=  $log){
		   $log->setLogLevel(16);
		   $log->Debug($info);
		}
	}catch (Exception $e){
		
	}
}