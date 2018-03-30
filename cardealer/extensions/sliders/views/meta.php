<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />
<p><a href="#" class="js_add_slide button button-primary"><?php _e('Add slides', 'cardealer'); ?></a></p>

<div id="tmm_slide_group">
	<?php if (!empty($slides_group)): ?>
		<?php foreach ($slides_group as $group): ?>
			<?php echo TMM::draw_free_page(TMM_Ext_Sliders::get_application_path() . '/views/meta_slide_item.php', array('group' => $group)); ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>

<div class="clear"></div>