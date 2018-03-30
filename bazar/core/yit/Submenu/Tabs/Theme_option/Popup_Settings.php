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
 * Class to print fields in the tab General -> Settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Popup_Settings extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_popup_settings
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
                'id'   => 'popup',
                'type' => 'onoff',
                'name' => __( 'Popup', 'yit' ),
                'desc' => __( 'Want to use a popup?', 'yit' ),
                'std'  => 0,
            ),
			20 => array(
                'id'   => 'popup_title',
                'type' => 'text',
                'name' => __( 'Popup Title', 'yit' ),
                'desc' => __( 'Enter the title', 'yit' ),
				'std'  => '',
            ),
			30 => array(
                'id'   => 'popup_image',
                'type' => 'upload',
                'name' => __( 'Popup Image', 'yit' ),
                'desc' => __( 'Upload an image', 'yit' ),
                'std'  => '',
            ),
			40 => array(
                'id'   => 'popupmessage',
                'type' => 'textareaeditor',
                'name' => __( 'Popup Message', 'yit' ),
                'desc' => __( 'Enter the message', 'yit' ),
                'std'  => ''
            ),
			50 => array(
                'id'   => 'popup_title_font',
                'type' => 'typography',
                'name' => __( 'Title font', 'yit' ),
                'desc' => __( 'Select the font used in the Popup Title. ', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_popup-title_std', array(
                    'size'   => 21,
                    'unit'   => 'px',
                    'family' => 'Play',
                    'style'  => 'regular',
                    'color'  => '#666767' 
                ) ),			
            	'style' => apply_filters( 'yit_popup-title_style', array(
					'selectors' => 'div.popup .title',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) ),
            ),
			60 => array(
                'id'   => 'popup_content_font',
                'type' => 'typography',
                'name' => __( 'Content Font', 'yit' ),
                'desc' => __( 'Select the font used in the Popup Content. ', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_popup-content_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Muli',
                    'style'  => 'regular',
                    'color'  => '#666767' 
                ) ),			
            	'style' => apply_filters( 'yit_popup-content_style', array(
					'selectors' => 'div.popup, div.popup_message, div.popup_message p, div.popup_message span',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) ),
            ),
        );
    }
}