<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_custom_meta_boxes' );
function _custom_meta_boxes() {

  $portfolio_settings_meta_box = array(
    'id'          => 'portfolio_settings',
    'title'       => 'Portfolio Settings',
    'desc'        => '',
    'pages'       => array( 'portfolio' ),
    'context'     => 'normal',
    'priority'    => 'default',
    'fields'      => array(
      array(
        'label'       => 'Portfolio Item Background Color',
        'id'          => 'portfolio_highlight_background_color',
        'type'        => 'colorpicker',
        'desc'        => 'Choose a value for background color. Default value is #111111.',
        'std'         => '#111',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'label'       => 'Portfolio Item Text Color',
        'id'          => 'portfolio_highlight_text_color',
        'type'        => 'colorpicker',
        'desc'        => 'Choose a value for text color. Default value is #ffffff.',
        'std'         => '#ffffff',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'label'       => 'Portfolio Custom URL',
        'id'          => 'portfolio_custom_url',
        'type'        => 'text',
        'desc'        => 'If you want to link the portfolio item to a custom URL, enter the URL here.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'label'       => 'Portfolio Image Lightbox',
        'id'          => 'portfolio_image_lightbox',
        'type'        => 'upload',
        'desc'        => 'If you want to open the lightbox with image by clicking the portfolio item, upload the image here.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'label'       => 'Enable 50% Width',
        'id'          => 'portfolio_50_width',
        'type'        => 'checkbox',
        'desc'        => 'Enable 50% width for portfolio item.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Enable 50% Width',
            'src'         => ''
          )
        )
      ),
	  array(
        'label'       => 'Enable transparent header background for single portfolio pages?',
        'id'          => 'optiontree_enable_transparent_header_background_for_single_portfolio_pages',
        'type'        => 'checkbox',
        'desc'        => 'Enable transparent header background for single portfolio pages?',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array( 
          array(
            'value'       => 'yes',
            'label'       => 'Enable transparent header background for single portfolio pages?',
            'src'         => ''
          )
        )
      ),
  	)
  );
  ot_register_meta_box( $portfolio_settings_meta_box );

}