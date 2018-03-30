<?php
$config  = array(
    'title' => sprintf('%s Widget Options', THEME_NAME),
    'id' => 'mk-metaboxes-widgets',
    'pages' => array(
        'page',
        'portfolio',
        'news',
        'post'
    ),
    'callback' => '',
    'context' => 'normal',
    'priority' => 'default'
);
$options = array(
    array(
        "name" => __("Footer Widget Area - First Column", "mk_framework"),
        "desc" => __("Choose which widget area you would like to show in this column for this post/page", "mk_framework"),
        "id" => "_widget_first_col",
        "default" => '',
        "options" => mk_get_sidebar_options(),
        "type" => "select"
    ),
    array(
        "name" => __("Footer Widget Area - Second Column", "mk_framework"),
        "desc" => __("Choose which widget area you would like to show in this column for this post/page", "mk_framework"),
        "id" => "_widget_second_col",
        "default" => '',
        "options" => mk_get_sidebar_options(),
        "type" => "select"
    ),
    array(
        "name" => __("Footer Widget Area - Third Column", "mk_framework"),
        "desc" => __("Choose which widget area you would like to show in this column for this post/page", "mk_framework"),
        "id" => "_widget_third_col",
        "default" => '',
        "options" => mk_get_sidebar_options(),
        "type" => "select"
    ),
    array(
        "name" => __("Footer Widget Area - Fourth Column", "mk_framework"),
        "desc" => __("Choose which widget area you would like to show in this column for this post/page", "mk_framework"),
        "id" => "_widget_fourth_col",
        "default" => '',
        "options" => mk_get_sidebar_options(),
        "type" => "select"
    ),
    array(
        "name" => __("Footer Widget Area - Fifth Column", "mk_framework"),
        "desc" => __("Choose which widget area you would like to show in this column for this post/page", "mk_framework"),
        "id" => "_widget_fifth_col",
        "default" => '',
        "options" => mk_get_sidebar_options(),
        "type" => "select"
    ),

    array(
        "name" => __("Footer Widget Area - Sixth Column", "mk_framework"),
        "desc" => __("Choose which widget area you would like to show in this column for this post/page", "mk_framework"),
        "id" => "_widget_sixth_col",
        "default" => '',
        "options" => mk_get_sidebar_options(),
        "type" => "select"
    )
    
    
    
);
new mkMetaboxesGenerator($config, $options);
