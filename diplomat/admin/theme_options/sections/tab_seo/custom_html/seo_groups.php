<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div id="js_seo_groups_panel">

	<div class="option option-add-form">

		<h4 class="option-title"><?php _e('Add SEO Group', 'diplomat'); ?></h4>

		<div class="controls">
			<input type="text" value="" id="seo_group_name" placeholder="<?php _e("type title here", 'diplomat') ?>">
			<div class="add-button add_seo_group"></div>
		</div><!--/ .controls-->
		<div class="explain"></div>

	</div><!--/ .option-->

	<div class="option">
		<input type="hidden" name="seo_group[]" value="" />
		<h4 class="option-title"><?php _e('SEO Groups', 'diplomat'); ?></h4>
		<ul class="groups seo_groups_list">
			<?php if (!empty($seo_groups) AND is_array($seo_groups)): ?>
				<?php foreach ($seo_groups as $group_id => $seo_group) : ?>
					<?php if ($group_id): ?>
						<li>
							<a data-id="seo_group_<?php echo $group_id; ?>" class="js_edit_seo_group" href="#"><?php echo esc_html($seo_group['name']); ?></a>
							<input type="hidden" name="seo_group[<?php echo $group_id; ?>][name]" value="<?php echo esc_attr($seo_group['name']); ?>" />
							<a href="#" title="<?php _e('Delete', 'diplomat'); ?>" class="remove js_remove_seo_group" data-id="seo_group_<?php echo $group_id ?>"></a>
							<a data-id="seo_group_<?php echo $group_id; ?>" href="#" title="<?php _e('Edit', 'diplomat'); ?>" class="edit js_edit_seo_group"></a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php else: ?>
				<li class="js_no_one_item_else"><span><?php _e('You have not created any group yet. Please create one using the form above.', 'diplomat'); ?></span></li>
			<?php endif; ?>

		</ul>

	</div><!--/ .option-->

</div>


<ul id="seo_groups_list">
	<?php if (!empty($seo_groups) AND is_array($seo_groups)): ?>
		<?php foreach ($seo_groups as $seo_group_id => $seo_group) : ?>
			<li style="display: none;" id="seo_group_<?php echo $seo_group_id ?>">
				<?php echo TMM::draw_free_page($custom_html_pagepath . 'seo_group.php', array('seo_group' => $seo_group, 'seo_group_id' => $seo_group_id)); ?>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>



