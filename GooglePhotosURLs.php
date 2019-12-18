<?php
function GooglePhotosURLs($albumURL,$width=NULL,$height=NULL,$urlsOnly=NULL) {
/* v.2.0
New: now needed array have 5 elements, not 10

Get the GooglePhoto album shared url, and
return array of the strings permanent urls of the albums photos.
else if $urlsOnly=='csv' - return a array of the arrays with 2 elements:
 first - the original image file name, second - the permanent url
If no the $width $height params - return full size images.
If any of the $width or $height params == 0 - return a Google preview size images.
If present a $width or $height params - return the scaled by Google to the this size images.
If present a $width and $height params - return the scaled by Google to min of the this sizes images.

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
		$buffer = explode(',',$buffer);
		//print_r($buffer);
		//if((count($buffer)!=10) AND (count($buffer)!=3)) continue; 	// требуемая строка - 10 значений, раздёлённых запятыми
		if((count($buffer)!=5) AND (count($buffer)!=3)) continue; 	// требуемая строка - 5 значений, раздёлённых запятыми
		array_walk($buffer, function (&$val){$val=trim($val," \t\n\r\0\x0B\"][");});
		//print_r($buffer);
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
		switch($urlsOnly) {
		case 'csv':
			$img = file_get_contents($buffer[0]); 	// 
			//print_r($http_response_header);
			$filename='';
			foreach($http_response_header as $header) {
				if((strpos($header,'Content-Disposition')!==FALSE) AND (($pos=strpos($header,'filename='))!==FALSE)) {
					$filename = trim(substr($header,$pos+9),'"');
					break;
				}
			}
			$albumsPhotos[] = array($filename,$buffer[0].$googletail);
			break;
		default:
			$albumsPhotos[] = $buffer[0].$googletail;
		}
	}
	if (!feof($album)) {
		echo "Error: unexpected fgets() fail, may be not all images presents\n";
	}
	fclose($album);
	return $albumsPhotos;
}
} // end function GooglePhotosURLs
?>

