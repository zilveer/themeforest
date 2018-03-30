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
 * Class to print fields in the tab Pages -> Categories
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Pages_Categories extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_pages_categories
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
                'id'   => 'show-title-categories',
                'type' => 'onoff',
                'name' => __( 'Show page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Category.', 'yit' ),
                'std'  => apply_filters( 'yit_show-title-categories_std', 1 ),
            ),
            20 => array(
                'id'   => 'page-categories-title',
                'type' => 'text',
                'name' => __( 'Page categories title', 'yit' ),
                'desc' => __( 'The title to use for the categories page. Use <strong>%s</strong> where you want to show the category name.', 'yit' ),
                'std'  => apply_filters( 'yit_page-categories-title_std', __( 'Archive for the %s Category', 'yit' ) ),
            ),
            30 => array(
                'id' => 'posts-categories',
                'type' => 'select',
                'name' => __( 'How show posts in Categories', 'yit' ),
                'desc' => __( 'Choose a theme background image or upload your own.', 'yit' ),
                'options' => apply_filters( 'yit_posts-categories_options', array(
					'content' => __( 'Content', 'yit' ),
					'excerpt' => __( 'Excerpt', 'yit' )
				) ),
                'std' => apply_filters( 'yit_posts-categories_std', 'excerpt' )
            ),
			40 => array(
                'id'   => 'readmore-categories',
                'type' => 'text',
                'name' => __( 'Read more text', 'yit' ),
                'desc' => __( 'Customize the Read more text.', 'yit' ),
                'std'  => apply_filters( 'yit_readmore-categories_std', __( 'Read more', 'yit' ) ),
                'deps' => array(
					'ids' => 'posts-categories',
					'values' => 'content'
				)
            )
        );
    }
}