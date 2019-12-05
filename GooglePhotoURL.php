<?php
function GooglePhotoURL($photoURL,$width=NULL,$height=NULL,$urlOnly=NULL) {
/* v.1.0
Get the GooglePhoto share url, and
return the <a ...><img ...></a> string of it photo, with permanent url.

If $urlOnly return a string with url with $width and $height only
Else return <a ...><img ...></a> string, there <img> have $width and $height size,
	and <a> are link to the original size in new window.
	
If $urlOnly == 'csv' - return a string '"original_file_name","url_with_$width_and_$height"'

If no $width $height params - return full size image.
If any of $width or $height params == 0 - return Google preview size image.
If present $width or $height params - return scaled by Google to this size image.
If present $width and $height params - return scaled by Google to min of this sizes image.

*/
$needle = 'https://lh3';
$googletail = '';
$permanentPhotoURL = '';
//echo "$photoURL,$width,$height,$urlOnly\n";
if( $photo = fopen($photoURL,'r')) {
	while (($buffer = fgets($photo, 4096)) !== FALSE) {
		if(($buffer=stristr($buffer,$needle)) === FALSE) continue; 	// если это не строка с требуемым url - проехали
		$buffer = explode(',',$buffer);
		if(count($buffer)!=10) continue; 	// требуемая строка - 10 значений, раздёлённых запятыми
		$buffer[0]=trim($buffer[0]);
		$buffer[0]=trim($buffer[0],'"');
		// итак, первый элемент - url, второй и третий - width height, десятый - ? 
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
		if($urlOnly) {
			if( (string)$urlOnly == 'csv') { 	// иначе происходит преобразование к числу
				$img = file_get_contents($buffer[0]); 	// 
				//print_r($http_response_header);
				$filename='';
				foreach($http_response_header as $header) {
					if((strpos($header,'Content-Disposition')!==FALSE) AND (($pos=strpos($header,'filename='))!==FALSE)) {
						$filename = trim(substr($header,$pos+9),'"');
						break;
					}
				}
				$permanentPhotoURL = '"'.$filename.'","'.$buffer[0].$googletail.'"';
			}
			else $permanentPhotoURL = $buffer[0].$googletail;
		}
		else {
			if($width===NULL AND $height===NULL) $googletail = '';
			$permanentPhotoURL = '<a href="'.$buffer[0].'=w'.$buffer[1].'-h'.$buffer[2].'" target="_blank"><img src="'.$buffer[0].$googletail.'"></a>';
		}
	}
	if (!feof($photo)) {
		echo "Error: unexpected fgets() fail, may be not all images presents\n";
	}
	fclose($photo);
	return $permanentPhotoURL;
}
} // end function GooglePhotosURLs
?>

