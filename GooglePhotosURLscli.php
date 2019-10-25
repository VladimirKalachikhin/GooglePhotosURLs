<?php
require_once("GooglePhotosURLs.php"); // 

if($argv[1]) {
	$albumPhotos=GooglePhotosURLs($argv[1],NULL,NULL,TRUE);
	foreach($albumPhotos as $photoURL) {
		$photoURL=explode('=',$photoURL); 	// [0] - base url == GooglePhoto preview, [1] - original size
		echo '<a href="'.$photoURL[0].'='.$photoURL[1].'" target="_blank"><img src="'.$photoURL[0].'"></a>';
		echo "\n\n";
	}
}
else echo "Usage:\n  php GooglePhotosURLscli.php https://yougooglephotoalbumsharedlink\n\n";
?>
