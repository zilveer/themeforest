<?php $style = 'boxed'; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo avia_get_browser('class', true); echo " html_$style";?> ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
	global $avia_config;

	/*
	 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
	 * located in framework/php/function-set-avia-frontend.php
	 */
	 if (function_exists('avia_set_follow') && empty($avia_config['deactivate_seo'])) { echo avia_set_follow(); }


	 /*
	 * outputs a favicon if defined
	 */
	 if (function_exists('avia_favicon'))    { echo avia_favicon(avia_get_option('favicon')); }

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
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/grid.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/base.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/layout.css?v=1" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/slideshow.css?v=1" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>



<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<!--<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>-->


<!-- mobile setting -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">




<?php

	/* add javascript */

	wp_enqueue_script( 'jquery' );
	//wp_enqueue_script( 'avia-html5-video' );
	wp_enqueue_script( 'avia-default' );
	wp_enqueue_script( 'avia-social' );
	wp_enqueue_script( 'avia-prettyPhoto' );
	wp_enqueue_script( 'aviapoly-slider' );



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
?>


<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css" type="text/css" media="screen"/>

</head>


<body id="top" <?php body_class(avia_get_option('blog_layout')." ".$style.$avia_config['font_stack']); ?>>

	<div id='wrap_all'>

			<div class='container_wrap' >

						<div class='container'>

							<div id='overflow_bg'></div>
							<div id='sidebar_bg'></div>

							<div id='header' class='seven units alpha offset-by-one'>

							<?php

							/*
							*	display the theme logo by checking if the default css defined logo was overwritten in the backend.
							*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
							*/
							echo avia_logo(AVIA_BASE_URL.'images/layout/logo.png');



								echo '<ul class="social_bookmarks">';
								do_action('avia_add_social_icon','header');
								if($dribbble = avia_get_option('dribbble')) { echo "<li class='dribbble'><a href='http://dribbble.com/".$dribbble."'>".__('Follow us on dribbble', 'avia_framework')."</a></li>"; }
								if($twitter  = avia_get_option('twitter'))  { echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>".__('Follow us on Twitter', 'avia_framework')."</a></li>"; }
								if($facebook = avia_get_option('facebook')) { echo "<li class='facebook'><a href='".$facebook."'>".__('Join our Facebook Group', 'avia_framework')."</a></li>";	}
								if($gplus    = avia_get_option('gplus'))    { echo "<li class='gplus'><a href='".$gplus."'>".__('Join me on Google Plus', 'avia_framework')."</a></li>"; }
								if($linkedin   = avia_get_option('linkedin'))    { echo "<li class='linkedin'><a href='".$linkedin."'>".__('Add me on Linkedin', 'avia_framework')."</a></li>"; }

								echo '	<li class="rss"><a href="'.avia_get_option('feedburner',get_bloginfo('rss2_url')).'">RSS</a></li>';
								echo '</ul>';




							?>
							</div> <!-- end header -->

							<div id='primary' class='<?php echo $avia_config['content_class']; ?> units'>





