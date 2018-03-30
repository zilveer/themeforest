<?php

// Insert Page Meta Boxes
function venedor_page_meta_boxes() {
    
    global $page_meta_boxes;
    
    venedor_show_meta_boxes($page_meta_boxes);
}
        
function venedor_add_page_meta_box() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Page Options', 'venedor_page_meta_boxes', 'page', 'normal', 'high' );
    }
}

// Save Page Metas        
function venedor_page_save_postdata( $post_id ) {
    global $page_meta_boxes;
    
    return venedor_save_postdata( $post_id, $page_meta_boxes );
}

// Get Page Metas        
function venedor_page_get_postdata() {
    global $page_meta_boxes, $wp_registered_sidebars;
    
    // Page Meta Options
    $theme_layouts = venedor_ct_layouts();
    $theme_layouts = array_merge(array(
        "widewidth" => "Wide Width"
    ), $theme_layouts);
    $sidebar_options = venedor_ct_sidebars();
    $banner_type = venedor_ct_banner_type();
    $banner_width = venedor_ct_banner_width();
    $layer_sliders = venedor_ct_layer_sliders();
    $rev_sliders = venedor_ct_rev_sliders();
    
    $portfolio_columns = array(
        "2" => "2 Columns",
        "3" => "3 Columns",
        "4" => "4 Columns"
    );
    
    $portfolio_cats = array();
    $portfolio_cats[0] = 'All Categories';
    $pcats = get_categories(array(
        'taxonomy' => 'portfolio_cat'
    ));
    
    foreach ($pcats as $pcat) {
        $portfolio_cats[$pcat->term_id] = $pcat->name;
    }
    
    $faq_cats = array();
    $faq_cats[0] = 'All Categories';
    $fcats = get_categories(array(
        'taxonomy' => 'faq_cat'
    ));
    
    foreach ($fcats as $fcat) {
        $faq_cats[$fcat->term_id] = $fcat->name;
    }
    
    // Page Meta Boxes
    $page_meta_boxes = array(
        // Breadcrumbs
        "breadcrumbs"=> venedor_labels_meta(
            "breadcrumbs",
            "Breadcrumbs",
            "Disable breadcrumbs",
            "checkbox"
        ),
        // Title
        "title"=> venedor_labels_meta(
            "title",
            "Page Title",
            "Hide page title",
            "checkbox"
        ),
        // Layout
        "layout" => venedor_labels_meta(
            "layout", 
            "Layout",
            "Select the layout.",
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
            "blog-sidebar",
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
        // Infinite Scroll
        "infinite_scroll"=> venedor_labels_meta(
            "infinite_scroll",
            "Infinite Scroll",
            "Enable infinite scroll. Use in <strong>Portfolio</strong> templates.",
            "checkbox"
        ),
        // Portfolio Columns
        "portfolio_columns"=> venedor_labels_meta(
            "portfolio_columns",
            "Portfolio Columns",
            "The number of the columns in the portfolio page. Use in <strong>Portfolio</strong> template.",
            "radio",
            "4",
            "radio",
            $portfolio_columns
        ),
        // Portfolio Category
        "portfolio_cat"=> venedor_labels_meta(
            "portfolio_cat",
            "Portfolio Category",
            "Select the portfolio categories. Use in <strong>Portfolio</strong> template.",
            "multi_checkbox",
            "",
            "",
            $portfolio_cats
        ),
        // Portfolio Filter
        "portfolio_filters"=> venedor_labels_meta(
            "portfolio_filters",
            "Portfolio Filters",
            "Show the portfolio filters. Use in <strong>Portfolio</strong> template.",
            "checkbox"
        ),
        // FAQ Category
        "faq_cat"=> venedor_labels_meta(
            "faq_cat",
            "FAQ Category",
            "Select the faq categories. Use in <strong>FAQs</strong> template.",
            "multi_checkbox",
            "",
            "",
            $faq_cats
        ),
        // FAQ Filter
        "faq_filters"=> venedor_labels_meta(
            "faq_filters",
            "FAQ Filters",
            "Show the faq filters. Use in <strong>FAQs</strong> template.",
            "checkbox"
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

add_action('add_meta_boxes', 'venedor_add_page_meta_box');
add_action('admin_menu', 'venedor_page_get_postdata');
add_action('save_post', 'venedor_page_save_postdata');

?>
