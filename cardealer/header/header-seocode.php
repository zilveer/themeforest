<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
global $post;
$meta_title = "";
$meta_keywords = "";
$meta_description = "";

if (is_front_page() || TMM_Helper::is_front_lang_page()) {
    $meta_title = TMM::get_option("meta_title_home");
    $meta_keywords = TMM::get_option("meta_keywords_home");
    $meta_description = TMM::get_option("meta_description_home");

	if (empty($meta_title)) {
		$meta_title = get_option('blogdescription');
	}
} else {
    if (is_single() OR is_page()) {
        $custom = get_post_custom($post->ID);
        $meta_title = isset($custom["meta_title"][0]) ? $custom["meta_title"][0] : '';
        $meta_keywords = isset($custom["meta_keywords"][0]) ? $custom["meta_keywords"][0] : '';
        $meta_description = isset($custom["meta_description"][0]) ? $custom["meta_description"][0] : '';
    } else {

        if (is_object($post) && $post->post_type === 'post') {
			$meta_title = TMM::get_option("meta_title_post_listing");
			$meta_keywords = TMM::get_option("meta_keywords_post_listing");
			$meta_description = TMM::get_option("meta_description_post_listing");
        }

        global $cat;
        $cat_head_seo_data = TMM_SEO_Group::get_cat_head_seo_data($cat);
        if (!empty($cat_head_seo_data['meta_title'])) {
            $meta_title = $cat_head_seo_data['meta_title'];
            $meta_keywords = $cat_head_seo_data['meta_keywords'];
            $meta_description = $cat_head_seo_data['meta_description'];
        }
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

	if (empty($meta_title)) {
		$meta_title = get_option('blogdescription');
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
		$title = get_bloginfo('name', 'display') . ' ' . $sep . ' ' . $meta_title;
	} else {
		global $post;

		if (get_post_type() === TMM_Ext_PostType_Car::$slug) {
			$title = ' ' . $sep . ' ' . tmm_get_car_title($post->ID);
		}

		$title = get_bloginfo('name', 'display') . $title;
	}

	return $title;
}

$GLOBALS['meta_title'] = $meta_title;
add_filter( 'wp_title', 'tmm_wp_title', 10, 2 );

?>

<title><?php wp_title(); ?></title>

<?php
//FAVICON
$favicon = TMM::get_option("favicon_img");
if ($favicon) :
    ?>
    <link href="<?php echo $favicon; ?>" rel="icon" type="image/x-icon" />
<?php else: ?>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon" />
<?php endif; ?>


<?php if (!empty($meta_keywords)): ?>
    <META NAME="keywords" CONTENT="<?php echo htmlspecialchars($meta_keywords, ENT_QUOTES) ?>">
<?php endif; ?>
<?php if (!empty($meta_description)): ?>
    <META NAME="Description" CONTENT="<?php echo htmlspecialchars($meta_description, ENT_QUOTES) ?>">
<?php endif; ?>


<!--[if lt IE 9]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<![endif]-->

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


