<?php
function GooglePhotosURLs($albumURL,$width=NULL,$height=NULL,$urlsOnly=FALSE) {
/* Get the GooglePhoto permanent album url, and
return array of <img ...> strings of it photos, with permanent url's too.
If no $width $height params - return full size images.
If any of $width or $height params == 0 - return Google preview size images.
If present $width or $height params - return scaled by Google to this size images.
If present $width and $height params - return scaled by Google to min of this sizes images.

If not album - not return. If empty album - empty array return.
*/
$needle = 'https://lh3';
$albumsPhotos = array();
$googletail = '';

//echo "$albumURL\n";
if( $album = fopen($albumURL,'r')) {
	while (($buffer = fgets($album, 4096)) !== FALSE) {
		//echo "$buffer\n";
		if(($buffer=stristr($buffer,$needle)) === FALSE) continue; 	// если это не строка с требуемым url - проехали
		//echo "$buffer\n";
		$buffer = explode(',',$buffer);
		//print_r($buffer);
		if((count($buffer)!=10) AND (count($buffer)!=3)) continue; 	// требуемая строка - 10 значений, раздёлённых запятыми
		array_walk($buffer, function ($val){return trim($val," \t\n\r\0\x0B\"][");});
		/* итак, первый элемент - url, второй и третий - width height, десятый - ? */
		if($width===NULL AND $height===NULL) {
			$googletail='=w'.$buffer[1].'-h'.$buffer[2]; 	// исходный размер
		}
		elseif($width AND $height) {
			$googletail='=w'.$width.'-h'.$height; 		// приведение к меньшему из указанных размеров
		}
		elseif($width) {
			$googletail='=w'.$width; 		// приведение к ширине
		}
		elseif($height) {
			$googletail='=-h'.$height; 		// приведение к высоте
		}
		if($urlsOnly) $albumsPhotos[] = $buffer[0].$googletail;
		else $albumsPhotos[] = '<img src="'.$buffer[0].$googletail.'">'."\n";
	}
	if (!feof($album)) {
		echo "Error: unexpected fgets() fail, may be not all images presents\n";
	}
	fclose($album);
	return $albumsPhotos;
}
} // end function GooglePhotosURLs
?>

