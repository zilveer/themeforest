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
 * Class to print fields in the tab Colors -> Footer
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Colors_Footer extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_colors_footer
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
                'id' => 'footer-background',
                'type' => 'colorpicker',
                'name' => __( 'Footer background color', 'yit' ),
                'desc' => __( 'Select the background for the footer.', 'yit' ),
                'std' => apply_filters( 'yit_footer-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '#footer',
                	'properties' => 'background'
				)
            ),
            20 => array(
                'id' => 'footer-borders-color',
                'type' => 'colorpicker',
                'name' => __( 'Footer borders color', 'yit' ),
                'desc' => __( 'Select the color for all the borderds in the footer.', 'yit' ),
                'std' => apply_filters( 'yit_footer-borders-color_std', '#CFCFCF' ),
                'style' => array(
                	'selectors' => '#footer, #footer *, #copyright *, #copyright .inner, #footer .recent-post .thumb-img img, #footer .widget_archive ul li a, #footer .widget_archive ul li a:hover, #footer .widget_nav_menu ul li a, #footer .widget_nav_menu ul li a:hover, #footer .widget_pages ul li a, #footer .widget_pages ul li a:hover, #footer .widget_categories ul li a, #footer .widget_categories ul li a:hover, #footer #searchform input, #footer .widget_flickrRSS img, #footer .widget_nav_menu ul li a, #footer .widget_pages ul li a, #footer .widget_categories ul li a, #footer .widget_archive ul li a:hover, #footer .widget_nav_menu ul li.current_page_item > a, #footer .widget_pages ul li.current_page_item > a, #footer .widget_categories ul li.current_page_item > a, #footer .testimonial-widget div.name-testimonial, #footer .last-tweets-widget ul li, #footer .yit-widget-content .widget, #footer .portfolio-categories ul li, #footer .recent-comments .avatar img, #footer .more-projects-widget .work-thumb, #footer .more-projects-widget .controls, #footer .more-projects-widget .top, #footer .featured-projects-widget img, #footer .thumb-project img',
                	'properties' => 'border-color'
				)
            ),
            30 => array(
                'id' => 'copyright-background',
                'type' => 'colorpicker',
                'name' => __( 'Copyright background color', 'yit' ),
                'desc' => __( 'Select the background for the copyright section.', 'yit' ),
                'std' => apply_filters( 'yit_copyright-background_std', '#ffffff' ),
                'style' => array(
                	'selectors' => '#copyright',
                	'properties' => 'background'
				)
            )
        );
    }
}