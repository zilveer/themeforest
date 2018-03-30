<?php

add_action('admin_init', 'uxbarn_create_homeslider_meta_boxes');

if( ! function_exists('uxbarn_create_homeslider_meta_boxes')) {
	
    function uxbarn_create_homeslider_meta_boxes() {
        
        uxbarn_create_homeslider_caption();
		uxbarn_create_homeslider_order();
        
    }
	
}

if( ! function_exists('uxbarn_create_homeslider_caption')) {
	
    function uxbarn_create_homeslider_caption() {
        $caption_display = array(
            'id'          => 'uxbarn_homeslider_caption_meta_box',
            'title'       => __('Caption Settings', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'homeslider' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_homeslider_caption_body',
                    'label'       => __('Caption Body Text', 'uxbarn'),
                    'desc'        => __('Text to be displayed as a body of slider caption. For caption title, use Title field above.', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'textarea-simple',
                    'section'     => 'uxbarn_sec_homeslider_caption',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
              ),
                array(
                    'id'          => 'uxbarn_homeslider_caption_display',
                    'label'       => __('Caption Display?', 'uxbarn'),
                    'desc'        => __('Whether to show the caption of this slide.', 'uxbarn'),
                    'std'         => 'true',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_sec_homeslider_caption',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
	                    'value'       => 'true',
	                    'label'       => __('Yes', 'uxbarn'),
	                    'src'         => ''
	                  ),
	                  array(
	                    'value'       => 'false',
	                    'label'       => __('No', 'uxbarn'),
	                    'src'         => ''
	                  )
                    ),
                ),
            )
        );
        
        ot_register_meta_box($caption_display);
    }

}

if( ! function_exists('uxbarn_create_homeslider_order')) {
	
	function uxbarn_create_homeslider_order() {
        $args = array(
            'id'          => 'uxbarn_homeslider_slide_order_meta_box',
            'title'       => __('Slide Order Settings', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'homeslider' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_homeslider_slide_order',
                    'label'       => __('Slide Order Number', 'uxbarn'),
                    'desc'        => __('Enter a number for ordering the slide. Only number is allowed.', 'uxbarn'),
                    'std'         => '1',
                    'type'        => 'text',
                    'section'     => 'uxbarn_sec_homeslider_slide_order',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                ),
            ),
        );
		
		ot_register_meta_box($args);
		
	}

}

?>