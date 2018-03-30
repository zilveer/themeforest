<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<a href="#" class="admin-button button-gray button-medium js_back_to_user_roles_list"><?php _e('Back to roles list', 'cardealer'); ?></a>

<h2 class="option-title"><?php echo __("Edit ", 'cardealer') . $user_role['name']; ?></h2>

<br /><br />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][name]',
	'type' => 'text',
	'default_value' => $user_role['name'],
	'title' => __("Account Status Name", 'cardealer'),
	'description' => __("Account status name", 'cardealer'),
	'css_class' => 'user_role_name_input',
	'data-id' => 'user_role_' . $user_role_id
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][life_period]',
	'type' => 'text',
	'default_value' => $user_role['life_period'],
	'title' => __('Account Life Period', 'cardealer'),
	'description' => __('Account life period (days). <br>Leave 0 if you don\'t need any fixed life time for this status', 'cardealer'),
	'css_class' => '',
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][packet_price]',
	'type' => 'text',
	'default_value' => $user_role['packet_price'],
    'data_typecheck' => 'number',
	'title' => __('Account Price', 'cardealer'),
	'description' => __('Account price', 'cardealer') . ' (<b>' . TMM_Ext_Car_Dealer::$default_currency['symbol'] . '</b>)',
	'css_class' => '',
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][max_cars]',
	'type' => 'text',
	'default_value' => $user_role['max_cars'],
	'title' => __('Max Count of Cars', 'cardealer'),
	'description' => __('Max count of cars', 'cardealer'),
	'css_class' => '',
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][max_images_size]',
	'type' => 'text',
	'default_value' => $user_role['max_images_size'],
	'title' => __('Disk Storage for Images (MB)', 'cardealer'),
	'description' => __('Disk Storage for images (MB)', 'cardealer'),
	'css_class' => '',
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][max_desc_count]',
	'type' => 'text',
	'default_value' => isset($user_role['max_desc_count']) ? $user_role['max_desc_count'] : '',
	'title' => __('Number of characters in description', 'cardealer'),
	'description' => __('The amount of letters allowed to use in description', 'cardealer'),
	'css_class' => '',
), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][features_cars_count]',
	'type' => 'text',
	'default_value' => $user_role['features_cars_count'],
	'title' => __('Featured Cars Count', 'cardealer'),
	'description' => __('Featured cars count', 'cardealer'),
	'css_class' => '',
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />

<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][feature_car_life_time]',
	'type' => 'text',
	'default_value' => $user_role['feature_car_life_time'],
	'title' => __('Featured Cars Lifetime', 'cardealer'),
	'description' => __('Featured cars lifetime (days)', 'cardealer'),
	'css_class' => '',
		), TMM_APP_CARDEALER_PREFIX);
?>

<hr class="sep-divider" />


<?php
TMM_OptionsHelper::draw_theme_option(array(
	'name' => 'user_roles[' . $user_role_id . '][enable_video]',
	'type' => 'checkbox',
	'default_value' => $user_role['enable_video'],
	'title' => __('Enable Video in Car Posts', 'cardealer'),
	'description' => __('Enable/disable video in car posts', 'cardealer'),
	'css_class' => '',
), TMM_APP_CARDEALER_PREFIX);
?>
