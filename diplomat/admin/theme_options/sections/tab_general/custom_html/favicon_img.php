<?php
if (!defined('ABSPATH')) die('No direct access allowed');

$favicon = TMM::get_option('favicon_img');

if (empty($favicon)) {
	$favicon = TMM_THEME_URI . '/favicon.ico';
}
?>
<div class="favicon_sample">
	<img id="favicon_preview_image" class="favicon" src="<?php echo esc_url($favicon); ?>" alt="favicon" />
</div>