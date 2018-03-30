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
class YIT_Submenu_Tabs_Seo_General_Title_Metas extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_seo_general_title_metas
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
                'id' => 'seo-title',
                'type' => 'text',
                'name' => __( 'Website Title', 'yit' ),
                'desc' => __( 'Type in the main website title.<br /><strong>Note</strong>: This field is different from "Site Title" in Settings -> General.', 'yit' ),
                'std' => ''
            ),
            
            20 => array(
                'id' => 'seo-keywords',
                'type' => 'text',
                'name' => __( 'Website Keywords', 'yit' ),
                'desc' => __( 'Type in the main website keywords.', 'yit' ),
                'std' => ''
            ),
            
            30 => array(
                'id' => 'seo-description',
                'type' => 'text',
                'name' => __( 'Website description', 'yit' ),
                'desc' => __( 'Type in the main website description.', 'yit' ),
                'std' => ''
            ),
            /* === END SEO SETTINGS === */
        );
    }
}