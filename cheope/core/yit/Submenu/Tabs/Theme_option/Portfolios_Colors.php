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
 * Class to print fields in the tab Home Portfolios -> Colors
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Portfolios_Colors extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_portfolios_colors
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
        	/* === START COLORS === */
        	10 => array(
                'id' => 'portfolios-image-background',
                'type' => 'bgpreview',
                'name' => __( 'Image background', 'yit' ),
                'desc' => __( 'Select the image of portfolios background or if you want to upload a own bg image.', 'yit' ),
                'area' => 'body',
                'std' => array( 'image' => YIT_THEME_IMG_URL . '/backgrounds/032.jpg', 'color' => '#ffffff' ),
                'style' => array(
                	'selectors' => '#portfolios',
                	'properties' => 'color, background'
				)
            ),
            20 => array(
                'id' => 'portfolios-bg-uploader',
                'type' => 'upload',
                'name' => __( 'Custom background', 'yit' ),
                'desc' => __( 'Upload your own background.', 'yit' ),
                'std' => ''
            ),
            30 => array(
                'id' => 'portfolios-image-repeat-background',
                'type' => 'select',
                'name' => __( 'Background image repeat', 'yit' ),
                'desc' => __( 'The repeat attribute of portfolios image uploaded above.', 'yit' ),
                'options' => array(
					'repeat' => 'Repeat',
					'repeat-x' => 'Repeat Horizontally',
					'repeat-y' => 'Repeat Vertically',
					'no-repeat' => 'No Repeat'
				),
                'std' => 'repeat'
            ),
            40 => array(
                'id' => 'portfolios-image-position-background',
                'type' => 'select',
                'name' => __( 'Background image position', 'yit' ),
                'desc' => __( 'The position attribute of portfolios image uploaded above.', 'yit' ),
                'options' => array(
					'center' => 'Center',
					'top left' => 'Top left',
					'top center' => 'Top center',
					'top right' => 'Top right',
					'bottom left' => 'Bottom left',
					'bottom center' => 'Bottom center',
					'bottom right' => 'Bottom right'
				),
                'std' => 'center'
            ),
            50 => array(
                'id' => 'portfolios-image-attachment-background',
                'type' => 'select',
                'name' => __( 'Background image attachment', 'yit' ),
                'desc' => __( 'The attachment of the background image.', 'yit' ),
                'options' => array(
					'scroll' => 'Scroll',
					'fixed' => 'Fixed'
				),
                'std' => ''
            ),
            /* === END COLORS === */            
        );
    }
}