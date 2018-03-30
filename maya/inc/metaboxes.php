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


//Testimonial checkbox that allows link to the extended page
$options_args = array(
    1 => array(
        'id' => 'testimonial_link',
        'name' => __( 'Allow Link', 'yiw' ), 
        'type' => 'checkbox',
        'desc' => __( 'Allow link to the testimonial page', 'yiw' ),
        'desc_location' => 'newline'
    ),
);
yiw_register_metabox( 'yiw_allow_link_testimonial', __( 'Allow Link Testimonial', 'yiw' ), 'bl_testimonials', $options_args, 'normal', 'high' );


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
    
//     72 => array( 
//         'id' => 'slider_accordion',
//         'name' => __( 'Accordion slider', 'yiw' ), 
//         'type' => 'select',
//         'options' => yiw_accordion_sliders( array( 'no' => __( 'No accordion', 'yiw' ) ) ),
//         'std' => 'yes',
//         'std' => 0
//     ),
    
    80 => array( 
        'id' => 'slider_type',
        'name' => __( 'Select a slider for this page', 'yiw' ), 
        'type' => 'select',
        'hidden' => false,
        'options' => $yiw_sliders,
        'std' => 'none'
    ),
	99 => array( 
		'id' => 'portfolio_post_type',
		'name' => __( 'Portfolio', 'yiw' ), 
		'desc' => __( 'NB: valid only for the portfolio template', 'yiw' ),
		'type' => 'select',
		'options' => yiw_get_portfolios(),
		//'hidden' => false,
		//'desc' => __( 'Insert the subtitle of slogan showed below the main title of this slogan.', 'yiw' ),
		//'desc_location' => 'newline'
	),

); 
yiw_add_options_to_metabox( 'yiw_options_page', $options_args );
	
// add map
$options_args = array( 
	10 => array( 
		'id' => 'show_map',
		'name' => __( 'Show Map', 'yiw' ), 
		'type' => 'radio',
		'options' => array(
            'yes' => __( 'Yes', 'yiw' ),
            'no' => __( 'No', 'yiw' ),
        ),
        'std' => 'no'
		//'hidden' => false,
		//'desc' => __( 'Insert the subtitle of slogan showed below the main title of this slogan.', 'yiw' ),
		//'desc_location' => 'newline'
	),
	20 => array( 
		'id' => 'map_url',
		'name' => __( 'Link src', 'yiw' ), 
		'type' => 'text',
		//'hidden' => false,
		'desc' => __( 'The link of the map, get from Google Maps.', 'yiw' ),
		//'desc_location' => 'newline'
	),
	30 => array( 
		'id' => 'map_opened',
		'name' => __( 'Open the map at page loaded.', 'yiw' ), 
		'type' => 'select',
		'options' => array(
            'yes' => __( 'Yes', 'yiw' ),
            'no' => __( 'No', 'yiw' ),
        ),
        'std' => 'no',
		//'hidden' => false,
		'desc' => __( 'Say if you want the map opened when the page is loaded.', 'yiw' ),
		'desc_location' => 'inline'
	),
); 
yiw_register_metabox( 'yiw_map_page', __( 'Tab with map', 'yiw' ), 'page', $options_args, 'normal', 'high' );

?>