<?php
if (!defined('ABSPATH')) exit();

$show_title_bar = false;
$title = '';
$alt_title = '';
$subtitle = '';
$bg_type = '';
$bg = '';

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
		$alt_title = get_post_meta($post_id, 'alt_page_title', 1);
		$subtitle = get_post_meta($post_id, 'page_subtitle', 1);
		$bg_type = get_post_meta($post_id, 'title_bar_bg_type', 1);
		$bg_color = get_post_meta($post_id, 'title_bar_bg_color', 1);
		$bg_image = get_post_meta($post_id, 'title_bar_bg_image', 1);
		$bg_image_option = get_post_meta($post_id, 'title_bar_bg_image_option', 1);
	}
}

if (tmm_is_blog_archive()) {
	$title = get_the_archive_title();
	$show_title_bar = TMM::get_option('blog_archive_show_title_bar');
	$alt_title = TMM::get_option('blog_archive_alt_title');
	$subtitle = TMM::get_option('blog_archive_subtitle');
	$bg_type = TMM::get_option('blog_archive_title_bar_bg_type');
	$bg_color = TMM::get_option('blog_archive_title_bar_bg_color');
	$bg_image = TMM::get_option('blog_archive_title_bar_bg_image');
	$bg_image_option = TMM::get_option('blog_archive_title_bar_bg_image_option');
}

if (is_search()) {
	$title = __('Search Results for: ', 'cardealer') . get_search_query();
	$show_title_bar = TMM::get_option('search_page_show_title_bar');
	$alt_title = TMM::get_option('search_page_alt_title');
	$subtitle = TMM::get_option('search_page_subtitle');
	$bg_type = TMM::get_option('search_page_title_bar_bg_type');
	$bg_color = TMM::get_option('search_page_title_bar_bg_color');
	$bg_image = TMM::get_option('search_page_title_bar_bg_image');
	$bg_image_option = TMM::get_option('search_page_title_bar_bg_image_option');
}

if (is_post_type_archive('car')) {
	$title = get_the_archive_title();
	$show_title_bar = TMM::get_option('car_archive_show_title_bar', TMM_APP_CARDEALER_PREFIX);
	$alt_title = TMM::get_option('car_archive_alt_title', TMM_APP_CARDEALER_PREFIX);
	$subtitle = TMM::get_option('car_archive_subtitle', TMM_APP_CARDEALER_PREFIX);
	$bg_type = TMM::get_option('car_archive_title_bar_bg_type', TMM_APP_CARDEALER_PREFIX);
	$bg_color = TMM::get_option('car_archive_title_bar_bg_color', TMM_APP_CARDEALER_PREFIX);
	$bg_image = TMM::get_option('car_archive_title_bar_bg_image', TMM_APP_CARDEALER_PREFIX);
	$bg_image_option = TMM::get_option('car_archive_title_bar_bg_image_option', TMM_APP_CARDEALER_PREFIX);
}

if (is_tax('carproducer')) {
	$title = get_the_archive_title();
	$show_title_bar = TMM::get_option('car_producer_tax_show_title_bar', TMM_APP_CARDEALER_PREFIX);
	$alt_title = TMM::get_option('car_producer_tax_alt_title', TMM_APP_CARDEALER_PREFIX);
	$subtitle = TMM::get_option('car_producer_tax_subtitle', TMM_APP_CARDEALER_PREFIX);
	$bg_type = TMM::get_option('car_producer_tax_title_bar_bg_type', TMM_APP_CARDEALER_PREFIX);
	$bg_color = TMM::get_option('car_producer_tax_title_bar_bg_color', TMM_APP_CARDEALER_PREFIX);
	$bg_image = TMM::get_option('car_producer_tax_title_bar_bg_image', TMM_APP_CARDEALER_PREFIX);
	$bg_image_option = TMM::get_option('car_producer_tax_title_bar_bg_image_option', TMM_APP_CARDEALER_PREFIX);
}

// define title bar background
if ($bg_type === 'color') {

	if (!empty($bg_color)) {
		$bg = "background: {$bg_color};";
	}

} else if ($bg_type === 'image') {

	if (!empty($bg_image)) {
		$bg = "background: url({$bg_image})";

		if ($bg_image_option === 'repeat-x') {
			$bg .= " repeat-x 0 0";
		} else if ($bg_image_option === 'fixed') {
			$bg .= " no-repeat center top fixed;";
		} else {
			$bg .= " repeat 0 0";
		}
	}

}

if (!empty($bg)) {
	$bg = 'style="' . $bg . '"';
}

// define title
if (!empty($alt_title)) {
	$title = $alt_title;
}
?>

<?php if (TMM::get_option('sticky_nav')) { ?>
<div id="navHolder">
<?php } ?>

	<div class="logo-bar sticky-bar">

		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-md-3">

					<?php get_template_part('header/header', 'logo'); ?>

				</div>
				<div class="col-xs-4 col-md-9">

					<?php get_template_part('header/header', 'nav'); ?>

				</div>
			</div><!--/ .row-->
		</div><!--/ .container-->

	</div><!--/ .logo-bar-->

<?php if (TMM::get_option('sticky_nav')) { ?>
</div><!--/ #navHolder-->
<?php } ?>

<?php if ($show_title_bar) { ?>

	<header class="page-header"<?php echo $bg ?>>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8">

					<h1 class="page-title">
						<?php echo esc_html($title) ?>
					</h1>

					<?php if ($subtitle) { ?>
						<h2 class="page-title"><?php echo esc_html($subtitle) ?></h2>
					<?php } ?>

				</div>
				<div class="col-xs-12 col-md-4">

					<?php tmm_breadcrumbs(); ?>

				</div>
			</div><!--/ .row-->
		</div><!--/ .container-->

	</header><!--/ .page-header -->

<?php } ?>
