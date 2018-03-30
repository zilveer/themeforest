<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div class="form-holder">

    <a class="add-button add_item_to_opt_group" href="#" title="<?php _e("Add item", 'cardealer') ?>"></a>

	<br />
	
    <ul class="data_group_items">

        <?php foreach ($items as $key => $value) { ?>

            <li class="admin-drag-holder">

	            <?php echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/opts_group_item_template.php', array('index' => $index, 'key' => $key, 'value' => $value)); ?>

            </li>

        <?php } ?>

    </ul>

</div>