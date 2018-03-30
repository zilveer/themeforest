<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
global $tmm_config;
$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/' . $tab_key . '/custom_html/';


$content = array(
    'new_user_email_subject' => array(
        'type' => 'text',
        'default_value' => '',
        'title' => __('User Registration Email Subject', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['create_user']['subject']),
        'css_class' => 'wide',
        'show_title' => false,
    ),
    'new_user_email' => array(
        'type' => 'textarea',
        'default_value' => '',
        'title' => __('User Registration Email Description', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['create_user']['message']),
        'css_class' => 'wide',
        'show_title' => true,
    ),

    'delete_user_email_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('User Deleting Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['delete_user']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'delete_user_email' => array(
        'type' => 'textarea',
        'default_value' => '',
        'title' => __('User Deleting Email', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['delete_user']['message']),
        'css_class' => 'wide',
        'show_title' => true,
    ),

    'new_car_email_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('Creating New Car Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['create_car']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'new_car_email' => array(
        'type' => 'textarea',
        'default_value' => '',
        'title' => __('Creating New Car Email Description', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['create_car']['message']),
        'css_class' => 'wide',
        'show_title' => true,
    ),

    'paypal_email_packet_succ_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('Account Status Updating Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['update_account']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'paypal_email_packet_succ_message' => array(
        'type' => 'textarea',
        'default_value' => '',
        'title' => __('Account Status Updating Email Description', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['update_account']['message']),
        'css_class' => 'wide',
        'show_title' => true,
    ),

    'message_packet_reset_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('Account Status Reset Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['reset_account']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'message_packet_reset' => array(
        'type' => 'textarea',
        'default_value' => '',
        'title' => __('Account Status Reset Email Description', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['reset_account']['message']),
        'css_class' => 'wide',
        'show_title' => true,
    ),

    'reset_account_before_week_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('Account Status Reset Warning (before a week) Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['reset_account_before_week']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'reset_account_before_week_message' => array(
	    'type' => 'textarea',
	    'default_value' => '',
	    'title' => __('Account Status Reset Warning (before a week) Email Description', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['reset_account_before_week']['message']),
	    'css_class' => 'wide',
	    'show_title' => true,
    ),

    'reset_account_before_day_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('Account Status Reset Warning (before a day) Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['reset_account_before_day']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'reset_account_before_day_message' => array(
	    'type' => 'textarea',
	    'default_value' => '',
	    'title' => __('Account Status Reset Warning (before a day) Email Description', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['reset_account_before_day']['message']),
	    'css_class' => 'wide',
	    'show_title' => true,
    ),

    'purchase_bundle_subject' => array(
	    'type' => 'text',
	    'default_value' => '',
	    'title' => __('Featured Cars Bundle Purchasing Email Subject', 'cardealer'),
	    'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['purchase_bundle']['subject']),
	    'css_class' => 'wide',
	    'show_title' => false,
    ),
    'purchase_bundle_message' => array(
        'type' => 'textarea',
        'default_value' => '',
        'title' => __('Featured Cars Bundle Purchasing Email Description', 'cardealer'),
        'description' => '<strong>' . __('Default', 'cardealer') . ': </strong>' . esc_html($tmm_config['emails']['purchase_bundle']['message']),
        'css_class' => 'wide',
        'show_title' => true,
    ),
);

$sections = array(
	'name' => __("Messages", 'cardealer'),
	'css_class' => 'shortcut-options',
	'show_general_page' => true,
	'content' => $content,
	'child_sections' => $child_sections,
	'menu_icon' => 'dashicons-email'
);

TMM_CarSettingsHelper::$sections[$tab_key] = $sections;