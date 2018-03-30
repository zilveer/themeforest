<?php

// Meta Fields
function porto_portfolio_meta_fields() {

    // Slideshow Types
    $slideshow_types = porto_ct_slideshow_types();

    return array(
        // Archive Image
        'portfolio_archive_image' => array(
            'name' => 'portfolio_archive_image',
            'title' => __('Change Featured Image', 'porto'),
            'desc' => __('Change featured image on Archives, Carousel, etc.', 'porto'),
            'type' => 'attach'
        ),
        // Slideshow Type
        'slideshow_type' => array(
            'name' => 'slideshow_type',
            'title' => __('Slideshow Type', 'porto'),
            'type' => 'radio',
            'default' => 'images',
            'options' => $slideshow_types
        ),
        // Slider Type
        'slider_type' => array(
            'name' => 'slider_type',
            'title' => __('Slider Type', 'porto'),
            'type' => 'radio',
            'desc' => __('Use in slider portfolio layout.', 'porto'),
            'default' => '',
            'options' => array(
                '' => __('Default', 'porto'),
                'without-thumbs' => __('Without Thumbs', 'porto'),
                'with-thumbs' => __('With Thumbs', 'porto'),
            ),
            'required' => array(
                'name' => 'slideshow_type',
                'value' => 'images'
            ),
        ),
        // Slider Thumbs Count
        'slider_thumbs_count' => array(
            'name' => 'slider_thumbs_count',
            'title' => __('Slider Thumbs Count', 'porto'),
            'type' => 'text',
            'desc' => __('Use in slider portfolio layout.', 'porto'),
            'default' => '4',
            'required' => array(
                'name' => 'slideshow_type',
                'value' => 'images'
            ),
        ),
        // Video & Audio Embed Code
        'video_code' => array(
            'name' => 'video_code',
            'title' => __('Video & Audio Embed Code or Content', 'porto'),
            'desc' => __('Paste the iframe code of the Flash (YouTube or Vimeo etc) or Input the shortcodes. Only necessary when the member type is Video & Audio.', 'porto'),
            'type' => 'textarea',
            'required' => array(
                'name' => 'slideshow_type',
                'value' => 'video'
            ),
        ),
        // More Information
        'portfolio_info' => array(
            'name' => 'portfolio_info',
            'title' => __('More Information', 'porto'),
            'type' => 'editor'
        ),
        // Visit Site Link
        'portfolio_link' => array(
            'name' => 'portfolio_link',
            'title' => __('Portfolio Link', 'porto'),
            'desc' => __('External Link for the Portfolio which adds a <strong>Live Preview</strong> button with the link. Leave blank for portfolio URL.', 'porto'),
            'type' => 'text'
        ),
        // Location
        'portfolio_location' => array(
            'name' => 'portfolio_location',
            'title' => __('Location', 'porto'),
            'type' => 'text'
        ),
        // Client Name
        'portfolio_client' => array(
            'name' => 'portfolio_client',
            'title' => __('Client Name', 'porto'),
            'type' => 'text'
        ),
        // Client URL
        'portfolio_client_link' => array(
            'name' => 'portfolio_client_link',
            'title' => __('Client URL(Link)', 'porto'),
            'type' => 'text'
        ),
        // Author Quote
        'portfolio_author_quote' => array(
            'name' => 'portfolio_author_quote',
            'title' => __('Author Quote', 'porto'),
            'type' => 'textarea'
        ),
        // Author Name
        'portfolio_author_name' => array(
            'name' => 'portfolio_author_name',
            'title' => __('Author Name', 'porto'),
            'type' => 'text'
        ),
        // Author Image
        'portfolio_author_image' => array(
            'name' => 'portfolio_author_image',
            'title' => __('Author Image', 'porto'),
            'type' => 'upload'
        ),
        // Author Role
        'portfolio_author_role' => array(
            'name' => 'portfolio_author_role',
            'title' => __('Author Role', 'porto'),
            'type' => 'text'
        ),
        // Layout
        'portfolio_layout' => array(
            'name' => 'portfolio_layout',
            'title' => __('Portfolio Layout', 'porto'),
            'type' => 'radio',
            'default' => 'default',
            'options' => array_merge(
                array(
                    'default' => __('Default', 'porto')
                ),
                porto_ct_portfolio_single_layouts()
            )
        ),
        // Share
        'portfolio_share' => array(
            'name' => 'portfolio_share',
            'title' => __('Share', 'porto'),
            'type' => 'radio',
            'default' => '',
            'options' => porto_ct_share_options()
        ),
        // Like Count
        'like_count'=> array(
            'name' => 'like_count',
            'title' => __('Like Count', 'porto'),
            'type' => 'text',
            'default' => __('0', 'porto')
        ),
    );
}

