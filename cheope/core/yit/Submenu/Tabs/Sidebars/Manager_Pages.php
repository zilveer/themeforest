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
 * Class to print fields in the tab Manager -> Pages
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Sidebars_Manager_Pages extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_sidebars_manager_pages
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
                'id'   => 'enable-all-sidebar',
                'type' => 'onoff',
                'name' => __( 'Enable one sidebar for all', 'yit' ),
                'desc' => __( 'Choose if you want show sidebar for all type of page.', 'yit' ),
                'std'  => 1,
            ),
            20 => array(
                'id'      => 'all-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'All sidebars', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar and where.', 'yit' ),
                'std'     => apply_filters( 'yit_all-sidebar_std', array(
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 1
				)
            ),
            25 => array(
                'id'      => 'pages-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Pages sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in simple page and where.', 'yit' ),
                'std'     => apply_filters( 'yit_pages-sidebar_std', array(
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 0
				)
            ),
            30 => array(
                'id'      => 'blog-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Blog sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in Blog page and where.', 'yit' ),
                'std'     => apply_filters( 'yit_blog-sidebar_std', array(
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Blog Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 0
				)
            ),
            40 => array(
                'id'      => '404-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( '404 Page sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in 404 Pages and where.', 'yit' ),
                'std'     => apply_filters( 'yit_404-sidebar_std', array(
                    'layout' => 'sidebar-no',
                    'sidebar' => '404 Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 0
				)
            ),
            50 => array(
                'id'      => 'archives-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Archives sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in Archives and where.', 'yit' ),
                'std'     => apply_filters( 'yit_archives-sidebar_std', array(
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 0
				)
            ),
            60 => array(
                'id'      => 'categories-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Categories sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in Categories and where.', 'yit' ),
                'std'     => apply_filters( 'yit_categories-sidebar_std', array(
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 0
				)
            ),
            70 => array(
                'id'      => 'search-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Search sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in Search and where.', 'yit' ),
                'std'     => apply_filters( 'yit_search-sidebar_std', array(
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-sidebar',
					'values' => 0
				)
            ),
        );
    }
}