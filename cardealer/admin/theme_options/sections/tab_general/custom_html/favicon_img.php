<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $favicon = TMM::get_option('favicon_img'); ?>
<div class="favicon_sample">
	<img id="favicon_preview_image" class="favicon" src="<?php echo(!empty($favicon)) ? $favicon : TMM_THEME_URI . '/favicon.ico' ?>" alt="favicon" />
</div>