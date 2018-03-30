<!DOCTYPE html>
<html <?php language_attributes(); ?> class='html_container '>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
	global $avia_config;

	/*
	 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
	 * located in framework/php/function-set-avia-frontend.php
	 */
	 if (function_exists('avia_set_follow') && empty($avia_config['deactivate_seo'])) { echo avia_set_follow(); }

	echo "\n\n\n<!-- page title, displayed in your browser bar -->\n";

	if(!empty($avia_config['deactivate_seo']))
	{
		$avia_page_title = wp_title('', false);
	}
	else
	{
		$avia_page_title = get_bloginfo('name') . ' | ' . (is_home() ? get_bloginfo('description') : wp_title('', false));
	}

	echo "<title>$avia_page_title</title>";
?>


<!-- add feeds, pingback and stuff-->
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- add css stylesheets -->
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/<?php avia_option('stylesheet', 'minimal-skin.css'); ?>" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/slideshow.css" type="text/css" media="screen"/>


<?php

	/* add javascript */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'avia-default' );
	wp_enqueue_script( 'avia-prettyPhoto' );
	wp_enqueue_script( 'avia-html5-video' );
	wp_enqueue_script( 'avia_fade_slider' );
	wp_enqueue_script( 'avia_fullscreen_slider' );
	wp_enqueue_script( 'avia_masonry' );


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

?>

<!-- plugin and theme output with wp_head() -->
<?php

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */

	wp_head();
	$fullwidth_slider = new avia_gallery_slider();
?>

<!-- custom.css file: use this file to add your own styles and overwrite the theme defaults -->
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css" type="text/css" media="screen"/>
<!--[if lt IE 8]>
<style type='text/css'> .one_fourth	{ width:21.5%;} </style>
<![endif]-->

</head>



<body id="top" <?php body_class(avia_get_option('sidebar_position')." ".$fullwidth_slider->instant_gal()." ". avia_get_option('boxed'). " ".avia_get_browser()); ?>>

	<?php
	$fullwidth_slider->display();
	?>

	<a class='return_content' href='#return_content'><?php _e('show sidebar &amp; content','avia_framework'); ?></a>
	<div id='wrap_all'>

	<!-- ####### HEAD CONTAINER ####### -->
			<div class='container_wrap' id='header'>

			</div>
			<!-- end container_wrap_header -->

	<!-- ####### END HEAD CONTAINER ####### -->



