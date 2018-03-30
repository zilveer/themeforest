<?php
$config  = array(
    'title' => sprintf('%s Page Options', THEME_NAME),
    'id' => 'mk-page-metabox',
    'pages' => array(
        'page'
    ),
    'callback' => '',
    'context' => 'normal',
    'priority' => 'core'
);
$options = array(
    array(
        "name" => __("Page Elements", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("Depending on your need you can change this page's general layout", "mk_framework"),
        "id" => "_template",
        "default" => '',
        "placeholder" => 'true',
        "width" => 400,
        "options" => array(
          "no-header" => __('Remove Header', "mk_framework"),
          "no-title" => __('Remove Page Title', "mk_framework"),
          "no-header-title" => __('Remove Header & Page Title', "mk_framework"),
          "no-title-footer" => __('Remove Page Title & Footer', "mk_framework"),
          "no-title-sub-footer" => __('Remove Page Title & Sub Footer', "mk_framework"),
          "no-title-footer-sub-footer" => __('Remove Page Title & Footer & Sub Footer', "mk_framework"),
          "no-footer-only" => __('Remove Footer', "mk_framework"),
          "no-sub-footer" => __('Remove Sub Footer', "mk_framework"),
          "no-footer" => __('Remove Footer & Sub Footer', "mk_framework"),
          "no-footer-title" => __('Remove Footer & Page Title', "mk_framework"),
          "no-sub-footer-title" => __('Remove Footer & Sub Footer & Page Title', "mk_framework"),
          "no-header-footer" => __('Remove Header & Footer & Sub Footer', "mk_framework"),
          "no-header-title-only-footer" => __('Remove Header & Page Title & Footer', "mk_framework"),
          "no-header-title-footer" => __('Remove Header & Page Title & Footer & Sub Footer', "mk_framework")
        ),
        "type" => "select"
    ),

    array(
        "name" => __("Stick Template?", "mk_framework"),
        "subtitle" => __("If enabled this option page will have no padding after header and before footer.", "mk_framework"),
        "desc" => __("Use this option if you need to use header slideshow or use a callout box before footer.", "mk_framework"),
        "id" => "_padding",
        "default" => 'false',
        "type" => "toggle"
    ),
    array(
        "name" => __("Header Toolbar?", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_header_toolbar",
        "default" => 'true',
        "type" => "toggle"
    ),
    array(
        "name" => __("Breadcrumb", "mk_framework"),
        "subtitle" => __("If you dont want to show breadcrumb disable this option.", "mk_framework"),
        "desc" => __("Breadcrumb is useful for SEO purposes and helps your site visitors to know where exactly they are relative to your sitemap from homepage. So its also good for UX.", "mk_framework"),
        "id" => "_breadcrumb",
        "default" => 'true',
        "type" => "toggle"
    ),
    array(
        "name" => __("Page Pre-loader", "mk_framework"),
        "subtitle" => __("adds a preloading overlay until the page is ready to be viewed.", "mk_framework"),
        "desc" => __("Please use this option when your have alot of images, slideshows and content.", "mk_framework"),
        "id" => "_preloader",
        "default" => 'false',
        "type" => "toggle"
    ),
    array(
        "name" => __("Header Style", "mk_framework"),
        "subtitle" => __("Defines how header appear in top.", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_header_style",
        "default" => 'block',
        "placeholder" => 'true',
        "width" => 400,
        "options" => array(
            "block" => __('Block module', "mk_framework"),
            "transparent" => __('Transparent Layer', "mk_framework")
        ),
        "type" => "select"
    ),
    array(
        "name" => __("Transparent Header Style Skin", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_trans_header_skin",
        "default" => 'light',
        "placeholder" => 'false',
        "width" => 400,
        "options" => array(
            "light" => __('Light', "mk_framework"),
            "dark" => __('Dark', "mk_framework")
        ),
        "type" => "select"
    ),
    array(
        "name" => __("Transparent Header Style Sticky Scroll Offset", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("zero means window height which is relative to the device screen height. any value bigger than 0 will set the sticky header to user defined value.", "mk_framework"),
        "id" => "_trans_header_offset",
        "default" => "120",
        "min" => "0",
        "max" => "5000",
        "step" => "1",
        "unit" => 'px',
        "type" => "range"
    ),
    array(
        "name" => __("Main Navigation Location", "mk_framework"),
        "subtitle" => __("Choose which menu location to be used in this page.", "mk_framework"),
        "desc" => __("If left blank, Primary Menu will be used. You should first <a target='_blank' href='".admin_url( 'nav-menus.php' ) . "'>create menu</a> and then <a target='_blank' href='".admin_url( 'nav-menus.php' ) . "?action=locations'>assign to menu locations</a>", "mk_framework"),
        "id" => "_menu_location",
        "default" => '',
        "placeholder" => 'true',
        "width" => 400,
        "options" => array(
            "primary-menu" => __('Primary Navigation', "mk_framework"),
            "second-menu" => __('Second Navigation', "mk_framework"),
            "third-menu" => __('Third Navigation', "mk_framework"),
            "fourth-menu" => __('Fourth Navigation', "mk_framework"),
            "fifth-menu" => __('Fifth Navigation', "mk_framework"),
            "sixth-menu" => __('Sixth Navigation', "mk_framework"),
            "seventh-menu" => __('Seventh Navigation', "mk_framework")
        ),
        "type" => "select"
    ),
    array(
        "name" => __("Quick Contact", "mk_framework"),
        "subtitle" => __("You can enable or disable Quick Contact Form using this option.", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_quick_contact",
        "default" => 'global',
        "placeholder" => 'true',
        "width" => 400,
        "options" => array(
            "global" => __('Override from Theme Settings', "mk_framework"),
            "enabled" => __('Enabled', "mk_framework"),
            "disabled" => __('Disabled', "mk_framework"),
        ),
        "type" => "select"
    ),
    array(
        "name" => __("Quick Contact Skin", "mk_framework"),
        "subtitle" => __("", "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "_quick_contact_skin",
        "default" => 'dark',
        "placeholder" => 'false',
        "width" => 400,
        "options" => array(
            "light" => __('Light', "mk_framework"),
            "dark" => __('Dark', "mk_framework")
        ),
        "type" => "select"
    ),
  
);
new mk_metaboxesGenerator($config, $options);
