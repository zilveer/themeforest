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
 * Class to print fields in the tab Pages -> Search
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Pages_Search extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_pages_search
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
                'id'   => 'show-title-searches',
                'type' => 'onoff',
                'name' => __( 'Show page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Search.', 'yit' ),
                'std'  => apply_filters( 'yit_show-title-searches_std', 1 ),
            ),
            20 => array(
                'id'   => 'page-searches-title',
                'type' => 'text',
                'name' => __( 'Page searches title', 'yit' ),
                'desc' => __( 'The title to use for the searches page. Use <strong>%s</strong> where you want to show the search value.', 'yit' ),
                'std'  => apply_filters( 'yit_page-searches-title_std', __( 'Search results for: %s', 'yit' ) ),
                'deps' => array(
					'ids' => 'show-title-searches',
					'values' => 1
				)
            ),
            30 => array(
                'id' => 'posts-searches',
                'type' => 'select',
                'name' => __( 'How show posts in searches', 'yit' ),
                'desc' => __( 'Choose a theme background image or upload your own.', 'yit' ),
                'options' => apply_filters( 'yit_posts-searches_options', array(
					'content' => __( 'Content', 'yit' ),
					'excerpt' => __( 'Excerpt', 'yit' )
				) ),
                'std' => apply_filters( 'yit_posts-searches_std', 'excerpt' )
            ),
			40 => array(
                'id'   => 'readmore-searches',
                'type' => 'text',
                'name' => __( 'Read more text', 'yit' ),
                'desc' => __( 'Customize the Read more text.', 'yit' ),
                'std'  => apply_filters( 'yit_readmore-searches_std', __( 'Read more', 'yit' ) ),
                'deps' => array(
					'ids' => 'posts-searches',
					'values' => 'content'
				)
            )
        );
    }
}