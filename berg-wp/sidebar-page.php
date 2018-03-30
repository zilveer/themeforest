<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package berg-wp
 */
$page_meta = get_post_meta(get_the_id());

if (isset($page_meta['sidebar_object'][0])) {
	$sidebar_object = $page_meta['sidebar_object'][0];
} else {
	$sidebar_object = 'page';
}

if (!is_active_sidebar( $sidebar_object ) ) {
	return;
}

?>
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( $sidebar_object ); ?>
</div>