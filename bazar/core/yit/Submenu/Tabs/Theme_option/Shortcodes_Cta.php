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
 * Class to print fields in the tab Home Shortcodes -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shortcodes_Cta extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_blog_typography
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
        	/* === START FONT === */            
            10 => array(
                'id'   => 'call-to-action',
                'type' => 'title',
                'name' => __( 'Call to action phone', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the call to action phone.', 'yit' )                
            ),
            20 => array(
                'id'   => 'call-to-action-title',
                'type' => 'typography',
                'name' => __( 'Title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_call-to-action-title_std', array(
                    'size'   => 20,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'bold',
                    'color'  => '#0C243D' 
                ) ),
                'style' => apply_filters('yit_call-to-action-title_style',array(
					'selectors' => '.call-to-action .incipit h2',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            30 => array(
                'id'   => 'call-to-action-incipit',
                'type' => 'typography',
                'name' => __( 'Incipit', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the incipit.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_call-to-action-incipit_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#464444' 
                ) ),
                'style' => apply_filters('yit_call-to-action-incipit_style',array(
					'selectors' => '.call-to-action .incipit p',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            40 => array(
                'id'   => 'call-to-action-phone',
                'type' => 'typography',
                'name' => __( 'Phone', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the phone.', 'yit' ),
                'min'  => 30,
                'max'  => 60,
                'std'  => apply_filters( 'yit_call-to-action-phone_std', array(
                    'size'   => 42,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'bold',
                    'color'  => '#838383' 
                ) ),
                'style' => apply_filters('yit_call-to-action-phone_style',array(
					'selectors' => '.call-to-action .number-phone, .call-to-action .number-phone a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
			50 => array(
                'id'   => 'call-to-action-button',
                'type' => 'title',
               'name' => __( 'Call to action with button', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the call to action with button.', 'yit' )        
            ),
            60 => array(
                'id'   => 'call-to-action-button-text',
                'type' => 'typography',
                'name' => __( 'Incipit', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the incipit.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_call-to-action-button-text_std', array(
                    'size'   => 14,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#666767' 
                ) ),
                'style' => apply_filters('yit_call-to-action-button-text_style',array(
					'selectors' => '.call-to-action-two .incipit',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            70 => array(
                'id' => 'call-to-action-button-background',
                'type' => 'colorpicker',
                'name' => __( 'Call to action with button background color', 'yit' ),
                'desc' => __( 'Select the background for Call to action with button.', 'yit' ),
                'std' => apply_filters( 'yit_call-to-action-button-background_std', '#F8F7F7' ),
                'style' => apply_filters( 'yit_call-to-action-button-background_style', array(
                	'selectors' => '.call-to-action-two',
                	'properties' => 'background-color'
				) )
            ),
            80 => array(
                'id' => 'call-to-action-button-border',
                'type' => 'colorpicker',
                'name' => __( 'Call to action with button border color', 'yit' ),
                'desc' => __( 'Select the background for Call to action with button.', 'yit' ),
                'std' => apply_filters( 'yit_call-to-action-button-border_std', '#DDDDDD' ),
                'style' => apply_filters( 'yit_call-to-action-button-border_style', array(
                	'selectors' => '.call-to-action-two',
                	'properties' => 'border-color'
				) )
            )			
        );
    }
}