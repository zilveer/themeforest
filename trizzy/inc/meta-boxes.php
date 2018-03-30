<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', '_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to
   * the OptionTree Meta Box API Class.
   */
  $meta_box_layout = array(
    'id'        => 'pp_metabox_sidebar',
    'title'     => __('Layout','trizzy'),
    'desc'      => __('You can choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Appearance -> Widgets.','trizzy'),
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    =>   array(
      array(
        'id'          => 'pp_sidebar_layout',
        'label'       => __('Layout','trizzy'),
        'desc'        => '',
        'std'         => 'right-sidebar',
        'type'        => 'radio_image',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => 'Left Sidebar',
            'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
            ),
          array(
            'value'   => 'right-sidebar',
            'label'   => 'Right Sidebar',
            'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
            )
          ),
        ),
      array(
        'id'          => 'pp_sidebar_set',
        'label'       => __('Sidebar','trizzy'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'sidebar-select',
        'class'       => '',
        )
      )
    );

$meta_box_layout_page = array(
  'id'        => 'pp_metabox_sidebar',
  'title'     => __('Layout','trizzy'),
  'desc'      => __('You can choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Appearance -> Widgets.','trizzy'),
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_sidebar_layout',
      'label'       => __('Layout','trizzy'),
      'desc'        => '',
      'std'         => 'full-width',
      'type'        => 'radio_image',
      'class'       => '',
      'choices'     => array(
        array(
          'value'   => 'left-sidebar',
          'label'   => __('Left Sidebar','trizzy'),
          'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
          ),
        array(
          'value'   => 'right-sidebar',
          'label'   => __('Right Sidebar','trizzy'),
          'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
          ),
        array(
          'value'   => 'full-width',
          'label'   => __('Full Width (no sidebar)','trizzy'),
          'src'     => OT_URL . '/assets/images/layout/full-width.png'
          )
        ),
      ),
    array(
      'id'          => 'pp_sidebar_set',
      'label'       => 'Sidebar',
      'desc'        => '',
      'std'         => '',
      'type'        => 'sidebar-select',
      'class'       => '',
      )
    )
);

$layers = array();
global $wpdb;
// Table name
$table_name = $wpdb->prefix . "revslider_sliders";
// Get sliders
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
  $sliders = $wpdb->get_results( "SELECT alias, title FROM $table_name" );
} else {
  $sliders = '';
}

// Iterate over the sliders
if($sliders) {
  foreach($sliders as $key => $item) {
    $layers[] = array(
      'label' => $item->title,
      'value' => $item->alias
      );
  }
} else {
  $layers[] = array(
    'label' => 'No Sliders Found',
    'value' => ''
    );
}


$slider = array(
  'id'        => 'pp_metabox_slider',
  'title'     => 'Slider settings',
  'desc'      => 'If you want to use Revolution Slider on this page, select page template "Revolution Page" and choose here slider you want to display',
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_page_layer',
      'label'       => 'Revolution Slider',
      'desc'        => '',
      'std'         => '',
      'type'        => 'select',
      'choices'     => $layers,
      'class'       => '',
      )
    )
  );

$meta_box_filters = array(
  'id'        => 'pp_metabox_pf_tax',
  'title'     => 'Portfolio Template Options',
  'desc'      => 'Use it also for "Creative Page Template"',
  'pages'     => array('page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'label' => 'Select Filters to display',
      'id' => 'portfolio_filters',
      'type' => 'taxonomy-checkbox',
      'desc' => 'Select filters from which you want to display your portfolio items.',
      'std' => '',
      'rows' => '',
      'post_type' => '',
      'taxonomy' => 'filters',
      'class' => 'filters-checbox' ),
    array(
      'id'          => 'pp_filters_switch',
      'label'       => 'Filters buttons display',
      'desc'        => '',
      'std'         => '',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Yes',
          'value' => 'yes'
          ),
        array(
          'label' => 'No',
          'value' => 'no'
          )
        )
      ),
    array(
      'id'          => 'pp_portfolio_title',
      'label'       => 'Title of Portfolio Section',
      'desc'        => 'Overwrites setting from Theme Options.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),
    )
);


