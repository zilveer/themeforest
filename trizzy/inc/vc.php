<?php

// Visual Composer related functions to implement it with Trizzy

$icons = ebor_icons_list();


/*
 * Image Captions Box for Visual Composer
 *
 */
add_action( 'init', 'trizzy_image_caption_box_integrateWithVC' );
function trizzy_image_caption_box_integrateWithVC() {
  vc_map( array(
    "name" => __("Image with caption","trizzy"),
    "base" => "vc_image_caption_box",
    'icon' => 'trizzy_icon',
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_templates/css/trizzy_vc_css.css'),
    'description' => __( 'Box with image and CSS animation', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as box title', 'trizzy' ),
        "value" => __("Men's Shirts","trizzy")
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Subtitle', 'trizzy' ),
        'description' => __( 'Shows up on hover', 'trizzy' ),
        'param_name' => 'subtitle',
        "value" => __("25% Off Summer Styles","trizzy")
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'URL', 'trizzy' ),
        'description' => __( 'Where box should link', 'trizzy' ),
        'param_name' => 'url',
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Link target", 'trizzy'),
        "param_name" => "target",
        "value" => array(
         'none' => '',
         '_blank' => '_blank',
         '_parent' => '_parent',
         '_self' => '_self',
         '_top' => '_top',
          ),
        "description" => "How the link should behave"
      ),
      array(
        'type' => 'attach_image',
        'heading' => __( 'Select image for the box', 'trizzy' ),
        'param_name' => 'image',
        'value' => '',
        'description' => __( 'Select image from media library.', 'trizzy' )
        )
      ),
    'js_view' => 'VcImageBoxView'
    ));
}

/*
 * eof Image Captions Box for Visual Composer
 *
 */

/*
 * Headline for Visual Composer
 *
 */
add_action( 'init', 'pp_headline_integrateWithVC' );
function pp_headline_integrateWithVC() {
  vc_map( array(
    "name" => __("Headline","trizzy"),
    "base" => "headline",
    'icon' => 'trizzy_icon',
    'description' => __( 'Header with horizontal line', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'content',
        'description' => __( 'Enter text which will be used as title', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Top margin', 'trizzy' ),
        'param_name' => 'margintop',
        'value' => array(
          '0' => '0',
          '10' => '10',
          '15' => '15',
          '20' => '20',
          '25' => '25',
          '30' => '30',
          '35' => '35',
          '40' => '40',
          '45' => '45',
          '50' => '50',
          ),
        'std' => '15',
        'description' => __( 'Choose top margin (in px)', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Bottom margin', 'trizzy' ),
        'param_name' => 'marginbottom',
        'value' => array(
          '0' => '0',
          '10' => '10',
          '15' => '15',
          '20' => '20',
          '25' => '25',
          '30' => '30',
          '35' => '35',
          '40' => '40',
          '45' => '45',
          '50' => '50',
          ),
        'std' => '35',
        'description' => __( 'Choose bottom margin (in px)', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Clearfix after?', 'trizzy' ),
        'param_name' => 'clearfix',
        'description' => __( 'Add clearfix after headline, you might want to disable it for some elements, like the recent products carousel.', 'trizzy' ),
        'value' => array(
          __( 'Yes, please', 'trizzy' ) => '1',
          __( 'No, thank you', 'trizzy' ) => 'no',
          ),
        'std' => '1',
        ),
      ),
    'js_view' => 'VcTrizzyHeadlineView'
));
}

/*
 * eof Headline for Visual Composer
 *
 */

/*
 * Recent WooCommerce products for Visual Composer
 *
 */
add_action( 'init', 'trizzy_woocommerce_recent_products_integrateWithVC' );
function trizzy_woocommerce_recent_products_integrateWithVC() {
  vc_map( array(
    "name" => __("Recent Products","trizzy"),
    "base" => "trizzy_recent_products",
    'icon' => 'trizzy_icon',
    'description' => __( 'Carousel with products', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'per_page',
        'value' => array(
          '1' => '1',
          '2' => '2',
          '3' => '3',
          '4' => '4',
          '5' => '5',
          '6' => '6',
          '7' => '7',
          '8' => '8',
          '9' => '9',
          '10' => '10',
          '11' => '11',
          '12' => '12',
          ),
        'std' => '6'
        ),

      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Products', 'trizzy' ),
        'param_name' => 'ids',
        'settings' => array(
          'post_type' => 'product',
          ),
        'description' => __( 'Select products, leave empty to use all.', 'trizzy' )
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Products categories', 'trizzy' ),
        'param_name' => 'category',
        'taxonomy' => 'product_cat',
        'description' => __( 'Select categories from which products will be taken.', 'trizzy' )
        ),
      ),

));
}


