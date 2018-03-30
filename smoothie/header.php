<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head> 
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" /> 
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!-- bookmark icon -->
	<?php if ( of_get_option('of_favicon') ) { ?>
		<link rel="shortcut icon" href="<?php echo of_get_option('of_favicon'); ?>" />
	<?php } else { ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
	<?php } ?>
	
	<!-- media queries -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
	
	<!-- load scripts -->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="backgrimage">
        <div id="open-sidebar-overlay"></div>
        <div id="leftsidebar">
            <div class="leftsidebar-inner">
                
                <div class="logo-wrap">
                    <!-- grab the logo -->
                    <?php if ( of_get_option('of_logo') ) { ?>
                        <div class="logo-img">
                            <a href="<?php echo home_url( '/' ); ?>"><img class="logo" src="<?php echo of_get_option('of_logo'); ?>" alt="<?php the_title(); ?>" /></a>
                        </div>
                    <?php } else { ?> 
                    <div class="logo-text">
                        <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name') ?></a>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="menu-wrap">
                    <?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'main-nav')); ?>	
                </div>
                
                <div class="leftsidebar-widgets">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Menu Sidebar')) : else : ?>		
                    <?php endif; ?>
                </div>

            </div><!-- leftsidebar-inner -->
        </div><!-- leftsidebar -->

				<div id="wrapper" class="clearfix">
                    <div class="mobile-logo-wrap">
                        <a href="#" id="sdbr-trigger"><i class="fa fa-bars"></i></a>
                        <!-- grab the logo -->
                        <?php if ( of_get_option('of_logo') ) { ?>
                            <div class="logo-img">
                                <a href="<?php echo home_url( '/' ); ?>"><img class="logo" src="<?php echo of_get_option('of_logo'); ?>" alt="<?php the_title(); ?>" /></a>
                            </div>
                        <?php } else { ?> 
                        <div class="logo-text">
                            <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name') ?></a>
                        </div>
                        <?php } ?>
                    </div>
					<div id="main" class="clearfix">
