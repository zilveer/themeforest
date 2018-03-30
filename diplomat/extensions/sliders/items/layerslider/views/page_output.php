<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$layerslider_slide_group = get_post_meta($post_id, "layerslider_slide_group", true);
if ($layerslider_slide_group > 0) {
	echo(do_shortcode('[layerslider id="' . $layerslider_slide_group . '"]'));
}
