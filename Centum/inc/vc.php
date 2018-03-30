<?php

// Visual Composer related functions to implement it with Centum

$icons = centum_icons_list();

add_action( 'init', 'centum_royalgallery_integrateWithVC' );
function centum_royalgallery_integrateWithVC() {
  vc_map( array(
    "name" => __("Royal Slider Gallery ", 'centum'),
    "base" => "vc_centum_royal_slider",
     'admin_enqueue_css' => array(get_template_directory_uri().'/vc_templates/css/trizzy_vc_css.css'),
    'admin_enqueue_js' => array(get_template_directory_uri().'/vc_templates/js/vc_image_caption_box.js'),
    'icon' => 'centum_icon',
    'description' => __( 'Simple Image Gallery', 'centum' ),
    "category" => __('Centum', 'centum'),
    "params" => array(

      array(
        'type' => 'attach_images',
        'heading' => __( 'Select images', 'centum' ),
        'param_name' => 'images',
        'value' => '',
        ),
      ),
));
}


 /*
 * Button Block Visual Composer
 *
 */


add_action( 'init', 'centum_button_integrateWithVC' );
function centum_button_integrateWithVC() {
  $icons = centum_icons_list();
  vc_map( array(
    "name" => __("Button", 'centum'),
    "base" => "button",
    'icon' => 'centum_icon',
    'description' => __( 'Just a button', 'centum' ),
    "category" => __('Centum', 'centum'),
    "params" => array(
        array(
          'type' => 'vc_link',
          'heading' => __( 'URL (Link)', 'centum' ),
          'param_name' => 'url',
          'description' => __( 'Button link.', 'centum' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Button color version', 'centum' ),
        'param_name' => 'color',
        'value' => array(
          __( 'Current main color', 'centum' ) => 'color',
          __( 'Gray', 'centum' ) => 'gray',
          __( 'Dark', 'centum' ) => 'dark',
          ),
        ),
      array(
        'type' => 'colorpicker',
        'heading' => __( 'Custom color', 'centum' ),
        'param_name' => 'customcolor',
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon color', 'centum' ),
        'param_name' => 'iconcolor',
        'value' => array(
          __( 'White', 'centum' ) => 'white',
          __( 'Black', 'centum' ) => 'black',
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Icon', 'centum' ),
        'param_name' => 'icon',
        'value' => $icons,
        ),
       array(
        'type' => 'dropdown',
        'heading' => __( 'Icon color', 'centum' ),
        'param_name' => 'iconcolor',
        'value' => array(
          __( 'White', 'centum' ) => 'white',
          __( 'Black', 'centum' ) => 'black',
          ),
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Custom class', 'centum' ),
        'param_name' => 'customclass',
        'description' =>  __( 'Optional', 'centum' ),
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'centum' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}



/*
 * Notification Box Visual Composer
 *
 */

add_action( 'init', 'centum_box_integrateWithVC' );
function centum_box_integrateWithVC() {
 
 vc_map( array(
  "name" => __("Notification box", 'centum'),
  "base" => "box",
  'icon' => 'centum_icon',
  "category" => __('Centum', 'centum'),
  "params" => array(
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'centum' ),
      'param_name' => 'content',
      'description' => __( 'Enter message content.', 'centum' )
      ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => __("Box type", 'centum'),
      "param_name" => "type",
      "value" => array(
        'Error' => 'error',
        'Success' => 'success',
        'Warning' => 'warning',
        'Notice' => 'notice',
        ),
      "description" => "",
      'save_always' => true,
      )

    ),

));
}

/*
 * Notice Box Visual Composer
 *
 */

add_action( 'init', 'centum_notice_integrateWithVC' );
function centum_notice_integrateWithVC() {
 
 vc_map( array(
  "name" => __("Notice box", 'centum'),
  "base" => "notice",
  'icon' => 'centum_icon',
  "category" => __('Centum', 'centum'),
  "params" => array(
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'centum' ),
      'param_name' => 'content',
      'description' => __( 'Enter message content.', 'centum' )
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Title', 'centum' ),
      'param_name' => 'title',
      'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'centum' )
      ),

    ),

));
}

add_action( 'init', 'centum_purelist_integrateWithVC' );
function centum_purelist_integrateWithVC() {
 
 vc_map( array(
  "name" => __("List with icons", 'centum'),
  "base" => "list",
  'icon' => 'centum_icon',
  "category" => __('Centum', 'centum'),
  "params" => array(
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'centum' ),
      'param_name' => 'content',
      'description' => __( 'Enter message content.', 'centum' )
      ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => __("List type", 'centum'),
      "param_name" => "type",
      "value" => array(
        'Check' => 'list-1',
        'Arrow' => 'list-2',
        'Check with background' => 'list-3',
        'Arrow with background' => 'list-4',
        ),
      "description" => "",
      'save_always' => true,
      )

    ),

));
}


