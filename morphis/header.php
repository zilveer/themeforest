<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="wrapper">
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="author" content="">
<?php global $NHP_Options; ?>
<?php $options_morphis = $NHP_Options; ?>
<?php //if( !empty($options_morphis['option_disable_responsive_grid']) ) { ?>
<?php if( !$options_morphis['option_disable_responsive_grid'] == '1' ) { ?>
<meta name="viewport" content="width=device-width,initial-scale=1">	
<?php } ?>
<?php //} ?>
<?php if ( !defined('WPSEO_VERSION') ) : ?>
<title><?php
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;

wp_title( '|', true, 'right' );

// Add the blog name.
bloginfo( 'name' );

// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 )
	echo ' | ' . sprintf( __( 'Page %s', 'morphis' ), max( $paged, $page ) );

?></title>
<?php else: ?>
<title><?php wp_title(''); ?></title>
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if( $options_morphis['faviconUpload'] != '' ) : ?>
<link rel="shortcut icon" href="<?php echo $options_morphis['faviconUpload']; ?>">
<?php endif; ?>
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png">

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	
	wp_head();
?>


</head>

<body <?php body_class(); ?>>

<!-- MAIN WRAPPER -->
<div id="wrapper">
  <!-- TOP SECTION -->
  <?php if($options_morphis['enable_top_section'] == '1'): ?>
  <?php get_template_part('inc/social-links'); ?>	
  <?php endif; ?>
  <!-- END TOP SECTION -->
  <!-- HEADER CONTAINER-->
  
  <div class="container">
	<!-- HEADER -->
	<header id="branding" role="banner" class="sixteen columns">
		<div class="five columns alpha">
			<div class="container-frame">
				<!-- HEADER LOGO -->
				<?php 				
					
					if( $options_morphis['logoUpload'] != '' && isset($options_morphis['logoUpload']) ) {
						$site_logo = '<img src="'. $options_morphis['logoUpload'] .'" alt="logo" id="img-logo" />';
					} else {
						$site_logo = get_bloginfo( 'name' );
					}
				?>						
				<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="logo"><?php echo $site_logo; ?></a></div>
				<span id="site-description"><?php bloginfo( 'description' ); ?></span>
			</div>
		</div>
		<div id="nav-container" class="eleven columns omega">
			<div class="container-frame">
				<!-- END HEADER LOGO -->
				<!-- NAVIGATION -->
				<nav id="access" role="navigation">				
					<?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
				</nav><!-- #access -->
				<!-- END NAVIGATION -->
			
				<div class="clear"></div>			
			</div>
		</div>
		
    </header>
	<!-- END HEADER -->	