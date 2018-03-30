<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (get_option('tz_feedburner')) { echo get_option('tz_feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<div id="header" class="clearfix">
			
			<!-- BEGIN #primary-nav -->
    		<div id="primary-nav">
    			<?php if ( has_nav_menu( 'primary-menu' ) ) { 
    				wp_nav_menu( array( 
    					'theme_location' => 'primary-menu', 
    					'container' => '',
    					'menu_id' => 'primary-menu',
    					'menu_class' => 'sf-menu' ) ); 
    			} ?>
    		<!-- END #primary-nav -->
    		</div>
    		
    		<?php if( get_option('tz_header_splash') ) { ?>
    		<!-- BEGIN .header-splash -->
            <div class="header-splash">
                <?php echo get_option('tz_header_splash'); ?>
            </div>
    		<!-- END .header-splash -->
    		<?php } ?>
			
		<!--END #header-->
		</div>
		

		<!--BEGIN #content -->
		<div id="content" class="clearfix">
		