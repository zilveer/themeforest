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
 * Class to print fields in the tab Colors -> General
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Colors_General extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_colors_general
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
            20 => array(
                'id' => 'background-style',
                'type' => 'bgpreview',
                'name' => __( 'Background', 'yit' ),
                'desc' => __( 'Select a background for the body of all pages (you can change a setting in a specific page).', 'yit' ),
                'std' => apply_filters( 'yit_background-style_std', array( 'image' => '', 'color' => '#ffffff' ) )
            ),
                    	
            30 => array(
                'id' => 'bg_image', 
                'type' => 'upload',
                'name' => __( 'Background custom image', 'yit' ),
                'desc' => __( 'Select a custom image, if you have set "Custom background" in the above option (you can change a setting in a specific page).', 'yit' ),
                'std' => apply_filters( 'yit_bg_image_std', '' )
            ),
                    	
            40 => array(
                'id' => 'bg_image_repeat',
                'type' => 'select',
                'name' => __( 'Background repeat', 'yit' ),
                'desc' => __( 'Select the repeat mode for the background image (you can change a setting in a specific page).', 'yit' ),
                'options' => apply_filters( 'yit_bg_image_repeat_options', array(
                    'repeat' => __( 'Repeat', 'yit' ),
                    'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
                    'repeat-y' => __( 'Repeat Vertically', 'yit' ),
                    'no-repeat' => __( 'No Repeat', 'yit' ),
                ) ),
                'std' => apply_filters( 'yit_bg_image_repeat_std', 'repeat' )
            ),
                    	
            50 => array(
                'id' => 'bg_image_position',
                'type' => 'select',
                'name' => __( 'Background position', 'yit' ),
                'desc' => __( 'Select the position for the background image (you can change a setting in a specific page).', 'yit' ),
                'options' => apply_filters( 'yit_bg_image_position_options', array(
                    'center' => __( 'Center', 'yit' ),
                    'top left' => __( 'Top left', 'yit' ),
                    'top center' => __( 'Top center', 'yit' ),
                    'top right' => __( 'Top right', 'yit' ),
                    'bottom left' => __( 'Bottom left', 'yit' ),
                    'bottom center' => __( 'Bottom center', 'yit' ),
                    'bottom right' => __( 'Bottom right', 'yit' ),
                ) ),
                'std' => apply_filters( 'yit_bg_image_position_std', 'top left' )
            ),
                    	
            60 => array(
                'id' => 'bg_image_attachment', 
                'type' => 'select',
                'name' => __( 'Background attachment', 'yit' ),
                'desc' => __( 'Select the attachment for the background image (you can change a setting in a specific page).', 'yit' ),
                'options' => apply_filters( 'yit_bg_image_attachment_options', array( 
                    'scroll' => __( 'Scroll', 'yit' ),
                    'fixed' => __( 'Fixed', 'yit' ),
                ) ),
                'std' => apply_filters( 'yit_bg_image_attachment_std', 'scroll' )
            ),
            
            65 => array(
                'id' => 'container-background',
                'type' => 'colorpicker',
                'name' => __( 'Container background', 'yit' ),
                'desc' => __( 'Select the color of the container if Layout type is "Boxed".', 'yit' ),
                'std' => apply_filters( 'yit_container-background_std', '#ffffff' ),
                'style' => apply_filters( 'yit_container-background_style', array( 
                	'selectors' => '.boxed #wrapper',
                	'properties' => 'background-color'
				) )
            ),
            
			70 => array(
                'id' => 'general-border',
                'type' => 'colorpicker',
                'name' => __( 'Border color', 'yit' ),
                'desc' => __( 'Select the color of the border.', 'yit' ),
                'std' => apply_filters( 'yit_general-border_std', '#cfcfcf' ),
                'style' => apply_filters( 'yit_general-border_style', array( 
                	'selectors' => 'code, pre, body hr, #copyright .inner, #footer .inner, .gallery img, .gallery img, .content .archive-list ul, .content .archive-list ul li, .more-projects-widget .work-thumb, .more-projects-widget .controls, .more-projects-widget .top, .featured-projects-widget img, .thumb-project img, #searchform input, .portfolio-categories ul li, .portfolio-categories ul li:hover, .recent-comments .avatar img, .content .contact-form li.submit-button input, #portfolio .read-more, #portfolio .more-link, #portfolio .read-more:hover, #portfolio .more-link:hover, .accordion-title, .accordion-item-thumb img, form input[type="text"], form textarea, .testimonial-page, div.section-caption .caption, .line, .last-tweets-widget ul li, .toggle p.tab-index, .toggle .content-tab, .tabs-container ul.tabs, .tabs-container ul.tabs li a, .tabs-container ul.tabs li:last-child, .tabs-container div.border-box, .testimonial, .google-map-frame, .section.blog .post, .section.blog h4.other-articles, .section.blog .sticky .thumbnail, .section .portfolio-sticky .work-categories, .testimonial, #searchform input, .blog-big .meta p, .blog-big p.list-tags, .blog-small .image-wrap, .comment-container, .image-square-style #comments img.avatar, #comments .comment-author img, .comment-meta, #respond input, #respond textarea, img.comment-avatar, .portfolio-big-image a.thumb, .portfolio-big-image a.more, .portfolio-big-image a.more:hover, .portfolio-big-image .work-thumbnail a.nozoom, .portfolio-big-image .work-skillsdate, .internal_page_item, .gallery-wrap li h5, .gallery-filters, .portfolio-full-description a.thumb, .portfolio-full-description a.more, .portfolio-full-description a.more:hover, .portfolio-full-description .work-skillsdate, .related_img, #portfolio.columns .overlay_a, .yit-widget-content .widget, .slider.thumbnails .showcase-thumbnail img, .slider.thumbnails .showcase-thumbnail img:hover, .slider.thumbnails .showcase-thumbnail.active img, .recent-post .thumb-img img, .widget_archive ul li a, .widget_archive ul li a:hover, .widget_nav_menu ul li a, .widget_nav_menu ul li a:hover, .widget_pages ul li a, .widget_pages ul li a:hover, .widget_categories ul li a, .widget_categories ul li a:hover, #searchform input, .widget_flickrRSS img, .widget_nav_menu ul li a, .widget_pages ul li a, .widget_categories ul li a, .widget_archive ul li a:hover, .widget_nav_menu ul li.current_page_item > a, .widget_pages ul li.current_page_item > a, .widget_categories ul li.current_page_item > a, .testimonial-widget div.name-testimonial, .last-tweets-widget ul li, .yit-widget-content .widget, .portfolio-categories ul li, .recent-comments .avatar img, .more-projects-widget .work-thumb, .more-projects-widget .controls, .more-projects-widget .top, .featured-projects-widget img, .thumb-project img, .recent-post .hentry-post, .recent-comments .border, #content-blog .blog-item',
                	'properties' => 'border-color'
				) )
            )
        );
    }
}