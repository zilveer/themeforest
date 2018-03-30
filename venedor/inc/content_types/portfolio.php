<?php

// Register Portfoio Content Type
add_action('init', 'venedor_portfolio_init');

function venedor_portfolio_init() {
    global $venedor_settings;

    $slug_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-slug-name']) && $venedor_settings['portfolio-slug-name']) ? esc_attr($venedor_settings['portfolio-slug-name']) : 'portfolio-items';
    $name = (isset($venedor_settings) && isset($venedor_settings['portfolio-name']) && $venedor_settings['portfolio-name']) ? $venedor_settings['portfolio-name'] : __('Portfolios', 'venedor');
    $singular_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-singular-name']) && $venedor_settings['portfolio-singular-name']) ? $venedor_settings['portfolio-singular-name'] : __('Portfolio', 'venedor');
    $cat_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-singular-name']) && $venedor_settings['portfolio-singular-name']) ? $venedor_settings['portfolio-singular-name'] . ' ' . __('Category', 'venedor') : __('Portfolio Category', 'venedor');
    $cats_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-singular-name']) && $venedor_settings['portfolio-singular-name']) ? $venedor_settings['portfolio-singular-name'] . ' ' . __('Categories', 'venedor') : __('Portfolio Categories', 'venedor');
    $skill_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-singular-name']) && $venedor_settings['portfolio-singular-name']) ? $venedor_settings['portfolio-singular-name'] . ' ' . __('Skill', 'venedor') : __('Portfolio Skill', 'venedor');
    $skills_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-singular-name']) && $venedor_settings['portfolio-singular-name']) ? $venedor_settings['portfolio-singular-name'] . ' ' . __('Skills', 'venedor') : __('Portfolio Skills', 'venedor');
    $cat_slug_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-cat-slug-name']) && $venedor_settings['portfolio-cat-slug-name']) ? esc_attr($venedor_settings['portfolio-cat-slug-name']) : 'portfolio_cat';
    $skill_slug_name = (isset($venedor_settings) && isset($venedor_settings['portfolio-skill-slug-name']) && $venedor_settings['portfolio-skill-slug-name']) ? esc_attr($venedor_settings['portfolio-skill-slug-name']) : 'portfolio_skills';
    
    register_post_type(         
        'portfolio',
        array(
            'labels' => venedor_labels($singular_name, $name),
            'exclude_from_search' => false,
            'has_archive' => false,
            'public' => true,
            'rewrite' => array('slug' => $slug_name),
            'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes'),
            'can_export' => true
        )
    );

    register_taxonomy(
        'portfolio_cat', 
        'portfolio', 
        array(
            'hierarchical' => true, 
            'labels' => venedor_labels_tax($cat_name, $cats_name),
            'query_var' => true, 
            'rewrite' => array('slug' => $cat_slug_name)
        )
    );
    
    register_taxonomy(
        'portfolio_skills',
        'portfolio', 
        array(
            'hierarchical' => true, 
            'labels' => venedor_labels_tax($skill_name, $skills_name),
            'query_var' => true, 
            'rewrite' => array('slug' => $skill_slug_name)
        )
    );
}

// Insert Portfolio Meta Boxes
function venedor_portfolio_meta_boxes() {
    
    global $portfolio_meta_boxes;
    
    venedor_show_meta_boxes($portfolio_meta_boxes);
}
        
function venedor_add_portfolio_meta_box() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Portfolio Options', 'venedor_portfolio_meta_boxes', 'portfolio', 'normal', 'high' );
    }
}

// Save Portfolio Metas        
function venedor_portfolio_save_postdata( $post_id ) {
    global $portfolio_meta_boxes;
    
    return venedor_save_postdata( $post_id, $portfolio_meta_boxes );
}

// Get Portfolio Metas        
function venedor_portfolio_get_postdata() {
    global $portfolio_meta_boxes, $portfolio_cat_meta_boxes;

    // Portfolio Meta Options
    $theme_layouts = venedor_ct_layouts();
    $sidebar_options = venedor_ct_sidebars();
    $banner_type = venedor_ct_banner_type();
    $banner_width = venedor_ct_banner_width();
    $layer_sliders = venedor_ct_layer_sliders();
    $rev_sliders = venedor_ct_rev_sliders();

    // Portfolio Meta Boxes
    $portfolio_meta_boxes = array(
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
        // Portfolio Type
        "slideshow_type" => venedor_labels_meta(
            "slideshow_type", 
            "Portfolio Type",
            "Select the portfolio type mode you want to use either image or video.",
            "radio",
            "images",
            "radio",
            array(
                "images" => "Images",
                "video" => "Video & Audio",
                "none" => "None"
            )
        ),
        // Video & Audio Embed Code
        "video_code"=> venedor_labels_meta(
            "video_code",
            "Video & Audio Embed Code",
            "Paste the iframe code of the Flash (YouTube or Vimeo etc). Only necessary when the portfolio type is video.",
            "textarea"
        ),
        // Visit Site Link
        "portfolio_link" => venedor_labels_meta(
            "portfolio_link",
            "Portfolio link",
            "External Link for the Portfolio which adds a visit site button with the link. Leave blank for post URL.",
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
    
    // Category Meta Boxes
    $portfolio_cat_meta_boxes = array(
        // Breadcrumbs
        "breadcrumbs"=> venedor_labels_meta(
            "breadcrumbs",
            "Breadcrumbs",
            "Disable breadcrumbs",
            "checkbox"
        ),
        // Default Layout, Sidebar
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

add_action('add_meta_boxes', 'venedor_add_portfolio_meta_box');
add_action('admin_menu', 'venedor_portfolio_get_postdata');
add_action('save_post', 'venedor_portfolio_save_postdata');

// Create Category Meta
global $wpdb;
$type = 'portfolio_cat';
$table_name = $wpdb->prefix . $type . 'meta';
$variable_name = $type . 'meta';
$wpdb->$variable_name = $table_name;

// Create Category Meta Table
create_metadata_table($table_name, $type);

// category meta
add_action( 'portfolio_cat_add_form_fields', 'venedor_add_portfolio_cat', 10, 2);
function venedor_add_portfolio_cat() {
    global $portfolio_cat_meta_boxes;
    
    venedor_show_tax_add_meta_boxes($portfolio_cat_meta_boxes);
}

add_action( 'portfolio_cat_edit_form_fields', 'venedor_edit_portfolio_cat', 10, 2);
function venedor_edit_portfolio_cat($tag, $taxonomy) {    
    global $portfolio_cat_meta_boxes;
    
    venedor_show_tax_edit_meta_boxes($tag, $taxonomy, $portfolio_cat_meta_boxes);
}

add_action( 'created_term', 'venedor_save_portfolio_cat', 10,3 );
add_action( 'edit_term', 'venedor_save_portfolio_cat', 10,3 );

function venedor_save_portfolio_cat($term_id, $tt_id, $taxonomy) {
    if (!$term_id) return;
    
    global $portfolio_cat_meta_boxes;
    
    venedor_post_get_postdata();    
    return venedor_save_taxdata( $term_id, $tt_id, $taxonomy, $portfolio_cat_meta_boxes );
}

?>
