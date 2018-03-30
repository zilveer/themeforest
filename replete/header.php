<?php
	global $avia_config;

	$style 		= $avia_config['box_class'];
	$responsive	= avia_get_option('responsive_layout','responsive');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo " html_$style ".$responsive;?> ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php

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


<!-- mobile setting -->
<?php
if($responsive === 'responsive') echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
?>


<?php

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */

	wp_head();
?>




</head>



<?php
/*
 * prepare big slideshow if available
 * If we are displaying a dynamic template the slideshow might already be set
 * therefore we dont need to call it here
 */

if(!avia_is_dynamic_template(avia_get_the_ID()))
{
	if(isset($post))
	{
		$slider = new avia_slideshow(avia_get_the_ID());
		$slider->customClass('stretch_full');

		$avia_config['slide_output'] =  $slider->display_big();
	}
}
else
{
	$style .= " dynamic-title-".$avia_config['dynamic_title'];
}


?>


<body id="top" <?php body_class($style." ".$avia_config['font_stack']); ?>>

	<?php

		/*
		*	display the themes social media icons, defined in the wordpress backend
		*   the avia_social_media_icons function is located in includes/helper-social-media-php
		*/
		$args = array('outside'=>'ul', 'inside'=>'li', 'append' => '');
		avia_social_media_icons($args);

	?>

	<div id='wrap_all'>

			<!-- ####### HEAD CONTAINER ####### -->
				<div id='header'>

				<div class='container_wrap container_wrap_logo header_color <?php avia_is_dark_bg('header_color'); ?>'>

						<div class='container' id='logo_container'>

							<?php
							/*
							*	display the theme logo by checking if the default logo was overwritten in the backend.
							*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
							*/
							echo avia_logo(AVIA_BASE_URL.'images/layout/logo.png');

							/*
							*	display the main navigation menu
							*   check if a description for submenu items was added and change the menu class accordingly
							*   modify the output in your wordpress admin backend at appearance->menus
							*/

							/*
							* Hook that can be used for plugins and theme extensions like the wpml language selector
							*/
							do_action('avia_meta_header');

							echo "<div class='header_meta'>";

							/*
							* Display the search form
							*/
							get_search_form();
							
							

							echo "</div>";

							//display the small submenu
							echo "<div class='sub_menu'>";
							$args = array('theme_location'=>'avia2', 'fallback_cb' => '', 'container'=>'');
							if(avia_woocommerce_enabled()) $args['fallback_cb'] ='avia_shop_nav';
							wp_nav_menu($args);
							echo "</div>";

							?>

						</div>

				</div><!-- end container_wrap-->


				<div class='container_wrap container_wrap_menu header_color <?php avia_is_dark_bg('header_color'); ?>'>

					<div class='container' id='menu_container'>

						<?php
							echo "<div class='main_menu' data-selectname='".__('Select a page','avia_framework')."'>";
							$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu', 'walker' => new avia_responsive_mega_menu());
							wp_nav_menu($args);

							if(avia_woocommerce_enabled()) echo avia_woocommerce_cart_dropdown();
							echo "</div>";
						?>

						</div><!-- end container-->

				</div><!-- end container_wrap-->




			<!-- ####### END HEAD CONTAINER ####### -->
			</div>


			<?php
			//display slideshow big if one is available
			if(!empty($avia_config['slide_output']))
			{
			    if(!empty($avia_config['slide_output_before']))  echo $avia_config['slide_output_before'];

				echo "<!-- ####### SLIDESHOW CONTAINER ####### -->";
				echo "<div id='slideshow_big' class='slideshow_color container_wrap ".avia_is_dark_bg('slideshow_color', true)."'>";
				echo "<div class='container slideshow_big_container'>".$avia_config['slide_output']."</div></div>";
			}
			?>




		<!-- ####### MAIN CONTAINER ####### -->
		<div id='main'>