$my_meta_box_pf = array(
  'id'        => 'pp_metabox_pf',
  'title'     => 'Portfolio Options',
  'desc'      => '',
  'pages'     => array('portfolio' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_pf_type',
      'label'       => 'Portfolio type',
      'desc'        => '',
      'std'         => '',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Gallery',
          'value' => 'gallery'
          ),
        array(
          'label' => 'Video',
          'value' => 'video'
          )
        )
      ),
    /*array(
      'id'          => 'pp_pf_lightbox',
      'label'       => 'Lightbox status',
      'desc'        => 'Display item with a link to lightbox or permalink when used in shortcode or "Recent work" section',
      'std'         => '',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Permalink',
          'value' => 'permalink'
          ),
        array(
          'label' => 'Lightbox',
          'value' => 'lightbox'
          )
        )
      ),*/
    array(
      'id'          => 'pp_pf_layout',
      'label'       => 'Portfolio layout',
      'desc'        => '',
      'std'         => '',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Wide',
          'value' => 'wide'
          ),
        array(
          'label' => 'Half',
          'value' => 'half'
          )
        )
      ),
    array(
      'label' => 'Gallery slider',
      'id'    => 'pp_gallery_slider',
      'type'  => 'gallery',
      'desc'  => 'Click Create Slider to create your gallery for slider.',
      'post_type' => 'post',

      ),
    array(
      'id'          => 'pp_pfvideo_link',
      'label'       => 'Link to Video',
      'desc'        => 'Just link, not embed code, this field is used for oEmbed.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),
    array(
      'id'          => 'pp_pfvideo_embed',
      'label'       => 'Embed code for Video',
      'desc'        => 'Place here embed code for videos services that do not support oEmbed',
      'std'         => '',
      'type'        => 'textarea',
      'class'       => '',
      ),
    array(
        'id'          => 'pp_related_items',
        'label'       => __( 'Choose related items for this portfolio', 'trizzy' ),
        'desc'        => __( 'Leave empty to use just recent items', 'trizzy' ),
        'std'         => '',
        'type'        => 'custom-post-type-checkbox',
        'post_type'   => 'portfolio',

      ),
    )
);


$testimonials = array(
  'id'        => 'pp_metabox_testimonials',
  'title'     => 'Testimonials info',
  'desc'      => 'Fill field below to use testimonials in slider',
  'pages'     => array( 'testimonial' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_author',
      'label'       => 'Author of testimonial',
      'desc'        => '',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),
    array(
      'id'          => 'pp_link',
      'label'       => 'Link to author\'s website (optional)',
      'desc'        => '',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),
    array(
      'id'          => 'pp_position',
      'label'       => 'Enter their position in their specific company.',
      'desc'        => '',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      )
    )
  );

