<?php
if (!defined('ABSPATH')) exit();

$show_title_bar = false;
$post_id = 0;

if (is_home()) {
	$post_id = get_option('page_for_posts');
} else if (is_single() || is_page()) {
	global $post;
	$post_id = $post->ID;
}

$post_id = apply_filters('tmm_post_id', $post_id);

if ($post_id) {

	$title = get_the_title();

	if ( get_post_meta($post_id, 'show_title_bar', 1) ) {
		$show_title_bar = true;
	}
}

if (tmm_is_blog_archive()) {
	$show_title_bar = TMM::get_option('blog_archive_show_title_bar');
}

if (is_search()) {
	$show_title_bar = TMM::get_option('search_page_show_title_bar');
}

if (is_post_type_archive('car')) {
	$show_title_bar = TMM::get_option('car_archive_show_title_bar', TMM_APP_CARDEALER_PREFIX);
}

if (is_tax('carproducer')) {
	$show_title_bar = TMM::get_option('car_producer_tax_show_title_bar', TMM_APP_CARDEALER_PREFIX);
}

if (!is_front_page() && !TMM_Helper::is_front_lang_page()) {

	$hide_title = false;

	if (is_single() || is_page() || is_home()) {
		global $post;

		if (is_object($post)) {
			$post_id = $post->ID;
		}

		if (is_home()) {
			$post_id = get_option('page_for_posts');
		}

		$hide_title = get_post_meta($post_id, 'hide_single_page_title', true);
		$title = get_the_title($post_id);

	} else if (is_archive()) {

		if (tmm_is_blog_archive()) {
			$hide_title = TMM::get_option('blog_archive_hide_title');
		} else if (is_post_type_archive('car')) {
			$hide_title = TMM::get_option('car_archive_hide_title', TMM_APP_CARDEALER_PREFIX);
		} else if (is_tax('carproducer')) {
			$hide_title = TMM::get_option('car_producer_tax_hide_title', TMM_APP_CARDEALER_PREFIX);
		}

		$title = get_the_archive_title();

	} else if (is_search()) {
		$hide_title = TMM::get_option('search_page_hide_title');
		$title = sprintf( __('Search Results for: %s', 'cardealer'), '<span>' . get_search_query() . '</span>');
	}

	$hide_title = apply_filters('tmm_hide_default_title', $hide_title);

	global $tmm_car_listing_layout_switcher;
	$show_switcher = false;

	if ($tmm_car_listing_layout_switcher && TMM::get_option('show_layout_switcher', TMM_APP_CARDEALER_PREFIX)) {

		$cars_listing_layout_class = tmm_get_car_listing_layout_type();

		$show_switcher = true;
	}

	if (is_page_template('template-car-listing.php')) {
		$title = __( "Search Results", 'cardealer' );
	}

	if (!$hide_title) {
		?>
		<div class="page-subheader">

			<?php if (!$show_title_bar) { ?>

				<?php tmm_breadcrumbs(); ?>

			<?php } ?>

			<h2 class="section-title">
				<?php echo $title; ?>
			</h2><!-- /.page-title -->

			<?php if ($show_switcher) { ?>
				<div class="layout-switcher">
					<a class="layout-grid <?php echo($cars_listing_layout_class == 'item-grid' ? 'active' : '') ?>" data-css-class="item-grid" href="javascript:void(0);">
						<?php _e("Grid View", 'cardealer') ?>
					</a>
					<a class="layout-list <?php echo($cars_listing_layout_class == 'item-list' ? 'active' : '') ?>" data-css-class="item-list" href="javascript:void(0);">
						<?php _e("List View", 'cardealer') ?>
					</a>
				</div><!--/ .layout-switcher-->
			<?php } ?>

		</div><!-- /.page-subheader -->
		<?php
	}
}
