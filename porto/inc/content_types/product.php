<?php

// Meta Fields
function porto_product_meta_fields() {
    global $porto_settings;

    $custom_tabs_count = isset($porto_settings['product-custom-tabs-count']) ? $porto_settings['product-custom-tabs-count'] : '2';
    $custom_tabs = array();
    if ($custom_tabs_count) {
        for ($i = 0; $i < $custom_tabs_count; $i++) {
            $tab_priority = 40 + $i;
            $index = $i + 1;

            // Custom Tab Title
            $custom_tabs['custom_tab_title'.$index] = array(
                'name' => 'custom_tab_title'.$index,
                'title' => sprintf( __( 'Custom Tab %d Title', 'porto' ), $index ),
                'type' => 'text'
            );

            // Content Tab Content
            $custom_tabs['custom_tab_content'.$index] = array(
                'name' => 'custom_tab_content'.$index,
                'title' => sprintf( __( 'Custom Tab %d Content', 'porto' ), $index ),
                'type' => 'editor'
            );

            // Content Tab Priority
            $custom_tabs['custom_tab_priority'.$index] = array(
                'name' => 'custom_tab_priority'.$index,
                'title' => sprintf( __( 'Custom Tab %d Priority', 'porto' ), $index ),
                'desc' => __('Input the custom tab priority. (Description: 10, Additional Information: 20, Reviews: 30, Default Global Tab: 60)', 'porto'),
                'type' => 'text',
                'default' => $tab_priority
            );
        }
    }

    $meta_fields = array_merge($custom_tabs, array(
        // Share
        'product_share' => array(
            'name' => 'product_share',
            'title' => __('Share', 'porto'),
            'type' => 'radio',
            'default' => '',
            'options' => porto_ct_share_options()
        ),
        // Read More Link
        'product_more_link' => array(
            'name' => 'product_more_link',
            'title' => __('Read More Link in Catalog Mode', 'porto'),
            'type' => 'text'
        ),
    ));

    return $meta_fields;
}

function porto_product_view_meta_fields() {
    $meta_fields = porto_ct_default_view_meta_fields();
    return $meta_fields;
}

function porto_product_skin_meta_fields() {
    $meta_fields = porto_ct_default_skin_meta_fields();
    return $meta_fields;
}

// Show Meta Boxes
add_action('add_meta_boxes', 'porto_add_product_meta_boxes');
function porto_add_product_meta_boxes() {
    if (!function_exists('get_current_screen')) return;
    global $porto_settings;
    $screen = get_current_screen();
    if ( function_exists('add_meta_box') && $screen && $screen->base == 'post' && $screen->id == 'product' ) {
        add_meta_box( 'product-meta-box', __('Product Options', 'porto'), 'porto_product_meta_box', 'product', 'normal', 'high' );
        add_meta_box( 'view-meta-box', __('View Options', 'porto'), 'porto_product_view_meta_box', 'product', 'normal', 'low' );
        if ($porto_settings['show-content-type-skin']) {
            add_meta_box( 'skin-meta-box', __('Skin Options', 'porto'), 'porto_product_skin_meta_box', 'product', 'normal', 'low' );
        }
    }
}

function porto_product_meta_box() {
    $meta_fields = porto_product_meta_fields();
    porto_show_meta_box($meta_fields);
}

function porto_product_view_meta_box() {
    $meta_fields = porto_product_view_meta_fields();
    porto_show_meta_box($meta_fields);
}

function porto_product_skin_meta_box() {
    $meta_fields = porto_product_skin_meta_fields();
    porto_show_meta_box($meta_fields);
}

// Save Meta Values
add_action('save_post', 'porto_save_product_meta_values');
function porto_save_product_meta_values( $post_id ) {
    if (!function_exists('get_current_screen')) return;
    $screen = get_current_screen();
    if ($screen && $screen->base == 'post' && $screen->id == 'product') {
        porto_save_meta_value( $post_id, porto_product_meta_fields() );
        porto_save_meta_value( $post_id, porto_product_view_meta_fields() );
        porto_save_meta_value( $post_id, porto_product_skin_meta_fields() );
    }
}

