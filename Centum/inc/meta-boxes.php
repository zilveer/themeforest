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

  $sidebars = ot_get_option('incr_sidebars');
  $sidebars_array = array();
  $sidebars_array[0] = array (
   'label' => "Default sidebar",
   'value' => 'sidebar'
   );

  $sidebars_k = 1;
  if(!empty($sidebars)){
    foreach($sidebars as $sidebar){
      $sidebars_array[$sidebars_k++] = array(
        'label' => $sidebar['title'],
        'value' => $sidebar['id']
        );
    }
  }



  $my_meta_box = array(
    'id'        => 'incr_metabox_sidebar',
    'title'     => 'Layout',
    'desc'      => 'If you choose the sidebar layout, please choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Theme Widgets.',
    'pages'     => array( 'post','page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'incr_sidebar_layout',
        'label'       => 'Layout',
        'desc'        => '',
        'std'         => 'right-sidebar',
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
      array(
        'id'          => 'incr_sidebar_set',
        'label'       => 'Sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'    => $sidebars_array
        )
      )
    );

  $my_meta_box2 = array(
    'id'        => 'incr_metabox_featue',
    'title'     => 'Post options',
    'desc'      => 'Select post display options.',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'incr_feattype',
        'label'       => 'Display type',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices' => array(
          array(
            'label' => 'Show thumbnail',
            'value' => 'show_thumb'
            ),
          array(
            'label' => 'Hide thumbnail',
            'value' => 'hide_thumb'
            )
          )

        ),
      array(
        'id'          => 'incr_video_link',
        'label'       => 'Link to Video',
        'desc'        => 'Just link, not embed code, this field uses oEmbed.',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        ),
      array(
        'id'          => 'incr_video_embed',
        'label'       => 'Embed code for Video',
        'desc'        => 'Place here embed code for videos services that do not support oEmbed',
        'std'         => '',
        'type'        => 'textarea',
        'class'       => '',
        ),
      array(
          'label' => 'Gallery slider (use when Post Type is set to Gallery)',
          'id' => 'pp_gallery_slider',
          'type' => 'gallery',
          'desc' => 'Click Create Slider to create your gallery for slider.',
          'post_type' => 'post',
        ),
      )
    );

$my_meta_box3 = array(
  'id'        => 'incr_metabox_subtitle',
  'title'     => 'Subtitle',
  'desc'      => '',
  'pages'     => array( 'page', 'portfolio' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'incr_subtitle',
      'label'       => 'Subtitle',
      'desc'        => 'Set subtitle for page.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      )
    )
  );

$my_meta_box4 = array(
  'id'        => 'incr_metabox_slider',
  'title'     => 'Slider settings',
  'desc'      => 'If you want to use Revolution Slider on this page, select page template "Revlution Page" and put here Alias of slider you want to display',
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'incr_page_revolution',
      'label'       => 'Revolution Slider Alias',
      'desc'        => 'Check it in settings of your slider.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      )
    )
  );

$meta_box_filters = array(

  'id'        => 'centum_metabox_pf_tax',
  'title'     => 'Portfolio Template Options',
  'desc'      => '',
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
      'id'          => 'centum_filters_switch',
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
      'id'          => 'centum_portfolio_title',
      'label'       => 'Title of Portfolio Section',
      'desc'        => 'Overwrites setting from Theme Options.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      ),

    )

  );

$meta_pf_fields = array();
$metafields = ot_get_option( 'centum_pf_meta', array() );
if (!empty( $metafields ) ) {
  $i = 0;
  foreach( $metafields as $metafield ) {
   if($metafield['type'] == "text") {
     $meta_pf_fields[$i]['id'] = "incr_pf_".sanitize_title($metafield['title']);
     $meta_pf_fields[$i]['label'] = $metafield['title'];
     $meta_pf_fields[$i]['type'] = "text";
     $i++;
   }
   if($metafield['type'] == "link") {
     $meta_pf_fields[$i]['id'] = "incr_pf_link";
     $meta_pf_fields[$i]['label'] = $metafield['title'];
     $meta_pf_fields[$i]['type'] = "text";
     $i++;
   }
 }
}


$meta_box_pffields = array(
 array(
      'id'          => 'incr_pf_type',
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
    array(
      'id'          => 'incr_pfvideo_link',
      'label'       => 'Link to Video',
      'desc'        => 'Just link, not embed code, this field is used for oEmbed.',
      'std'         => '',
      'type'        => 'text',
      'class'       => '',
      'condition'   => 'incr_pf_type:is(video)'
      ),
     array(
        'id'          => 'incr_pfvideo_embed',
        'label'       => 'Embed code for Video',
        'desc'        => 'Place here embed code for videos services that do not support oEmbed',
        'std'         => '',
        'type'        => 'textarea',
        'class'       => '',
        'condition'   => 'incr_pf_type:is(video)'
        ),

    array(
        'label' => 'Gallery slider (use when Post Type is set to Gallery)',
        'id' => 'pp_gallery_slider',
        'type' => 'gallery',
        'desc' => 'Click Create Slider to create your gallery for slider.',
        'post_type' => 'post',
        'condition'   => 'incr_pf_type:is(gallery)'
      ),
    array(
      'id'          => 'incr_pf_full',
      'label'       => 'Full width content ',
      'desc'        => 'If you don\'t want to show date, client and launch button fields, you can switch to full width content here',
      'std'         => 'none',
      'type'        => 'select',
      'class'       => '',
      'choices' => array(
        array(
          'label' => 'Full width',
          'value' => 'full'
          ),
        array(
          'label' => '12 columns',
          'value' => 'none'
          )
        )

      ),

  );




$my_meta_box_pf = array(
  'id'        => 'incr_metabox_pf',
  'title'     => 'Portfolio Options',
  'desc'      => '',
  'pages'     => array('portfolio' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array_merge($meta_box_pffields,$meta_pf_fields)
);

$my_meta_box_recent_pf = array(
  'id'        => 'incr_metabox_recent_pf',
  'title'     => '"Recent Projects" Options',
  'desc'      => '',
  'pages'     => array('portfolio' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
        'label' => '"Recent Projects" section settings',
        'id' => 'pp_recent_pofrfolio_textblock',
        'type' => 'textblock',
        'desc' => 'Under the post content you can see "Recent portfolio" section, which by default displays 4 latest posts, here you can configure it to show selected items or filters.',
        'post_type' => 'post',
    ),
    array(
        'label' => '"Recent Projects" filters to display',
        'id' => 'pp_recent_portfolio_filters',
        'type' => 'taxonomy-checkbox',
        'taxonomy'  => 'filters',
    ),
    array(
        'label' => '"Recent Projects" items to display',
        'id' => 'pp_recent_portfolio_posts',
        'type'        => 'custom-post-type-checkbox',
        'post_type'   => 'portfolio',
    ),
  ),
);


$productsoptions = array(
  'id'        => 'pp_metabox_products',
  'title'     => 'Product page Options',
  'pages'     => array( 'product' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
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
  ot_register_meta_box( $my_meta_box );
  ot_register_meta_box( $my_meta_box2 );
  ot_register_meta_box( $meta_box_filters );
  ot_register_meta_box( $my_meta_box3 );
  ot_register_meta_box( $my_meta_box4 );
  ot_register_meta_box( $my_meta_box_pf );
  ot_register_meta_box( $my_meta_box_recent_pf );
  ot_register_meta_box( $productsoptions );

}