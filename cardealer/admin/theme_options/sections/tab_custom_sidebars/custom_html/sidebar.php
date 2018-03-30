<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<h2 class="section-title"><?php echo $sidebar['name']; ?></h2>

<a href="#" class="admin-button button-gray js_back_to_sidebars_list"><?php _e('Back to sidebars list', 'cardealer'); ?></a>


<div class="option">

	<input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][name]" value="<?php echo $sidebar['name']; ?>" />

	<div class="admin-one-half">

		<div class="add-button add_page" data-id="<?php echo $sidebar_id ?>"></div>&nbsp;<strong><?php _e('Add Page', 'cardealer'); ?></strong>

		<?php
		if (!empty($sidebar['page'])) {
			foreach ($sidebar['page'] as $page_key => $page_value) {
				?>
				<div class="tmk_row">
					
					<br />
					
					<label class="sel">
						<?php echo TMM_Custom_Sidebars::get_pages_select($page_value, 'sidebars[' . $sidebar_id . '][page][' . $page_key . ']'); ?>
					</label>
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

		<div class="add-button add_category" data-id="<?php echo $sidebar_id ?>"></div>&nbsp;<strong><?php _e('Add Category', 'cardealer'); ?></strong>
		
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