/*
 * Headline for Visual Composer
 *
 */
add_action( 'init', 'pp_headline_integrateWithVC' );
function pp_headline_integrateWithVC() {
  vc_map( array(
    "name" => __("Headline","centum"),
    "base" => "headline",
    'icon' => 'centum_icon',
    'description' => __( 'Header with horizontal line', 'centum' ),
    'admin_enqueue_js' => array(get_template_directory_uri().'/vc_templates/js/vc_image_caption_box.js'),
    "category" => __('Centum',"centum"),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'centum' ),
        'param_name' => 'content',
        'description' => __( 'Enter text which will be used as title', 'centum' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Top margin', 'centum' ),
        'param_name' => 'margintop',
        'value' => array(
          'No margin' => 'no-margin',
          'Low margin' => 'low-margin',
          ),
        'std' => '15',
        'description' => __( 'Choose top margin size', 'centum' )
        ),
      ),
    'js_view' => 'VcCentumHeadlineView'
));
}


/*
 * Recent portfolio for Visual Composer
 *
 */
add_action( 'init', 'centum_recent_work_integrateWithVC' );
function centum_recent_work_integrateWithVC() {
  vc_map( array(
    "name" => __("Recent Portfolio", 'centum'),
    "base" => "recent_pf",
    'icon' => 'centum_icon',
    'description' => __( 'List with portfolio items ', 'centum' ),
    "category" => __('Centum',"centum"),
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'centum' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'centum' ) => 'date',
          __( 'ID', 'centum' ) => 'ID',
          __( 'Author', 'centum' ) => 'author',
          __( 'Title', 'centum' ) => 'title',
          __( 'Modified', 'centum' ) => 'modified',
          __( 'Random', 'centum' ) => 'rand',
          __( 'Comment count', 'centum' ) => 'comment_count',
          __( 'Menu order', 'centum' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'centum' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'centum' ) => 'DESC',
          __( 'Ascending', 'centum' ) => 'ASC'
          ),
        ),     
      array(
        'type' => 'dropdown',
        'heading' => __( 'Open photos in Lightbox?', 'centum' ),
        'param_name' => 'lightbox',
        'value' => array(
          __( 'Yes', 'centum' ) => 'yes',
          __( 'No', 'centum' ) => 'no'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'centum' ),
        'param_name' => 'limit',
        'value' => array(
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
          '15' => '15',
          '16' => '16',
          ),
        'std' => '6'
        ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Potfolio items to Exclude', 'centum' ),
        'param_name' => 'exclude_posts',
        'settings' => array(
          'post_type' => 'portfolio',
          ),
        'description' => __( 'Select items to exclude from list.', 'centum' )
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Portfolio filters', 'centum' ),
        'param_name' => 'filters',
        'taxonomy' => 'filters',
        'description' => __( 'Select categories from which portfolio items will be populated.', 'centum' )
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Add "read more" button?', 'centum' ),
        'param_name' => 'read_more',
        'value' => array(
          __( 'Yes', 'centum' ) => 'yes',
          __( 'No', 'centum' ) => 'no'
          ),
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'centum' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        ),
      ),

));
}



/*
 * Icon Box for Visual Composer
 *
 */


