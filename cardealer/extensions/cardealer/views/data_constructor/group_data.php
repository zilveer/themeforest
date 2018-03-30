<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="form-holder">
    <span class="form-group-title" id="data_group_title">
        <input type="text" name="data_groups[<?php echo $data_group_index ?>][name]" value="<?php echo $data_group_items['name'] ?>" placeholder="<?php _e("Edit group name", 'cardealer') ?>" />
    </span>
	
    <a class="add-button add_contact_field_button add_item_to_data_group" href="#" title="<?php _e("Add new item", 'cardealer') ?>"></a>

	<br />
	
    <ul class="data_group_items">
        <?php if (!empty($data_group_items['data'])): ?>
            <?php foreach ($data_group_items['data'] as $key => $value) : ?>
                <li class="admin-drag-holder">
                    <?php echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/data_group_item_template.php', array('data_group_index' => $data_group_index, 'itemdata' => $value)); ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

</div>