<?php

// theme explorer
if (file_exists(dirname( __FILE__ ) . '/_theme-explorer/header.php')) { 
	//if (session_status() == PHP_SESSION_NONE) {
	if(!isset($_SESSION)) {
		session_start();
	}
}

global $woo_options;
global $woocommerce;
global $wp_version;
global $theretailer_theme_options;

$header_style = "";

if (isset($_GET["header_style"])) { $header_style = $_GET["header_style"]; }

if ($header_style == "default") {
    $theretailer_theme_options['gb_header_style'] = 0;
} elseif ($header_style == "centered") {
    $theretailer_theme_options['gb_header_style'] = 1;
} elseif ($header_style == "under") {
    $theretailer_theme_options['gb_header_style'] = 2;
}

?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]--><head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- ******************************************************************** -->
<!-- ************************ Custom Favicon **************************** -->
<!-- ******************************************************************** -->

<?php
if ( !$theretailer_theme_options['favicon_image'] ) {
	
	if (is_ssl()) {
		$favicon_image_img = str_replace("http://", "https://", get_template_directory_uri() . "/favicon.ico");		
	} else {
		$favicon_image_img = get_template_directory_uri() . "/favicon.ico";	
	}
	
} else {
	
	if (is_ssl()) {
		$favicon_image_img = str_replace("http://", "https://", $theretailer_theme_options['favicon_image']);		
	} else {
		$favicon_image_img = $theretailer_theme_options['favicon_image'];
	}
}
?>

<link rel="shortcut icon" href="<?php echo $favicon_image_img; ?>" />

<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script> -->

<!-- ******************************************************************** -->
<!-- *********************** Custom Javascript ************************** -->
<!-- ******************************************************************** -->

<?php if ( (isset($theretailer_theme_options['custom_js_header'])) && ($theretailer_theme_options['custom_js_header'] != "") ) : ?>
	<?php echo $theretailer_theme_options['custom_js_header']; ?>
<?php endif; ?>

<!-- ******************************************************************** -->
<!-- *********************** WordPress wp_head() ************************ -->
<!-- ******************************************************************** -->
	
<?php wp_head(); ?>
</head>

<!-- *********************************************************************** -->
<!-- ********************* EVERYTHING STARTS HERE ************************** -->
<!-- *********************************************************************** -->

<body <?php body_class(); ?>>

	<?php if (file_exists(dirname( __FILE__ ) . '/_theme-explorer/header.php')) { include_once('_theme-explorer/header.php'); } ?>
    <?php //if (file_exists(dirname( __FILE__ ) . '/_theme-explorer/content.php')) { include_once('_theme-explorer/content.php'); } ?>
    
    <div id="global_wrapper">
    
    <?php if (file_exists(get_template_directory().'/_demo_top_message.php')) include_once('_demo_top_message.php'); ?>
  
    <?php if ( (!$theretailer_theme_options['hide_topbar']) || ($theretailer_theme_options['hide_topbar'] == 0) ) { ?>
    	<?php include_once('header_topbar.php'); ?>    
    <?php } ?>
    
    <?php if ((!$theretailer_theme_options['gb_header_style']) || ($theretailer_theme_options['gb_header_style'] == "0")) { ?>
    	<?php include_once('header_style_default.php'); ?>
	<?php } else if (($theretailer_theme_options['gb_header_style'] == "1")) { ?>
    	<?php include_once('header_style_centered.php'); ?>
    <?php } else if (($theretailer_theme_options['gb_header_style'] == "2")) { ?>
    	<?php include_once('header_style_menu_under.php'); ?>
    <?php } ?>
		
        <?php
		if ((isset($theretailer_theme_options['progress_bar'])) && ($theretailer_theme_options['progress_bar'] == "1")) {
		?>
        <div class="progress-bar-wrapper"></div>
        <?php } ?>