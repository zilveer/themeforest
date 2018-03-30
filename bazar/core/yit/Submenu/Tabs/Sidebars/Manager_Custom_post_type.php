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
 * Class to print fields in the tab Manager -> Custom post type
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Sidebars_Manager_Custom_post_type extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_sidebars_manager_custom_post_type
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
                'id'   => 'enable-all-custom-sidebar',
                'type' => 'onoff',
                'name' => __( 'Enable one sidebar for all Custom post type', 'yit' ),
                'desc' => __( 'Choose if you want show sidebar for all custom post type.', 'yit' ),
                'std'  => 1,
            ),
            20 => array(
                'id'      => 'all-custom-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'All custom post type sidebars', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in a custom post type and where.', 'yit' ),
                'std'     => apply_filters( 'yit_all-custom-sidebar_std', array( 
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-custom-sidebar',
					'values' => 1
				)
            ),
            30 => array(
                'id'      => 'testimonial-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Testimonials sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in Testimonials page and where.', 'yit' ),
                'std'     => apply_filters( 'yit_testimonials-sidebar_std', array( 
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-custom-sidebar',
					'values' => 0
				)
            ),
            40 => array(
                'id'      => 'portfolios-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Portfolios sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in Portfolios page and where.', 'yit' ),
                'std'     => apply_filters( 'yit_portfolios-sidebar_std', array( 
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-custom-sidebar',
					'values' => 0
				)
            ),
// 			50 => array(
//                 'id'      => 'galleries-sidebar',
//                 'type'    => 'customsidebar',
//                 'name'    => __( 'Galleries sidebar', 'yit' ),
//                 'desc'    => __( 'Choose if you want to show a sidebar in Galleries page and where.', 'yit' ),
//                 'std'     => apply_filters( 'yit_galleries-sidebar_std', array( 
//                     'layout' => 'sidebar-right',
//                     'sidebar' => 'Default Sidebar'
//                 ) ),
//                 'deps'    => array(
// 					'ids'    => 'enable-all-custom-sidebar',
// 					'values' => 0
// 				)
//             ),
            60 => array(
                'id'      => 'services-sidebar',
                'type'    => 'customsidebar',
                'name'    => __( 'Services sidebar', 'yit' ),
                'desc'    => __( 'Choose if you want to show a sidebar in services page and where.', 'yit' ),
                'std'     => apply_filters( 'yit_services-sidebar_std', array( 
                    'layout' => 'sidebar-right',
                    'sidebar' => 'Default Sidebar'
                ) ),
                'deps'    => array(
					'ids'    => 'enable-all-custom-sidebar',
					'values' => 0
				)
            )
        );
    }
}