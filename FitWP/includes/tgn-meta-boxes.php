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
  $my_meta_box1 = array(
    'id'          => 'my_meta_box1',
    'title'       => 'Post Options',
    'desc'        => '',
    'pages'       => array('post_classes', 'post_trainers'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
       array(
        'label'       => 'Big Image (Use In Single Post)',
        'id'          => 'bigimg',
        'type'        => 'upload',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),
          array(
        'label'       => 'Thumbnail Image',
        'id'          => 'thumbimg',
        'type'        => 'upload',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      )   

  	)
  );
  
    $my_meta_box2 = array(
    'id'          => 'my_meta_box2',
    'title'       => 'Pages Options',
    'desc'        => '',
    'pages'       => array( 'page', 'events', 'sermons', 'videogallery'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
   
        array(
        'label'       => 'Allow Widgetized Module On This Page?',
        'id'          => 'wmodulepage',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
            array(
            'label'       => 'Make your choice',
            'value'       => 'choice'
          ),
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          )
        ),
        'std'         => 'maybe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      ),

  	)
  );
    
 $my_meta_box3 = array(
    'id'          => 'my_meta_box3',
    'title'       => 'Custom Posts Options',
    'desc'        => '',
    'pages'       => array('post_classes', 'post_trainers'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
      
          array(
        'label'       => 'Quote (Will go under the page title)',
        'id'          => 'quote',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      )

  	)
  );
         
  $my_meta_box4 = array(
    'id'          => 'my_meta_box4',
    'title'       => 'Trainer Posts Options',
    'desc'        => '',
    'pages'       => array('post_trainers'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
      
          array(
        'label'       => 'Contact Email',
        'id'          => 'contactemail',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      )

  	)
  );
         
            $my_meta_box5 = array(
    'id'          => 'my_meta_box5',
    'title'       => 'Post Options',
    'desc'        => '',
    'pages'       => array('post'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
       array(
        'label'       => 'Thumb Image',
        'id'          => 'bigimg',
        'type'        => 'upload',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'miscellaneous'
      )
         

  	)
  );  
            
              $my_meta_box6 = array(
    'id'          => 'my_meta_box6',
    'title'       => 'Classes Posts Options',
    'desc'        => '',
    'pages'       => array('post_classes'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      
   
         array(
            'label'       => 'Difficulty Level',
            'id'          => 'difficulty',
            'type'        => 'textarea-simple',
            'desc'        => 'This is where you put the HTML snippet (see documentation) for the difficulty level widget.',
            'std'         => '',
            'rows'        => '10',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )

  	)
  );
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */

  ot_register_meta_box( $my_meta_box1 );
  ot_register_meta_box( $my_meta_box2 );
    ot_register_meta_box( $my_meta_box3 );
        ot_register_meta_box( $my_meta_box4 );
              ot_register_meta_box( $my_meta_box5 );
                    ot_register_meta_box( $my_meta_box6 );


}