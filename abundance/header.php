<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
	wp_enqueue_script( 'avia-slider' );
	wp_enqueue_script( 'aviacordion' );


	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }

	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
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

<!-- custom.css file: use this file to add your own styles and overwrite the theme defaults -->
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css" type="text/css" media="screen"/>
<!--[if lt IE 8]>
<style type='text/css'> .one_fourth	{ width:21.5%;} div{zoom:1;}</style>
<![endif]-->

</head>



<?php
/*
 * prepare big slideshow if available
 * If we are displaying a dynamic template the slideshow might already be set
 * therefore we dont need to call it here
 */

if(!avia_special_dynamic_template())
{
	avia_template_set_page_layout();
	$slider = new avia_slideshow(avia_get_the_ID());
	$avia_config['slide_output'] =  $slider->display();
}


$style = avia_get_option('boxed','boxed');
?>


<body id="top" <?php body_class($style." ".avia_get_browser()); ?>>

	<div class='mobile_wrap'>

			<!-- ####### HEAD CONTAINER ####### -->

			<div class='container_wrap <?php echo $style; ?>' id='header'>


				<div class='container'>

					<?php
					/*
					*	display the theme logo by checking if the default css defined logo was overwritten in the backend.
					*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
					*/
					echo avia_logo();


					/*
					*	display the theme search form
					*   the tempalte file that is called is searchform.php in case you want to edit it
					*/
					get_search_form();
					?>

					<ul class="social_bookmarks">
						<?php do_action('avia_add_social_icon','header'); ?>

						<li class='rss'><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
						<?php
						if($twitter = avia_get_option('twitter')) echo "<li class='twitter'><a href='http://twitter.com/".$twitter."'>Twitter</a></li>";
						if($facebook = avia_get_option('facebook')) echo "<li class='facebook'><a href='".$facebook."'>Twitter</a></li>";
						 ?>
					</ul>
					<!-- end social_bookmarks-->


				</div>
				<!-- end container-->


			</div>
			<!-- end container_wrap_header -->

			<!-- ####### END HEAD CONTAINER ####### -->



			<div id='wrap_all'>


			<?php

				/*
				*	display the main navigation menu
				*   check if a description for submenu items was added and change the menu class accordingly
				*   modify the output in your wordpress admin backend at appearance->menus
				*/
				echo "<div class='main_menu'>";
				$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu', 'max_columns'=>4);
				wp_nav_menu($args);
				if(avia_woocommerce_enabled()) echo avia_woocommerce_cart_dropdown();
				echo "</div>";

				echo "<div class='sub_menu'>";
				$args = array('theme_location'=>'avia2', 'fallback_cb' => '');
				if(avia_woocommerce_enabled()) $args['fallback_cb'] ='avia_shop_nav';
				wp_nav_menu($args);
				echo "</div>";


				//display slideshow big if one is available
				if(!empty($avia_config['slide_output'])) echo "<div class='container slideshow_big'>".$avia_config['slide_output']."</div>";


			?>
