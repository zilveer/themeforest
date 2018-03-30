<?php
global $houzez_options, $houzez_local;
$houzez_local = houzez_get_localization();
/**
 * @package Houzez
 * @since Houzez 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<?php
$fave_page_header_search = get_post_meta( $post->ID, 'fave_page_header_search', true );
$fave_head_trans = 'no';
$houzez_onepage_mode = '';
if( $fave_page_header_search != 'yes' ) {
	$fave_head_trans = get_post_meta($post->ID, 'fave_main_menu_trans', true);
}
if ( is_page_template( 'template/template-onepage.php' ) ) {
	$houzez_onepage_mode = 'houzez-onepage-mode';
}
?>

<body <?php body_class($houzez_onepage_mode.' transparent-'.$fave_head_trans); ?>>
<div id="fb-root"></div>

<?php get_template_part( 'inc/header/login-register-popup' ); ?>
<?php if ( !is_page_template( 'template/template-splash.php' ) ) { ?>

<?php
$houzez_header_style = houzez_option('header_style');
if( empty($houzez_header_style)) {
	$houzez_header_style = '1';
}
get_template_part( 'inc/header/header', $houzez_header_style );
//get_template_part( 'inc/header/header', 'transparent' ); ?>

<?php
$search_enable = houzez_option('main-search-enable');
$search_position = houzez_option('search_position');
$search_pages = houzez_option('search_pages');

if( !is_404() && !is_search() ) {
	$adv_search_enable = get_post_meta($post->ID, 'fave_adv_search_enable', true);
	$adv_search = get_post_meta($post->ID, 'fave_adv_search', true);
	$adv_search_pos = get_post_meta($post->ID, 'fave_adv_search_pos', true);
}

if( isset( $_GET['search_pos'] ) ) {
	$search_enable = 1;
	$search_position = $_GET['search_pos'];
}

if( ! is_search() ) {
	if ((!empty($adv_search_enable) && $adv_search_enable != 'global')) {
		if ($adv_search_pos == 'under_menu') {
			if ($adv_search == 'show' || $adv_search == 'hide_show') {
				get_template_part('template-parts/advanced-search', 'undermenu');
			}
		}
	} else {
		if (!is_home() && !is_singular('post')) {
			if ($search_enable != 0 && $search_position == 'under_nav') {
				if ($search_pages == 'only_home') {
					if (is_front_page()) {
						get_template_part('template-parts/advanced-search', 'undermenu');
					}
				} elseif ($search_pages == 'all_pages') {
					get_template_part('template-parts/advanced-search', 'undermenu');

				} elseif ($search_pages == 'only_innerpages') {
					if (!is_front_page()) {
						get_template_part('template-parts/advanced-search', 'undermenu');
					}
				}
			}
		}
	}
}

if( !is_404() && !is_search() ) {
	$adv_search_enable = get_post_meta($post->ID, 'fave_adv_search_enable', true);
	$adv_search = get_post_meta($post->ID, 'fave_adv_search', true);
}
$section_body = '';
if( ( !empty( $adv_search_enable ) && $adv_search_enable != 'global' ) ) {
	if( $adv_search == 'hide_show' ) {
		$section_body = 'sticky_show_scroll_active';
	} else {
		$section_body = '';
	}
}
if ( is_page_template( 'template/property-listings-map.php' ) ) { $section_body .= 'houzez-body-half'; }
?>

<div id="section-body" class="<?php echo esc_attr( $section_body ); ?>">

	<?php
		get_template_part( 'template-parts/page-headers/page-header' );

		if( ! is_search() ) {
			if ((!empty($adv_search_enable) && $adv_search_enable != 'global')) {
				if ($adv_search_pos == 'under_banner') {
					if ($adv_search == 'show' || $adv_search == 'hide_show') {
						get_template_part('template-parts/advanced-search', 'undermenu');
					}
				}
			} else {
				if (!is_home() && !is_singular('post')) {
					if ($search_enable != 0 && $search_position == 'under_banner') {
						if ($search_pages == 'only_home') {
							if (is_front_page()) {
								get_template_part('template-parts/advanced-search', 'undermenu');
							}
						} elseif ($search_pages == 'all_pages') {
							get_template_part('template-parts/advanced-search', 'undermenu');

						} elseif ($search_pages == 'only_innerpages') {
							if (!is_front_page()) {
								get_template_part('template-parts/advanced-search', 'undermenu');
							}
						}
					}
				}
			}
		}
	?>

	<?php if( !is_singular( 'property' ) && !is_page_template( 'template/property-listings-map.php' ) ) { ?>
	<div class="container">
	<?php } ?>

<?php } // End splash template if  ?>

<?php
	$disable_compare = houzez_option('disable_compare');
	if( $disable_compare != 0 ) {
		get_template_part('template-parts/compare-panel');
	}
	?>