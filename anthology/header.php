<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type"
	content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php if (is_home()) {
	echo bloginfo('name');
} elseif (is_category()) {
	echo __('Category &raquo; ', 'blank'); wp_title('&laquo; @ ', TRUE, 'right');
	echo bloginfo('name');
} elseif (is_tag()) {
	echo __('Tag &raquo; ', 'blank'); wp_title('&laquo; @ ', TRUE, 'right');
	echo bloginfo('name');
} elseif (is_search()) {
	echo __('Search results &raquo; ', 'blank');
	echo the_search_query();
	echo '&laquo; @ ';
	echo bloginfo('name');
} elseif (is_404()) {
	echo '404 '; wp_title(' @ ', TRUE, 'right');
	echo bloginfo('name');
} else {
	echo wp_title(' @ ', TRUE, 'right');
	echo bloginfo('name');
} ?>
</title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/nivo-slider.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/superfish.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fonts.css" type="text/css" charset="utf-8" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/cssLoader.php" type="text/css" media="screen" charset="utf-8" />
	
	
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	
<?php 
wp_enqueue_script('jquery');
wp_head(); ?>
	<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/script/jquery.prettyPhoto.js"></script>

	
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/jquery.tools.min.js"></script> 
<script type="text/javascript"
	src="<?php echo get_template_directory_uri(); ?>/script/script.js"></script>
	
<script type="text/javascript">

jQuery(document).ready(function($){
	pexetoSite.initSite();
});

</script>

	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<!-- enables nested comments in WP 2.7 -->


<!--[if lte IE 6]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie6.css" rel="stylesheet" type="text/css" /> 
 <input type="hidden" value="<?php echo get_template_directory_uri(); ?>" id="baseurl" /> 
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/script/supersleight.js"></script>
<![endif]-->
<!--[if IE 7]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie7.css" rel="stylesheet" type="text/css" />  
<![endif]-->
<!--[if IE 8]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie8.css" rel="stylesheet" type="text/css" />  
<![endif]-->

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

</head>
<body>
<div id="main-container">
<div class="loading-container hidden"></div>

<div id="line-top"></div>
<div id="header" >
<div id="logo-container" class="center"><a href="<?php echo home_url(); ?>"></a></div>
<div id="menu-container">
<div class="hr"></div>
<div id="menu" class="center">
<?php wp_nav_menu(array('theme_location' => 'pexeto_main_menu' )); ?>

 </div>
	  <div class="hr"></div>

</div>