function porto_portfolio_view_meta_fields() {
    $meta_fields = porto_ct_default_view_meta_fields();
    // Layout
    $meta_fields['layout']['default'] = 'fullwidth';
    return $meta_fields;
}

function porto_portfolio_skin_meta_fields() {
    $meta_fields = porto_ct_default_skin_meta_fields();
    return $meta_fields;
}

// Show Meta Boxes
add_action('add_meta_boxes', 'porto_add_portfolio_meta_boxes');
function porto_add_portfolio_meta_boxes() {
    if (!function_exists('get_current_screen')) return;
    global $porto_settings;
    $screen = get_current_screen();
    if ( function_exists('add_meta_box') && $screen && $screen->base == 'post' && $screen->id == 'portfolio' ) {
        add_meta_box( 'portfolio-meta-box', __('Portfolio Options', 'porto'), 'porto_portfolio_meta_box', 'portfolio', 'normal', 'high' );
        add_meta_box( 'view-meta-box', __('View Options', 'porto'), 'porto_portfolio_view_meta_box', 'portfolio', 'normal', 'low' );
        if ($porto_settings['show-content-type-skin']) {
            add_meta_box( 'skin-meta-box', __('Skin Options', 'porto'), 'porto_portfolio_skin_meta_box', 'portfolio', 'normal', 'low' );
        }
    }
}

function porto_portfolio_meta_box() {
    $meta_fields = porto_portfolio_meta_fields();
    porto_show_meta_box($meta_fields);
}

function porto_portfolio_view_meta_box() {
    $meta_fields = porto_portfolio_view_meta_fields();
    porto_show_meta_box($meta_fields);
}

function porto_portfolio_skin_meta_box() {
    $meta_fields = porto_portfolio_skin_meta_fields();
    porto_show_meta_box($meta_fields);
}

// Save Meta Values
add_action('save_post', 'porto_save_portfolio_meta_values');
function porto_save_portfolio_meta_values( $post_id ) {
    if (!function_exists('get_current_screen')) return;
    $screen = get_current_screen();
    if ($screen && $screen->base == 'post' && $screen->id == 'portfolio') {
        porto_save_meta_value( $post_id, porto_portfolio_meta_fields() );
        porto_save_meta_value( $post_id, porto_portfolio_view_meta_fields() );
        porto_save_meta_value( $post_id, porto_portfolio_skin_meta_fields() );
    }
}

// Remove in default custom field meta box
add_filter('is_protected_meta', 'porto_portfolio_protected_meta', 10, 3);
function porto_portfolio_protected_meta($protected, $meta_key, $meta_type) {
    if (!function_exists('get_current_screen')) return $protected;
    $screen = get_current_screen();
    if (!$protected && $screen && $screen->base == 'post' && $screen->id == 'portfolio') {
        if (array_key_exists($meta_key, porto_portfolio_meta_fields())
            || array_key_exists($meta_key, porto_portfolio_view_meta_fields())
            || array_key_exists($meta_key, porto_portfolio_skin_meta_fields()))
            $protected = true;
    }
    return $protected;
}

////////////////////////////////////////////////////////////////////////

