<?php 
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'boc_meta_boxes' );

function boc_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */

  $sidebars = ot_get_option('boc_sidebars');
  $sidebars_array = array();
  $sidebars_array[0] = array (
   'label' => "Default sidebar",
   'value' => 'Terra Sidebar'
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

  
  $boc_sidebar = array(
    'id'        => 'boc_metabox_sidebar',
    'title'     => 'Layout',
    'desc'      => 'If you select the "Page + Sidebar" template or "Default Template" in the Posts Section, you can assign a dynamic sidebar for this page. Sidebars can be created in the Theme Options->Sidebars and configured in the Widgets area.',
    'pages'     => array( 'post','page'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'boc_sidebar_set',
        'label'       => 'Sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'    => $sidebars_array
        )
      )
    );
  
	
	
  $boc_post_options = 
  	array(
    'id'        => 'boc_post_options',
    'title'     => 'Video Post Options',
    'desc'      => '',
    'pages'     => array( 'post','portfolio' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'video_embed_code',
        'label'       => 'Paste your Video Embed Code',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        )
      )  
    );
    
    ot_register_meta_box( $boc_sidebar );     
    ot_register_meta_box( $boc_post_options );


}