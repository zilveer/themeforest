<?php

/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package VPBakeryVisualComposer
 *
 */

$posts = $categories = $pages = $testimonials = $clients = $portfolio_posts = $edge_posts = $tab_posts = $employees = $pricing = $animated_columns = $infinite_animation = $mk_awesome_icons_list = $mk_orderby = $mk_product_orderby = $mk_product_categories_orderby = $device_visibility = $css_animations = $product_cats = array();

global $mk_settings;

$skin_color = $mk_settings['accent-color'];

$target_arr = array(
    __("Same window", "mk_framework") => "_self",
    __("New window", "mk_framework") => "_blank"
);

$add_device_visibility = array(
    "type" => "dropdown",
    "heading" => __("Visibility For devices", "mk_framework") ,
    "param_name" => "visibility",
    "value" => array(
        "All" => '',
        "Hidden on Phones" => "hidden-sm",
        "Hidden on Tablets" => "hidden-tl",
        "Hidden on Desktops" => "hidden-dt",
        "Visible on Phones" => "visible-sm",
        "Visible on Tablets" => "visible-tl",
        "Visible on Desktops" => "visible-dt"
    ) ,
    "description" => __("You can make this element invisible for a particular device (screen resolution) or set it to All to be visible for all devices.", "mk_framework")
);

if (mk_page_is_vc_edit_form()) {
    
    $pricing_entries = get_posts('post_type=pricing&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    if ($pricing_entries != null && !empty($pricing_entries)) {
        foreach ($pricing_entries as $key => $entry) {
            $pricing[$entry->ID] = $entry->post_title;
        }
    }
    $employees_entries = get_posts('post_type=employees&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    
    if ($employees_entries != null && !empty($employees_entries)) {
        foreach ($employees_entries as $key => $entry) {
            $employees[$entry->ID] = $entry->post_title;
        }
    }
    
    $animated_columns_entries = get_posts('post_type=animated-columns&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    
    if ($animated_columns_entries != null && !empty($animated_columns_entries)) {
        foreach ($animated_columns_entries as $key => $entry) {
            $animated_columns[$entry->ID] = $entry->post_title;
        }
    }
    
    $portfolio_entries = get_posts('post_type=portfolio&orderby=title&numberposts=40&order=ASC&suppress_filters=0');
    foreach ($portfolio_entries as $key => $entry) {
        $portfolio_posts[$entry->ID] = $entry->post_title;
    }
    
    $clients_entries = get_posts('post_type=clients&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    
    if ($clients_entries != null && !empty($clients_entries)) {
        foreach ($clients_entries as $key => $entry) {
            $clients[$entry->ID] = $entry->post_title;
        }
    }
    
    $edge_entries = get_posts('post_type=edge&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    
    if ($edge_entries != null && !empty($edge_entries)) {
        foreach ($edge_entries as $key => $entry) {
            $edge_posts[$entry->ID] = $entry->post_title;
        }
    }
    
    $tab_entries = get_posts('post_type=tab_slider&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    
    if ($tab_entries != null && !empty($tab_entries)) {
        foreach ($tab_entries as $key => $entry) {
            $tab_posts[$entry->ID] = $entry->post_title;
        }
    }
    
    $testimonials_entries = get_posts('post_type=testimonial&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
    
    if ($testimonials_entries != null && !empty($testimonials_entries)) {
        foreach ($testimonials_entries as $key => $entry) {
            $testimonials[$entry->ID] = $entry->post_title;
        }
    }
    
    $cats_entries = get_categories('orderby=name&hide_empty=0&suppress_filters=0');
    foreach ($cats_entries as $key => $entry) {
        $categories[$entry->term_id] = $entry->name;
    }
    
    $posts_entries = get_posts('orderby=title&numberposts=40&order=ASC&suppress_filters=0');
    foreach ($posts_entries as $key => $entry) {
        $posts[$entry->ID] = $entry->post_title;
    }
    
    $page_entries = get_pages('title_li=&orderby=name&suppress_filters=0');
    foreach ($page_entries as $key => $entry) {
        $pages['None'] = "*";
        $pages[$entry->post_title] = $entry->ID;
    }
}
$infinite_animation = array(
    "None" => '',
    "Float Vertically" => "float-vertical",
    "Float Horizontally" => "float-horizontal",
    "Pulse" => "pulse",
    "Tossing" => "tossing",
    "Spin" => 'spin',
    'Flip Horizontally' => 'flip-horizontal'
);

$css_animations = array(
    "None" => '',
    "Fade In" => "fade-in",
    "Scale Up" => "scale-up",
    "Scale Down" => "scale-down",
    "Right to Left" => "right-to-left",
    "Left to Right" => "left-to-right",
    "Bottom to Top" => "bottom-to-top",
    "Top to Bottom" => "top-to-bottom",
    "Flip Horizontally" => "flip-x",
    "Flip Vertically" => "flip-y",
    "Rotate" => "forthy-five-rotate",
);

$mk_orderby = array(
    __("Date", 'mk_framework') => "date",
    __("Posts In (manually selected posts)", 'mk_framework') => "post__in",
    __('Menu Order', 'mk_framework') => 'menu_order',
    __("post id", 'mk_framework') => "id",
    __("title", 'mk_framework') => "title",
    __("Comment Count", 'mk_framework') => "comment_count",
    __("Random", 'mk_framework') => "rand",
    __("Author", 'mk_framework') => "author",
    __("No order", 'mk_framework') => "none",
);

$mk_product_orderby = array(
    __("Date", 'mk_framework') => "date",
    __("Title", 'mk_framework') => "title",
    __("Product ID", 'mk_framework') => "product_id",
    __("Name", 'mk_framework') => "name",
    __("Price", 'mk_framework') => "price",
    __("Sales", 'mk_framework') => "sales",
    __("Random", 'mk_framework') => "random",
);
$mk_product_categories_orderby = array(
    __("ID", 'mk_framework') => "id",
    __("Count", 'mk_framework') => "count",
    __("Name", 'mk_framework') => "name",
    __("Slug", 'mk_framework') => "slug",
    __("None", 'mk_framework') => "none",
);
