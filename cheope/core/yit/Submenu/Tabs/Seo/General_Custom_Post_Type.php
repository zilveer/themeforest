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
class YIT_Submenu_Tabs_Seo_General_Custom_Post_Type extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_seo_general_custom_post_type
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
                'id' => 'portfolios-seo-title',
                'type' => 'text',
                'name' => __( 'Portfolios Title', 'yit' ),
                'desc' => __( 'Type in the portfolios title.', 'yit' ),
                'std' => ''
            ),
            11 => array(
                'id' => 'portfolios-seo-keywords',
                'type' => 'text',
                'name' => __( 'Portfolios Keywords', 'yit' ),
                'desc' => __( 'Type in the portfolios keywords.', 'yit' ),
                'std' => ''
            ),
            12 => array(
                'id' => 'portfolios-seo-description',
                'type' => 'text',
                'name' => __( 'Portfolios Description', 'yit' ),
                'desc' => __( 'Type in the portfolios description.', 'yit' ),
                'std' => ''
            ),
            20 => array(
                'id' => 'services-seo-title',
                'type' => 'text',
                'name' => __( 'Services Title', 'yit' ),
                'desc' => __( 'Type in the services title.', 'yit' ),
                'std' => ''
            ),
            21 => array(
                'id' => 'services-seo-keywords',
                'type' => 'text',
                'name' => __( 'Services Keywords', 'yit' ),
                'desc' => __( 'Type in the services keywords.', 'yit' ),
                'std' => ''
            ),
            22 => array(
                'id' => 'services-seo-description',
                'type' => 'text',
                'name' => __( 'Services Description', 'yit' ),
                'desc' => __( 'Type in the services description.', 'yit' ),
                'std' => ''
            ),
            30 => array(
                'id' => 'testimonial-seo-title',
                'type' => 'text',
                'name' => __( 'Testimonials Title', 'yit' ),
                'desc' => __( 'Type in the testimonial title.', 'yit' ),
                'std' => ''
            ),
            31 => array(
                'id' => 'testimonial-seo-keywords',
                'type' => 'text',
                'name' => __( 'Testimonials Keywords', 'yit' ),
                'desc' => __( 'Type in the testimonial keywords.', 'yit' ),
                'std' => ''
            ),
            32 => array(
                'id' => 'testimonial-seo-description',
                'type' => 'text',
                'name' => __( 'Testimonials Description', 'yit' ),
                'desc' => __( 'Type in the testimonial description.', 'yit' ),
                'std' => ''
            )
            /* === END SEO SETTINGS === */
        );
    }
}