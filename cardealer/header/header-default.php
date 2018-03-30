<?php
$page_id = 0;

if (is_object($post)) {
	$page_id = $post->ID;
}

if (is_home()) {
	$page_id = get_option('page_for_posts');
}

$page_id = apply_filters('tmm_post_id', $page_id);

$header_type = TMM::get_option('header_type');

if ($page_id) {
	$page_header_type = get_post_meta($page_id, 'header_type', 1);

	if (!empty($page_header_type)) {
		$header_type = $page_header_type;
	}
}

if (tmm_is_blog_archive()) {
	$page_header_type = TMM::get_option('blog_archive_header_type');

	if (!empty($page_header_type)) {
		$header_type = $page_header_type;
	}
}

if (is_search()) {
	$page_header_type = TMM::get_option('search_page_header_type');

	if (!empty($page_header_type)) {
		$header_type = $page_header_type;
	}
}

if (is_post_type_archive('car')) {
	$page_header_type = TMM::get_option('car_archive_header_type', TMM_APP_CARDEALER_PREFIX);

	if (!empty($page_header_type)) {
		$header_type = $page_header_type;
	}
}

if (is_tax('carproducer')) {
	$page_header_type = TMM::get_option('car_producer_tax_header_type', TMM_APP_CARDEALER_PREFIX);

	if (!empty($page_header_type)) {
		$header_type = $page_header_type;
	}
}

$header_type_class = '';

if ($header_type === 'alternate') {
	$header_type_class = ' alternate';
} else {
	$header_type_class = ' classic';
}
?>

<div class="header<?php echo esc_attr($header_type_class); ?>">

	<?php get_template_part('header/header', 'top-bar'); ?>

	<?php if ($header_type === 'alternate') {

		get_template_part('header/header', 'logo-bar-alternate');

	} else {

		get_template_part('header/header', 'logo-bar-classic');

	} ?>

</div><!--/ .header-->