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
 * Class to print fields in the tab Shop -> Category page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Category_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_category_page
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
                'id'   => 'shop-category-title',
                'type' => 'onoff',
                'name' => __( 'Show category page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Category.', 'yit' ),
                'std'  => true
            ),
            20 => array(
                'id'   => 'shop-category-banner',
                'type' => 'onoff',
                'name' => __( 'Show category static image banner', 'yit' ),
                'desc' => __( 'Activate/Deactivate static image banner on Category.', 'yit' ),
                'std'  => false
            )

        );
    }
}