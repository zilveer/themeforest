<?php
if (!defined('ABSPATH')) exit();

$page_id = 0;
if (is_single() OR is_page() OR is_front_page()) {
	global $post;
	if($post) {
		$page_id = $post->ID;
	}
}

/* Favicon */
$favicon = TMM::get_option("favicon_img");
if (!$favicon) {
	$favicon = get_stylesheet_directory_uri() . '/favicon.ico';
}

/* Sidebar position */
$sidebar_position = "sbr";

if (is_single() && class_exists('TMM_Grid_Slider') && $post->post_type == TMM_Grid_Slider::$slug ) {
	$sidebar_position = 'no_sidebar';
} else {

	$page_sidebar_position = "default";

	if (!is_404()) {
		if (is_single() || is_page() || (class_exists('woocommerce') && is_product()) || class_exists('bbPress') && is_post_type_archive( 'forum' )) {
			$page_sidebar_position = get_post_meta(get_the_ID(), 'page_sidebar_position', TRUE);
		}
		if (class_exists('bbPress') && (bbp_is_custom_post_type() || bbp_is_single_user() ||  bbp_is_topic_tag())){
			$page = get_page_by_path(bbp_show_on_root());
			if (!empty($page->ID)) {
				$forums_id = $page->ID;
				$page_sidebar_position = get_post_meta($forums_id, 'page_sidebar_position', TRUE);
			}
		}

		if (!empty($page_sidebar_position) AND $page_sidebar_position != 'default') {
			$sidebar_position = $page_sidebar_position;
		} else if(class_exists('woocommerce') && is_product()) {
			$sidebar_position = TMM::get_option("product_sidebar_position");
		} else {
			$sidebar_position = TMM::get_option("sidebar_position");
		}

		if (!$sidebar_position) {
			$sidebar_position = "sbr";
		}

	} else {
		$sidebar_position = 'no_sidebar';
	}
}

/* is portfolio archive or is shop */
if (is_archive()) {
	if (class_exists('woocommerce') && is_woocommerce()) {
		$sidebar_position = '';

		if(is_shop()){
			$sidebar_position = get_post_meta(wc_get_page_id('shop'), 'page_sidebar_position', true);
		}

		if(!$sidebar_position){
			$sidebar_position = TMM::get_option("product_sidebar_position");
		}
	}
}

$_REQUEST['sidebar_position'] = $sidebar_position;

/* section#main class*/
if ($sidebar_position != 'no_sidebar'){
	$main_class = 'medium-8 large-8 ';
} else {
	$main_class = 'medium-12 large-12 ';
}

if (!isset($content_width)) $content_width = 960;

?>
<!DOCTYPE html>
<!--[if lte IE 8]>              <html class="ie8 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>					<html class="ie9 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if !(IE)]><!-->			<html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<!--[if ie]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" type="image/x-icon" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php get_template_part('header', 'seocode'); ?>

		<?php wp_head(); ?>
	</head>

	<body <?php  body_class(TMM::get_option('fixed_menu') ? 'header-fixed animated' : 'header-show animated'); ?>>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

       <?php if (TMM::get_option('page_loader')){
                TMM_Helper::page_loader();
       } ?>

		<div id="fb-root"></div>
                	
        <!-- - - - - - - - - - - - - - Wrapper - - - - - - - - - - - - - - - - -->

        <div id="wrapper">

	        <!-- - - - - - - - - - - - - Mobile Menu - - - - - - - - - - - - - - -->

	        <nav id="mobile-advanced" class="mobile-advanced"></nav>

	        <!-- - - - - - - - - - - - end Mobile Menu - - - - - - - - - - - - - -->
                
            <!-- - - - - - - - - - - - Header - - - - - - - - - - - - - -->

            <?php get_template_part('header', 'default'); ?>

            <!-- - - - - - - - - - - - end Header - - - - - - - - - - - - - -->
                

			<!-- - - - - - - - - - - - - - Main - - - - - - - - - - - - - - - - -->

	        <?php
	        if (is_single($page_id) || is_page() || is_page_template()) {
		        tmm_layout_content($post->ID, 'before_full_width');
	        }
	        ?>

			<main id="content" class="row <?php echo esc_attr($sidebar_position); ?>">

				<?php get_template_part('content', 'header'); ?>

				<section id="main" class="<?php echo esc_attr($main_class); ?>columns">