$team = array(
  'id'        => 'pp_team',
  'title'     => 'Subtitle',
  'desc'      => '',
  'pages'     => array( 'team' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_position',
      'label'       => 'Position',
      'desc'        => 'Position of team member.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),
    array(
      'label'       => 'Social profiles',
      'id'          => 'pp_socialicons',
      'type'        => 'list-item',
      'desc'        => 'Manage socials icons.',
      'settings'    => array(
        array(
          'id'          => 'icons_service',
          'label'       => 'Choose service',
          'desc'        => '',
          'std'         => '',
          'type'        => 'select',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'choices'     => array(
            array('value'=> 'twitter','label' => 'Twitter','src'=> ''),
            array('value'=> 'wordpress','label' => 'WordPress','src'=> ''),
            array('value'=> 'facebook','label' => 'Facebook','src'=> ''),
            array('value'=> 'linkedin','label' => 'LinkedIN','src'=> ''),
            array('value'=> 'steam','label' => 'Steam','src'=> ''),
            array('value'=> 'tumblr','label' => 'Tumblr','src'=> ''),
            array('value'=> 'github','label' => 'GitHub','src'=> ''),
            array('value'=> 'delicious','label' => 'Delicious','src'=> ''),
            array('value'=> 'instagram','label' => 'Instagram','src'=> ''),
            array('value'=> 'xing','label' => 'Xing','src'=> ''),
            array('value'=> 'amazon','label'=> 'Amazon','src'=> ''),
            array('value'=> 'dropbox','label'=> 'Dropbox','src'=> ''),
            array('value'=> 'paypal','label'=> 'PayPal','src'=> ''),
            array('value'=> 'lastfm','label' => 'LastFM','src'=> ''),
            array('value'=> 'gplus','label' => 'Google Plus','src'=> ''),
            array('value'=> 'yahoo','label' => 'Yahoo','src'=> ''),
            array('value'=> 'pinterest','label' => 'Pinterest','src'=> ''),
            array('value'=> 'dribbble','label' => 'Dribbble','src'=> ''),
            array('value'=> 'flickr','label' => 'Flickr','src'=> ''),
            array('value'=> 'reddit','label' => 'Reddit','src'=> ''),
            array('value'=> 'vimeo','label' => 'Vimeo','src'=> ''),
            array('value'=> 'spotify','label' => 'Spotify','src'=> ''),
            array('value'=> 'rss','label' => 'RSS','src'=> ''),
            array('value'=> 'youtube','label' => 'YouTube','src'=> ''),
            array('value'=> 'blogger','label' => 'Blogger','src'=> ''),
            array('value'=> 'appstore','label' => 'AppStore','src'=> ''),
            array('value'=> 'evernote','label' => 'Evernote','src'=> ''),
            array('value'=> 'digg','label' => 'Digg','src'=> ''),
            array('value'=> 'forrst','label' => 'Forrst','src'=> ''),
            array('value'=> 'fivehundredpx','label' => '500px','src'=> ''),
            array('value'=> 'stumbleupon','label' => 'StumbleUpon','src'=> ''),
            array('value'=> 'dribbble','label' => 'Dribbble','src'=> '')
            ),
),
array(
  'label'       => 'URL to profile page',
  'id'          => 'icons_url',
  'type'        => 'text',
  'desc'        => '',
  'std'         => '',
  'rows'        => '',
  'post_type'   => '',
  'taxonomy'    => '',
  'class'       => ''
  )
)
)
)
);


$products = array(
  'id'        => 'pp_metabox_products_hover',
  'title'     => 'Featured Hover Image',
  'pages'     => array( 'product' ),
  'context'   => 'side',
  'priority'  => 'default',
  'fields'    => array(
    array(
      'id'          => 'pp_featured_hover',
      'label'       => 'Product thumbnail on hover',
      'desc'        => '',
      'std'         => '',
      'type'        => 'upload',
      'class'       => 'ot-upload-attachment-id',

      ),

    )
  );

$parallax = array(
  'id'        => 'pp_metabox_parallax_bg',
  'title'     => 'Background image for parallax page header',
  'desc'      => '',
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_title_bar_hide',
      'label'       => 'Title bar status on this page',
      'desc'        => 'Set to "Off" to hide title bar',
      'std'         => 'on',
      'type'        => 'on_off',
      'class'       => '',
    ),
    array(
      'id'          => 'pp_parallax_bg',
      'label'       => 'Parallax header background ',
      'desc'        => 'Set image for header, it must be 1290px wide.',
      'std'         => '',
      'type'        => 'upload',
      'class'       => '',
      ),
     array(
      'id'          => 'pp_parallax_color',
      'label'       => 'Overlay color',
      'desc'        => '',
      'std'         => '',
      'type'        => 'colorpicker',
      'class'       => '',
      ),
     array(
      'id'          => 'pp_parallax_opacity',
      'label'       => 'Overlay opacity',
      'desc'        => '',
      'std'         => '',
      'class'       => '',
      'type'        => 'numeric-slider',
      'min_max_step'=> '0,1,0.01',
      )
    )
  );


