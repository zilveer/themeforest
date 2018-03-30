<?php

// Insert Post Meta Boxes
function venedor_product_meta_boxes() {
    
    global $product_meta_boxes;
    
    venedor_show_meta_boxes($product_meta_boxes);
}
        
function venedor_add_product_meta_box() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Product Options', 'venedor_product_meta_boxes', 'product', 'normal', 'high' );
    }
}

// Save Product Metas        
function venedor_product_save_postdata( $post_id ) {
    global $product_meta_boxes;
    
    return venedor_save_postdata( $post_id, $product_meta_boxes );
}

// Get Product Metas
function venedor_product_get_postdata() {
    global $product_meta_boxes, $product_cat_meta_boxes;
    
    // Product Meta Options
    $theme_layouts = venedor_ct_layouts();
    $sidebar_options = venedor_ct_sidebars();
    $banner_type = venedor_ct_banner_type();
    $banner_width = venedor_ct_banner_width();
    $layer_sliders = venedor_ct_layer_sliders();
    $rev_sliders = venedor_ct_rev_sliders();
    
    $product_meta_boxes = array(
        // Breadcrumbs
        "breadcrumbs"=> venedor_labels_meta(
            "breadcrumbs",
            "Breadcrumbs",
            "Disable breadcrumbs",
            "checkbox"
        ),
        // Layout, Sidebar
        "default"=> venedor_labels_meta(
            "default",
            "Layout & Sidebar",
            "Use selected layout and sidebar",
            "checkbox"
        ),
        // Layout
        "layout" => venedor_labels_meta(
            "layout",
            "Layout",
            "Select layout.",
            "radio",
            "fullwidth",
            "radio",
            $theme_layouts
        ),
        // Sidebar
        "sidebar"=> venedor_labels_meta(
            "sidebar",
            "Sidebar",
            "Select the sidebar you would like to display. <strong>Note</strong>: You must first create the sidebar under <strong>Appearance > Sidebars</strong>.",
            "customselect",
            "woocommerce-sidebar",
            "",
            $sidebar_options
        ),
        // Show Header on Banner
        "header_on_banner"=> venedor_labels_meta(
            "header_on_banner",
            "Header on Banner",
            "Show header on banner. When select <strong>\"Banner Type\"</strong> to <strong>\"Layerslider\"</strong>, <strong>\"Revolution Slider\"</strong> or <strong>\"Banner\"</strong>, this option will be work.",
            "checkbox"
        ),
        // Background Revolution Slider
        "bg_rev_slider"=> venedor_labels_meta(
            "bg_rev_slider",
            "Background Slider",
            "Select the Background Revolution Slider. If you should select <strong>\"Banner Type\"</strong> to <strong>\"Revolution Slider\"</strong>, this will be <strong>synchronize</strong> with <strong>banner revolution slider</strong>.",
            "customselect",
            "",
            "",
            $rev_sliders
        ),
        // Banner Type
        "banner_type"=> venedor_labels_meta(
            "banner_type",
            "Banner Type",
            "Select the banner type which display above the page content.",
            "customselect",
            "",
            "",
            $banner_type
        ),
        // Banner Width
        "banner_width"=> venedor_labels_meta(
            "banner_width",
            "Banner Width",
            "Select the banner width",
            "radio",
            "wide",
            "radio",
            $banner_width
        ),
        // LayerSlider
        "layer_slider"=> venedor_labels_meta(
            "layer_slider",
            "LayerSlider",
            "Select the LayerSlider.",
            "customselect",
            "",
            "",
            $layer_sliders
        ),
        // Revolution Slider
        "rev_slider"=> venedor_labels_meta(
            "rev_slider",
            "Revolution Slider",
            "Select the Revolution Slider.",
            "customselect",
            "",
            "",
            $rev_sliders
        ),
        // Banner
        "banner"=> venedor_labels_meta(
            "banner",
            "Banner",
            "",
            "textarea"
        ),
        // Product Slider
        "product_slider"=> venedor_labels_meta(
            "product_slider",
            "Product Slider",
            "Comma separated list of product id.",
            "text"
        ),
        // Content Top
        "content_top"=> venedor_labels_meta(
            "content_top",
            "Content Top",
            "Input the content top block.",
            "text"
        ),
        // Content Bottom
        "content_bottom"=> venedor_labels_meta(
            "content_bottom",
            "Content Bottom",
            "Input the content bottom block.",
            "text"
        ),
        // Custom Tab Title
        "custom_tab_title1"=> venedor_labels_meta(
            "custom_tab_title1",
            "Custom Tab Title 1",
            "Input the custom tab title.",
            "text"
        ),
        // Content Tab Content
        "custom_tab_content1"=> venedor_labels_meta(
            "custom_tab_content1",
            "Custom Tab Content 1",
            "Input the custom tab content.",
            "textarea"
        ),
        // Custom Tab Title
        "custom_tab_title2"=> venedor_labels_meta(
            "custom_tab_title2",
            "Custom Tab Title 2",
            "Input the custom tab title.",
            "text"
        ),
        // Content Tab Content
        "custom_tab_content2"=> venedor_labels_meta(
            "custom_tab_content2",
            "Custom Tab Content 2",
            "Input the custom tab content.",
            "textarea"
        )
    );
    
    $banner_type['featured_products'] = "Featured Products";
    $banner_type['hide_banner'] = "Hide Banner";
    // Category Meta Boxes
    $product_cat_meta_boxes = array(
        // Breadcrumbs
        "breadcrumbs"=> venedor_labels_meta(
            "breadcrumbs",
            "Breadcrumbs",
            "Disable breadcrumbs",
            "checkbox"
        ),
        // Layout, Sidebar
        "default"=> venedor_labels_meta(
            "default",
            "Layout & Sidebar",
            "Use selected layout and sidebar",
            "checkbox"
        ),
        // Layout
        "layout" => venedor_labels_meta(
            "layout", 
            "Layout",
            "Select layout.",
            "radio",
            "right-sidebar",
            "radio",
            $theme_layouts
        ),
        // Sidebar
        "sidebar"=> venedor_labels_meta(
            "sidebar",
            "Sidebar",
            "Select the sidebar you would like to display. <strong>Note</strong>: You must first create the sidebar under <strong>Appearance > Sidebars</strong>.",
            "customselect",
            "woocommerce-sidebar",
            "",
            $sidebar_options
        ),
        // Show Header on Banner
        "header_on_banner"=> venedor_labels_meta(
            "header_on_banner",
            "Header on Banner",
            "Show header on banner. When select <strong>\"Banner Type\"</strong> to <strong>\"Layerslider\"</strong>, <strong>\"Revolution Slider\"</strong> or <strong>\"Banner\"</strong>, this option will be work.",
            "checkbox"
        ),
        // Background Revolution Slider
        "bg_rev_slider"=> venedor_labels_meta(
            "bg_rev_slider",
            "Background Slider",
            "Select the Background Revolution Slider. If you should select <strong>\"Banner Type\"</strong> to <strong>\"Revolution Slider\"</strong>, this will be <strong>synchronize</strong> with <strong>banner revolution slider</strong>.",
            "customselect",
            "",
            "",
            $rev_sliders
        ),
        // Banner Type
        "banner_type"=> venedor_labels_meta(
            "banner_type",
            "Banner Type",
            "Select the banner type which display above the page content.",
            "customselect",
            "",
            "",
            $banner_type
        ),
        // Banner Width
        "banner_width"=> venedor_labels_meta(
            "banner_width",
            "Banner Width",
            "Select the banner width",
            "radio",
            "wide",
            "radio",
            $banner_width
        ),
        // LayerSlider
        "layer_slider"=> venedor_labels_meta(
            "layer_slider",
            "LayerSlider",
            "Select the LayerSlider.",
            "customselect",
            "",
            "",
            $layer_sliders
        ),
        // Revolution Slider
        "rev_slider"=> venedor_labels_meta(
            "rev_slider",
            "Revolution Slider",
            "Select the Revolution Slider.",
            "customselect",
            "",
            "",
            $rev_sliders
        ),
        // Banner
        "banner"=> venedor_labels_meta(
            "banner",
            "Banner",
            "",
            "textarea"
        ),
        // Product Slider
        "product_slider"=> venedor_labels_meta(
            "product_slider",
            "Product Slider",
            "Comma separated list of product id.",
            "text"
        ),
        // Content Top
        "content_top"=> venedor_labels_meta(
            "content_top",
            "Content Top",
            "Input the content top block.",
            "text"
        ),
        // Content Bottom
        "content_bottom"=> venedor_labels_meta(
            "content_bottom",
            "Content Bottom",
            "Input the content bottom block.",
            "text"
        )
    );
}

