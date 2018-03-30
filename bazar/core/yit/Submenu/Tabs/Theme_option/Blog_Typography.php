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
 * Class to print fields in the tab Home Blog -> Typography
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Blog_Typography extends YIT_Submenu_Tabs_Abstract {
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
                'id'   => 'blog-title-font',
                'type' => 'typography',
                'name' => __( 'Title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title.', 'yit' ),
                'min'  => 1,
                'max'  => 30,
                'std'  => apply_filters( 'yit_blog-title-font_std', array(
                    'size'   => 22,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters('yit_blog-title-font_style',array(
					'selectors' => '.post-title, .post-title a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				))
            ),
            20 => array(
                'id'   => 'blog-meta-font',
                'type' => 'typography',
                'name' => __( 'Metas', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the metas.', 'yit' ),
                'min'  => 1,
                'max'  => 18,
                'std'  => apply_filters( 'yit_blog-meta-font_std', array(
                    'size'   => 12,
                    'unit'   => 'px',
                    'family' => 'Droid Sans',
                    'style'  => 'regular',
                    'color'  => '#000000' 
                ) ),
                'style' => apply_filters( 'yit_blog-meta-font_style', array(
					'selectors' => '.blog-big .meta a, .blog-small .meta a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            21 => array(
                'id'   => 'blog-meta-font-hover',
                'type' => 'colorpicker',
                'name' => __( 'Metas hover', 'yit' ),
                'desc' => __( 'Choose the font color for the metas when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_blog-meta-font-hover_std', '#333333' ),
                'style' => array(
					'selectors' => '.blog-big .meta a:hover, .blog-small .meta a:hover',
					'properties' => 'color'
				)
            ),
            30 => array(
                'id'   => 'section-blog-post-title',
                'type' => 'typography',
                'name' => __( 'Section blog title', 'yit' ),
                'desc' => __( 'Choose the font type, size and color for the title in the section blog shortcode.', 'yit' ),
                'min'  => 1,
                'max'  => 20,
                'std'  => apply_filters( 'yit_section-blog-post-title_std', array(
                    'size'   => 15,
                    'unit'   => 'px',
                    'family' => 'Rokkitt',
                    'style'  => 'regular',
                    'color'  => '#030303' 
                ) ),
                'style' => apply_filters( 'yit_section-blog-post-title_style', array(
					'selectors' => '.section.blog .meta h4 a',
					'properties' => 'font-size, font-family, color, font-style, font-weight'
				) )
            ),
            40 => array(
                'id'   => 'section-blog-post-title-hover',
                'type' => 'colorpicker',
                'name' => __( 'Section blog title hover', 'yit' ),
                'desc' => __( 'Choose the color for the title in the section blog shortcode when the status is "hover".', 'yit' ),
                'std'  => apply_filters( 'yit_section-blog-post-title-hover_std', '#AC670C' ),
                'style' => apply_filters( 'yit_section-blog-post-title-hover_style', array(
					'selectors' => '.section.blog .meta h4 a:hover',
					'properties' => 'color'
				) )
            )            
        );
    }
}