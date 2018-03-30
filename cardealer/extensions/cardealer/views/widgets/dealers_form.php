<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>

<p>
    <label for="<?php echo $widget->get_field_id('user_number'); ?>"><?php _e('Dealers Number', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('user_number'); ?>" name="<?php echo $widget->get_field_name('user_number'); ?>" class="widefat">
		<?php
		$range = range(1,12);

		foreach ($range as $value) {
			?>
			<option <?php selected($instance['user_number'], $value); ?> value="<?php echo $value ?>"><?php echo $value ?></option>
		<?php
		}
		?>
	</select>
</p>

<p>
    <label for="<?php echo $widget->get_field_id('order'); ?>"><?php _e('Display Order', 'cardealer') ?>:</label>
    <select id="<?php echo $widget->get_field_id('order'); ?>" name="<?php echo $widget->get_field_name('order'); ?>" class="widefat">
        <?php
        $order = array(
	        'DESC' => __('Latest First', 'cardealer'),
	        'ASC' => __('Oldest First', 'cardealer'),
	        'random' => __('Random', 'cardealer')
        );
        foreach ($order as $key => $type) {
	        ?>
	        <option <?php selected($instance['order'], $key); ?> value="<?php echo $key ?>"><?php echo $type ?></option>
            <?php
        }
        ?>
    </select>
</p>

<p>
	<?php
	$packets = TMM_Cardealer_User::get_user_roles();
	$packets = array_merge($packets, array('administrator' => array('name' => __('Administrator', 'cardealer'))));
	?>
	<label for="<?php echo $widget->get_field_id('dealer_type'); ?>"><?php _e('Dealer Type', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('dealer_type'); ?>" name="<?php echo $widget->get_field_name('dealer_type'); ?>" class="widefat widget_dealer_type">
		<option <?php selected($instance['dealer_type'], '0'); ?> value="0"><?php _e('All', 'cardealer') ?></option>
		<option <?php selected($instance['dealer_type'], '1'); ?> value="1"><?php _e('All without Administrator', 'cardealer') ?></option>
		<?php
		foreach ($packets as $key => $value) {
			?>
			<option <?php selected($instance['dealer_type'], $key); ?> value="<?php echo $key ?>"><?php echo $value['name'] ?></option>
		<?php
		}
		?>
	</select>
</p>

<p>
	<?php
	$args = array();
	$dealers = array();

	if (!empty($instance['dealer_type']) && $instance['dealer_type'] !== '1') {
		$args['role'] = $instance['dealer_type'];
	}
	$users = get_users($args);

	foreach ($users as $value) {
		if ($instance['dealer_type'] === '1' && !empty($value->caps['administrator'])) {
			continue;
		}
		$dealers[] = array(
			'ID' => $value->ID,
			'user_nicename' => $value->user_nicename,
		);
	}
	?>
	<label for="<?php echo $widget->get_field_id('specific_dealer'); ?>"><?php _e('Specific Dealer', 'cardealer') ?>:</label>
	<select id="<?php echo $widget->get_field_id('specific_dealer'); ?>" name="<?php echo $widget->get_field_name('specific_dealer'); ?>" class="widefat widget_specific_dealer">
		<option <?php selected($instance['specific_dealer'], ''); ?> value=""><?php _e('All', 'cardealer') ?></option>
		<?php
		foreach ($dealers as $value) {
			?>
			<option <?php selected($instance['specific_dealer'], $value['ID']); ?> value="<?php echo $value['ID'] ?>"><?php echo $value['user_nicename'] ?></option>
		<?php
		}
		?>
	</select>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_dealer_logo'); ?>"
	       name="<?php echo $widget->get_field_name('show_dealer_logo'); ?>" value="true" <?php checked($instance['show_dealer_logo'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_dealer_logo'); ?>"><?php _e('Display Dealer Logo', 'cardealer') ?></label>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_dealer_bio'); ?>"
	       name="<?php echo $widget->get_field_name('show_dealer_bio'); ?>" value="true" <?php checked($instance['show_dealer_bio'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_dealer_bio'); ?>"><?php _e('Display Dealer Bio', 'cardealer') ?></label>
</p>

<p>
	<label for="<?php echo $widget->get_field_id('dealer_bio_symbols_count'); ?>"><?php _e('Excerpt Bio symbol count', 'cardealer') ?>:</label>
	<input class="widefat" type="text" id="<?php echo $widget->get_field_id('dealer_bio_symbols_count'); ?>" name="<?php echo $widget->get_field_name('dealer_bio_symbols_count'); ?>" value="<?php echo $instance['dealer_bio_symbols_count']; ?>" />
</p>

<p>
    <?php
    $checked = "";
    if ($instance['show_phone'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_phone'); ?>" name="<?php echo $widget->get_field_name('show_phone'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_phone'); ?>"><?php _e('Display Phone', 'cardealer') ?></label>
</p>


<p>
    <?php
    $checked = "";
    if ($instance['show_mobile'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_mobile'); ?>" name="<?php echo $widget->get_field_name('show_mobile'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_mobile'); ?>"><?php _e('Display Cell Phone', 'cardealer') ?></label>
</p>



<p>
    <?php
    $checked = "";
    if ($instance['show_fax'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_fax'); ?>" name="<?php echo $widget->get_field_name('show_fax'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_fax'); ?>"><?php _e('Display Fax', 'cardealer') ?></label>
</p>



<p>
    <?php
    $checked = "";
    if ($instance['show_email'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_email'); ?>" name="<?php echo $widget->get_field_name('show_email'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_email'); ?>"><?php _e('Display Email', 'cardealer') ?></label>
</p>



<p>
    <?php
    $checked = "";
    if ($instance['show_skype'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_skype'); ?>" name="<?php echo $widget->get_field_name('show_skype'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_skype'); ?>"><?php _e('Display Skype ID', 'cardealer') ?></label>
</p>



<p>
    <?php
    $checked = "";
    if ($instance['show_site'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_site'); ?>" name="<?php echo $widget->get_field_name('show_site'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_site'); ?>"><?php _e('Display Website Url', 'cardealer') ?></label>
</p>


<p>
    <?php
    $checked = "";
    if ($instance['show_address'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_address'); ?>" name="<?php echo $widget->get_field_name('show_address'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_address'); ?>"><?php _e('Display Postal Address', 'cardealer') ?></label>
</p>


<p>
    <?php
    $checked = "";
    if ($instance['show_map'] == 'true') {
        $checked = 'checked="checked"';
    }
    ?>
    <input type="checkbox" id="<?php echo $widget->get_field_id('show_map'); ?>" name="<?php echo $widget->get_field_name('show_map'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_map'); ?>"><?php _e('Display Map Location', 'cardealer') ?></label>
</p>

<p>
	<input type="checkbox" id="<?php echo $widget->get_field_id('show_see_all_button'); ?>"
	       name="<?php echo $widget->get_field_name('show_see_all_button'); ?>" value="true" <?php checked($instance['show_see_all_button'], 'true'); ?> />
	<label for="<?php echo $widget->get_field_id('show_see_all_button'); ?>"><?php _e('Display "All Cars" button', 'cardealer') ?></label>
</p>