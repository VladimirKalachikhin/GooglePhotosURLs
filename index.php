<?php
require_once("GooglePhotosURLs.php"); // 
require_once("GooglePhotoURL.php"); // 

$albumUrl = 'https://photos.app.goo.gl/ieZq8sHioiytnx6y6'; 	// album permanent link, getted as "Share"->"Get link" 
$photoUrl = 'https://photos.app.goo.gl/Gp2WP39VV9RwbNJf9'; 	// one photo permanent link, getted as "Share"->"Get link" 

?>
<!DOCTYPE html >
<html lang="ru">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Get GooglePhoto's url example</title>
</head>
<body>
<h1>Get & Show</h1>
<p>
Of course, there is no need of Get url's every time. Do it once in cli.<br>
<h2>One photo</h2>
<?php
$url = GooglePhotoURL($photoUrl);
echo "$url<br>\n";
?>
<h2>Album</h2>
<?php
/* Trivial example:
$albumsPhotos=GooglePhotosURLs($albumUrl);
echo "Album's Photos:<pre>"; print_r($albumsPhotos); echo "</pre>";
*/
/* More comlex */
$albumPhotos=GooglePhotosURLs($albumUrl,NULL,NULL,TRUE);
foreach($albumPhotos as $photoURL) {
	$photoURL=explode('=',$photoURL); 	// [0] - base url == GooglePhoto preview, [1] - original size
	echo '<a href="'.$photoURL[0].'='.$photoURL[1].'" target="_blank"><img src="'.$photoURL[0].'"></a>';
}
?>
</body>
</html>
