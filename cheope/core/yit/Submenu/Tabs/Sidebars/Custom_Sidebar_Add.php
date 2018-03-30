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
 * Class to print fields in the tab General -> Header
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Sidebars_Custom_Sidebar_Add extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_sidebars_custom_add
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
            /* === START HEADER === */
            1 => array(
                'id' => 'custom-sidebars',
                'type' => 'text',
                'name' => __( 'Add sidebar', 'yit' ),
                'desc' => __( 'Type the name of the new sidebar to add.', 'yit' ),
                'button' => __( 'Add', 'yit' ),
                'data' => 'array-merge',
                'validate' => array(
                    'trim',
                    'esc_html',
                    'yit_avoid_duplicate'
                ),
                'std' => ''
            )
        );
    }
}