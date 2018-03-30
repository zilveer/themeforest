<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/header.php
 * @file	 	1.2
 */
?>
<?php global $data, $prefix; ?>

	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php prostore_meta_head(); ?>

		<title><?php wp_title('', true, 'right'); ?> | <?php bloginfo('name'); ?></title>

		<!-- media-queries.js (fallback) -->
		<!--[if lt IE 9]>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

		<!-- html5.js -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--[if IE 7]>
    		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/icons-ie7.css">
    	<![endif]-->

    	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if($data[$prefix.'rss_url']){ echo $data[$prefix.'rss_url']; } else { bloginfo( 'rss2_url' ); } ?>" />
    	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/icons/h/apple-touch-icon.png">
		<!-- For iPad 1-->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/icons/m/apple-touch-icon.png">
		<!-- For iPhone 3G, iPod Touch and Android -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/img/icons/l/apple-touch-icon-precomposed.png">
		<!-- For Nokia -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/icons/l/apple-touch-icon.png">
		<?php
			$favicon = $data[$prefix."general_favicon"];

			if( $favicon != '' ) {
				echo '<link rel="shortcut icon" href="' .  esc_url( $favicon )  . '"/>' . "\n";
			}
		?>

		<?php do_action('custom_head_scripts'); ?>

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<?php prostore_head(); ?>

	</head>

	<body <?php body_class('no-js'); ?>>

		<?php
			// Variables initialization
			if(!isset($_GET['home_slider'])) $_GET['home_slider']='';
			if(!isset($_GET['home_layout'])) $_GET['home_layout']='';
			if(!isset($_GET['header_layout'])) $_GET['header_layout']='';

		?>

		<?php do_action('custom_head_styles'); ?>

		<?php if($data[$prefix."optimize_preload"]!="1") { ?>
			<div id="loadingContainer"></div>
		<?php } ?>

		<?php if($data[$prefix."header_announcement"]=="1" && !empty($data[$prefix."header_announcement_text"])) { ?>
			<div class="alert-box <?php echo $data[$prefix."header_announcement_color"]; ?> text-center show-for-custom-bp" id="announcement">
				<div class="row container">
					<div class="twelve columns">
						<?php echo nl2br($data[$prefix."header_announcement_text"]); ?>
						<a href="" class="close">&times;</a>
					</div>
				</div>
			</div>
		<?php } ?>

		<header role="banner" id="top-header" class="hide-on-print">

			<?php if($data[$prefix."header_helper_bar"]=="1") { ?>
				<?php get_template_part('library/loop/header','helper'); ?>
			<?php } ?>

			<?php get_template_part('library/loop/header','branding'); ?>

			<?php
				prostore_main_nav('nav hide-on-print','responsiveMenu');
			?>

		</header> <!-- end header -->

		<?php show_search_form('search-fullwidth hide-on-print show-for-custom-bp'); ?>

		<?php show_search_form('search-fullwidth-mobile hide-on-print hide-for-custom-bp'); ?>

		<div class="clear"></div>

		<div id="content" class="clearfix">

		<?php

			if($data[$prefix.'home_slider']=="1" && (is_home() || is_front_page())) {

/* ! */			if($_GET['home_slider']!="") {

					if($_GET['home_slider']=="flex") {
						get_template_part('library/loop/home','flexslider');
					} elseif($_GET['home_slider']=="rev") {
						$rev_slider = $data[$prefix."home_slider_rev_id"];
						if($rev_slider != "") {
							if(function_exists('putRevSlider')) {
								putRevSlider($rev_slider,"homepage");
							}
						}
					}

/* ! */			} else {

					if($data[$prefix.'home_slider_mod']=="FlexSlider") {
						get_template_part('library/loop/home','flexslider');
					} else {
						if(!isset($data[$prefix."home_slider_rev_id"])) $data[$prefix."home_slider_rev_id"]='';
						$rev_slider = $data[$prefix."home_slider_rev_id"];
						if($rev_slider != "") {
							if(function_exists('putRevSlider')) {
								putRevSlider($rev_slider,"homepage");
							}
						}
					}

				}


/* ! */		}

/* ! */		if(is_home() || is_front_page() || $_GET['home_layout']=="alt") {
				get_template_part('library/loop/home','content');
/* ! */		}
		?>