/*
 * Recent portfolio for Visual Composer
 *
 */
add_action( 'init', 'trizzy_recent_work_integrateWithVC' );
function trizzy_recent_work_integrateWithVC() {
  vc_map( array(
    "name" => __("Recent Portfolio", 'trizzy'),
    "base" => "recent_work",
    'icon' => 'trizzy_icon',
    'description' => __( 'Carousel with portfolio items ', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'per_page',
        'value' => array(
          '4' => '4',
          '5' => '5',
          '6' => '6',
          '7' => '7',
          '8' => '8',
          '9' => '9',
          '10' => '10',
          '11' => '11',
          '12' => '12',
          ),
        'std' => '6'
        ),

      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Potfolio items to Include', 'trizzy' ),
        'param_name' => 'include_posts',
        'settings' => array(
          'post_type' => 'portfolio',
          ),
        'description' => __( 'Select items, leave empty to use all.', 'trizzy' )
        ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Potfolio items to Exclude', 'trizzy' ),
        'param_name' => 'include_posts',
        'settings' => array(
          'post_type' => 'portfolio',
          ),
        'description' => __( 'Select items to exclude from list.', 'trizzy' )
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Portfolio filters', 'trizzy' ),
        'param_name' => 'filters',
        'taxonomy' => 'filters',
        'description' => __( 'Select categories from which portfolio items will be taken.', 'trizzy' )
        ),
      ),

));
}

/*
 * eof  Recent WooCommerce products for Visual Composer
 *
 */

/*
 * Parallax banner for Visual Composer
 *
 */