// Taxonomy Meta Fields
function porto_portfolio_cat_meta_fields() {
    global $porto_settings;

    $meta_fields = porto_ct_default_view_meta_fields();

    // Portfolio Options
    $meta_fields = array_insert_before('loading_overlay', $meta_fields, 'portfolio_options', array(
        'name' => 'portfolio_options',
        'title' => __('Archive Options', 'porto'),
        'desc' => __('Change default theme options.', 'porto'),
        'type' => 'checkbox'
    ));

    // Infinite Scroll
    $meta_fields = array_insert_after('portfolio_options', $meta_fields, 'portfolio_infinite', array(
        'name' => 'portfolio_infinite',
        'title' => __('Infinite Scroll', 'porto'),
        'desc' => __('Disable infinite scroll.', 'porto'),
        'type' => 'checkbox',
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));

    // Layout
    $meta_fields = array_insert_after('portfolio_infinite', $meta_fields, 'portfolio_layout', array(
        'name' => 'portfolio_layout',
        'title' => __('Portfolio Layout', 'porto'),
        'type' => 'radio',
        'default' => 'grid',
        'options' => porto_ct_portfolio_archive_layouts(),
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));
    // Grid Columns
    $meta_fields = array_insert_after('portfolio_layout', $meta_fields, 'portfolio_grid_columns', array(
        'name' => 'portfolio_grid_columns',
        'title' => __('Columns in Grid, Masonry Layout', 'porto'),
        'type' => 'radio',
        'default' => '4',
        'options' => array(
            '1' => __('1 Column', 'porto'),
            '2' => __('2 Columns', 'porto'),
            '3' => __('3 Columns', 'porto'),
            '4' => __('4 Columns', 'porto'),
            '5' => __('5 Columns', 'porto'),
            '6' => __('6 Columns', 'porto'),
        ),
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));
    // Grid View
    $meta_fields = array_insert_after('portfolio_grid_columns', $meta_fields, 'portfolio_grid_view', array(
        'name' => 'portfolio_grid_view',
        'title' => __('View Type in Grid, Masonry Layout', 'porto'),
        'type' => 'radio',
        'default' => 'default',
        'options' => array(
            'default' => __('Default', 'porto'),
            'full' => __('No Margin', 'porto'),
            'outimage' => __('Out of Image', 'porto')
        ),
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));
    // Info View Type
    $meta_fields = array_insert_after('portfolio_grid_view', $meta_fields, 'portfolio_archive_thumb', array(
        'name' => 'portfolio_archive_thumb',
        'title' => __('Info View Type in Grid, Masonry, Timeline Layout', 'porto'),
        'type' => 'radio',
        'default' => 'left-info',
        'options' => array(
            'left-info' => __('Left Info', 'porto'),
            'centered-info' => __('Centered Info', 'porto'),
            'bottom-info' => __('Bottom Info', 'porto'),
            'bottom-info-dark' => __('Bottom Info Dark', 'porto'),
            'hide-info-hover' => __('Hide Info Hover', 'porto')
        ),
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));
    // Image Overlay Background
    $meta_fields = array_insert_after('portfolio_archive_thumb', $meta_fields, 'portfolio_archive_thumb_bg', array(
        'name' => 'portfolio_archive_thumb_bg',
        'title' => __('Image Overlay Background', 'porto'),
        'type' => 'radio',
        'default' => 'darken',
        'options' => array(
            'darken' => __('Darken', 'porto'),
            'lighten' => __('Lighten', 'porto'),
            'hide-wrapper-bg' => __('Transparent', 'porto')
        ),
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));
    // Image Hover Effect
    $meta_fields = array_insert_after('portfolio_archive_thumb_bg', $meta_fields, 'portfolio_archive_thumb_image', array(
        'name' => 'portfolio_archive_thumb_image',
        'title' => __('Hover Image Effect', 'porto'),
        'type' => 'radio',
        'default' => 'zoom',
        'options' => array(
            'zoom' => __('Zoom', 'porto'),
            'no-zoom' => __('No Zoom', 'porto'),
        ),
        'required' => array(
            'name' => 'portfolio_options',
            'value' => 'portfolio_options'
        ),
    ));

    if (isset($porto_settings['show-category-skin']) && $porto_settings['show-category-skin']) {
        $meta_fields = array_merge($meta_fields, porto_ct_default_skin_meta_fields(true));
    }

    return $meta_fields;
}

$taxonomy = 'portfolio_cat';
$table_name = $wpdb->prefix . $taxonomy . 'meta';
$variable_name = $taxonomy . 'meta';
$wpdb->$variable_name = $table_name;

// Add Meta Fields when edit taxonomy
add_action( 'portfolio_cat_edit_form_fields', 'porto_edit_portfolio_cat_meta_fields', 100, 2);
function porto_edit_portfolio_cat_meta_fields($tag, $taxonomy) {
    if ($taxonomy !== 'portfolio_cat') return;
    porto_edit_tax_meta_fields( $tag, $taxonomy, porto_portfolio_cat_meta_fields() );
}

// Save Meta Values
add_action( 'edit_term', 'porto_save_portfolio_cat_meta_values', 100, 3 );
function porto_save_portfolio_cat_meta_values($term_id, $tt_id, $taxonomy) {
    if ($taxonomy !== 'portfolio_cat') return;
    porto_create_tax_meta_table($taxonomy);
    return porto_save_tax_meta_values( $term_id, $taxonomy, porto_portfolio_cat_meta_fields() );
}

// Delete Meta Values
add_action( 'delete_term', 'porto_delete_portfolio_cat_meta_values', 10, 5);
function porto_delete_portfolio_cat_meta_values($term_id, $tt_id, $taxonomy, $deleted_term, $object_ids) {
    if ($taxonomy !== 'portfolio_cat') return;
    return porto_delete_tax_meta_values( $term_id, $taxonomy, porto_portfolio_cat_meta_fields() );
}
