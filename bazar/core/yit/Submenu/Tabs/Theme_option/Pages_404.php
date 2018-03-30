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
 * Class to print fields in the tab Pages -> 404
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Pages_404 extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_pages_404
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
                'id'   => '404-custom',
                'type' => 'onoff',
                'name' => __( 'Custom 404 Error page', 'yit' ),
                'desc' => __( 'Activate/Deactivate the custom 404 Error page.', 'yit' ),
                'std'  => apply_filters( 'yit_404-custom_std', 0 ),
            ),
            15 => array(
                'id'   => '404-image-position',
                'type' => 'select',
                'name' => __( 'Image position', 'yit' ),
                'desc' => __( 'Where the image will appear.', 'yit' ),
                'std'  => apply_filters( 'yit_404-image-position_std', 'above' ),
                'options' => apply_filters( 'yit_404-image-position_options', array(
                    'above' => __( 'Above text', 'yit' ),
                    'below' => __( 'Below text', 'yit' )
                ) ),
				'deps' => array(
					'ids' => '404-custom',
					'values' => 1
				)
            ),
            20 => array(
                'id' => '404-text',
                'type' => 'textarea',
                'name' => __( 'Text to show', 'yit' ),
                'desc' => __( 'Text shown if a user request a page that doesn\'t exists.', 'yit' ),
                'std' => apply_filters( 'yit_404-text_std', '' ),
				'deps' => array(
					'ids' => '404-custom',
					'values' => 1
				)
            ),
            30 => array(
                'id'   => '404-image',
                'type' => 'upload',
                'name' => __( 'Personal image', 'yit' ),
                'desc' => __( 'A image shown if a user request a page that doesn\'t exists.', 'yit' ),
                'validate' => 'esc_url',
                'std'  => apply_filters( 'yit_404-image_std', get_template_directory_uri() . '/images/404.png' ),
				'deps' => array(
					'ids' => '404-custom',
					'values' => 1
				)
            ),
        );
    }
}