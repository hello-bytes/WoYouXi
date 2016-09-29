<?php

require_once('game/protected/controllers/bcssupport/bcs.class.php');

function get_file_extension_helper($file_name){
	$extend = pathinfo($file_name);
	$extend = strtolower($extend["extension"]);
	return $extend;
}

function set_object_meta($baidu_bcs,$object, $type) {
	$meta = array (
			"Content-Type" => BCS_MimeTypes::get_mimetype ( $type ) );
	$response = $baidu_bcs->set_object_meta ( "youxires", $object, $meta );
}

function move_attachments_bcs_fileupload($fileName, $folder, $filePath, $isContent) {
	$bcs_ak = "0L1kRm1BU8I65X5qdUa6xg9I";
	$bcs_sk = "2aELEySjaMgaNZT1WFyqddXPEXDhUSrI";
	$bucket = "youxires";
	$object = "";
	if(strlen($folder) > 0){
		$object =  "/" . $folder . "/" . $fileName;
	}else{
		$object =  "/" . $fileName;
	}
	
	$opt = array(
			"acl" => "public-read"
	);

	$baidu_bcs = new BaiduBCS($bcs_ak, $bcs_sk);
	if($baidu_bcs->is_object_exist($bucket, $object)){
		$baidu_bcs->delete_object($bucket, $object);
	}

	if($isContent){
		$baidu_bcs->create_object_by_content ( $bucket, $object, $filePath, $opt);
	}else{
		$baidu_bcs->create_object ( $bucket, $object, $filePath, $opt);
	}
	
	set_object_meta($baidu_bcs,$object, get_file_extension_helper($fileName));

	//$url = "http://bcs.duapp.com/{$bucket}{$object}";
	$url = "http://bcs.pubbcsapp.com/{$bucket}{$object}";

	return true;
}

function is_bcs_object_exist($object){
	//return true;
	
	$bcs_ak = "0L1kRm1BU8I65X5qdUa6xg9I";
	$bcs_sk = "2aELEySjaMgaNZT1WFyqddXPEXDhUSrI";
	$bucket = "youxires";

	$baidu_bcs = new BaiduBCS($bcs_ak, $bcs_sk);
	$exist = $baidu_bcs->is_object_exist($bucket, $object);

	return $exist; 
}


function request_bcs_object($object){
	$bcs_ak = "0L1kRm1BU8I65X5qdUa6xg9I";
	$bcs_sk = "2aELEySjaMgaNZT1WFyqddXPEXDhUSrI";
	$bucket = "youxires";

	$baidu_bcs = new BaiduBCS($bcs_ak, $bcs_sk);
	$response = $baidu_bcs->get_object($bucket, $object); 
	if($response != null){
		return $response->body;
	}
	return "";
}

function delete_bcs_object($object){
	$bcs_ak = "0L1kRm1BU8I65X5qdUa6xg9I";
	$bcs_sk = "2aELEySjaMgaNZT1WFyqddXPEXDhUSrI";
	$bucket = "youxires";
	
	//echo $object;
 
	$baidu_bcs = new BaiduBCS($bcs_ak, $bcs_sk);
	if($baidu_bcs->is_object_exist($bucket, $object)){
		//$response = $baidu_bcs->delete_object($bucket, $object);
		//print_r($response);
	}
	//$response = $baidu_bcs->delete_object($bucket, $object);

	
}
