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
class YIT_Submenu_Tabs_Splash_Custom_Splash_Logo extends YIT_Submenu_Tabs_Abstract {
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
                'id' => 'splash-logo_image', 
                'type' => 'upload',
                'name' => __( 'Logo image', 'yit' ),
                'desc' => __( 'Logo image. Leave empty to use default image.', 'yit' ),
                'std' => apply_filters( 'yit_splash-logo_image_std', '' )
            ),
                    	
            20 => array(
                'id' => 'splash-logo_color', 
                'type' => 'colorpicker',
                'name' => __( 'Background color', 'yit' ),
                'desc' => __( 'Logo background color. Leave empty for transparent background.', 'yit' ),
                'std' => apply_filters( 'yit_splash-logo_color_std', '' )
            ),

            30 => array(
                'id' => 'splash-logo_height',
                'type' => 'number',
                'name' => __( 'Height of the logo', 'yit' ),
                'desc' => __( 'The height in pixels of the login logo', 'yit' ),
                'std'  => apply_filters( 'yit_splash-logo_height_std' , 102),
                'min'  => 1,
                'max'  => 999
            ),
        );
    }
}