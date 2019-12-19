#!/usr/bin/php
<?php
require_once("GooglePhotosURLs.php"); // 

$optind = null;
$options=getopt('w::h::m::',['help','csv'],$optind);
$pos_args = array_slice($argv, $optind);
//print_r($argv); 
//print_r($options); 
//print_r($pos_args); 
if(isset($options['help']) OR !isset($pos_args[0]) OR !filter_var($pos_args[0],FILTER_VALIDATE_URL)) {
?>
Create a list of <a ...><img ...></a> string with permanent link from GooglePhoto album shared url
Usage:
GooglePhotosURLscli.php [[-w=width] [-h=height] [-m=csv]] https://youGoogleGhotoGharedLink
or
GooglePhotosURLscli.php [--help] - this help

where
-w=width	width img on pixels
-h=height	height img on pixels
-m=csv		return list of strings "original_file_name","permanent_url"

<?php
}
else {
	$url = filter_var($pos_args[0],FILTER_SANITIZE_URL);
	$width = NULL;
	if(isset($options['w'])) $width = intval( filter_var($options['w'],FILTER_SANITIZE_NUMBER_INT));
	$height = NULL;
	if(isset($options['h'])) $height = intval( filter_var($options['h'],FILTER_SANITIZE_NUMBER_INT));
	$mode = NULL;
	if(isset($options['m'])) {
		$mode = substr(trim(filter_var($options['m'],FILTER_SANITIZE_STRING)),0,3);
		if(!$mode) $mode=TRUE;
	}
	//echo "$url,$width,$height,$mode\n";
	$albumPhotos=GooglePhotosURLs($url,$width,$height,$mode);
	foreach($albumPhotos as $photo) {
		switch($mode) {
		case 'csv':
			echo '"'.$photo[0].'","'.$photo[1].'"';
			echo "\n";
			break;
		default:
			$photoURL=explode('=',$photo); 	// [0] - base url == GooglePhoto preview, [1] - original size
			echo '<a href="'.$photoURL[0].'='.$photoURL[1].'" target="_blank"><img src="'.$photoURL[0].'"></a>';
			echo "\n\n";
		}
	}
}
?>
