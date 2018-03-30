<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/* check if Visual Composer is installed */
if( ! defined( 'WPB_VC_VERSION' )  ) {
    return;
}


/**
 * Add Text Transform for Custom Heading Shortcode
 *
 * @return    array
 *
 * @access    private
 * @since     4.0
 */
 
function _vc_add_text_transform_to_custom_heading() {
    
    return array(
        'type'          => 'dropdown',
        'heading'       => esc_html__( 'Text Transform', 'unitedthemes' ),
        'param_name'    => 'text_transform',
        'value'         => array(
            esc_html__( 'Select Text Transform' , 'ut_shortcodes' ) => '',
            esc_html__( 'None' , 'ut_shortcodes' )        => 'none',
            esc_html__( 'Capitalize' , 'ut_shortcodes' )  => 'capitalize',
            esc_html__( 'Inherit' , 'ut_shortcodes' )     => 'inherit',
            esc_html__( 'Lowercase' , 'ut_shortcodes' )   => 'lowercase',
            esc_html__( 'Uppercase' , 'ut_shortcodes' )   => 'uppercase'            
        ),
        
    );
    
}

vc_add_param( 'vc_custom_heading', _vc_add_text_transform_to_custom_heading() );



/**
 * Add Overlay Settings to VC Row
 *
 * @return    array
 *
 * @access    private
 * @since     4.0
 */

function _vc_add_overlay_settings_to_vc_row() {
    
    return array( 
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Activate Overlay?', 'unitedthemes' ),
            'param_name'    => 'bklyn_overlay',
            'value'         => array(
                esc_html__( 'off', 'ut_shortcodes' ) => '',
                esc_html__( 'on', 'ut_shortcodes' )  => 'true'
            ),
            'group'         => 'Overlay'
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__( 'Overlay Color', 'unitedthemes' ),
            'param_name'    => 'bklyn_overlay_color',
            'group'         => 'Overlay',
            'dependency'    => array(
                'element' => 'bklyn_overlay',
                'value'   => 'true',
            ),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Activate Overlay Pattern?', 'unitedthemes' ),
            'param_name'    => 'bklyn_overlay_pattern',
            'value'         => array(
                esc_html__( 'off', 'ut_shortcodes' ) => '',
                esc_html__( 'on', 'ut_shortcodes' )  => 'true'
            ),
            'group'         => 'Overlay',
            'dependency'    => array(
                'element' => 'bklyn_overlay',
                'value'   => 'true',
            ),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Overlay Style', 'unitedthemes' ),
            'param_name'    => 'bklyn_overlay_pattern_style',
            'group'         => 'Overlay',
            'value'         => array(
                esc_html__( 'Style One' , 'ut_shortcodes' )  => 'bklyn-style-one',
                esc_html__( 'Style Two' , 'ut_shortcodes' )  => 'bklyn-style-two',
            ),
            'dependency'    => array(
                'element' => 'bklyn_overlay_pattern',
                'value'   => 'true',
            )
                        
        )
        
        
    );
    
}

vc_add_params( 'vc_row', _vc_add_overlay_settings_to_vc_row() );



/**
 * Add Background Settings to VC Row
 *
 * @return    array
 *
 * @access    private
 * @since     4.0.3
 */

function _vc_add_background_settings_to_vc_row() {
    
    return array(
        
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Background Position', 'unitedthemes' ),
            'param_name'    => 'background_position',
            'value'         => array(
                esc_html__( 'Select Background Position', 'unite' ) => '',
                esc_html__( 'left top', 'unite' )                   => 'left top',
                esc_html__( 'left center', 'unite' )                => 'left center',
                esc_html__( 'left bottom', 'unite' )                => 'left bottom',
                esc_html__( 'center top', 'unite' )                 => 'center top',
                esc_html__( 'center center', 'unite' )              => 'center center',
                esc_html__( 'center bottom', 'unite' )              => 'center bottom',
                esc_html__( 'right top', 'unite' )                  => 'right top',
                esc_html__( 'right center', 'unite' )               => 'right center',
                esc_html__( 'right bottom', 'unite' )               => 'right bottom'  
            ),
            'group'         => 'Design Options',
            'dependency'    => array(
                'element' => 'parallax',
                'value_not_equal_to' => array('content-moving','content-moving-fade')
            )
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Background Attachment', 'unitedthemes' ),
            'param_name'    => 'background_attachment',
            'value'         => array(
                esc_html__( 'Select Background Attachment', 'unitedthemes' )=> '',
                esc_html__( 'Scroll', 'unitedthemes' )                      => 'scroll',
                esc_html__( 'Fixed', 'unitedthemes' )                       => 'fixed',
                esc_html__( 'Inherit', 'unitedthemes' )                     => 'inherit'
            ),
            'group'         => 'Design Options',
            'dependency'    => array(
                'element' => 'parallax',
                'value_not_equal_to' => array('content-moving','content-moving-fade')
            )   
        ),    
        
    );
    
}

vc_add_params( 'vc_row', _vc_add_background_settings_to_vc_row() );

/**
 * Enhance VC Media Grid
 *
 * @return    array
 *
 * @access    private
 * @since     4.0.3
 */

function _vc_add_enhance_media_grid_gap() {
    
    return array(
        'type' => 'dropdown',
        'heading' => __( 'Gap', 'unitedthemes' ),
        'param_name' => 'gap',
        'value' => array(
            '0px' => '0',
            '1px' => '1',
            '2px' => '2',
            '3px' => '3',
            '4px' => '4',
            '5px' => '5',
            '10px' => '10',
            '15px' => '15',
            '20px' => '20',
            '25px' => '25',
            '30px' => '30',
            '35px' => '35',
            '40px' => '40',
        ),
        'std' => '40',
        'description' => __( 'Select gap between grid elements.', 'unitedthemes' ),
        'edit_field_class' => 'vc_col-sm-6'
        
    );
    
}

vc_add_param( 'vc_media_grid', _vc_add_enhance_media_grid_gap() );

/* remove grid items */
vc_remove_param( 'vc_media_grid', 'item' );


/**
 * Enhance VC Media Gallery
 *
 * @return    array
 *
 * @access    private
 * @since     4.0.3
 */

function _vc_add_color_settings_to_vc_media_gallery() {
    
    return array(
        
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__( 'Arrow Color', 'unitedthemes' ),
            'param_name'    => 'arrow_color',
            'group'         => 'Colors'
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__( 'Arrow Hover Color', 'unitedthemes' ),
            'param_name'    => 'arrow_color_hover',
            'group'         => 'Colors'
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__( 'Dot Color', 'unitedthemes' ),
            'param_name'    => 'dot_color',
            'group'         => 'Colors'
        ),
        array(
            'type'          => 'colorpicker',
            'heading'       => esc_html__( 'Dot Color Active', 'unitedthemes' ),
            'param_name'    => 'dot_color_active',
            'group'         => 'Colors'
        )
    
    );

}

vc_add_params( 'vc_gallery', _vc_add_color_settings_to_vc_media_gallery() );




$deprecated = array (
    'category'   => 'Brooklyn ( Deprecated )',
    'deprecated' => true
);

vc_map_update( 'vc_posts_slider', $deprecated );
vc_map_update( 'vc_media_grid', $deprecated );
vc_map_update( 'vc_images_carousel', $deprecated );
vc_map_update( 'vc_gallery', $deprecated );