add_action( 'init', 'trizzy_parallax_integrateWithVC' );
function trizzy_parallax_integrateWithVC() {
  vc_map( array(
    "name" => __("Parallax Banner","trizzy"),
    "base" => "parallax",
    'icon' => 'trizzy_icon',
    'description' => __( 'Parallax banner', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    "params" => array(
      array(
        'type' => 'textarea',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as title.', 'trizzy' ),
        "value" => __("End of season sale ","trizzy")
        ), 
      array(
        'type' => 'textarea',
        'heading' => __( 'URL', 'trizzy' ),
        'param_name' => 'url',
        'description' => __( 'Optional link for the title.', 'trizzy' ),
        "value" => ''
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Link target", 'trizzy'),
        "param_name" => "target",
        "value" => array(
         'none' => '',
         '_blank' => '_blank',
         '_parent' => '_parent',
         '_self' => '_self',
         '_top' => '_top',
          ),
        "description" => "How the link should behave"
      ),
      array(
        'type' => 'textarea',
        'heading' => __( 'Subtitle', 'trizzy' ),
        'param_name' => 'subtitle',
        'description' => __( 'Enter text which will be used as subtitle.', 'trizzy' ),
        "value" => __("Up to 35% off Women’s Denim","trizzy")
        ),
      array(
        'type' => 'attach_image',
        'heading' => __( 'Image', 'trizzy' ),
        'param_name' => 'image',
        'value' => '',
        'description' => __( 'Select image from media library.', 'trizzy' )
        ),
      array(
            'type' => 'colorpicker',
            'heading' => __( 'Background color', 'trizzy' ),
            'param_name' => 'background',
            'value' => '#000',
            'description' => __( 'Select custom background color for parallax.', 'trizzy' ),
            //'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
          ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Opacity', 'trizzy' ),
        'param_name' => 'opacity',
        'value' => array(
          '0.1',
          '0.2',
          '0.3',
          '0.4',
          '0.5',
          '0.6',
          '0.7',
          '0.8',
          '0.9',
          '1',
          ),
        'std' => '0.7'
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Height in px', 'trizzy' ),
        'param_name' => 'height',
        'description' => __( 'Type just a number', 'trizzy' ),
        'value' => 200
      ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      )
    ));
}


/*
 * eof Parallax banner  for Visual Composer
 *
 */

/*
 * WooCommerce Products list for Visual Composer
 *
 */

add_action( 'init', 'trizzy_products_list_integrateWithVC' );
function trizzy_products_list_integrateWithVC() {
  vc_map( array(
    "name" => __("Products vertical list", 'trizzy'),
    "base" => "trizzy_products_list",
    'icon' => 'trizzy_icon',
    'description' => __( 'List of products with thumbnails', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used title.', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Type of list', 'trizzy' ),
        'param_name' => 'type',
        'value' => array(
          __('Best Selling','trizzy') => 'best_selling',
          __('Top Rated','trizzy') => 'top_rated',
          __('Featured','trizzy') => 'featured',
          __('Custom','trizzy') => 'custom',
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'per_page',
        'value' => array(
          '1' => '1',
          '2' => '2',
          '3' => '3',
          '4' => '4',
          '5' => '5',
          '6' => '6',
          '7' => '7',
          '8' => '8',
          '9' => '9',
          '10' => '10',
          '11' => '11',
          '12' => '12',
          ),
        'std' => '3'
        ),
 
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Products', 'trizzy' ),
        'param_name' => 'ids',
        'settings' => array(
          'post_type' => 'product',
          ),
        'description' => __( 'Select products, leave empty to use all.', 'trizzy' )
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Products categories', 'trizzy' ),
        'param_name' => 'category',
        'taxonomy' => 'product_cat',
        'description' => __( 'Select categories to populate posts from. Leave empty to choose from all', 'trizzy' )
        ),
   
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}


/*
 * WooCommerce Products list for Visual Composer
 *
 */

/*
 * Recent blog posts for Visual Composer
 *
 */

add_action( 'init', 'trizzy_recent_blog_integrateWithVC' );
function trizzy_recent_blog_integrateWithVC() {
  vc_map( array(
    "name" => __("Recent blog posts","trizzy"),
    "base" => "latest_from_blog",
    'icon' => 'trizzy_icon',
    'description' => __( 'Recent posts list', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    /*  'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),*/
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'limit',
        'value' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'std' => '4'
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'In how many columns will be post displayed', 'trizzy' ),
        'param_name' => 'columns',
        'value' => array('2','3','4'),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Masonry mode', 'trizzy' ),
        'param_name' => 'masonry',
        'value' => array(
          __( 'Disable', 'trizzy' ) => 'no',
          __( 'Enable', 'trizzy' ) => 'yes'
          ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
        array(
        'type' => 'textfield',
        'heading' => __( 'Number of words from content to show below thumbnail', 'trizzy' ),
        'param_name' => 'limit_words',
        'description' => __( 'Type just a number', 'trizzy' ),
        'value' => 10
      ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Exclude posts, leave empty to not exclude anything', 'trizzy' ),
        'param_name' => 'exclude_posts',
        'settings' => array(
          'post_type' => 'post',
          ),
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Show only this categories', 'trizzy' ),
        'param_name' => 'categories',
        'taxonomy' => 'category',
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Show only this tags', 'trizzy' ),
        'param_name' => 'tags',
        'taxonomy' => 'post_tag',
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
  ));
}

/*
 * Recent blog posts for Visual Composer
 *
 */

 /*
 * Recent blog posts carousel for Visual Composer
 *
 */

add_action( 'init', 'trizzy_recent_blog_carousel_integrateWithVC' );
function trizzy_recent_blog_carousel_integrateWithVC() {
  vc_map( array(
    "name" => __("Recent blog posts - carousel","trizzy"),
    "base" => "latest_from_blog_carousel",
    'icon' => 'trizzy_icon',
    'description' => __( 'Recent posts list', 'trizzy' ),
    "category" => __('Trizzy',"trizzy"),
    /*  'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),*/
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'limit',
        'value' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'std' => '4'
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'In how many columns will be post displayed', 'trizzy' ),
        'param_name' => 'columns',
        'value' => array('2','3','4'),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
        array(
        'type' => 'textfield',
        'heading' => __( 'Number of words from content to show below thumbnail', 'trizzy' ),
        'param_name' => 'limit_words',
        'description' => __( 'Type just a number', 'trizzy' ),
        'value' => 10
      ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Exclude posts, leave empty to not exclude anything', 'trizzy' ),
        'param_name' => 'exclude_posts',
        'settings' => array(
          'post_type' => 'post',
          ),
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Show only this categories', 'trizzy' ),
        'param_name' => 'categories',
        'taxonomy' => 'category',
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Show only this tags', 'trizzy' ),
        'param_name' => 'tags',
        'taxonomy' => 'post_tag',
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
  ));
}

/*
 * Recent blog posts for Visual Composer
 *
 */

/*
 * Skillbars for Visual Composer
 *
 */

add_action( 'init', 'skillbar_integrateWithVC' );
function skillbar_integrateWithVC() {
  vc_map( array(
    "name" => __("Skills Box", "trizzy"),
    "base" => "skillbars",
    'icon' => 'trizzy_icon',
    "as_parent" => array('only' => 'skillbar'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "category" => __('Trizzy',"trizzy"),
    "show_settings_on_create" => false,
    "params" => array(
        // add params same as with any other content element
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "trizzy"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "trizzy")
        )
      ),
    "js_view" => 'VcColumnView'
    ));

  vc_map( array(
    "name" => __("Skill bar", "trizzy"),
    "base" => "skillbar",
    'icon' => 'trizzy_icon',
    "content_element" => true,
    "as_child" => array('only' => 'skillbars'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as title.', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Skill Level', 'trizzy' ),
        'param_name' => 'value',
        'value' => array('0','5','10','15','20','25','30','35','40','45','50','55','60','65','70','75','80','85','90','95','100'),
        'std' => '90'
        ),

      ),
    ));
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Skillbars extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Skillbar extends WPBakeryShortCode {
  }
}

/*
 * eof Skillbars for Visual Composer
 *
 */



/*
 * Social Icons for Visual Composer
 *
 */

add_action( 'init', 'socialicons_integrateWithVC' );
function socialicons_integrateWithVC() {
  vc_map( array(
    "name" => __("Social Icons", "trizzy"),
    "base" => "pt_social_icons",
    "as_parent" => array('only' => 'pt_social_icon'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "category" => __('Trizzy', 'trizzy'),
    'icon' => 'trizzy_icon',
    "show_settings_on_create" => false,
    "params" => array(
        // add params same as with any other content element
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "trizzy"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "trizzy")
        )
      ),
    "js_view" => 'VcColumnView'
    ));

  vc_map( array(
    "name" => __("Social icon","trizzy"),
    "base" => "pt_social_icon",
    'icon' => 'trizzy_icon',
    "content_element" => true,
    "as_child" => array('only' => 'pt_social_icons'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'URL', 'trizzy' ),
        'param_name' => 'url',
        'description' => __( 'Where icon will link.', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Social service', 'trizzy' ),
        'param_name' => 'service',
        'value' => array(
            'Twitter' => "twitter",
            'WordPress'=>  "wordpress",
            'Facebook'=> "facebook",
            'LinkedIn'=> "linkedin",
            'Steam'=> "steam",
            'Tumblr'=> "tumblr",
            'GitHub'=> "github",
            'Delicious'=> "delicious",
            'Instagram'=> "instagram",
            'Xing'=> "xing",
            'Amazon'=> "amazon",
            'Dropbox'=> "dropbox",
            'PayPal'=> "paypal",
            'LastFM'=> "lastfm",
            'Google+'=> "gplus",
            'Yahoo'=> "yahoo",
            'Pinterest'=> "pinterest",
            'Dribbble'=> "dribbble",
            'Flickr'=> "flickr",
            'Reddit'=> "reddit",
            'Vimeo'=> "vimeo",
            'Spotify'=> "spotify",
            'RSS'=> "rss",
            'YouTube'=> 'youtube',
            'Blogger'=> 'blogger',
            'AppStore'=> 'appstore',
            'Digg'=> 'digg',
            'Evernote'=> 'evernote',
            '500px'=> 'fivehundredpx',
            'Forrst'=> 'forrst',
            'StumbleUpon'=> 'stumbleupon',
        ),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon size', 'trizzy' ),
        'param_name' => 'service',
        'value' => array(
            'Standard' => 'standard',
            'Small' => 'small'
        ),
      ),
     ),
  ));
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Pt_social_icons extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Pt_social_icon extends WPBakeryShortCode {
  }
}

