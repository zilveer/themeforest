<?php
	header("Content-type: text/css");
	require_once('../../../../../wp-load.php');

	$google_font_1 = get_option(THEME_NAME."_google_font_1");

?>
/* Font Family */
body {
	font-family: '<?php echo $google_font_1;?>', sans-serif;
}
.block-text-left, .block-text-right, .block-text-center {
	font-family: Georgia, "Times New Roman", Times, serif;
}
.button, button, input[type="submit"], input[type="reset"], input[type="button"], .entry-content .more-link {
	font-family: inherit;
}
input[type="text"], input[type="password"], input[type="search"], input[type="email"], textarea, select {
	font-family: '<?php echo $google_font_1;?>', sans-serif;
}