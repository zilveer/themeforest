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
 * Class to print fields in the tab Home Testimonials -> Settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Testimonials_Settings extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_testimonials_settings
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
                'id' => 'thumbnail-testimonials',
                'type' => 'onoff',
                'name' => __( 'Show Thumbnail', 'yit' ),
                'desc' => __( 'Activate/Deactivate the item thumbnail of testimonials.', 'yit' ),
                'std' => true
            ),
			20 => array(
                'id' => 'link-testimonials',
                'type' => 'onoff',
                'name' => __( 'Link to testimonial detail page', 'yit' ),
                'desc' => __( 'Say if you want that the testimonial links, link to the testimonial detail page.', 'yit' ),
                'std' => true
            ),
            30 => array(
                'id' => 'text-type-testimonials',
                'type' => 'select',
                'name' => __( 'Testimonial text type', 'yit' ),
                'desc' => __( 'Select what kind of content you want to show.', 'yit' ),
                'options' => array(
					'content' => 'Complete content',
					'excerpt' => 'Limit Words for Excerpt'
				),
                'std' => 'content',
            ),
            40 => array(
                'id' => 'limit-words-testimonials',
                'type' => 'slider',
                'name' => __( 'Limit words', 'yit' ),
                'desc' => __( 'Select how many words to show.', 'yit' ),
                'min'  => 5,
                'max'  => 255,
                'step' => 1,
                'std'  => 50,
                'deps' => array(
					'ids' => 'text-type-testimonials',
					'values' => 'excerpt'
				)
            )
        );
    }
}