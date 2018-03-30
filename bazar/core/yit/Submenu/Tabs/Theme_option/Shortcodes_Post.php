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
class YIT_Submenu_Tabs_Theme_option_Shortcodes_Post extends YIT_Submenu_Tabs_Abstract {
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
                'id'   => 'recent-posts',
                'type' => 'title',
                'name' => __( 'Recent and popular posts', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the recent and popular posts.', 'yit' )                
            ),
            20 => array(
                'id'   => 'recent-posts-title',
                'type' => 'typography',
                'name' => __( 'Title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_recent-posts-title_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#676768' 
                ) ),
                'style' => apply_filters('yit_recent-posts-title_style',array(
					'selectors' => '.recent-post .text > a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            30 => array(
                'id'   => 'recent-posts-title-hover',
                'type' => 'colorpicker',
                'name' => __( 'Title hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'std'  => apply_filters( 'yit_recent-posts-title-hover_std', '#6C6D03' ),
                'style' => apply_filters('yit_recent-posts-title-hover_style',array(
					'selectors' => '.recent-post .text > a:hover',
					'properties' => 'color'
				))
            ),
            40 => array(
                'id'   => 'recent-posts-excerpt',
                'type' => 'typography',
                'name' => __( 'Excerpt text', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_recent-posts-excerpt_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#656262' 
                ) ),
                'style' => apply_filters('yit_recent-posts-excerpt_style',array(
					'selectors' => '.recent-post p',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            50 => array(
                'id'   => 'recent-posts-date',
                'type' => 'typography',
                'name' => __( 'Date', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_recent-posts-date_std', array(
                    'size'   => 10,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#213140' 
                ) ),
                'style' => apply_filters('yit_recent-posts-date_style',array(
					'selectors' => '.recent-post .hentry-post p.post-date',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            60 => array(
                'id'   => 'recent-posts-readmore',
                'type' => 'typography',
                'name' => __( 'Read more', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_recent-posts-readmore_std', array(
                    'size'   => 13,
                    'unit'   => 'px',
                    'family' => 'Open Sans',
                    'style'  => 'regular',
                    'color'  => '#1A5B7D' 
                ) ),
                'style' => apply_filters('yit_recent-posts-readmore_style',array(
					'selectors' => '.recent-post .text > a.read-more',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            70 => array(
                'id'   => 'recent-posts-readmore-hover',
                'type' => 'colorpicker',
                'name' => __( 'Read more hover', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
                'std'  => apply_filters( 'yit_recent-posts-readmore-hover_std', '#6B0303' ),
                'style' => apply_filters('yit_recent-posts-readmore-hover_style',array(
					'selectors' => '.recent-post .text > a.read-more:hover',
					'properties' => 'color'
				))
            ),
        );
    }
}