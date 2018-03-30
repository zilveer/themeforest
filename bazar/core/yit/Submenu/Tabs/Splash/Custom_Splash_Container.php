<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
/**
 * Class to print fields in the tab General -> Header
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Splash_Custom_Splash_Container extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_sidebars_custom_all
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return array(
            10 => array(
                'id' => 'splash-container_width',
                'type' => 'number',
                'name' => __( 'Width of the container', 'yit' ),
                'desc' => __( 'The width in pixels of the login container', 'yit' ),
				'std'  => apply_filters( 'yit_splash-container_width_std' , 462),
				'min'  => 320,
				'max'  => 999
            ),
            
            20 => array(
                'id' => 'splash-container_height',
                'type' => 'number',
                'name' => __( 'Min height of the container', 'yit' ),
                'desc' => __( 'The minimum height in pixels of the login container', 'yit' ),
				'std'  => apply_filters( 'yit_splash-container_height_std' , 404),
				'min'  => 300,
				'max'  => 999
            ),
			
            30 => array(
                'id' => 'splash-container-bg_image', 
                'type' => 'upload',
                'name' => __( 'Container background image', 'yit' ),
                'desc' => __( 'Container background image.', 'yit' ),
                'std' => ''
            ),
			
			40 => array(
                'id' => 'splash-container-bg_color',
                'type' => 'colorpicker',
                'name' => __( 'Container background color', 'yit' ),
                'desc' => __( 'The container background color', 'yit' ),
				'std'  => apply_filters( 'yit_splash-container-bg_color_std' , '#ffffff')
            ),
            
            50 => array(
                'id'   => 'splash-container-label_font',
                'type' => 'typography',
                'name' => __( 'Labels & inputs font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the labels and inputs.', 'yit' ),
                'min'  => 12,
                'max'  => 30,
                'std'  => apply_filters( 'yit_splash-container-label_font_std', array(
                    'size'   => 15,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#5b5b5b' 
                ) )
            ),

            60 => array(
                'id'   => 'splash-container-submit_font',
                'type' => 'typography',
                'name' => __( 'Submit button font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the submit button.', 'yit' ),
                'min'  => 12,
                'max'  => 30,
                'std'  => apply_filters( 'yit_splash-container-submit_font_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#ffffff' 
                ) )
            ),
            
            70 => array(
                'id' => 'splash-container-submit_bg_color', 
                'type' => 'colorpicker',
                'name' => __( 'Submit button background color', 'yit' ),
                'desc' => __( 'Submit button background color', 'yit' ),
                'std' => apply_filters( 'yit_splash-container-submit_bg_color_std', '#c58408' )
            ),
            
            80 => array(
                'id' => 'splash-container-submit_bg_color_hover', 
                'type' => 'colorpicker',
                'name' => __( 'Submit button background color', 'yit' ),
                'desc' => __( 'Submit button background color', 'yit' ),
                'std' => apply_filters( 'yit_splash-container-submit_bg_color_hover_std', '#e79c0c' )
            ),

            90 => array(
                'id'   => 'splash-container-lostback_font',
                'type' => 'typography',
                'name' => __( 'Lost your password and Back links font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for Lost your password and Back links.', 'yit' ),
                'min'  => 12,
                'max'  => 30,
                'std'  => apply_filters( 'yit_splash-container-lostback_font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#ffffff'
                ) )
            ),
			
        );
    }
}