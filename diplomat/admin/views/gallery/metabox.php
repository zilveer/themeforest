<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php wp_enqueue_style('tmm_theme_admin_gallery_css', TMM_THEME_URI . '/admin/css/gallery.css'); ?>
<?php wp_enqueue_script('tmm_theme_admin_gallery_js', TMM_THEME_URI . '/admin/js/gallery.js'); ?>
<div class="gallery-meta-container">
	<input type="hidden" value="1" name="tmm_meta_saving" />
	<div class="gallery_layout">
		<p><a href="#" class="js_inpost_gallery_add_slide button button-primary"><?php esc_html_e('Add images', 'diplomat'); ?></a></p>
	</div>

	<ul id="gallery_item_list">
		<?php if (!empty($tmm_gallery)): ?>
			<?php foreach ($tmm_gallery as $value) : ?>
				<?php TMM_Gallery::render_gallery_item($value) ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
</div>