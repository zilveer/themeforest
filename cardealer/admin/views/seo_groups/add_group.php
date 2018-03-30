<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="tab-content" id="<?php echo $group_id; ?>">
    <input type="hidden" name="seo_group[<?php echo $group_id; ?>][name]" value="<?php echo $group_name; ?>" />

    <div class="clearfix ">
        <div class="admin-one-half">

            <h4><?php _e('Meta title', 'cardealer'); ?></h4>
            <input type="text" name="seo_group[<?php echo $group_id ?>][title]" value=""><br />
            <br />
            <h4><?php _e('Meta keywords', 'cardealer'); ?></h4>
            <textarea name="seo_group[<?php echo $group_id ?>][keywords]"></textarea><br />
            <br />
            <h4><?php _e('Meta description', 'cardealer'); ?></h4>
            <textarea name="seo_group[<?php echo $group_id ?>][description]"></textarea><br />



        </div><!--/ .admin-one-half-->

        <div class="admin-one-half last">

            <div class="add-button add_seo_group_category" group-id="<?php echo $group_id; ?>"></div>&nbsp;<strong><?php _e('Add Category', 'cardealer'); ?></strong><br /><br />
            <div class="tmk_row">
				<label class="sel">
					<?php echo $categories_select ?>
				</label>
            </div>

        </div><!--/ .admin-one-half-->

    </div>
    <br />
    <h2 style="color: red"><?php _e('Notice: One SEO group can be used only once per category. In other case it would be used for category as it was picked at first time for category.', 'cardealer'); ?></h2>

    <hr class="admin-divider" />
</div>



