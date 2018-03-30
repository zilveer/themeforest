<!DOCTYPE html>

<!--[if IE 7]>                  <html class="ie7 no-js"  <?php language_attributes(); ?>     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js"  <?php language_attributes(); ?>     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title><?php wp_title('|', true, 'right'); ?></title>

	<?php if( of_get_option('ss_favicon') ): ?>
		<link rel="icon" type="image/png" href="<?php echo of_get_option('ss_favicon'); ?>">
	<?php endif; ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="header" class="container clearfix">

	<a href="<?php echo home_url('/'); ?>" id="logo" title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
		<?php if( of_get_option('ss_logo') ): ?>
			<img src="<?php echo of_get_option('ss_logo'); ?>" alt="<?php bloginfo('name'); ?>">
		<?php else: ?>
			<h1><?php bloginfo('name'); ?></h1>
		<?php endif; ?>
	</a>

	<nav id="main-nav">
		
		<?php echo ss_framework_main_navigation(); ?>

	</nav><!-- end #main-nav -->
	
</header><!-- end #header -->