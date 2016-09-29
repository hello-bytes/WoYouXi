<?php

function my_addslash($content){
	$content = addslashes($content);
	$content = str_replace("_","\_",$content);//转义掉”_” 
	$content = str_replace("%","\%",$content);//转义掉”%”
	return $content;
}