add_action('add_meta_boxes', 'venedor_add_product_meta_box');
add_action('admin_menu', 'venedor_product_get_postdata');
add_action('save_post', 'venedor_product_save_postdata');

// Create Product Cat Meta
global $wpdb;
$type = 'product_cat';
$table_name = $wpdb->prefix . $type . 'meta';
$variable_name = $type . 'meta';
$wpdb->$variable_name = $table_name;

// Create Product Cat Meta Table
create_metadata_table($table_name, $type);

// category meta
add_action( 'product_cat_add_form_fields', 'venedor_add_product_cat', 10, 2);
function venedor_add_product_cat() {
    global $product_cat_meta_boxes;
    
    venedor_show_tax_add_meta_boxes($product_cat_meta_boxes);
}

add_action( 'product_cat_edit_form_fields', 'venedor_edit_product_cat', 10, 2);
function venedor_edit_product_cat($tag, $taxonomy) {    
    global $product_cat_meta_boxes;
    
    venedor_show_tax_edit_meta_boxes($tag, $taxonomy, $product_cat_meta_boxes);
}

add_action( 'created_term', 'venedor_save_product_cat', 10,3 );
add_action( 'edit_term', 'venedor_save_product_cat', 10,3 );

function venedor_save_product_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    global $product_cat_meta_boxes;
    
    venedor_product_get_postdata();    
    return venedor_save_taxdata( $term_id, $tt_id, $taxonomy, $product_cat_meta_boxes );
}

?>
