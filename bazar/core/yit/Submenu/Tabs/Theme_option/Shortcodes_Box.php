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
class YIT_Submenu_Tabs_Theme_option_Shortcodes_Box extends YIT_Submenu_Tabs_Abstract {
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
                'id'   => 'section-box',
				'type' => 'title',
                'name' => __( 'Box Shortcodes', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the Box Shortcodes.', 'yit' ),
            ),           
            20 => array(
                'id'   => 'success-box',
                'type' => 'typography',
                'name' => __( 'Success box', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the success box.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_success-box_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#599847' 
                ) ),
                'style' => apply_filters('yit_success-box_style',array(
					'selectors' => 'div.box.success-box',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            30 => array(
                'id'   => 'arrow-box',
                'type' => 'typography',
                'name' => __( 'Arrow box', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the arrow box.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_arrow-box_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#599847' 
                ) ),
                'style' => apply_filters('yit_arrow-box_style',array(
					'selectors' => 'div.box.arrow-box',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            40 => array(
                'id'   => 'alert-box',
                'type' => 'typography',
                'name' => __( 'Alert box', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the alert box.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_alert-box_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#CA6B1C' 
                ) ),
                'style' => apply_filters('yit_alert-box_style',array(
					'selectors' => 'div.box.alert-box',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            50 => array(
                'id'   => 'error-box',
                'type' => 'typography',
                'name' => __( 'Error box', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the error box.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_error-box_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#883333' 
                ) ),
                'style' => apply_filters('yit_error-box_style',array(
					'selectors' => 'div.box.error-box',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            60 => array(
                'id'   => 'notice-box',
                'type' => 'typography',
                'name' => __( 'Notice box', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the notice box.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_notice-box_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#9F6722' 
                ) ),
                'style' => apply_filters('yit_notice-box_style',array(
					'selectors' => 'div.box.notice-box',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            70 => array(
                'id'   => 'info-box',
                'type' => 'typography',
                'name' => __( 'Info box', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the info box.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_info-box_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#277DCE' 
                ) ),
                'style' => apply_filters('yit_info-box_style',array(
					'selectors' => 'div.box.info-box',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            80 => array(
                'id'   => 'box-sections',
                'type' => 'typography',
                'name' => __( 'Box sections title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title of box sections.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_box-sections_std', array(
                    'size'   => 16,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'bold',
                    'color'  => '#51595D' 
                ) ),
                'style' => apply_filters('yit_box-sections_style',array(
					'selectors' => 'div.box-sections h1, div.box-sections h2, div.box-sections h3, div.box-sections h4, div.box-sections h5, div.box-sections h6, div.box-sections h1 span, div.box-sections h2 span, div.box-sections h3 span, div.box-sections h4 span, div.box-sections h5 span, div.box-sections h6 span',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
        );
    }
}