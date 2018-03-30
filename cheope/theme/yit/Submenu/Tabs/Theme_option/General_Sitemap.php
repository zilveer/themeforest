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
 * Class to print fields in the tab Shop -> General settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_General_Sitemap extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_general_settings
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
            40 => array(
                'type' => 'title',
                'name' => __( 'Page Settings', 'yit' ),
                'desc' => ''
            ), 
        	50 => array(
                'id'   => 'sitemap-page-title',
                'type' => 'text',
                'name' => __( 'Title', 'yit' ),
                'desc' => ''
            ),
        	60 => array(
                'id'   => 'sitemap-page-sort_column',
                'type' => 'select',
                'name' => __( 'Order By', 'yit' ),
                'desc' => '',
                'std'  => 'post_title',
                'options' => array(
					'post_title' => __('Pages alphabetically (by title)', 'yit'),
					'menu_order' => __('Pages by Page Order', 'yit'),
					'post_date' => __('Creation time', 'yit'),
					'post_modified' => __('Time last modified', 'yit'),
					'ID' =>  __('Numeric Page ID', 'yit'),
					'post_author' => __('Page author\'s numeric ID', 'yit'),
					'post_name' =>  __('Alphabetically by Post slug', 'yit')
				)
            ), 
        	70 => array(
                'id'   => 'sitemap-page-sort_order',
                'type' => 'select',
                'name' => __( 'Order', 'yit' ),
                'desc' => '',
                'std'  => 'ASC',
                'options' => array(
                	'ASC' => __('Sort from lowest to highest', 'yit'),
                	'DESC' => __('Sort from highest to lowest', 'yit')
				)
            ),
        	80 => array(
                'id'   => 'sitemap-page-exclude',
                'type' => 'text',
                'name' => __( 'Exclude Pages', 'yit' ),
                'desc' => __( 'Define a comma-separated list of Page IDs to be excluded from the list (example: \'exclude=3,7,31\')', 'yit' ),
                'std'  => '',
            ),
        	90 => array(
                'id'   => 'sitemap-page-depth',
                'type' => 'slider',
                'name' => __( 'Depth', 'yit' ),
                'desc' => __( 'This parameter controls how many levels in the hierarchy of pages are to be included in the list generated. The default value is 0 (display all pages, including all sub-pages)', 'yit' ),
                'std'  => 0,
                'min'  => 0,
                'max'  => 10,
                'step' => 1
            ),
            110 => array(
                'type' => 'title',
                'name' => __( 'Posts Settings', 'yit' ),
                'desc' => ''
            ), 
        	120 => array(
                'id'   => 'sitemap-posts-title',
                'type' => 'text',
                'name' => __( 'Title', 'yit' ),
                'desc' => ''
            ),
        	130 => array(
                'id'   => 'sitemap-posts-orderby',
                'type' => 'select',
                'name' => __( 'Order By', 'yit' ),
                'desc' => '',
                'std'  => 'post_date',
                'options' => array(
					'post_date'	=> __('Sort by post date', 'yit'),
					'author'	=> __('Sort by the numeric author IDs', 'yit'),
					'category'	=> __('Sort by the numeric category IDs', 'yit'),
					'content'	=> __('Sort by content', 'yit'),
					'date'		=> __('Sort by creation date', 'yit'),
					'ID'		=> __('Sort by numeric Post ID', 'yit'),
					'modified'	=> __('Sort by last modified date', 'yit'),
					'name'		=> __('Sort by stub', 'yit'),
					'parent'	=> __('Sort by parent ID', 'yit'),
					'password'	=> __('Sort by password', 'yit'),
					'rand'		=> __('Randomly sort results', 'yit'),
					'status'	=> __('Sort by status', 'yit'),
					'title'		=> __('Sort by title', 'yit'),
					'type'		=> __('Sort by type', 'yit'),
				)
            ), 
        	140 => array(
                'id'   => 'sitemap-posts-order',
                'type' => 'select',
                'name' => __( 'Order', 'yit' ),
                'desc' => '',
                'std'  => 'DESC',
                'options' => array(
                	'ASC' => __('Sort from lowest to highest', 'yit'),
                	'DESC' => __('Sort from highest to lowest', 'yit')
				)
            ),
        	150 => array(
                'id'   => 'sitemap-posts-exclude',
                'type' => 'text',
                'name' => __( 'Exclude Posts', 'yit' ),
                'desc' => __( 'Define a comma-separated list of Posts IDs to be excluded from the list (example: \'exclude=3,7,31\')', 'yit' ),
                'std'  => '',
            ),
            160 => array( 
			    'id' => 'sitemap-posts-cats_exclude',
			    'name' => __('Exclude categories', 'yit'),
			    'desc' => __('Select which categories you want to exclude.', 'yit'),
			    'type' => 'cat',
			    'cols' => 1,
			    'heads' => array(__('Categories', 'yit'))
			),
        	170 => array(
                'id'   => 'sitemap-posts-show_date',
                'type' => 'onoff',
                'name' => __( 'Show Date', 'yit' ),
                'desc' => __( 'Display the post date', 'yit' ),
                'std'  => false,
            ),
        	180 => array(
                'id'   => 'sitemap-posts-number',
                'type' => 'number',
                'name' => __( 'Number of items', 'yit' ),
                'desc' => __( 'Number of items to show in each category. (-1 means no limit)', 'yit' ),
                'std'  => -1,
                'min'  => -1,
                'max'  => 99
            ),
            190 => array(
                'type' => 'title',
                'name' => __( 'Archive Settings', 'yit' ),
                'desc' => ''
            ),
        	200 => array(
                'id'   => 'sitemap-archive-title',
                'type' => 'text',
                'name' => __( 'Title', 'yit' ),
                'desc' => ''
            ),
        	210 => array(
                'id'   => 'sitemap-archive-type',
                'type' => 'select',
                'name' => __( 'Type', 'yit' ),
                'desc' => __( 'The type of archive list to display.', 'yit' ),
                'std'  => 'monthly',
                'options' => array(
					'yearly'	=> __('Yearly', 'yit'),
					'monthly'	=> __('Monthly', 'yit'),
					'daily'		=> __('Daily', 'yit'),
					'weekly'	=> __('Weekly', 'yit'),
				)
            ),
        	220 => array(
                'id'   => 'sitemap-archive-limit',
                'type' => 'number',
                'name' => __( 'Limit', 'yit' ),
                'desc' => 'Number of archives to get. (-1 means no limit)',
                'std'  => -1,
                'min'  => -1,
                'max'  => 99
            ),
        	230 => array(
                'id'   => 'sitemap-archive-show_post_count',
                'type' => 'onoff',
                'name' => __( 'Post Count', 'yit' ),
                'desc' => __( 'Display number of posts in an archive or do not.', 'yit' ),
                'std'  => false,
            ),
        	240 => array(
                'id'   => 'sitemap-page-order',
                'type' => 'select',
                'name' => __( 'Order', 'yit' ),
                'desc' => '',
                'std'  => 'DESC',
                'options' => array(
                	'ASC' => __('Ascending order (A-Z)', 'yit'),
                	'DESC' => __('Descending order (Z-A)', 'yit')
				)
            ),
            
			/* --- */
            270 => array(
                'type' => 'title',
                'name' => __( 'Products Settings', 'yit' ),
                'desc' => __( 'This settings will applied only if Woocommerce is enabled.', 'yit')
            ),
        	280 => array(
                'id'   => 'sitemap-products-title',
                'type' => 'text',
                'name' => __( 'Title', 'yit' ),
                'desc' => ''
            ),
        	290 => array(
                'id'   => 'sitemap-products-number',
                'type' => 'number',
                'name' => __( 'Number of products', 'yit' ),
                'desc' => __( 'The number of products to show in each category. (-1 means no limit)', 'yit'),
                'min'  => -1,
                'max'  => 99,
                'std'  => -1
            ),

            300 => array(
                'type' => 'title',
                'name' => __( 'Sitemap Settings', 'yit' ),
                'desc' => __('Choose the elements to include/exclude in your sitemap and the order in which they will be displayed', 'yit')
            ),
        	310 => array(
                'id'   => 'sitemap-order',
                'type' => 'connectedlist',
                'name' => __( 'Sitemap Order', 'yit' ),
                'desc' => __('Drag and drop elements between the lists to determine what you want to display and the order.', 'yit'),
			    'heads' => array(
			    	'include' => __('Show', 'yit'), 
			    	'exclude' => __('Hide', 'yit')
				),
                'lists' => array(
					'include' => array(
						'pages' => __('Pages', 'yit'),
						'posts' => __('Posts', 'yit'),
						'archives' => __('Archives', 'yit'),
						'products' => __('Products', 'yit')
					),
					'exclude' => array()
				),
                'std' => json_encode(array(
					'include' => array(
						'pages' => __('Pages', 'yit'),
						'posts' => __('Posts', 'yit'),
						'archives' => __('Archives', 'yit'),
						'products' => __('Products', 'yit')
					),
					'exclude' => array()
				))
            ),
        );
    }
}
