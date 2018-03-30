<?php
/* Send headers & start */
header("Content-type: application/x-javascript");
$wp_include = "../../../../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
	$wp_include = "../$wp_include";
}

require($wp_include);

?>