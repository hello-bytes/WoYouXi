<?php

require_once __DIR__ . '/Common.php';

use OSS\OssClient;
use OSS\Core\OssException;
use OSS\Core\OssUtil;

function is_oss_object($url){
	if(strpos("http://youxires.oss-cn-hangzhou.aliyuncs.com/", $url) === 0){
		return true;
	}
	return false;
}

function get_file_extension_helper_oss($file_name){
	$extend = pathinfo($file_name);
	$extend = strtolower($extend["extension"]);
	if(strlen($extend) == 0){
		return "jpg";
	}
	return $extend;
}

function is_oss_file_exist($objectKey){
	$client = Common::getOssClient();
	if($client == null) return null;
	return $client->doesObjectExist("youxires",$objectKey,null);
}

function get_oss_file_content($objectKey){
	$client = Common::getOssClient();
	if($client == null) return null;
	
	$options = array();
	return $client->getObject("youxires",$objectKey,$options);
}

function move_url_oss_fileupload($url, $folder) {
	if(strpos($url, "//") === 0){
		$url = "http:" . $url;
	}
	
	$localFileName = md5($url) . "." . get_file_extension_helper_oss($url);
	$runtimedir = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/cache/img/";
	
	$localFile = $runtimedir . $localFileName;
	$content = file_get_contents($url);
	file_put_contents($localFile, $content);
	
	$result = move_attachments_oss_fileupload($localFileName,$folder,$localFile,false);
	
	unlink($localFile);
	
	return $result;
}

//woyouxi/caches/1/
function move_attachments_oss_fileupload($fileName, $folder, $filePath, $isContent) {
	$client = Common::getOssClient();
	if($client == null){
		//echo "client is null";
	 	return;
	}
	
	$result = "";
	
	try {
		$objectkey = "";
		if(strlen($folder) > 0){
			$objectkey =  $folder . "/" . $fileName;
		}else{
			$objectkey =  $fileName;
		}
		//echo $objectkey;
		if($isContent === false){
			$result = $client->uploadFile("youxires", $objectkey, $filePath);
			//echo "isContent = false";
			//print_r($result);
		} else {
			$result = $client->putObject("youxires", $objectkey, $filePath);
			//echo "isContent = true";
			//print_r($result);
		}
		$result = "http://youxires.oss-cn-hangzhou.aliyuncs.com/" . $objectkey;
	}catch (Exception $e){
		return false;
	}
	
	return $result;
}

function is_oss_object_exist($object){
	$client = Common::getOssClient();	

	try {
		$object = $client->getObject(array(
	    	'Bucket' => 'youxires',
	    	'Key' => $object,
		));
		return $object != null;	
	}catch (Exception $e){
		//print_r($e);
	}
	
	return false; 
}

function initiateMultipartUpload($filesize, $object){
	$partSize = 5 * 1024 * 1024;
	$ossClient = Common::getOssClient();
	$uploadId = "";
	try {
        $uploadId = $ossClient->initiateMultipartUpload("youxires", $object);
        $pieces = $ossClient->generateMultiuploadParts($filesize, $partSize);
    } catch (Exception $e) {
        //printf(__FUNCTION__ . ": initiateMultipartUpload FAILED\n");
        //printf($e->getMessage() . "\n");
    }
    return array(
    		"objectid" => $object,
    		"uploadid" => $uploadId,
    		"pieces" => $pieces,
    	);
}

function ossUploadPart($uploadFile, $object, $uploadId, $totlaFileSize, $index){
	$partSize = 5 * 1024 * 1024;
    $ossClient = Common::getOssClient();
    
    $pieces = $ossClient->generateMultiuploadParts($totlaFileSize, $partSize);
    
    $isCheckMd5 = true;
    $uploadResult = null;
    $piece = $pieces[$index];
    $responseUploadPart = array();
    $filelength = filesize($uploadFile);
    
    if($filelength != $piece[$ossClient::OSS_LENGTH]){
    	return null;
    }
    
	$upOptions = array(
		$ossClient::OSS_FILE_UPLOAD => $uploadFile,
        $ossClient::OSS_PART_NUM => ($index + 1),
        //$ossClient::OSS_SEEK_TO => $piece[$ossClient::OSS_SEEK_TO],
        $ossClient::OSS_LENGTH => $filelength,
        $ossClient::OSS_CHECK_MD5 => $isCheckMd5,
	);
    if ($isCheckMd5) {
    	$contentMd5 = OssUtil::getMd5SumForFile($uploadFile, /*0*/$piece[$ossClient::OSS_SEEK_TO],
    					 $filelength);
        $upOptions[$ossClient::OSS_CONTENT_MD5] = $contentMd5;
	}
        
    try {
		$uploadResult = $ossClient->uploadPart("youxires", $object, $uploadId, $upOptions);
	} catch (Exception $e) {
		//printf($e->getMessage() . "\n");
		return;
	}
        
	return $uploadResult;
}

function ossCompleteMultiUpload($uploadId,$objectId,$uploadParts){
	$ossClient = Common::getOssClient();
	try {
        $ossClient->completeMultipartUpload("youxires", $objectId, $uploadId, $uploadParts);
        return true;
    } catch (Exception $e) {
        //printf(__FUNCTION__ . ": completeMultipartUpload FAILED\n");
        //printf($e->getMessage() . "\n");
    }
    return false;
}

function ossGetSignUrl($bucket, $object, $timeout){
	$ossClient = Common::getOssClient();
	try{
        return $ossClient->signUrl($bucket,$object,$timeout);
    } catch(Exception $e) {
        //printf(__FUNCTION__ . ": FAILED\n");
        //printf($e->getMessage() . "\n");
    }
    return "";
}