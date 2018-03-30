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
 * Class to print fields in the tab Colors -> Header
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Colors_Header extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_colors_header
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
                'id' => 'header-background',
                'type' => 'colorpicker',
                'name' => __( 'Background color', 'yit' ),
                'desc' => __( 'Select the background color of the header.', 'yit' ),
                'std' => apply_filters( 'yit_header-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '#header',
                	'properties' => 'background-color'
				)
            ),
            20 => array(
                'id' => 'header-border',
                'type' => 'colorpicker',
                'name' => __( 'Border color', 'yit' ),
                'desc' => __( 'Select the color of the border above the navigation.', 'yit' ),
                'std' => apply_filters( 'yit_header-border_std', '#cfcfcf' ),
                'style' => array(
                	'selectors' => '#header hr',
                	'properties' => 'border-color'
				)
            )
        );
    }
}