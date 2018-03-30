<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label  for="<?php echo $widget->get_field_id('title'); ?>"><?php _e('Title', 'cardealer') ?>:</label>
    <input class="widefat" type="text" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<?php
$locations_captions_on_search_widget = TMM::get_option('locations_captions_on_search_widget', TMM_APP_CARDEALER_PREFIX);
$locations_captions_on_search_widget = explode(',', $locations_captions_on_search_widget);
?>

<?php if(!empty($locations_captions_on_search_widget[0])){ ?>
<p>
	<?php
	$sel_class = 'qs_widget_carlocation0';
	$checked = "";
	if ($instance['show_location0'] == 'true') {
		$checked = 'checked="checked"';
		$sel_class .= ' hide';
	}
	?>
	<input class="qs_widget_checkbox" type="checkbox" id="<?php echo $widget->get_field_id('show_location0'); ?>" name="<?php echo $widget->get_field_name('show_location0'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_location0'); ?>"><?php _e($locations_captions_on_search_widget[0], 'cardealer'); ?></label>

	<?php
	$selected = 0;
	if ( isset($instance['selected_location0']) ) {
		$selected = $instance['selected_location0'];
	}

	TMM_Ext_Car_Dealer::draw_locations_select(array(
		'required' => 0,
		'selected' => $selected,
		'class' => $sel_class,
		'name' => $widget->get_field_name('selected_location0'),
		'parent_id' => 0,
		'container' => false
	));
	?>
</p>
<?php } ?>

<?php if(!empty($locations_captions_on_search_widget[1])){ ?>
<p>
	<?php
	$checked = "";
	if ($instance['show_location1'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input class="qs_widget_checkbox" type="checkbox" id="<?php echo $widget->get_field_id('show_location1'); ?>" name="<?php echo $widget->get_field_name('show_location1'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_location1'); ?>"><?php _e($locations_captions_on_search_widget[1], 'cardealer'); ?></label>

	<?php
	$selected = 0;
	if ( isset($instance['selected_location1']) ) {
		$selected = $instance['selected_location1'];
	}
	$sel_class = 'qs_widget_carlocation1';
	if ($instance['show_location1'] == 'true' || $instance['show_location0'] == 'true' || !$instance['selected_location0']) {
		$sel_class .= ' hide';
	}
	TMM_Ext_Car_Dealer::draw_locations_select(array(
		'required' => 0,
		'selected' => $selected,
		'class' => $sel_class,
		'name' => $widget->get_field_name('selected_location1'),
		'parent_id' => $instance['selected_location0'],
		'container' => false
	));
	?>
</p>
<?php } ?>

<?php if(!empty($locations_captions_on_search_widget[2])){ ?>
<p>
	<?php
	$checked = "";
	if ($instance['show_location2'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
	<input  type="checkbox" id="<?php echo $widget->get_field_id('show_location2'); ?>" name="<?php echo $widget->get_field_name('show_location2'); ?>" value="true" <?php echo $checked; ?> />
	<label for="<?php echo $widget->get_field_id('show_location2'); ?>"><?php _e($locations_captions_on_search_widget[2], 'cardealer'); ?></label>
</p>
<?php } ?>

<p>
	<?php
	$checked = "";
	if ($instance['show_search_state_cars'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_search_state_cars'); ?>" name="<?php echo $widget->get_field_name('show_search_state_cars'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_search_state_cars'); ?>"><?php _e('Car Condition', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_producers_and_models'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_producers_and_models'); ?>" name="<?php echo $widget->get_field_name('show_producers_and_models'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_producers_and_models'); ?>"><?php _e('Producers &amp; Models', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_min_max_price'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_min_max_price'); ?>" name="<?php echo $widget->get_field_name('show_min_max_price'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_min_max_price'); ?>"><?php _e('Price Range', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_years'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_years'); ?>" name="<?php echo $widget->get_field_name('show_years'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_years'); ?>"><?php _e('Year Range', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_mileage'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_mileage'); ?>" name="<?php echo $widget->get_field_name('show_mileage'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_mileage'); ?>"><?php _e('Mileage', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_fuel_type'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_fuel_type'); ?>" name="<?php echo $widget->get_field_name('show_fuel_type'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_fuel_type'); ?>"><?php _e('Fuel type', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_transmission'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_transmission'); ?>" name="<?php echo $widget->get_field_name('show_transmission'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_transmission'); ?>"><?php _e('Gearbox', 'cardealer') ?></label>
</p>


<p>
	<?php
	$checked = "";
	if ($instance['show_body_type'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_body_type'); ?>" name="<?php echo $widget->get_field_name('show_body_type'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_body_type'); ?>"><?php _e('Body type', 'cardealer') ?></label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_doors_count'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_doors_count'); ?>" name="<?php echo $widget->get_field_name('show_doors_count'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_doors_count'); ?>"><?php _e('Doors count', 'cardealer') ?></label>
</p>

<p>
	<?php
	$checked = "";
	if ($instance['show_colors'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_colors'); ?>" name="<?php echo $widget->get_field_name('show_colors'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_colors'); ?>"><?php _e('Colors', 'cardealer') ?></label>
</p>
<p>
	<?php
	$checked = "";
	if ($instance['show_advanced_options'] == 'true') {
		$checked = 'checked="checked"';
	}
	?>
    <input  type="checkbox" id="<?php echo $widget->get_field_id('show_advanced_options'); ?>" name="<?php echo $widget->get_field_name('show_advanced_options'); ?>" value="true" <?php echo $checked; ?> />
    <label for="<?php echo $widget->get_field_id('show_advanced_options'); ?>"><?php _e('Advanced Search', 'cardealer') ?></label>
</p>

