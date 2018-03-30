<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php 
$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/admin/theme_options/sections/' . $tab_key . '/custom_html/';

$post_types = get_post_types(array(), 'object');

$child_sections['submitting_subscription_messages'] = array(
    'name' => __('Submitting  subscription messages', 'diplomat'),
    'sections' => array(
        'subscribe_mail_validation' => array(
            'title' => __('Subscribe Mail Validation Message', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("Please enter valid email address", 'diplomat'),
            'description' => '',
            'custom_html' => ''
        ),
        'info_already_subscribed' => array(
            'title' => __('Email is Already Subscribed message', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("You have been already subscribed", 'diplomat'),
            'description' => '',
            'custom_html' => ''
        ),
        'info_successfully_subscribed' => array(
            'title' => __('Email Successfully Subscribed message', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("Thank you for subscribing", 'diplomat'),
            'description' => '',
            'custom_html' => ''
        ),    
        'info_success_unsubscription' => array(
            'title' => __('Email Successfully Unsubscribed message', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("Thank You, You have been successfully unsubscribed", 'diplomat'),
            'description' => '',
            'custom_html' => ''
        ),
    )    
);
$child_sections['subscription_confirmation_email'] = array(
    'name' => __('Subscription confirmation email', 'diplomat'),
    'sections' => array(
        'subscribe_subject' => array(
            'title' => __('Subscription confirmation email Subject', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("Thank you for subscribing on %site_url%", 'diplomat'),
            'description' => 'You may use the following variables: %site_url%, %unsubscribe_url%, %n%',
            'custom_html' => ''
        ),
        'subscribe_message' => array(
            'title' => __('Subscription confirmation email Message', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("You have been successfully subscribed to our posts.%n% For unsubscribing from upcomming emails, please follow this link: <a href='%unsubscribe_url%'>Unsubscribe</a>", 'diplomat'),
            'description' => 'You may use the following variables: %site_url%, %unsubscribe_url%, %n%',
            'custom_html' => ''
        ),
    )
);
$child_sections['new_subscription_emails'] = array(
    'name' => __('New subscription email', 'diplomat'),
    'sections' => array(
        'new_post_subject' => array(
            'title' => __('New Email Subject', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __('New post on %site_url%', 'diplomat'),
            'description' => 'You may use the following variables: %post_title%, %post_url%, %site_url%, %unsubscribe_url%',
            'custom_html' => ''
        ),
        'new_post_message' => array(
            'title' => __('New Email Message', 'diplomat'),
            'type' => 'textarea',
            'default_value' => __("There is a new post at %site_url%. You can read it here: <a href='%post_url%'>%post_title%</a>.%n% For unsubscribing from upcomming emails, please follow this link: <a href='%unsubscribe_url%'>Unsubscribe</a>", 'diplomat'),
            'description' => 'You may use the following variables: %post_title%, %post_url%, %site_url%, %unsubscribe_url%, %n%',
            'custom_html' => ''
        ),
    )
);

$sections = array(
	'name' => __("Mail Subscription", 'diplomat'),
	'css_class' => 'shortcut-header',
	'show_general_page' => false,
	'content' => $content,
	'child_sections' => $child_sections,
    'menu_icon' => 'dashicons-email'    
);

TMM_OptionsHelper::$sections[$tab_key] = $sections;