// Remove in default custom field meta box
add_filter('is_protected_meta', 'porto_product_protected_meta', 10, 3);
function porto_product_protected_meta($protected, $meta_key, $meta_type) {
    if (!function_exists('get_current_screen')) return $protected;
    $screen = get_current_screen();
    if (!$protected && $screen && $screen->base == 'post' && $screen->id == 'product') {
        if (array_key_exists($meta_key, porto_product_meta_fields())
            || array_key_exists($meta_key, porto_product_view_meta_fields())
            || array_key_exists($meta_key, porto_product_skin_meta_fields()))
            $protected = true;
    }
    return $protected;
}

////////////////////////////////////////////////////////////////////////

// Taxonomy Meta Fields
function porto_product_cat_meta_fields() {
    global $porto_settings;

    $view_mode = porto_ct_category_view_mode();
    $product_columns = porto_ct_product_columns();
    $addlinks_pos = porto_ct_category_addlinks_pos();

    $meta_fields = porto_ct_default_view_meta_fields();

    // Category Image
    $meta_fields = array_insert_before('loading_overlay', $meta_fields, 'category_image', array(
        'name' => 'category_image',
        'title' => __('Category Image', 'porto'),
        'type' => 'upload'
    ));

    // View Mode
    $meta_fields = array_insert_after('category_image', $meta_fields, 'view_mode', array(
        'name' => 'view_mode',
        'title' => __('View Mode', 'porto'),
        'type' => 'radio',
        'options' => $view_mode
    ));

    // Columns
    $meta_fields = array_insert_after('view_mode', $meta_fields, 'product_cols', array(
        'name' => 'product_cols',
        'title' => __('Product Columns', 'porto'),
        'type' => 'select',
        'options' => $product_columns
    ));

    // Add Links Position
    $meta_fields = array_insert_after('product_cols', $meta_fields, 'addlinks_pos', array(
        'name' => 'addlinks_pos',
        'title' => __('Add Links Position', 'porto'),
        'desc' => __('Select position of add to cart, add to wishlist, quickview.', 'porto'),
        'type' => 'select',
        'options' => $addlinks_pos
    ));

    if (isset($porto_settings['show-category-skin']) && $porto_settings['show-category-skin']) {
        $meta_fields = array_merge($meta_fields, porto_ct_default_skin_meta_fields(true));
    }

    return $meta_fields;
}

$taxonomy = 'product_cat';
$table_name = $wpdb->prefix . $taxonomy . 'meta';
$variable_name = $taxonomy . 'meta';
$wpdb->$variable_name = $table_name;

// Add Meta Fields when edit taxonomy
add_action( 'product_cat_edit_form_fields', 'porto_edit_product_cat_meta_fields', 100, 2);
function porto_edit_product_cat_meta_fields($tag, $taxonomy) {
    if ($taxonomy !== 'product_cat') return;
    porto_edit_tax_meta_fields( $tag, $taxonomy, porto_product_cat_meta_fields() );
}

// Save Meta Values
add_action( 'edit_term', 'porto_save_product_cat_meta_values', 100, 3 );
function porto_save_product_cat_meta_values($term_id, $tt_id, $taxonomy) {
    if ($taxonomy !== 'product_cat') return;
    porto_create_tax_meta_table($taxonomy);
    return porto_save_tax_meta_values( $term_id, $taxonomy, porto_product_cat_meta_fields() );
}

// Delete Meta Values
add_action( 'delete_term', 'porto_delete_product_cat_meta_values', 10, 5);
function porto_delete_product_cat_meta_values($term_id, $tt_id, $taxonomy, $deleted_term, $object_ids) {
    if ($taxonomy !== 'product_cat') return;
    return porto_delete_tax_meta_values( $term_id, $taxonomy, porto_product_cat_meta_fields() );
}