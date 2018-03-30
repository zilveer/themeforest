<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php zilla_meta_head(); ?>
	
	<!-- Title -->
	<title><?php wp_title('|', true, 'right'); ?></title>
	
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if(zilla_get_option('general_feedburner_url')){ echo zilla_get_option('general_feedburner_url'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
    <?php zilla_head(); ?>
    
<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class( 'no-js' ); ?>>
    <?php zilla_body_start(); ?>
	
	    <?php zilla_header_before(); ?>
		<!-- BEGIN #header -->
		<div id="header">
		
		    <!-- BEGIN .header-inner -->
		    <div class="header-inner">
    		<?php zilla_header_start(); ?>
			
    			<!-- BEGIN #logo -->
    			<div id="logo">
    				<?php /*
    				If "plain text logo" is set in theme options then use text
    				if a logo url has been set in theme options then use that
    				if none of the above then use the default logo.png */
    				if( zilla_get_option('general_text_logo') == 'on' ) { ?>
    				    <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
    				<?php } elseif( zilla_get_option('general_custom_logo') ) { ?>
    				    <a href="<?php echo home_url(); ?>"><img src="<?php echo zilla_get_option('general_custom_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
    				<?php } else { ?>
    				    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" width="240" height="30" /></a>
    				<?php } ?>
    				
    				<p id="tagline"><?php bloginfo( 'description' ); ?></p>
    			<!-- END #logo -->
    			</div>
			
	        <?php zilla_header_end(); ?>	
	        <!-- END .header-inner -->
	        </div>
    	        
		<!-- END #header-->
		</div>
		<?php zilla_header_after(); ?>
		
		<!-- BEGIN .main-navigation -->
		<div class="main-navigation">
		
		    <?php zilla_nav_before(); ?>
    		<!-- BEGIN #primary-nav -->
    		<div id="primary-nav">
    		    <?php if( has_nav_menu( 'primary-menu' ) ) {
    		        wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu' ) ); 
    		    } ?>
    		    
    		    <?php /* remove this line to remove search box */ get_search_form(); ?>
    		<!-- END #primary-nav -->
    		</div>
    		<?php zilla_nav_after(); ?>
		
		<!-- END .main-navigation -->
		</div>
		
		<!-- BEGIN #content -->
		<div id="content" class="clearfix">
		<?php zilla_content_start(); ?>