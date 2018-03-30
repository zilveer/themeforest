<?php
/**
 * Register theme metaboxes.     
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */
 
// subtitle slogan
$options_args = array(
	11 => array( 
		'id' => 'subslogan_page',
		'name' => __( 'Slogan Subtitle', 'yiw' ), 
		'type' => 'text',
		'desc' => __( 'Insert the subtitle of slogan showed below the main title of this slogan.', 'yiw' ),
		'desc_location' => 'newline'
	),
); 
yiw_add_options_to_metabox( 'yiw_slogan_page', $options_args );

//show breadcrumbs
global $yiw_sliders;
$options_args = array(
    21 => array( 
        'id' => 'show_breadcrumbs_page',
        'name' => __( 'Show Breadcrumbs below the title', 'yiw' ), 
        'type' => 'radio',
        'options' => array(
            'yes' => __( 'Yes', 'yiw' ),
            'no' => __( 'No', 'yiw' ),  
        ),
        'std' => 'yes'
    ),

); 
yiw_add_options_to_metabox( 'yiw_options_page', $options_args );    




//testimonial url
$options_args = array(
    10 => array(
        'id' => 'testimonial_label',
        'name' => __( 'Web Site Label', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the label used for Testimonial Website Url', 'yiw' ),
        'desc_location' => 'newline'
    ),
    20 => array(
        'id' => 'testimonial_website',
        'name' => __( 'Web Site URL', 'yiw' ), 
        'type' => 'text',
        'desc' => __( 'Insert the url referred to Testimonial', 'yiw' ),
        'desc_location' => 'newline'
    )
);
yiw_register_metabox( 'yiw_url_testimonial', __( 'Website Testimonial', 'yiw' ), 'bl_testimonials', $options_args, 'normal', 'high' );
?>