/*
 * eof Social Icons for Visual Composer
 *
 */

/*
 * Counter for Visual Composer
 *
 */

add_action( 'init', 'trizzy_counterbox_integrateWithVC' );
function trizzy_counterbox_integrateWithVC() {

  $icons = ebor_icons_list();
  vc_map( array(
    "name" => __("Count up box", 'trizzy'),
    "base" => "counterbox",
    'icon' => 'trizzy_icon',
    'description' => __( 'Box with animated number\'s counting', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as title.', 'trizzy' )
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Icon", 'trizzy'),
        "param_name" => "icon",
        "value" => $icons,
        "description" => "Choose icon"
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Value', 'trizzy' ),
        'param_name' => 'value',
        'description' => __( 'Only number (for example 2,147).', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Colored box?', 'trizzy' ),
        'param_name' => 'colored',
        'description' => __( 'If selected to "yes", box will be in current main color.', 'trizzy' ),
        'value' => array(
          __( 'No, thank you', 'trizzy' ) => 'no',
          __( 'Yes, please', 'trizzy' ) => 'yes'
          )
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}


/*
 * eof Counter for Visual Composer
 *
 */

/*
 * Team section for Visual Composer
 *
 */

add_action( 'init', 'trizzy_team_integrateWithVC' );
function trizzy_team_integrateWithVC() {
  vc_map( array(
    "name" => __("Team section", 'trizzy'),
    "base" => "team",
    'icon' => 'trizzy_icon',
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'limit',
        'value' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'std' => '3'
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'In how many columns elements will be displayed', 'trizzy' ),
        'param_name' => 'columns',
        'value' => array('2','3','4'),
        ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Include this members', 'trizzy' ),
        'param_name' => 'members',
        'settings' => array(
          'post_type' => 'team',
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Link to single member page?', 'trizzy' ),
        'param_name' => 'link_to_pages',
        'description' => __( 'If selected, image will link to the single team.', 'trizzy' ),
        'value' => array(
          __( 'No, thank you', 'trizzy' ) => 'no',
          __( 'Yes, please', 'trizzy' ) => 'yes'
          )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}

/*
 * eof Team section for Visual Composer
 *
 */


/*
 * Icon Box for Visual Composer
 *
 */


add_action( 'init', 'trizzy_iconbox_integrateWithVC' );
function trizzy_iconbox_integrateWithVC() {

  $icons = ebor_icons_list();
  vc_map( array(
    "name" => __("Icon box", 'trizzy'),
    "base" => "iconbox",
    'icon' => 'trizzy_icon',
    'description' => __( 'Text box with icon', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as title.', 'trizzy' )
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Icon", 'trizzy'),
        "param_name" => "icon",
        "value" => $icons,
        "description" => ""
        ),
      array(
        'type' => 'textarea_html',
        'heading' => __( 'Content', 'trizzy' ),
        'param_name' => 'content',
        'description' => __( 'Enter content of the box.', 'trizzy' )
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'URL', 'trizzy' ),
        'param_name' => 'link',
        'description' => __( 'Where should it link?.', 'trizzy' )
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Link target", 'trizzy'),
        "param_name" => "target",
        "value" => array(
         'none' => '',
         '_blank' => '_blank',
         '_parent' => '_parent',
         '_self' => '_self',
         '_top' => '_top',
          ),
        "description" => "How the link should behave"
    ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}
/*
 * eof Icon Box for Visual Composer
 *
 */


/*
 * Banner Box for Visual Composer
 *
 */


add_action( 'init', 'trizzy_banner_integrateWithVC' );
function trizzy_banner_integrateWithVC() {

  $icons = ebor_icons_list();
  vc_map( array(
    "name" => __("Text banner box", 'trizzy'),
    "base" => "infobanner",
    'icon' => 'trizzy_icon',
    'description' => __( 'Call to action banner box', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    /*  'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),*/
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'trizzy' )
        ),
      array(
        'type' => 'textarea_html',
        'heading' => __( 'Content', 'trizzy' ),
        'param_name' => 'content',
        'description' => __( 'Enter content of the box.', 'trizzy' )
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Button text', 'trizzy' ),
        'param_name' => 'buttontext',
        'description' => __( 'Text on the button on the right side of banner', 'trizzy' )
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'URL', 'trizzy' ),
        'param_name' => 'url',
        'description' => __( 'Where button links.', 'trizzy' )
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Link target", 'trizzy'),
        "param_name" => "target",
        "value" => array(
         'none' => '',
         '_blank' => '_blank',
         '_parent' => '_parent',
         '_self' => '_self',
         '_top' => '_top',
          ),
        "description" => "How the link should behave"
    ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}
/*
 * eof Icon Box for Visual Composer
 *
 */

/*
 * Clients Carousel Visual Composer
 *
 */


add_action( 'init', 'clients_carousel_integrateWithVC' );
function clients_carousel_integrateWithVC() {

  vc_map( array(
    "name" => __("Client logos carousel", 'trizzy'),
    "base" => "vc_clients_carousel",
    'icon' => 'trizzy_icon',
    'description' => __( 'Carousel with logos', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
     array(
      'type' => 'attach_images',
      'heading' => __( 'Clients logos', 'trizzy' ),
      'param_name' => 'logos',
      'value' => '',
      'description' => __( 'Select images from media library.', 'trizzy' )
      ),
     array(
      'type' => 'from_vs_indicatior',
      'heading' => __( 'From Visual Composer', 'trizzy' ),
      'param_name' => 'from_vs',
      'value' => 'yes',
      'save_always' => true,
      )
     ),
    ));
}

/*
 * eof Clients Carousel Visual Composer
 *
 */

/*
 * Content Box Visual Composer
 *
 */

add_action( 'init', 'contentbox_integrateWithVC' );
function contentbox_integrateWithVC() {
 $icons = ebor_icons_list();
 vc_map( array(
  "name" => __("Content box", 'trizzy'),
  "base" => "contentbox",
  'icon' => 'trizzy_icon',
  'description' => __( 'Animated content box', 'trizzy' ),
  "category" => __('Trizzy', 'trizzy'),
  "params" => array(
    array(
      'type' => 'textfield',
      'heading' => __( 'Title', 'trizzy' ),
      'param_name' => 'title',
      'description' => __( 'Enter text which will be used as title.', 'trizzy' )
      ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => __("Icon", 'trizzy'),
      "param_name" => "icon",
      "value" => $icons,
      "description" => ""
      ),
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'trizzy' ),
      'param_name' => 'content',
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'URL of the box', 'trizzy' ),
      'param_name' => 'link',
      'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'trizzy' )
      ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Link target", 'trizzy'),
        "param_name" => "target",
        "value" => array(
         'none' => '',
         '_blank' => '_blank',
         '_parent' => '_parent',
         '_self' => '_self',
         '_top' => '_top',
          ),
        "description" => "How the link should behave"
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => __("Animation effect", 'trizzy'),
      "param_name" => "effect",
      "value" => array(
        'Style 1' => '1',
        'Style 2' => '2',
        'Style 3' => '3',
        'Style 4' => '4',
        ),
      "description" => "How icon will be animated on hover"
      ),

     array(
      'type' => 'from_vs_indicatior',
      'heading' => __( 'From Visual Composer', 'trizzy' ),
      'param_name' => 'from_vs',
      'value' => 'yes',
      'save_always' => true,
      )
    ),
));
}

/*
 * eof Content Box Visual Composer
 *
 */


/*
 * Notification Box Visual Composer
 *
 */

add_action( 'init', 'trizzy_box_integrateWithVC' );
function trizzy_box_integrateWithVC() {
 $icons = ebor_icons_list();
 vc_map( array(
  "name" => __("Notification box", 'trizzy'),
  "base" => "box",
  'icon' => 'trizzy_icon',
  "category" => __('Trizzy', 'trizzy'),
  "params" => array(
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'trizzy' ),
      'param_name' => 'content',
      'description' => __( 'Enter message content.', 'trizzy' )
      ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => __("Box type", 'trizzy'),
      "param_name" => "type",
      "value" => array(
        'Error' => 'error',
        'Success' => 'success',
        'Warning' => 'warning',
        'Notice' => 'notice',
        ),
      "description" => ""
      )

    ),
/*    'custom_markup' => 'Type: %content% co to kurwa jest',
    'js_view' => 'VcTrizzyMessageView'*/
));
}

/*
 * eof Notification Box Visual Composer
 *
 */

 /*
 * Testimonials Block Visual Composer
 *
 */

add_action( 'init', 'trizzy_happytestimonials_integrateWithVC' );
function trizzy_happytestimonials_integrateWithVC() {
  vc_map( array(
    "name" => __("Testimonials", 'trizzy'),
    "base" => "happytestimonials",
    'icon' => 'trizzy_icon',
    'description' => __( 'List of testimonials', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'trizzy' ),
        'param_name' => 'limit',
        'value' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        ),

      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'trizzy' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'trizzy' ) => 'date',
          __( 'ID', 'trizzy' ) => 'ID',
          __( 'Author', 'trizzy' ) => 'author',
          __( 'Title', 'trizzy' ) => 'title',
          __( 'Modified', 'trizzy' ) => 'modified',
          __( 'Random', 'trizzy' ) => 'rand',
          __( 'Comment count', 'trizzy' ) => 'comment_count',
          __( 'Menu order', 'trizzy' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'trizzy' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'trizzy' ) => 'DESC',
          __( 'Ascending', 'trizzy' ) => 'ASC'
          ),
        ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Include this testimonials', 'trizzy' ),
        'param_name' => 'include_posts',
        'settings' => array(
          'post_type' => 'testimonial',
          ),
        ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Exclude this testimonials', 'trizzy' ),
        'param_name' => 'exclude_posts',
        'settings' => array(
          'post_type' => 'testimonial',
          ),
        ),

      ),
));
}


