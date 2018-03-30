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
class YIT_Submenu_Tabs_Theme_option_Shortcodes_Various extends YIT_Submenu_Tabs_Abstract {
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
            10 => array(
                'id'   => 'twitter-sc',
                'type' => 'typography',
                'name' => __( 'Twitter', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title of twitter.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_twitter-sc_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#676768' 
                ) ),
                'style' => apply_filters('yit_twitter-sc_style',array(
					'selectors' => 'div.last-tweets-widget ul.tweets-widget li p, div.last-tweets-widget ul.tweets-widget li p a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),

            20 => array(
                'id'   => 'twitter-link-sc',
                'type' => 'colorpicker',
                'name' => __( 'Twitter link', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title of twitter link.', 'yit' ),
                'std'  => apply_filters( 'yit_twitter-link-sc_std', '#919303' ),
                'style' => apply_filters('yit_twitter-link-sc_style', array(
					'selectors' => 'div.last-tweets-widget ul.tweets-widget li p a',
					'properties' => 'color'
				))
            ),

            30 => array(
                'id'   => 'twitter-link-hover-sc',
                'type' => 'colorpicker',
                'name' => __( 'Twitter link hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title of twitter link hover.', 'yit' ),
                'std'  => apply_filters( 'yit_twitter-link-hover-sc_std', '#6C6D03' ),
                'style' => apply_filters('yit_twitter-link-hover-sc_style', array(
					'selectors' => 'div.last-tweets-widget ul.tweets-widget li p a:hover',
					'properties' => 'color'
				))
            ),

			40 => array(
                'id'   => 'tabs-sep',
                'type' => 'title',
                'name' => '',
                'desc' => ''                
            ),

            50 => array(
                'id'   => 'bullet-list',
                'type' => 'typography',
                'name' => __( 'Bullet list', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the bullet list.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_bullet-list_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#676768' 
                ) ),
                'style' => apply_filters('yit_bullet-list_style',array(
					'selectors' => 'ul.short li',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),

			60 => array(
                'id'   => 'toggle-title',
                'type' => 'typography',
                'name' => __( 'Toggle title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_toggle-title_std', array(
                    'size'   => 16,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#3E3E3E' 
                ) ),
                'style' => apply_filters('yit_toggle-title_style',array(
					'selectors' => '.toggle h4.tab-index a, .toggle h4.tab-index a:hover',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),

            70 => array(
                'id'   => 'toggle-text',
                'type' => 'typography',
                'name' => __( 'Toggle text', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_toggle-text_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#676768' 
                ) ),
                'style' => apply_filters('yit_toggle-text_style',array(
					'selectors' => '.toggle .content-tab, .toggle .content-tab p',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),

            80 => array(
                'id'   => 'tabs-sep',
                'type' => 'title',
                'name' => '',
                'desc' => ''                
            ),

            90 => array(
                'id'   => 'contact-info',
                'type' => 'typography',
                'name' => __( 'Contact info', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text of contact info.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_contact-info_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#676768' 
                ) ),
                'style' => apply_filters('yit_contact-info_style',array(
					'selectors' => '.contact-info .sidebar-nav ul li',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            )
        );
    }
}