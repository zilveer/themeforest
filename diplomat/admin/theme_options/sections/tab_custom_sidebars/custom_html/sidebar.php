<?php if (!defined('ABSPATH')) die('No direct access allowed');

if (!isset($sidebar['lang'])) {
	$sidebar['lang'] = (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != '') ? ICL_LANGUAGE_CODE : '';
}

$hidden = false;

if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != '') {

	if ($sidebar['lang'] !== ICL_LANGUAGE_CODE) {
		$hidden = true;
	}
}
?>

<h2 class="section-title"><?php echo esc_html($sidebar['name']); ?></h2>

<a href="#" class="admin-button button-gray js_back_to_sidebars_list"><?php _e('Back to sidebars list', 'diplomat'); ?></a>


<div class="option">

	<input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][name]" value="<?php echo esc_attr($sidebar['name']); ?>" />
	<input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][lang]" value="<?php echo esc_attr($sidebar['lang']); ?>" />

	<div class="admin-one-half">

		<div class="add-button add_page" data-id="<?php echo $sidebar_id ?>"></div>&nbsp;<strong><?php _e('Add Page', 'diplomat'); ?></strong>

		<?php
		if (!empty($sidebar['page'])) {
			foreach ($sidebar['page'] as $page_key => $page_value) {
				?>
				<div class="tmk_row">
					
					<br />

					<?php if (!$hidden) { ?>
					<label class="sel">
						<?php echo TMM_Custom_Sidebars::get_pages_select($page_value, 'sidebars[' . $sidebar_id . '][page][' . $page_key . ']'); ?>
					</label>
					<?php } else { ?>
						<input type="hidden" value="<?php echo $page_value ?>" name="sidebars[<?php echo $sidebar_id ?>][page][<?php echo $page_key ?>]">
					<?php } ?>
					<?php if ($page_key > 0): ?>
						<a class="remove-button remove_page" href="#"></a>
					<?php endif; ?>
						
				</div>

				<?php
			}
		} else {
			 ?>
		
			<div class="tmk_row">

				<br />

				<label class="sel">
					<?php echo TMM_Custom_Sidebars::get_pages_select('', 'sidebars[' . $sidebar_id . '][page][0]'); ?>
				</label>

			</div>
		
			<?php
		}
		?>

	</div><!--/ .admin-one-half-->

	<div class="admin-one-half last">

		<div class="add-button add_category" data-id="<?php echo $sidebar_id ?>"></div>&nbsp;<strong><?php _e('Add Category', 'diplomat'); ?></strong>
		
		<?php
		if (!empty($sidebar['cat'])) {
			foreach ($sidebar['cat'] as $cat_key => $cat_value) {
				?>
				<div class="tmk_row">
					<br />
					
					<label class="sel">
						<?php echo TMM_Custom_Sidebars::get_categories_select($cat_value, 'sidebars[' . $sidebar_id . '][cat][' . $cat_key . ']'); ?>
					</label>
					
					<?php if ($cat_key > 0): ?>
						<a class="remove-button remove_page" href="#"></a>
					<?php endif; ?>
						
				</div>

				<?php
			}
		} else {
			 ?>
		
			<div class="tmk_row">

				<br />

				<label class="sel">
					<?php echo TMM_Custom_Sidebars::get_categories_select('', 'sidebars[' . $sidebar_id . '][cat][0]'); ?>
				</label>

			</div>
		
			<?php	
		}
		?>

	</div><!--/ .admin-one-half-->

</div>



