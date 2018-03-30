<?php
/**
 * The Header for our theme.
 *
 * @package BTP_Flare_Theme
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html class="no-js" id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html class="no-js" id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js" id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="initial-scale=1.0, width=device-width" />

<title>
<?php
    $title = wp_title( '', false, 'right' );
    echo $title ? $title : get_bloginfo('name').' - '.get_bloginfo('description');
?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri().'/js/tools/html5.js'; ?>"></script>
<![endif]-->


<?php
if ( is_singular() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}	
wp_head();
?>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/respond/respond.src.js"></script>
</head>

<body <?php body_class(); ?>>

<div id="page">

	<div id="page-inner">	
			
			
	<header id="header" role="banner" class="<?php echo btp_header_get_class(); ?>">
		<div id="header-inner">		
		
			<div id="primary-bar">	
				<div id="primary-bar-inner">	
					<?php btp_site_id_render(); ?>	
							
					<nav id="primary-nav">
                        <p id="primary-nav-tip" class="assistive-text"><?php _e('Go to:', 'btp_theme' ); ?></p>
						<?php 
							if ( has_nav_menu( 'primary_nav' ) ) {
								wp_nav_menu( array(
									'theme_location'	=> 'primary_nav',
									'container'			=> '',
									'menu_id'			=> 'primary-nav-menu',
									'menu_class'		=> 'dd-menu',
									'depth'				=> 0								
								));									
						 	} else {		 		
						 		btp_helpmode_render(
						 			__( 'Empty Primary Navigation', 'btp_theme' ),
						 			'<p>' . sprintf( __( 'You should <a href="%s">assign a menu to the Primary Navigation Theme Location</a>', 'btp_theme' ), network_admin_url( 'nav-menus.php' ) ) . '</p>'
						 		);
						 	}	
						?>					
					</nav><!-- #primary-nav -->						
				</div><!-- #primary-bar-inner -->
				<div class="background">
					<div class="pattern"></div>
					<div class="flare">
						<div></div>
						<div></div>
					</div>
				</div>
			</div><!-- #primary-bar -->
			
			<div id="secondary-bar">
				<div id="secondary-bar-inner">
					<?php do_action( 'icl_language_selector' ); ?>				
					<?php if ( has_nav_menu( 'secondary_nav' ) ): ?>
					<nav id="secondary-nav">
					<?php 
						wp_nav_menu( array(
							'theme_location'	=> 'secondary_nav',
							'container'			=> '',
							'menu_id'			=> 'secondary-nav-menu',
							'menu_class'		=> 'simple-menu meta',
							'depth'				=> 0								
						));
					?>					
					</nav><!-- #secondary-nav -->
					<?php endif; ?>
					
					<?php 
						if ( 'none' !== btp_theme_get_option_value('style_header_searchform' ) && !is_404() ) {
							get_search_form();
						}	
					?>
					
					<?php if ( 'none' !== btp_theme_get_option_value('style_header_feeds' ) ): ?>
					<div id="feeds-nav">
						<?php echo do_shortcode('[feeds template="list-horizontal" hide="label, caption"]'); ?>
					</div>	
					<?php endif; ?>
				</div><!-- #secondary-bar-inner -->
			</div><!-- #secondary-bar -->		
				
				
		</div><!-- #header-inner -->
		<div class="background"><div></div></div>
	</header><!-- #header -->