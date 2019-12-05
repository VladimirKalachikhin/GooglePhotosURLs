#!/usr/bin/php
<?php
require_once("GooglePhotoURL.php"); // 

$optind = null;
$options=getopt('w::h::m::',['help'],$optind);
$pos_args = array_slice($argv, $optind);
//print_r($argv); 
//print_r($options); 
//print_r($pos_args); 
if(isset($options['help']) OR !isset($pos_args[0]) OR !filter_var($pos_args[0],FILTER_VALIDATE_URL)) {
?>
Create <a ...><img ...></a> string with permanent link from GooglePhoto shared url
Usage:
GooglePhotoURLcli.php https://youGoogleGhotoGharedLink [[width] [height] [1|csv]]
or
GooglePhotoURLcli.php [[-w=width] [-h=height] [-m=1|csv]] https://youGoogleGhotoGharedLink
or
GooglePhotoURLcli.php [--help] - this help

where
-w=width	width on pixels
-h=height	height on pixels
-m=...	 	mode: -m or -m=1 return only image url, without <a ...><img ...></a>
		-m=csv	return string "original_file_name","permanent_url"

<?php
}
else {
	$url = filter_var($pos_args[0],FILTER_SANITIZE_URL);
	$width = NULL;
	if(isset($options['w'])) $width = intval( filter_var($options['w'],FILTER_SANITIZE_NUMBER_INT));
	elseif(isset($pos_args[1])) $width = intval( filter_var($pos_args[1],FILTER_SANITIZE_NUMBER_INT));
	$height = NULL;
	if(isset($options['h'])) $height = intval( filter_var($options['h'],FILTER_SANITIZE_NUMBER_INT));
	elseif(isset($pos_args[2])) $height = intval( filter_var($pos_args[2],FILTER_SANITIZE_NUMBER_INT));
	$mode = NULL;
	if(isset($options['m'])) {
		$mode = substr(trim(filter_var($options['m'],FILTER_SANITIZE_STRING)),0,3);
		if(!$mode) $mode=TRUE;
	}
	elseif(isset($pos_args[3])) {
		$mode = substr(trim(filter_var($pos_args[3],FILTER_SANITIZE_STRING)),0,3);
		if(!$mode) $mode=TRUE;
	}
	//echo "$url,$width,$height,$mode\n";
	echo GooglePhotoURL($url,$width,$height,$mode)."\n\n";
}
?>
