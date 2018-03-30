<?php
//include the main class file
require_once ( mango_plugins . "/taxonomy_meta_class/Tax-meta-class.php" );
class Tax_Meta_Validate{
    function mango_validate_url ( $url ) {
        // must start with http:// or https://
        if ( 0 !== strpos ( $url, 'http://' ) && 0 !== strpos ( $url, 'https://' ) ) {
            return '';
        }
        // must pass validation
        if ( !filter_var ( $url, FILTER_VALIDATE_URL ) ) {
            return '';
        }
        return $url;
    }
}

if ( is_admin () ) {
    /*
     * prefix of meta keys, optional
     */
    $prefix = 'mango_';
    /*
     * configure your meta box
     */

    $config = array (
        'id' => 'mango_meta_box',          // meta box id, unique per meta box
        'title' => 'Mango Meta Box',       // meta box title
        'context' => 'advanced',
        'pages' => array ( "product_cat", "product_tag" ),  // where the meta box appear: normal (default), advanced, side; optional
        'fields' => array (),              // list of meta fields (can be added by field arrays)
        'local_images' => false,           // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => mango_uri . '/inc/plugins/taxonomy_meta_class',       //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );
    $mango_product_meta = new Tax_Meta_Class( $config );
    $mango_product_meta->addSelect ( $prefix . 'product_cat_columns',
        array (
            '' => __ ( 'Default', 'mango' ),
            '1' => "1",
            '2' => "2",
            '3' => "3",
            '4' => "4",
            '5' => "5",
            '6' => "6",
        ),
        array (
            'name' => __ ( 'Product Columns', 'mango' ),
        )
    );
    $mango_product_meta->addSelect ( $prefix . 'product_cat_view',
        array (
            '' => __ ( 'Default', 'mango' ),
            'v_1' => __ ( "Grid Style 1", 'mango' ),
            'v_2' => __ ( "Grid Style 2", 'mango' ),
            'v_3' => __ ( "Grid Style 3", 'mango' ),
            'v_4' => __ ( "Grid Style 4", 'mango' ),
            'list' => __ ( "List", 'mango' ),
            'list_right' => __ ( "List Right Aligned", 'mango' ),
        ),
        array (
            'name' => __ ( 'Product Page Style', 'mango' ),
        )
    );
    $config2 = array (
        'id' => 'mango_meta_box',          // meta box id, unique per meta box
        'title' => 'Mango Meta Box',       // meta box title
        'context' => 'advanced',
        'pages' => array ( 'category', 'post_tag', 'product_cat', 'product_tag', 'portfolio-category', 'faq-category' ),  // where the meta box appear: normal (default), advanced, side; optional
        'fields' => array (),              // list of meta fields (can be added by field arrays)
        'local_images' => false,           // Use local or hosted images (meta box images for add/remove)
        'use_with_theme' => mango_uri . '/inc/plugins/taxonomy_meta_class',       //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
    );

   // $config[ 'page' ] = ;        // taxonomy name, accept categories, post_tag and custom taxonomies
    /*
     * Initiate your meta box
     */
    $mango_meta = new Tax_Meta_Class( $config2 );
    /*
     * Add fields to your meta box
     */
    //radio field
    $mango_meta->addRadio ( $prefix . 'taxonomy_layout',
        array (
            'default' => __ ( 'Default Layout', 'mango' ),
            'left' => __ ( 'Left Sidebar', 'mango' ),
            'right' => __ ( 'Right Sidebar', 'mango' ),
            'both' => __ ( 'Both Sidebar', 'mango' ),
            'no' => __ ( 'Full Width', 'mango' )
        ),
        array (
            'name' => __ ( 'Page Layout', 'mango' ),
            'std' => array ( 'default' )
        )
    );

    $wp_registered_sidebar = wp_get_sidebars_widgets ();
    $mango_sidebar[] = __("Default",'mango');
    foreach ( $wp_registered_sidebar as $sidebar => $sidebar_info ) {
        if ( $sidebar == 'wp_inactive_widgets' ) continue;
        $mango_sidebar[ $sidebar ] = ucwords ( str_replace ( array ( '_', '-' ), ' ', $sidebar ) );
    }
    $mango_meta->addSelect ( $prefix . 'taxonomy_left_sidebar',
        $mango_sidebar,
        array (
            'name' => __ ( 'Left Sidebar', 'mango' ),
           // 'desc' => __ ( 'Keep Empty to use Default Sidebar', 'mango' )
        )
    );
    $mango_meta->addSelect ( $prefix . 'taxonomy_right_sidebar',
        $mango_sidebar,
        array (
            'name' => __ ( 'Right Sidebar', 'mango' ),
            //'desc' => __ ( 'Keep Empty to use Default Sidebar', 'mango' )
        )
    );
    $mango_meta->addRadio ( $prefix . 'taxonomy_banner_type',
        array (
            '' => __ ( 'No Banner', 'mango' ),
            'image' => __ ( 'Image', 'mango' ),
            'video' => __ ( 'Video', 'mango' ),
            'rev_slider' => __ ( 'Revolution Slider', 'mango' ),
            'custom_banner' => __ ( 'Custom Banner', 'mango' ),
        ),
        array (
            'name' => __ ( 'Banner Type', 'mango' ),
            'std' => array ( '' )
        )
    );
    //Image field
    $mango_meta->addImage($prefix.'taxonomy_banner_image',
        array(
            'name'  => __('Banner Image ','mango'),
            'desc'  => __ ( 'Only useful when the banner type is Image', 'mango' ),
            'height'=>  '400px'
        )
    );
    //text field
    $mango_meta->addText($prefix.'taxonomy_banner_video',
        array(
            'name'=>  __('Banner video URL','mango'),
            'validate_func' => "mango_validate_url",
            'style' => 'width: 100% !important;',
            'desc' => __('Only useful when the banner type is Video. Add a valid flash video url like: youtube, vimeo, dailymotion etc. If you put an invalid url the data will not be saved.','mango')
        )
    );
    $mango_meta->addSelect($prefix.'taxonomy_banner_rev_slider',
        mango_get_rev_sliders(),
        array(
            'name'=>  __('Banner Revolution Slider','mango'),
            'desc' => __('Only useful when the banner type is Revolution Slider.','mango')
        )
    );
    //wysiwyg field
    $mango_meta->addWysiwyg($prefix.'taxonomy_banner_custom',
        array(
            'name'=> __('Custom Banner','mango'),
            'desc' => __("Add custom banner from this editor",'mango')
        )
    );
    /* Don't Forget to Close up the meta box decleration
     */
    //Finish Meta Box Decleration
    $mango_meta->Finish ();
    $mango_product_meta->Finish ();
}