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

 $saved_settings = get_option( 'option_tree_settings', array() );

 $current_sliders = get_option( 'cp_sliders');

// Iterate over the sliders
 if($current_sliders) {
  foreach($current_sliders as $key => $item) {
    $cpsliders[] = array(
      'label' => $item->name,
      'value' => $item->slug
      );
  }
} else {
  $cpsliders[] = array(
    'label' => 'No Sliders Found',
    'value' => ''
    );
}
  /**
   * Create a custom meta boxes array that we pass to
   * the OptionTree Meta Box API Class.
   */
  $meta_box_layout = array(
    'id'        => 'pp_metabox_sidebar',
    'title'     => 'Layout',
    'desc'      => 'If you choose the sidebar layout, please choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Theme Widgets.',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    =>   array(
      array(
        'id'          => 'pp_sidebar_layout',
        'label'       => 'Layout',
        'desc'        => '',
        'std'         => ot_get_option('pp_blog_layout','left-sidebar'),
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
        'label'       => 'Sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'sidebar-select',
        'class'       => '',

        )
      )
    );

$meta_box_layout_page = array(
  'id'        => 'pp_metabox_sidebar',
  'title'     => 'Layout',
  'desc'      => 'If you choose the sidebar layout, please choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Theme Widgets.',
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
    array(
      'id'          => 'pp_sidebar_layout',
      'label'       => 'Layout',
      'desc'        => '',
      'std'         => ot_get_option('pp_blog_layout','left-sidebar'),
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
          ),
        array(
          'value'   => 'full-width',
          'label'   => 'Full Width (no sidebar)',
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
      ),
    array(
      'label'       => 'Select slider',
      'id'          => 'pp_slider_select',
      'type'        => 'select',
      'desc'        => 'Don\'t forget to choose Page Template: Page with Slider',
      'choices'     => $cpsliders,
      'std'         => 'true',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => '',
      'section'     => 'slider'
      ),
    )
);

$post_options = array(
  'id'        => 'pp_metabox_featue',
  'title'     => 'Post options',
  'desc'      => 'Select post display options (Option depends on Post\'s Format, so be sure to select one.',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'label' => 'Gallery slider (use when Post Type is set to Gallery)',
        'id' => 'pp_gallery_slider',
        'type' => 'gallery',
        'desc' => 'Click Create Slider to create your gallery for slider.',
        'post_type' => 'post',
        ),
      array(
        'id'          => 'pp_video_link',
        'label'       => 'Link to Video',
        'desc'        => 'Just link, not embed code, this field uses oEmbed.',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        ),
      array(
        'id'          => 'pp_video_embed',
        'label'       => 'Embed code for Video',
        'desc'        => 'Place here embed code for videos services that do not support oEmbed',
        'std'         => '',
        'type'        => 'textarea',
        'class'       => '',
        ),
      )
    );



$gallerypage = array(
  'id'        => 'pp_metabox_gallerypage',
  'title'     => 'Gallery slider',
  'desc'      => 'If you want to use flexslider gallery like on Portfolio item, just create gallery using button below',
  'pages'     => array( 'page' ),
  'context'   => 'normal',
  'priority'  => 'high',
  'fields'    => array(
   array(
    'label' => 'Gallery slider (use when Post Type is set to Gallery)',
    'id' => 'pp_gallery_slider',
    'type' => 'gallery',
    'desc' => 'Click Create Slider to create your gallery for slider.',
    'post_type' => 'post',
    ),
   )
  );


  /**
   * Register our meta boxes using the
   * ot_register_meta_box() function.
   */
  ot_register_meta_box( $meta_box_layout );
  ot_register_meta_box( $meta_box_layout_page );
  ot_register_meta_box( $post_options );
  ot_register_meta_box( $gallerypage );


}