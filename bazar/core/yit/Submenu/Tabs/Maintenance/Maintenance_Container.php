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
class YIT_Submenu_Tabs_Maintenance_Maintenance_Container extends YIT_Submenu_Tabs_Abstract {
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
                'id' => 'maintenance-container_width',
                'type' => 'number',
                'name' => __( 'Width of the container', 'yit' ),
                'desc' => __( 'The width in pixels of the login container', 'yit' ),
				'std'  => apply_filters( 'yit_maintenance-container_width_std' , 830),
				'min'  => 320,
				'max'  => 1500
            ),
            
            20 => array(
                'id' => 'maintenance-container_height',
                'type' => 'number',
                'name' => __( 'Min height of the container', 'yit' ),
                'desc' => __( 'The minimum height in pixels of the login container', 'yit' ),
				'std'  => apply_filters( 'yit_maintenance-container_height_std' , 406),
				'min'  => 300,
				'max'  => 999
            ),
			
			30 => array(
                'id' => 'maintenance-container-bg_color',
                'type' => 'colorpicker',
                'name' => __( 'Container background color', 'yit' ),
                'desc' => __( 'The container background color', 'yit' ),
				'std'  => apply_filters( 'yit_maintenance-container-bg_color_std' , '#ffffff')
            ),


            40 => array(
                'id'   => 'maintenance-container-message-font',
                'type' => 'typography',
                'name' => __( 'Message Font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the message.', 'yit' ),
                'min'  => 12,
                'max'  => 30,
                'std'  => apply_filters( 'yit_maintenance-container-message-font_std', array(
                    'size'   => 15,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#5b5b5b'
                ) ),
                'style' => apply_filters('yit_bmaintenance-container-message-font_style',array(
					'selectors' => '#maintenance_message',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),


        );
    }

}