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
class YIT_Submenu_Tabs_Maintenance_Maintenance_Background extends YIT_Submenu_Tabs_Abstract {
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
            30 => array(
                'id' => 'maintenance-bg_image', 
                'type' => 'upload',
                'name' => __( 'Background image', 'yit' ),
                'desc' => __( 'Login screen background image', 'yit' ),
                'std' => apply_filters( 'yit_maintenance-bg_image_std', YIT_IMAGES_URL . '/backgrounds/splash/01.jpg' )
            ),
                    	
            35 => array(
                'id' => 'maintenance-bg_color', 
                'type' => 'colorpicker',
                'name' => __( 'Background color', 'yit' ),
                'desc' => __( 'Login screen background color', 'yit' ),
                'std' => apply_filters( 'yit_maintenance-bg_color_std', '#ffffff' )
            ),
                    	
            40 => array(
                'id' => 'maintenance-bg_image_repeat', 
                'type' => 'select',
                'name' => __( 'Background repeat', 'yit' ),
                'desc' => __( 'Select the repeat mode for the background image (you can change a setting in a specific page).', 'yit' ),
                'options' => apply_filters( 'yit_bg_image_repeat_options', array(
                    'repeat' => __( 'Repeat', 'yit' ),
                    'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
                    'repeat-y' => __( 'Repeat Vertically', 'yit' ),
                    'no-repeat' => __( 'No Repeat', 'yit' ),
                ) ),
                'std' => apply_filters( 'yit_maintenance-bg_image_repeat_std', 'repeat' )
            ),
                    	
            50 => array(
                'id' => 'maintenance-bg_image_position', 
                'type' => 'select',
                'name' => __( 'Background position', 'yit' ),
                'desc' => __( 'Select the position for the background image (you can change a setting in a specific page).', 'yit' ),
                'options' => apply_filters( 'yit_bg_image_position_options', array(
                    'center' => __( 'Center', 'yit' ),
                    'top left' => __( 'Top left', 'yit' ),
                    'top center' => __( 'Top center', 'yit' ),
                    'top right' => __( 'Top right', 'yit' ),
                    'bottom left' => __( 'Bottom left', 'yit' ),
                    'bottom center' => __( 'Bottom center', 'yit' ),
                    'bottom right' => __( 'Bottom right', 'yit' ),
                ) ),
                'std' => apply_filters( 'yit_maintenance-bg_image_position_std', 'top left' )
            ),
                    	
            60 => array(
                'id' => 'maintenance-bg_image_attachment', 
                'type' => 'select',
                'name' => __( 'Background attachment', 'yit' ),
                'desc' => __( 'Select the attachment for the background image (you can change a setting in a specific page).', 'yit' ),
                'options' => apply_filters( 'yit_bg_image_attachment_options', array( 
                    'scroll' => __( 'Scroll', 'yit' ),
                    'fixed' => __( 'Fixed', 'yit' ),
                ) ),
                'std' => apply_filters( 'yit_maintenance-bg_image_attachment_std', 'scroll' )
            ),

        );
    }


	/** 
	 * Returns the list of roles except administrator
	 * 
	 * @return array
	 * @access protected
	 * @since 1.0.0
	 */
	protected function _getRoles() {
		$roles = yit_wp_roles();
		unset($roles['administrator']);
		return $roles;
	}
}