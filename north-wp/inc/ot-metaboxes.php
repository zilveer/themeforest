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
  $post_meta_box_video = array(
    
    'id'          => 'post_meta_video',
    'title'       => 'Video Settings',
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Video URL',
        'id'          => 'post_video',
        'type'        => 'textarea-simple',
        'desc'        => 'Video URL. You can find a list of websites you can embed here: <a href="http://codex.wordpress.org/Embeds">Wordpress Embeds</a>',
        'std'         => '',
        'rows'        => '5'
      )
    )
  );
  
  $post_meta_box_sidebar_gallery = array(
    'id'        => 'meta_box_sidebar_gallery',
    'title'     => 'Gallery',
    'pages'     => array('post'),
    'context'   => 'side',
    'priority'  => 'low',
    'fields'    => array(
      array(
        'id' => 'pp_gallery_slider',
        'type' => 'gallery',
        'desc' => '',
        'post_type' => 'post'
      )
     )
   );
  
	$product_meta_box = array(
	  'id'          => 'product_settings',
	  'title'       => 'Product Page Settings',
	  'pages'       => array( 'product' ),
	  'context'     => 'normal',
	  'priority'    => 'high',
	  'fields'      => array(
		  array(
			'id'          => 'tab2',
			'label'       => 'Sizing Guide',
			'type'        => 'tab'
		  ),
		  array(
		    'label'       => 'Enable Sizing Guide',
		    'id'          => 'sizing_guide',
		    'type'        => 'on_off',
		    'desc'        => 'Enabling the sizing guide will add a link to the product page that will open the below content in a lightbox.',
		    'std'         => 'off'
		  ),
		  array(
		  	'label'       => 'Sizing Guide Text',
		  	'id'          => 'sizing_guide_text',
		  	'type'        => 'text',
		  	'desc'        => 'You can override the sizing guide text here',
		  	'rows'        => '1',
		  	'condition'   => 'sizing_guide:is(on)'
		  ),
		  array(
			'label'       => 'Sizing Guide Content',
			'id'          => 'sizing_guide_content',
			'type'        => 'textarea',
			'desc'        => 'You can insert your sizin guide content here. Preferablly an image.',
			'std'         => '',
			'rows'        => '5',
    	  	'condition'   => 'sizing_guide:is(on)'
		  )
		)
	);
  $page_metabox = array(
    'id'          => 'post_metaboxes_combined',
    'title'       => 'Page Settings',
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
		array(
			'id'          => 'tab2',
			'label'       => 'Page Settings',
			'type'        => 'tab'
		),
		array(
    	  'label'       => 'Enable Page Padding',
    	  'id'          => 'page_padding',
    	  'type'        => 'on_off',
    	  'desc'        => 'This adds padding to the top & bottom of the page so the footer and header does not overlap with content',
    	  'std'         => 'off'
    	),
      array(
        'id'          => 'sidebar_set',
        'label'       => 'Sidebar',
        'type'        => 'sidebar_select',
        'desc'        => 'Select a sidebar to display inside the page. <small>Blog pages automatically display the Blog sidebar</small>'
      ),
      array(
        'label'       => 'Sidebar Position',
        'id'          => 'sidebar_position',
        'type'        => 'radio',
        'desc'        => 'Select where the sidebar should be positioned',
        'choices'     => array(
        	array(
        	  'label'       => 'Left',
        	  'value'       => 'left'
        	),
          array(
            'label'       => 'Right',
            'value'       => 'right'
          )
          
        ),
        'std'         => 'left',
        'condition'   => 'sidebar_set:not()'
      ),
    	array(
    	  'id'          => 'tab0',
    	  'label'       => 'Header Override',
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => 'Override Global Header?',
    	  'id'          => 'header_override',
    	  'type'        => 'on_off',
    	  'desc'        => 'You can override global header styles here',
    	  'std'         => 'off'
    	),
			array(
    	  'label'       => 'Display Light or Dark Menu?',
    	  'id'          => 'header_menu_color',
    	  'type'        => 'radio',
    	  'desc'        => 'What color would you like to display for the menu? This works with Header - Style 1',
    	  'choices'     => array(
    	    array(
    	      'label'       => 'Light Menu',
    	      'value'       => 'background--dark'
    	    ),
    	    array(
    	      'label'       => 'Dark Menu',
    	      'value'       => 'background--light'
    	    )
    	    
    	  ),
    	  'std'         => 'background--light',
    	  'condition'   => 'header_override:is(on)'
    	),
      array(
        'id'          => 'tab4',
        'label'       => 'Revolution Slider',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Revolution Slider Alias',
        'id'          => 'rev_slider_alias',
        'type'        => 'revslider-select',
        'desc'        => 'If you would like to display Revolution Slider on top of this page, please enter the slider alias',
        'std'         => '',
        'rows'        => '1'
      ),
      array(
        'id'          => 'tab5',
        'label'       => 'Navigation',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Select Page Primary Menu',
        'id'          => 'page_menu',
        'type'        => 'menu_select',
        'desc'        => 'If you select a menu here, it will override the main navigation menu.'
      ),
      array(
        'label'       => 'Enable One-Page-Scroll Navigation?',
        'id'          => 'page_scroll',
        'desc'        => 'This enables the one page scroll navigation. When clicked on navigation elements, the page will scroll.',
        'std'         => 'off',
        'type'        => 'on_off',
        
      ),
      array(
        'id'          => 'tab6',
        'label'       => 'Snap To Scroll',
        'type'        => 'tab'
      ),
      array(
        'label'       => 'Enable Snap To Scroll Effect?',
        'id'          => 'snap_scroll',
        'desc'        => 'This enables the one page snap to scroll feature. When you scroll, the screen will snap to sections',
        'std'         => 'off',
        'type'        => 'on_off',
        
      ),
	  array(
        'id'          => 'tab7',
        'label'       => 'Look Book',
        'type'        => 'tab'
      ),
	  array(
        'id'          => 'lookbook_text',
        'label'       => 'About the Look Book Settings',
        'desc'        => 'These settings will only work if you have selected the Look Book template for this page.',
        'std'         => '',
        'type'        => 'textblock'
      ),
	  array(
        'label'       => 'Content Background',
        'id'          => 'look_book_bg',
        'type'        => 'background',
        'desc'        => 'Background settings for look book content on the left.'
      ),
      array(
		'label'       => 'Look Book Items',
		'id'          => 'look_book',
		'type'        => 'list-item',
		'desc'        => 'You can add Look Book Items here',
		'settings'    => array(
		  array(
			'label'       => 'Look Image',
			'id'          => 'look_image',
			'type'        => 'upload',
			'desc'        => 'You can upload your Look Image here.'
		  ),
		  array(
			'label'       => 'Product IDs',
			'id'          => 'look_product_ids',
			'type'        => 'text',
			'desc'        => 'Product IDs associated with this look.',
			'rows'        => '1'
		  ),
		)
	  )
    )
  );
  
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
   
   
	ot_register_meta_box( $post_meta_box_video );
	ot_register_meta_box( $post_meta_box_sidebar_gallery);
	ot_register_meta_box( $page_metabox );
  	ot_register_meta_box( $product_meta_box );
}