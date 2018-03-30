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
class YIT_Submenu_Tabs_Maintenance_Maintenance_General extends YIT_Submenu_Tabs_Abstract {
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
                'id' => 'enable-maintenance',
                'type' => 'onoff',
                'name' => __( 'Enable Maintenance Page', 'yit' ),
                'desc' => __( 'Enable the splash page to lets users to know the blog is down for maintenance.', 'yit' ),
				'std'  => apply_filters( 'yit_enable-maintenance_std' , 0)
            ),
            

            20 => array(
                'id' => 'maintenance-allowed_roles',
                'type' => 'connectedlist',
                'name' => __( 'Roles', 'yit' ),
                'desc' => __( 'The user roles enabled to see the frontend. Drag & Drop roles to allow or deny the access.', 'yit' ),
                'heads' => array(
			    	'allowed' => __('Allowed', 'yit'), 
			    	'denied' => __('Denied', 'yit')
				),
                'lists' => array(
					'allowed' => array(
						'administrator' => __('Administrator', 'yit')
					),
					'denied' => $this->_getRoles()
				),
                'std' => json_encode(array(
					'allowed' => array(
						'administrator' => __('Administrator', 'yit')
					),
					'denied' => $this->_getRoles()
				))
            ),
            
			30 => array(
                'type' => 'textarea',
                'id' => 'maintenance-message',
                'name' => __( 'Message', 'yit' ),
                'desc' => __( 'The message displayed. You can also use HTML code.', 'yit' )
            ),
			
            100 => array(
                'type' => 'textarea',
                'id' => 'maintenance-custom-style',
                'name' => __( 'Custom Style', 'yit' ),
                'desc' => __( 'Insert here your custom CSS style', 'yit' )
            )
			
			/*
            20 => array(
                'type' => 'textarea',
                'id' => 'splash-custom-style',
                'name' => 'Custom Style',
                'desc' => 'Insert here your custom CSS style'                
            ),
			 */

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