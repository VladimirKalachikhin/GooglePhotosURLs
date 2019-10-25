<?php
require_once("GooglePhotoURL.php"); // 

if($argv[1]) {
	echo GooglePhotoURL($argv[1])."\n\n";
}
else echo "Usage:\n  php GooglePhotoURLcli.php https://yougooglephotosharedlink\n\n";
?>
