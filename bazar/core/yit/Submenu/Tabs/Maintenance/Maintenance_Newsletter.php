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
class YIT_Submenu_Tabs_Maintenance_Maintenance_Newsletter extends YIT_Submenu_Tabs_Abstract {
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
                'id' => 'maintenance-enable-newsletter',
                'type' => 'onoff',
                'name' => __( 'Enable Newsletter form', 'yit' ),
                'desc' => __( 'You can customize the Newsletter from Theme Options -> General -> Newsletter tab.', 'yit' ),
				'std'  => apply_filters( 'yit_maintenance-enable-newsletter_std' , 1)
            ),
            

            20 => array(
                'id'   => 'maintenance-newsletter-email-font',
                'type' => 'typography',
                'name' => __( 'Newsletter Email Font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the email input field.', 'yit' ),
                'min'  => 12,
                'max'  => 30,
                'std'  => apply_filters( 'yit_maintenance-newsletter-font_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#a09b9b'
                ) ),
                'style' => apply_filters('yit_maintenance-newsletter-email-font_style',array(
					'selectors' => '#maintenance_newsletter .newsletter-section input.text-field, #maintenance_newsletter .newsletter-section label',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),

            30 => array(
                'id'   => 'maintenance-newsletter-submit-font',
                'type' => 'typography',
                'name' => __( 'Newsletter Submit Font', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the email submit.', 'yit' ),
                'min'  => 12,
                'max'  => 30,
                'std'  => apply_filters( 'yit_maintenance-newsletter-submit-font_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Oswald',
                    'style'  => 'regular',
                    'color'  => '#ffffff'
                ) ),
                'style' => apply_filters('yit_maintenance-newsletter-submit-font_style',array(
					'selectors' => '#maintenance_newsletter .newsletter-section input.submit-field',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),

            40 => array(
                'id' => 'maintenance-newsletter-background',
                'type' => 'colorpicker',
                'name' => __( 'Newsletter submit background', 'yit' ),
                'desc' => __( 'The submit button background', 'yit' ),
				'std'  => apply_filters( 'yit_maintenance-newsletter-background_std' , '#c58408')
            ),
            
            50 => array(
                'id' => 'maintenance-newsletter-background_hover',
                'type' => 'colorpicker',
                'name' => __( 'Newsletter submit hover background', 'yit' ),
                'desc' => __( 'The submit button hover background', 'yit' ),
				'std'  => apply_filters( 'yit_maintenance-enable-newsletter-background_hover_std' , '#e79c0c')
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