<?php
/**
 * The Header base for MPC WP Boilerplate
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

global $mpcth_cake;
global $mpcth_options;
global $mpcth_sidebar_options;
global $post;
global $ID;

if($post != '')
	$ID = $post->ID;
if(isset($ID) && isset($mpcth_sidebar_options['custom_sidebars']) && isset($mpcth_sidebar_options['custom_sidebars']['top_area'])) {
	if(isset($mpcth_sidebar_options['custom_sidebars']['top_area']['id_' . $ID])) {
		$custom_top_area = true;
		$custom_top_area_id = 'custom_top_area_' . $ID;
	} else {
		$custom_top_area = false;
	}
} else {
	$custom_top_area = false;
}
?>

<!DOCTYPE html>
<!--[if IE ]>    <html class="ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php
	/* Print the <title> tag based on what is being viewed. */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if (is_int($page) && ($paged >= 2 || $page >= 2))
		echo ' | ' . sprintf(__('Page %s', 'mpcth'), max($paged, $page));
	?></title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if($mpcth_options['mpcth_fav'] == '1') { ?>
	<link rel="icon" type="image/png" href="<?php echo $mpcth_options['mpcth_fav_icon']; ?>">
<?php } ?>

<?php 
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>

</head>
<body <?php body_class(); ?>>
	<div id="mpcth_page_wrap" class="mpcth-reponsive mpcth-layout-<?php echo $mpcth_cake['layoutStyle']; ?>">
		<header id="mpcth_page_header_wrap">
			<div id="mpcth_page_header_content">
				<?php
					$post_meta = get_post_custom($ID);
					
					if(isset($post_meta) && ((isset($post_meta['hide_top_area']) && $post_meta['hide_top_area'][0] == 'off') || !isset($post_meta['hide_top_area']))) {
						if($custom_top_area && is_dynamic_sidebar($custom_top_area_id) ) {
							mpcth_display_top_area($custom_top_area_id);
						} elseif(isset($mpcth_options['mpcth_top_widget_area']) && $mpcth_options['mpcth_top_widget_area'] && is_dynamic_sidebar('mpcth_top_widget_area')) {
							mpcth_display_top_area();
						}
					}

					if(isset($mpcth_cake['topMenu']) && $mpcth_cake['topMenu'] && has_nav_menu('top')) {
						echo '<nav id="mpcth_secondary_nav">';
						wp_nav_menu(array(
							'theme_location' => 'top',
							'container' => '', 
							'depth' => 1,
							'menu_id' => 'mpcth_secondary_menu'
						)); 
						echo '</nav>';
					}

					if(isset($mpcth_cake['topRibbon']) && $mpcth_cake['topRibbon'] ) {
						echo '<div id="mpcth_top_ribbon">';

						mpcth_get_social_icons();

						get_search_form();
						echo '<div class="mpcth-clear-fix"></div></div>';
					}

					if($mpcth_cake['logoPosition'] == 'header')
						echo mpcth_display_logo();

					if($mpcth_cake['menuPosition'] == 'header') {
						echo '<nav id="mpcth_nav" class="mpcth-visible-desktop">';

						if(has_nav_menu('main')) {
							wp_nav_menu(array( 
								'theme_location' => 'main', 
								'container' => '', 
								'menu_id' => 'mpcth_menu'
							)); 
						} else {
							echo '<ul id="nav">';
								wp_list_pages('title_li='); 
							echo '</ul>';
						}

						echo '</nav><!-- end #mpcth_nav -->';
					}
				 ?> <!-- end menu --> 
				<div class="mpcth-clear-fix"></div>
			</div> <!-- end #mpcth_page_header_content -->
		</header><!-- end #mpcth_page_header_wrap -->