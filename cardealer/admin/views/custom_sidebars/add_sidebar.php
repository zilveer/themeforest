<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="tab-content" id="<?php echo $sidebar_id; ?>">
    <input type="hidden" name="sidebars[<?php echo $sidebar_id; ?>][name]" value="<?php echo $sidebar_name; ?>" />

    <div class="clearfix ">

        <div class="admin-one-half">

            <div class="add-button add_page" sidebar-id="<?php echo $sidebar_id; ?>"></div>&nbsp;<strong><?php _e('Add Page', 'cardealer'); ?></strong><br /><br />
            <div class="tmk_row">
				<label class="sel">
					<?php echo $categories_select ?>
				</label>
            </div>

        </div><!--/ .admin-one-half-->

        <div class="admin-one-half last">

            <div class="add-button add_category" sidebar-id="<?php echo $sidebar_id; ?>"></div>&nbsp;<strong><?php _e('Add Category', 'cardealer'); ?></strong><br /><br />
            <div class="tmk_row">
				<label class="sel">
					<?php echo $pages_select ?>
				</label>
            </div>

        </div><!--/ .admin-one-half-->

    </div>

    <hr class="admin-divider" />
</div>



