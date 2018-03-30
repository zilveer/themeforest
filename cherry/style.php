<?php
if(extension_loaded('zlib')){ob_start('ob_gzhandler');}

header("Content-type: text/css; charset: UTF-8");
header("Cache-Control: must-revalidate");
$offset = 60 * 60 ;
$ExpStr = "Expires: " .
gmdate("D, d M Y H:i:s",
time() + $offset) . " GMT";
header($ExpStr);


// Begin theme options
$layout_style = of_get_option('layout_style');
$body_background = of_get_option('body_background');
$pattern_background = of_get_option('pattern_background');
$typography = of_get_option('body_typography');
$menu_typography = of_get_option('menu_typography');

// Main Body Styles
echo 'body {';
if ($typography) {
		echo 'color:'.$typography['color'].';';
		echo 'font-size:'.$typography['size'].';';
		echo 'font-family:'.$typography['face'].';';
		echo 'font-weight:'.$typography['style'].';';
		echo 'font-style:'.$typography['style'].';';
	}

// Verify if layout = boxed
if ($layout_style == 'boxed') { 	

// Custom Background
if ($body_background) {
	if ($body_background['image']) {
	echo 'background:'.$body_background['color'].' url('.$body_background['image'].') '.$body_background['repeat'].' '.$body_background['position'].' '.$body_background['attachment'].'';
	} elseif ($body_background['color']) {
	echo 'background-color:'.$body_background['color'].';';
	}
}

// Pattern Background
if ($pattern_background) {
	if ($pattern_background !== 'none') {
	echo 'background: url('.get_template_directory_uri().'/images/patterns/'.$pattern_background.'.png) repeat left top;';
	}
}

}

// End Body Styles
echo '}';

// Main Menu Styles
echo '#navigation ul li a, #site-title a {';
if ($menu_typography) {
		echo 'color:'.$menu_typography['color'].';';
		echo 'font-size:'.$menu_typography['size'].';';
		echo 'font-family:'.$menu_typography['face'].';';
		echo 'font-weight:'.$menu_typography['style'].';';
		echo 'font-style:'.$menu_typography['style'].';';
	}
echo '}';		

// H1 Settings
$h1 = of_get_option('h1_typography');

echo 'h1 {';
if ($h1) {
		echo 'color:'.$h1['color'].';';
		echo 'font-size:'.$h1['size'].';';
		echo 'font-family:'.$h1['face'].';';
		echo 'font-weight:'.$h1['style'].';';
		echo 'font-style:'.$h1['style'].';';
	}
	echo '}';
	
// H2 Settings
$h2 = of_get_option('h2_typography');

echo 'h2 {';
if ($h2) {
		echo 'color:'.$h2['color'].';';
		echo 'font-size:'.$h2['size'].';';
		echo 'font-family:'.$h2['face'].';';
		echo 'font-weight:'.$h2['style'].';';
		echo 'font-style:'.$h2['style'].';';
	}
	echo '}';

// H3 Settings
$h3 = of_get_option('h3_typography');

echo 'h3 {';
if ($h3) {
		echo 'color:'.$h3['color'].';';
		echo 'font-size:'.$h3['size'].';';
		echo 'font-family:'.$h3['face'].';';
		echo 'font-weight:'.$h3['style'].';';
		echo 'font-style:'.$h3['style'].';';
	}
	echo '}';
	
// H4 Settings
$h4 = of_get_option('h4_typography');

echo 'h4 {';
if ($h4) {
		echo 'color:'.$h4['color'].';';
		echo 'font-size:'.$h4['size'].';';
		echo 'font-family:'.$h4['face'].';';
		echo 'font-weight:'.$h4['style'].';';
		echo 'font-style:'.$h4['style'].';';
	}
	echo '}';

// h5 Settings
$h5 = of_get_option('h5_typography');

echo 'h5 {';
if ($h5) {
		echo 'color:'.$h5['color'].';';
		echo 'font-size:'.$h5['size'].';';
		echo 'font-family:'.$h5['face'].';';
		echo 'font-weight:'.$h5['style'].';';
		echo 'font-style:'.$h5['style'].';';
	}
	echo '}';
?>

<?php
	$sidebar_position = of_get_option('page_layout');
	$content_position = ($sidebar_position == "right" ? "left" : "right");
	$sidebar_margin = ($sidebar_position == "right" ? "left" : "right");
?>
.container #content {float:<?php echo $content_position; ?>;}
.container #sidebar {float:<?php echo $sidebar_position; ?>;}

<?php
if(extension_loaded('zlib')){ob_end_flush();}
?>