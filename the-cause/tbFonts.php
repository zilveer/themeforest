<?php

$fontFile = get_option('tb_font');
$fontFile2 = get_option('tb_font2');

if ($fontFile) {
	echo "<link href='" . TEMPLATE_DIRECTORY ."/styles/fonts/$fontFile' rel='stylesheet' type='text/css' media='screen'>\n";
} else {
	echo "<link href='" . TEMPLATE_DIRECTORY ."/styles/fonts/" . DEFAULT_FONT ."' rel='stylesheet' type='text/css' media='screen'>\n";
}

if ($fontFile2) {
	echo "<link href='" . TEMPLATE_DIRECTORY ."/styles/fonts2/$fontFile2' rel='stylesheet' type='text/css' media='screen'>\n";
} else {
	echo "<link href='" . TEMPLATE_DIRECTORY ."/styles/fonts2/" . DEFAULT_FONT2 ."' rel='stylesheet' type='text/css' media='screen'>\n";
}

?>