<div class="js_data_constructor_panel">

	<h2 class="option-title"><?php _e('Edit Default Car Options', 'cardealer'); ?></h2>

	<div class="clearfix">

		<input type="hidden" value="" name="default_options">

		<ul class="groups data_groups_list">

			<?php foreach (TMM_Ext_Car_Dealer::$opt_groups as $key => $value) { ?>

				<li>
					<?php
					$data = array();
					$data['index'] = $key;
					$data['name'] = $value;

					echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/opt_groups_list_item.php', $data);
					?>
				</li>

			<?php } ?>

		</ul>

	</div>

	<br/><br/>


	<h2 class="option-title"><?php _e('Edit Advanced Car Options', 'cardealer'); ?></h2>

	<div class="option option-add-data">

	    <div class="controls">
	            <input value="" type="text" id="new_data_group_name" placeholder="Type group name here"/>
	            <a href="#" id="new_data_group_name_button" class="add-button"></a>
	    </div>
	    <div class="explain"><?php _e("Add new advanced options group", 'cardealer') ?></div>

	</div>

	<div class="clearfix">

		<?php $data_groups = TMM_Cardealer_DataConstructor::get_data_groups() ?>
		<input type="hidden" value="" name="data_groups">
		<ul id="data_groups_list" class="groups data_groups_list">
			<?php if (!empty($data_groups)): ?>
				<?php foreach ($data_groups as $data_group_index => $value) : ?>
					<li>
						<?php
						$template_data = array();
						$template_data['data_group_index'] = $data_group_index;
						$template_data['name'] = $value['name'];
						?>
						<?php echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/data_groups_list_item.php', $template_data); ?>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>

	</div>

</div>

<div class="clearfix">

	<ul class="data_group_data">

		<?php foreach (TMM_Ext_Car_Dealer::$opt_groups as $key => $value) { ?>

			<li style="display: none;" class="data_group_<?php echo $key ?>">
				<?php
				$data = TMM_Ext_PostType_Car::$car_options[$key];
				?>
				<h2 class="option-title"><?php echo __("Edit ", 'cardealer') . $value; ?></h2>
				<br /><br />
				<?php
				echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/opt_group_data.php', array('items' => $data, 'index' => $key));
				?>
			</li>

		<?php } ?>

	</ul>

</div>

<a href="#" class="admin-button button-gray button-medium js_back_to_group_data_list"><?php _e('Back to list', 'cardealer'); ?></a>

<div id="data_groups_errors" style="display: none;"></div>
<div id="data_groups_succsess" style="display: none;"></div>

<div class="clearfix">
    <ul class="data_group_data" id="data_group_data">
        <?php if (!empty($data_groups)): ?>
            <?php foreach ($data_groups as $data_group_index => $value) : ?>
                <li style="display: none;" class="data_group_<?php echo $data_group_index ?>">
                    <?php
                    $data = TMM_Cardealer_DataConstructor::get_group_data($data_group_index);
					?>
					<h2 class="option-title"><?php echo __("Edit ", 'cardealer') . $data['name']; ?></h2>
					<br /><br />
					<?php
                    echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/data_constructor/group_data.php', array('data_group_items' => $data, 'data_group_index' => $data_group_index));
                    ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