$parallax_post = array(
  'id'        => 'pp_metabox_parallax_bg',
  'title'     => 'Background image for parallax page header',
  'desc'      => '',
  'pages'     => array( 'post' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_parallax_bg',
      'label'       => 'Parallax header background ',
      'desc'        => 'Set image for header, it must be 1290px wide.',
      'std'         => '',
      'type'        => 'upload',
      'class'       => '',
      ),
     array(
      'id'          => 'pp_parallax_color',
      'label'       => 'Overlay color',
      'desc'        => '',
      'std'         => '',
      'type'        => 'colorpicker',
      'class'       => '',
      ),
     array(
      'id'          => 'pp_parallax_opacity',
      'label'       => 'Overlay opacity',
      'desc'        => '',
      'std'         => '',
      'class'       => '',
      'type'        => 'numeric-slider',
      'min_max_step'=> '0,1,0.01',
      )
    )
  );

$parallaxproduct = array(
  'id'        => 'pp_metabox_parallax_product_bg',
  'title'     => 'Background image for parallax page header',
  'desc'      => '',
  'pages'     => array(  'product' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_woo_parallax_type',
      'label'       => 'Choose which paralax you want to use on this product page',
      'desc'        => '<strong>"General shop parallax"</strong> can be set in Appearance -> Theme Options -> WooCommerce, while <strong>Product\'s parallax</strong> can be set in options below',
      'std'         => 'default',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Default header (no paralax)',
          'value' => 'default'
          ),
        array(
          'label' => 'General shop parallax',
          'value' => 'general'
          ),
        array(
          'label' => 'Product\'s parallax',
          'value' => 'products'
          )
        )
    ),
    array(
      'id'          => 'pp_parallax_bg',
      'label'       => 'Parallax header background ',
      'desc'        => 'Set image for header, it must be 1290px wide.',
      'std'         => '',
      'type'        => 'upload',
      'class'       => '',
      ),
     array(
      'id'          => 'pp_parallax_color',
      'label'       => 'Overlay color',
      'desc'        => '',
      'std'         => '',
      'type'        => 'colorpicker',
      'class'       => '',
      ),
     array(
      'id'          => 'pp_parallax_opacity',
      'label'       => 'Overlay opacity',
      'desc'        => '',
      'std'         => '',
      'class'       => '',
      'type'        => 'numeric-slider',
      'min_max_step'=> '0,1,0.01',
      )
    )
  );

$subtitle = array(
  'id'        => 'pp_metabox_subtitle',
  'title'     => 'Subtitle for page header',
  'desc'      => '',
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_subtitle',
      'label'       => 'Subtitle',
      'desc'        => 'Set optional subtitle.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),

    )
  );

$productsoptions = array(
  'id'        => 'pp_metabox_products',
  'title'     => 'Product page Options',
  'pages'     => array( 'product' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_woo_thumbnail_style',
      'label'       => 'Change the direction of thumbnails in product gallery',
      'desc'        => '',
      'std'         => '',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Vertical',
          'value' => 'vertical'
          ),
        array(
          'label' => 'Horizontal',
          'value' => 'horizontal'
          )
        )
      ),
        array(
        'id'          => 'pp_sidebar_layout',
        'label'       => 'Layout',
        'desc'        => '',
        'std'         => 'full-width',
        'type'        => 'radio_image',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'full-width',
            'label'   => 'Full Width (no sidebar)',
            'src'     => OT_URL . '/assets/images/layout/full-width.png'
            ),
          array(
            'value'   => 'left-sidebar',
            'label'   => 'Left Sidebar',
            'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
            ),
          array(
            'value'   => 'right-sidebar',
            'label'   => 'Right Sidebar',
            'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
            )
          ),
        ),
    )
  );
  /**
   * Register our meta boxes using the
   * ot_register_meta_box() function.
   */
  ot_register_meta_box( $meta_box_layout );
  ot_register_meta_box( $meta_box_layout_page );

  ot_register_meta_box( $meta_box_filters );
  /*ot_register_meta_box( $gallerypage );*/
  ot_register_meta_box( $subtitle );
  ot_register_meta_box( $parallax );
  ot_register_meta_box( $parallaxproduct );
  ot_register_meta_box( $parallax_post );
  ot_register_meta_box( $slider );
  ot_register_meta_box( $my_meta_box_pf );
  ot_register_meta_box( $testimonials );
  ot_register_meta_box( $team );
  ot_register_meta_box( $productsoptions );
  ot_register_meta_box( $products );
} ?>