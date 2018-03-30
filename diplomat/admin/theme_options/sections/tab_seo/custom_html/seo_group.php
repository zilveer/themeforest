<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<h2 class="section-title"><?php echo esc_html($seo_group['name']); ?></h2>


<a href="#" class="admin-button button-gray js_back_to_seo_list"><?php _e('Back to groups list', 'diplomat'); ?></a><br />

<div class="clear"></div>

<input type="hidden" name="seo_group[<?php echo $seo_group_id; ?>][name]" value="<?php echo esc_attr($seo_group['name']); ?>" />

<div class="option">
	
	<div class="admin-one-half">

		<h4 class="option-title"><?php _e('Meta Title', 'diplomat'); ?></h4>
		<input type="text" name="seo_group[<?php echo $seo_group_id ?>][title]" value="<?php echo esc_attr($seo_group['title']); ?>"><br />
		<br />
		<h4 class="option-title"><?php _e('Meta Keywords', 'diplomat'); ?></h4>
		<textarea name="seo_group[<?php echo $seo_group_id ?>][keywords]"><?php echo esc_attr($seo_group['keywords']); ?></textarea><br />
		<br />
		<h4 class="option-title"><?php _e('Meta Description', 'diplomat'); ?></h4>
		<textarea name="seo_group[<?php echo $seo_group_id ?>][description]"><?php echo esc_attr($seo_group['description']); ?></textarea><br />

	</div><!--/ .admin-one-half-->

	<div class="admin-one-half last">
		
		<br />

		<div class="add-button add_seo_group_category" group-id="<?php echo $seo_group_id ?>"></div>&nbsp;<strong><?php _e('Add Category', 'diplomat'); ?></strong>
		
			<?php
		if (!empty($seo_group['cat'])) {
			foreach ($seo_group['cat'] as $cat_key => $cat_value) {
				?>

				<div class="tmk_row">
					
					<br />
					
					<label class="sel">
						<?php echo TMM_SEO_Group::get_categories_select($cat_value, 'seo_group[' . $seo_group_id . '][cat][' . $cat_key . ']', '', 'seo_categories_selects'); ?>
					</label>
					
					<?php if ($cat_key > 0): ?>
						<a class="remove-button remove_seo_group_category" href="#"></a>
					<?php endif; ?>	
				</div>

				<?php
			}
		} else {
			 ?>
			 <div class="tmk_row">
				 
				 <br />
				 
				<label class="sel">
				   <?php echo TMM_SEO_Group::get_categories_select('', 'seo_group[' . $seo_group_id . '][cat][0]'); ?>
				</label>				 
			 </div>
			<?php 
		}
		?>

	</div><!--/ .admin-one-half-->

</div>
<br />
<h2 style="color: red"><?php _e('Notice: One SEO group can be used only once per category. In other case it would be used for category as it was picked at first time for category.', 'diplomat'); ?></h2>




