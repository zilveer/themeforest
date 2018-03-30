<!DOCTYPE html> 
<!--[if lt IE 7 ]><html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php wp_title(''); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,300italic,400italic,600italic,700italic&subset=latin,latin-ext" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<?php echo wpb_page_background_image(); ?>

<div id="wrap">
	<header id="header">
		<div id="header-inner" class="container fix">
			<?php echo wpb_site_name(); ?>
			<?php echo wpb_site_desc(); ?>
			<?php wp_nav_menu(array('container'=>'nav','container_id'=>'header-nav','container_class'=>'fix','theme_location'=>'wpb-nav-header','menu_id'=>'nav','fallback_cb'=>FALSE)); ?>
		</div>		
	</header><!--/header-->