add_action( 'init', 'centum_iconbox_integrateWithVC' );
function centum_iconbox_integrateWithVC() {

  $icons = centum_icons_list();
  vc_map( array(
    "name" => __("Feautre Icon box", 'centum'),
    "base" => "feature",
    'icon' => 'centum_icon',
    'description' => __( 'Text box with icon', 'centum' ),
    "category" => __('Centum', 'centum'),
    "params" => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Title', 'centum' ),
        'param_name' => 'title',
        'description' => __( 'Enter text which will be used as title.', 'centum' )
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Icon", 'centum'),
        "param_name" => "icon",
        "value" => $icons,
        "description" => ""
        ),
      array(
        'type' => 'colorpicker',
        'heading' => __( 'Custom color', 'centum' ),
        'param_name' => 'color',
        ),
      array(
        'type' => 'textarea_html',
        'heading' => __( 'Content', 'centum' ),
        'param_name' => 'content',
        'description' => __( 'Enter content of the box.', 'centum' )
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'URL', 'centum' ),
        'param_name' => 'url',
        'description' => __( 'Where should it link?.', 'centum' )
        ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __("Link target", 'centum'),
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
        'heading' => __( 'From Visual Composer', 'centum' ),
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
 
  
add_action( 'init', 'centum_recent_blog_integrateWithVC' );
function centum_recent_blog_integrateWithVC() {
  vc_map( array(
    "name" => __("Recent blog posts","centum"),
    "base" => "recent_blog",
    'icon' => 'centum_icon',
    'description' => __( 'Recent posts list', 'centum' ),
    "category" => __('Centum',"centum"),
    /*  'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
    'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),*/
    "params" => array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Elements to show', 'centum' ),
        'param_name' => 'limit',
        'value' => array('1','2','3','4','5','6','7','8','9','10','11','12'),
        'std' => '4'
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'In how many columns will be post displayed', 'centum' ),
        'param_name' => 'columns',
        'value' => array('2','3','4'),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order by', 'centum' ),
        'param_name' => 'orderby',
        'value' => array(
          __( 'Date', 'centum' ) => 'date',
          __( 'ID', 'centum' ) => 'ID',
          __( 'Author', 'centum' ) => 'author',
          __( 'Title', 'centum' ) => 'title',
          __( 'Modified', 'centum' ) => 'modified',
          __( 'Random', 'centum' ) => 'rand',
          __( 'Comment count', 'centum' ) => 'comment_count',
          __( 'Menu order', 'centum' ) => 'menu_order'
          ),
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Order', 'centum' ),
        'param_name' => 'order',
        'value' => array(
          __( 'Descending', 'centum' ) => 'DESC',
          __( 'Ascending', 'centum' ) => 'ASC'
          ),
        ),
        array(
        'type' => 'textfield',
        'heading' => __( 'Number of words from content to show below thumbnail', 'centum' ),
        'param_name' => 'limit_words',
        'description' => __( 'Type just a number', 'centum' ),
        'value' => 13
      ),
      array(
        'type' => 'custom_posts_list',
        'heading' => __( 'Exclude posts, leave empty to not exclude anything', 'centum' ),
        'param_name' => 'exclude_posts',
        'settings' => array(
          'post_type' => 'post',
          ),
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Show only this categories', 'centum' ),
        'param_name' => 'categories',
        'taxonomy' => 'category',
        ),
      array(
        'type' => 'custom_taxonomy_list',
        'heading' => __( 'Show only this tags', 'centum' ),
        'param_name' => 'tags',
        'taxonomy' => 'post_tag',
        ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Add "read more" button?', 'centum' ),
        'param_name' => 'read_more',
        'value' => array(
          __( 'Yes', 'centum' ) => 'yes',
          __( 'No', 'centum' ) => 'no'
          ),
        ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'centum' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
  ));
}



add_action( 'init', 'testimonial_integrateWithVC' );
function testimonial_integrateWithVC() {
  vc_map( array(
    "name" => __("Testimonials", "centum"),
    "base" => "testimonials",
    'icon' => 'centum_icon',
    "as_parent" => array('only' => 'testimonial'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "category" => __('Centum',"centum"),
    "show_settings_on_create" => false,
    "params" => array(
        // add params same as with any other content element
      array(
        "type" => "textfield",
        "heading" => __("Title", "centum"),
        "param_name" => "title",
        "description" => __("Testimonials", "centum")
        ),    
      array(
        "type" => "textfield",
        "heading" => __("Delay", "centum"),
        "param_name" => "delay",
        "description" => __("Testimonials", "centum")
        )
      ),
    "js_view" => 'VcColumnView'
    ));

  vc_map( array(
    "name" => __("Testimonial", "centum"),
    "base" => "testimonial",
    'icon' => 'centum_icon',
    "content_element" => true,
    "as_child" => array('only' => 'testimonials'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "category" => __('Centum', 'centum'),
    "params" => array(
      array(
        'type' => 'textarea_html',
        'heading' => __( 'Text', 'centum' ),
        'param_name' => 'content',
        'description' => __( 'Enter text which will be used as title', 'centum' )
      ),     
      array(
        'type' => 'textfield',
        'heading' => __( 'Author', 'centum' ),
        'param_name' => 'author',
        'description' => __( 'Enter text which will be used as author name.', 'centum' )
        ),      
      array(
        'type' => 'textfield',
        'heading' => __( 'Job', 'centum' ),
        'param_name' => 'job',
        'description' => __( 'Enter text which will be used as job.', 'centum' )
        ),
      ),
    ));
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Testimonials extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Testimonial extends WPBakeryShortCode {
  }
}



/*


*/
/*
 * WooCommerce Products list for Visual Composer
 *
 */

add_action( 'init', 'centum_pricing_table_integrateWithVC' );
function centum_pricing_table_integrateWithVC() {


     vc_map( array(
    "name" => __("Pricing Table wrapper", "centum"),
    "base" => "pricing_wrapper",
    'icon' => 'centum_icon',
    "as_parent" => array('only' => 'pricing_table'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "category" => __('Centum',"centum"),
    "show_settings_on_create" => false,
    "params" => array(
        // add params same as with any other content element
      array(
        "type" => "dropdown",
        "heading" => __("Number", "centum"),
        "param_name" => "title",
          'number' => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
          
          ),
        "description" => __("How many pricing tables are inside", "centum")
        ),     
     ),
    "js_view" => 'VcColumnView'
    ));

  vc_map( array(
    "name" => __("Pricing table", 'centum'),
    "base" => "pricing_table",
    "as_child" => array('only' => 'pricing_wrapper'),
    'icon' => 'centum_icon',
    'description' => __( 'Pricing table', 'centum' ),
    "category" => __('Centum', 'centum'),
    "params" => array(
    array(
        'type' => 'dropdown',
        'heading' => __( 'Color', 'centum' ),
        'param_name' => 'color',
        'value' => array(
          __('1','centum') => '1',
          __('2','centum') => '2',
          __('3','centum') => '3',
          ),
        ),

    array(
      'type' => 'textfield',
      'heading' => __( 'Title', 'centum' ),
      'param_name' => 'header',
      'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'centum' )
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Price', 'centum' ),
      'param_name' => 'price',
      'value' => '30',
      ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Per', 'centum' ),
      'param_name' => 'per',
      'value' => 'per month',
      ),
      array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'centum' ),
      'param_name' => 'content',
      'description' => __( 'Put here simple UL list', 'centum' )
      ),
      array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'centum' ),
        'param_name' => 'from_vs',
        'value' => 'yes',
        'save_always' => true,
        )
      ),
));
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
  class WPBakeryShortCode_Pricing_wrapper extends WPBakeryShortCodesContainer {
  }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
  class WPBakeryShortCode_Pricing_table extends WPBakeryShortCode {
  }
}


