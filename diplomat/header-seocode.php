<?php
if (!defined('ABSPATH')) die('No direct access allowed');

global $post;
$meta_title = "";
$meta_keywords = "";
$meta_description = "";

if (is_single() || is_page()) {

	$custom = get_post_custom($post->ID);
	$meta_title = (isset($custom["meta_title"][0])) ? $custom["meta_title"][0] : '';
	$meta_keywords = (isset($custom["meta_keywords"][0])) ? $custom["meta_keywords"][0] : '';
	$meta_description = (isset($custom["meta_description"][0])) ? $custom["meta_description"][0] : '';

	if (is_front_page()) {
		if (empty($meta_title)) {
			$meta_title = TMM::get_option("meta_title_home");
		}

		if (empty($meta_keywords)) {
			$meta_keywords = TMM::get_option("meta_keywords_home");
		}

		if (empty($meta_description)) {
			$meta_description = TMM::get_option("meta_description_home");
		}
	}
} else {

	if (is_object($post)) {
		if ($post->post_type === 'post') {
			$meta_title = TMM::get_option("meta_title_post_listing");
			$meta_keywords = TMM::get_option("meta_keywords_post_listing");
			$meta_description = TMM::get_option("meta_description_post_listing");
		} else if (class_exists('TMM_Portfolio') && $post->post_type === TMM_Portfolio::$slug) {
			$meta_title = TMM::get_option("meta_title_portfolio_listing");
			$meta_keywords = TMM::get_option("meta_keywords_portfolio_listing");
			$meta_description = TMM::get_option("meta_description_portfolio_listing");
		} else if (class_exists('TMM_Gallery') && $post->post_type === TMM_Gallery::$slug) {
			$meta_title = TMM::get_option("meta_title_gallery_listing");
			$meta_keywords = TMM::get_option("meta_keywords_gallery_listing");
			$meta_description = TMM::get_option("meta_description_gallery_listing");
		}
	}

	global $cat;
	$cat_head_seo_data = TMM_SEO_Group::get_cat_head_seo_data($cat);
	if (!empty($cat_head_seo_data['meta_title'])) {
		$meta_title = $cat_head_seo_data['meta_title'];
		$meta_keywords = $cat_head_seo_data['meta_keywords'];
		$meta_description = $cat_head_seo_data['meta_description'];
	}
}

if (is_home()) {
	$page_id = get_option('page_for_posts');

	if ($page_id) {
		$custom = get_post_custom($page_id);
		$meta_title = (isset($custom["meta_title"][0])) ? $custom["meta_title"][0] : '';
		$meta_keywords = (isset($custom["meta_keywords"][0])) ? $custom["meta_keywords"][0] : '';
		$meta_description = (isset($custom["meta_description"][0])) ? $custom["meta_description"][0] : '';
	}

}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */

function tmm_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $meta_title;

	if (!empty($meta_title)) {
		$title = $meta_title . ' ' . $sep . ' ' . get_bloginfo('name', 'display');
	}

	return $title;
}

$GLOBALS['meta_title'] = $meta_title;
add_filter( 'wp_title', 'tmm_wp_title', 10, 2 );

/* Display meta tags */
if (!empty($meta_keywords)) {
	?>
<meta name="keywords" content="<?php echo esc_attr($meta_keywords) ?>">
	<?php
}

if (!empty($meta_description)) {
	?>
	<meta name="description" content="<?php echo esc_attr($meta_description) ?>">
	<?php
}

