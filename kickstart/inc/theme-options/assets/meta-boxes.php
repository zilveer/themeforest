<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {
  $header_opt_meta_box = array(
    'id'          => 'header_opt_meta_box',
    'title'       => 'Header element options',
    'desc'        => '',
    'pages'       => array( 'post', 'page', 'portfolio' ),
    'context'     => 'side',
    'priority'    => 'high',
    'fields'      => array(
	  array(
        'id'          => 'header_choice_select',
        'label'       => 'Select header element:',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '',
            'label'       => 'Title',
            'src'         => ''
          ),
          array(
            'value'       => 'notitle',
            'label'       => 'No Title',
            'src'         => ''
          ),
          array(
            'value'       => 'orbit-slider',
            'label'       => 'Orbit Slider',
            'src'         => ''
          ),
          array(
            'value'       => 'custom-element',
            'label'       => 'Custom Header Element',
            'src'         => ''
          ),
          array(
            'value'       => 'custom-element-full',
            'label'       => 'Custom Header Element (FULL)',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'header_opt_info',
        'label'       => 'Header Element info',
        'desc'        => 'For Blog page header choice go to: Appearance / Theme Options / Blog Options',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  
ot_register_meta_box( $header_opt_meta_box );
	
  $advanced_opt_meta_box = array(
    'id'          => 'advanced_opt_meta_box',
    'title'       => 'Advanced options',
    'desc'        => '',
    'pages'       => array( 'post', 'page', 'portfolio' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'id'          => 'custom_header_html',
        'label'       => 'Custom Header HTML',
        'desc'        => 'Custom Header HTML will only work if "Custom Header Element" chosen. Supports any content!',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '',
        'rows'        => '8',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  
ot_register_meta_box( $advanced_opt_meta_box );

$format_opt_meta_box = array(
    'id'          => 'format_opt_meta_box',
    'title'       => 'Post options',
    'desc'        => '',
    'pages'       => array( 'post'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
	  array(
        'id'          => 'full_width_posts',
        'label'       => 'Full width post',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enable_full_width_posts',
            'label'       => 'Enable full width for this post',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'post_sidebar_position',
        'label'       => 'Sidebar position',
        'desc'        => '',
        'std'         => 'right',
        'type'        => 'select',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Right',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'gallery_height',
        'label'       => 'Slider height (For Gallery post format)',
        'desc'        => 'Enter image slider height (Example: 350px or auto). Slider will use images attached to this post!',
        'std'         => '350px',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'post_embed',
        'label'       => 'Video or Audio embed code (For Video / Audio post format)',
        'desc'        => 'Paste here embedding code and choose Video or Audio post format. (Set 650px width for default layout and 940px for full width layout.)',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '',
        'rows'        => '3',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  
ot_register_meta_box( $format_opt_meta_box );
  
$portfolio_opt_meta_box = array(
    'id'          => 'portfolio_opt_meta_box',
    'title'       => 'Portfolio options',
    'desc'        => '',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'default',
    'fields'      => array(
      array(
        'id'          => 'pf_item_count',
        'label'       => 'How many items show per page?',
        'desc'        => 'Enter -1 to show all items',
        'std'         => '10',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pf_item_columns',
        'label'       => 'How many item columns?',
        'desc'        => '',
        'std'         => 'pf-three-columns',
        'type'        => 'select',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'pf-one-column',
            'label'       => 'One column',
            'src'         => ''
          ),
          array(
            'value'       => 'pf-two-columns',
            'label'       => 'Two columns',
            'src'         => ''
          ),
          array(
            'value'       => 'pf-three-columns',
            'label'       => 'Three columns',
            'src'         => ''
          ),
          array(
            'value'       => 'pf-four-columns',
            'label'       => 'Four columns',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'pf_cat_filter',
        'label'       => 'Show category filter?',
        'desc'        => '',
        'std'         => 'show',
        'type'        => 'radio',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array(
          array(
            'value'       => 'show',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'hide',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'pf_item_category',
        'label'       => 'Show only certain categories?',
        'desc'        => 'Enter category <strong>SLUGS</strong> (comma separated) you want to display.<br/>If you want to display only one category, disable category filter!<br/><span style="color:green;">LEAVE EMPTY TO DISPLAY ALL CATEGORIES!</span>',
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
	)
  );
  
ot_register_meta_box( $portfolio_opt_meta_box );

$portfolio_post_opt_meta_box = array(
    'id'          => 'portfolio_post_opt_meta_box',
    'title'       => 'Portfolio options',
    'desc'        => '',
    'pages'       => array( 'portfolio' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'id'          => 'portfolio_video_link',
        'label'       => 'Video link',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'portfolio_html',
        'label'       => 'HTML description (Only for one column portfolio)',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => '',
        'rows'        => '6',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'portfolio_external_link',
        'label'       => 'Add external link (Optional)',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
	)
  );
  
ot_register_meta_box( $portfolio_post_opt_meta_box );
}