add_action( 'init', 'centum_team_integrateWithVC' );
function centum_team_integrateWithVC() {
  vc_map( array(
    "name" => __("Team member", 'centum'),
    "base" => "team",
    'icon' => 'centum_icon',
    'description' => __( 'Simple Image Gallery', 'centum' ),
    "category" => __('Centum', 'centum'),
    "params" => array(
      array(
        'type' => 'attach_image',
        'heading' => __( 'Select image', 'centum' ),
        'param_name' => 'photo',
        'value' => '',
        ),
      array(
        'type' => 'textfield',
        'heading' => __( 'URL', 'centum' ),
        'param_name' => 'link',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Name', 'centum' ),
        'param_name' => 'name',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Job', 'centum' ),
        'param_name' => 'job',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Twitter', 'centum' ),
        'param_name' => 'twitter',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Facebook', 'centum' ),
        'param_name' => 'facebook',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Digg', 'centum' ),
        'param_name' => 'digg',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Vimeo', 'centum' ),
        'param_name' => 'vimeo',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'LinkedIn', 'centum' ),
        'param_name' => 'linkedin',
        'value' => ''
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'YouTube', 'centum' ),
        'param_name' => 'youtube',
        'value' => ''
      ),
       array(
        'type' => 'from_vs_indicatior',
        'heading' => __( 'From Visual Composer', 'centum' ),
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

add_shortcode_param('from_vs_indicatior', 'from_vs_indicatior_settings_field');
add_shortcode_param('custom_taxonomy_list', 'custom_taxonomy_list_settings_field', get_template_directory_uri() . '/vc_templates/js/vc_centum_vc_scripts.js');
add_shortcode_param('custom_posts_list', 'custom_posts_list_settings_field', get_template_directory_uri() . '/vc_templates/js/vc_centum_vc_scripts.js');


/* Custom parameters */

/*vc_add_param("vc_accordion_tab", array(
  "type" => "dropdown",
  "class" => "",
  "heading" => __("Icon", 'centum'),
  "param_name" => "icon",
  "value" => $icons,
  "description" => ""
  ));*/

/*vc_remove_element("vc_gallery");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_images_carousel");*/
  ?>
