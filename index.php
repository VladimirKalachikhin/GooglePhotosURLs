<?php
require_once("GooglePhotosURLs.php"); // 

$url = 'https://photos.app.goo.gl/ieZq8sHioiytnx6y6';

?>
<!DOCTYPE html >
<html lang="ru">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>GooglePhotos album example</title>
</head>
<body>
<?php
/* Trivial example:
$albumsPhotos=GooglePhotosURLs($ur);
echo "Album's Photos:<pre>"; print_r($albumsPhotos); echo "</pre>";
*/
/* More comlex */
$albumPhotos=GooglePhotosURLs($url,NULL,NULL,TRUE);
foreach($albumPhotos as $photoURL) {
	$photoURL=explode('=',$photoURL); 	// [0] - base url == GooglePhoto preview, [1] - original size
	echo '<a href="'.$photoURL[0].'='.$photoURL[1].'" target="_blank"><img src="'.$photoURL[0].'"></a>';
}
?>
</body>
</html>