/*
 * WooCommerce Products list for Visual Composer
 *
 */

add_action( 'init', 'trizzy_pricing_table_integrateWithVC' );
function trizzy_pricing_table_integrateWithVC() {
  vc_map( array(
    "name" => __("Pricing table", 'trizzy'),
    "base" => "pricing_table",
    'icon' => 'trizzy_icon',
    'description' => __( 'Pricing table', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
    array(
        'type' => 'dropdown',
        'heading' => __( 'Type of table', 'trizzy' ),
        'param_name' => 'type',
        'value' => array(
          __('Standard','trizzy') => 'standard',
          __('Featured','trizzy') => 'featured',
          ),
        ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Custom color', 'trizzy' ),
      'param_name' => 'color',
      'description' => __( 'Select custom background color for table.', 'trizzy' ),
      //'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Title', 'trizzy' ),
      'param_name' => 'title',
      'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'trizzy' )
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Currency', 'trizzy' ),
      'param_name' => 'currency',
      'value' => '$',
      'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'trizzy' )
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Price', 'trizzy' ),
      'param_name' => 'price',
      'value' => '30',
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Per', 'trizzy' ),
      'param_name' => 'per',
      'value' => 'per month',
      ),
      array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'trizzy' ),
      'param_name' => 'content',
      'description' => __( 'Put here simple UL list', 'trizzy' )
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Button URL', 'trizzy' ),
      'param_name' => 'buttonlink',
      'value' => ''
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Button text', 'trizzy' ),
      'param_name' => 'buttontext',
      'value' => ''
      ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}


/*
 * WooCommerce Products list for Visual Composer
 *
 */



 /*
 * Button Block Visual Composer
 *
 */

add_action( 'init', 'trizzy_button_integrateWithVC' );
function trizzy_button_integrateWithVC() {
  $icons = ebor_icons_list();
  vc_map( array(
    "name" => __("Button", 'trizzy'),
    "base" => "button",
    'icon' => 'trizzy_icon',
    'description' => __( 'Just a button', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
        array(
          'type' => 'vc_link',
          'heading' => __( 'URL (Link)', 'trizzy' ),
          'param_name' => 'url',
          'description' => __( 'Button link.', 'trizzy' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Button color version', 'trizzy' ),
        'param_name' => 'color',
        'value' => array(
          __( 'Current main color', 'trizzy' ) => 'color',
          __( 'Gray', 'trizzy' ) => 'gray',
          __( 'Dark', 'trizzy' ) => 'dark',
          ),
        ),
      array(
        'type' => 'colorpicker',
        'heading' => __( 'Custom color', 'trizzy' ),
        'param_name' => 'colorpicker',
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon color', 'trizzy' ),
        'param_name' => 'color',
        'value' => array(
          __( 'White', 'trizzy' ) => 'white',
          __( 'Black', 'trizzy' ) => 'black',
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon', 'trizzy' ),
        'param_name' => 'icon',
        'value' => $icons,
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Custom class', 'trizzy' ),
        'param_name' => 'customclass',
        'description' =>  __( 'Optional', 'trizzy' ),
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}

 /*
 * Popup Block Visual Composer
 *
 */

add_action( 'init', 'trizzy_popup_integrateWithVC' );
function trizzy_popup_integrateWithVC() {
  $icons = ebor_icons_list();
  vc_map( array(
    "name" => __("Popup", 'trizzy'),
    "base" => "popup",
    'icon' => 'trizzy_icon',
    'description' => __( 'Modal Box', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(

      array(
        'type' => 'textfield',
        'heading' => __( 'Text on button', 'trizzy' ),
        'param_name' => 'buttontext',
        'description' =>  __( 'Button that opens popup', 'trizzy' ),
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'trizzy' ),
        'param_name' => 'title',
        'description' =>  __( 'Title for content', 'trizzy' ),
        ),
      array(
        'type' => 'textarea',
        'heading' => __( 'Content', 'trizzy' ),
        'param_name' => 'content',
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'trizzy' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}


add_action( 'init', 'trizzy_royalgallery_integrateWithVC' );
function trizzy_royalgallery_integrateWithVC() {
  vc_map( array(
    "name" => __("Royal Slider Gallery ", 'trizzy'),
    "base" => "vc_trizzy_royal_slider",
    'icon' => 'trizzy_icon',
    'description' => __( 'Simple Image Gallery', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(

      array(
        'type' => 'attach_images',
        'heading' => __( 'Select images', 'trizzy' ),
        'param_name' => 'images',

        ),
      ),
));
}

add_action( 'init', 'trizzy_magazine_lead_integrateWithVC' );
function trizzy_magazine_lead_integrateWithVC() {
  vc_map( array(
    "name" => __("Magazine Lead ", 'trizzy'),
    "base" => "magazine_lead",
    'icon' => 'trizzy_icon',
    'description' => __( 'Lead of Featured post and side post for magazine style page', 'trizzy' ),
    "category" => __('Trizzy', 'trizzy'),
    "params" => array(
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Select ONLY ONE post for a Featured post', 'trizzy' ),
        'param_name' => 'leadpost',
        'settings' => array(
          'post_type' => 'post',
        ),
      ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Set 2 posts for a Featured side posts', 'trizzy' ),
        'param_name' => 'sideposts',
        'settings' => array(
          'post_type' => 'post',
        ),
      ),

      ),
));
}




/*
function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {

 if ($tag=='vc_row' || $tag=='vc_row_inner') {
    $class_string = str_replace('vc_row-fluid', 'my_row-fluid', $class_string);
  }
  if ($tag=='vc_column' || $tag=='vc_column_inner') {
    $width_value = filter_var($class_string, FILTER_SANITIZE_NUMBER_INT);
    echo $width_value;
    $class_string = preg_replace('/vc_span(\d{1,2})/', 'my_span$1', $class_string);
  }
  return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);*/


/*
New parameters type:
*/

function custom_posts_list_settings_field($settings, $value) {

  $dependency = vc_generate_dependencies_attributes($settings);
  /* setup the post types */
  $post_type = $settings['settings']['post_type'];

  /* query posts array */
  $my_posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'any' ) );
  $value_arr = $value;
  if ( !is_array($value_arr) ) {
    $value_arr = array_map( 'trim', explode(',', $value_arr) );
  }

  $output = '';
  if ( is_array( $my_posts ) && ! empty( $my_posts ) ) {
    foreach( $my_posts as $my_post ) {
      $post_title = '' != $my_post->post_title ? $my_post->post_title : 'Untitled';

      $output .= '<p>';
      $output .= '<input id="'.$settings['param_name'] . '-' . $my_post->ID.'" class="'. $settings['param_name'].' '.$settings['type'].'" type="checkbox" name="'.$settings['param_name'].'" value="'. $my_post->ID.'" '.checked( in_array( $my_post->ID, $value_arr ), true, false ).' />';
      $output .= '<label for="' . $settings['param_name'] . '-' . esc_attr( $my_post->ID ) . '">' . $my_post->post_title . '</label>';
      $output .= '</p>';
    }
  } else {
   $output .= '<p>' . __( 'No Posts Found', 'option-tree' ) . '</p>';
 }

 return '<div class="custom_posts_list_block">'
 .'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" '.$dependency.' />'
 .'<div class="custom_posts_list_items">'.$output.'</div></div>';
}


function custom_taxonomy_list_settings_field($settings, $value) {

  $dependency = vc_generate_dependencies_attributes($settings);
  /* setup the post types */
  $taxname = $settings['taxonomy'];
  $value_arr = $value;
  if ( !is_array($value_arr) ) {
    $value_arr = array_map( 'trim', explode(',', $value_arr) );
  }
  $output = '';
  /* query posts array */
  $terms = get_terms( $taxname );
  if ( $terms && !is_wp_error($terms) ) {
    foreach( $terms as $term ) {

      $output .= '<p>';
      $output .= '<input id="'.$settings['param_name'] . '-' . $term->slug.'" class="'. $settings['param_name'].' '.$settings['type'].'" type="checkbox" name="'.$settings['param_name'].'" value="'. $term->slug.'" '.checked( in_array( $term->slug, $value_arr ), true, false ).' />';
      $output .= '<label for="' . $settings['param_name'] . '-' . esc_attr( $term->slug ) . '">' . $term->name . '</label>';
      $output .= '</p>';
    }
  } else {
   $output .= '<p>' . __( 'Nothing Found', 'option-tree' ) . '</p>';
 }
 return '
 <div class="custom_taxonomy_list_block">
   <input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" '.$dependency.' />
   <div class="custom_taxonomy_list_items">'.$output.'</div>
 </div>';
}

function from_vs_indicatior_settings_field($settings, $value) {
  $dependency = vc_generate_dependencies_attributes($settings);
  return '<div class="from_vs_indicatior_block" >'
  .'<input type="hidden" name="from_vs" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="yes" '.$dependency.' /></div>';
}

vc_add_shortcode_param('from_vs_indicatior', 'from_vs_indicatior_settings_field');
vc_add_shortcode_param('custom_taxonomy_list', 'custom_taxonomy_list_settings_field', get_template_directory_uri() . '/vc_templates/js/vc_trizzy_vc_scripts.js');
vc_add_shortcode_param('custom_posts_list', 'custom_posts_list_settings_field', get_template_directory_uri() . '/vc_templates/js/vc_trizzy_vc_scripts.js');


/* Custom parameters */

vc_add_param("vc_accordion_tab", array(
  "type" => "dropdown",
  "class" => "",
  "heading" => __("Icon", 'trizzy'),
  "param_name" => "icon",
  "value" => $icons,
  "description" => ""
  ));

vc_remove_element("vc_gallery");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_images_carousel");
  ?>
