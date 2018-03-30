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
class YIT_Submenu_Tabs_Seo_General_Pages extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_seo_general_pages
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
                'id' => 'page-seo-title',
                'type' => 'text',
                'name' => __( 'Pages Title', 'yit' ),
                'desc' => __( 'Type in the pages title.', 'yit' ),
                'std' => ''
            ),
            
            11 => array(
                'id' => 'page-seo-keywords',
                'type' => 'text',
                'name' => __( 'Pages keywords', 'yit' ),
                'desc' => __( 'Type in the pages keywords.', 'yit' ),
                'std' => ''
            ),
            
            12 => array(
                'id' => 'page-seo-description',
                'type' => 'text',
                'name' => __( 'Pages description', 'yit' ),
                'desc' => __( 'Type in the pages description.', 'yit' ),
                'std' => ''
            ),
            
            20 => array(
                'id' => 'post-seo-title',
                'type' => 'text',
                'name' => __( 'Posts Title', 'yit' ),
                'desc' => __( 'Type in the posts title.', 'yit' ),
                'std' => ''
            ),
            
            21 => array(
                'id' => 'post-seo-keywords',
                'type' => 'text',
                'name' => __( 'Posts keywords', 'yit' ),
                'desc' => __( 'Type in the posts keywords.', 'yit' ),
                'std' => ''
            ),
            
            22 => array(
                'id' => 'post-seo-description',
                'type' => 'text',
                'name' => __( 'Posts description', 'yit' ),
                'desc' => __( 'Type in the posts description.', 'yit' ),
                'std' => ''
            ),
            /* === END SEO SETTINGS === */
        );
    }
}