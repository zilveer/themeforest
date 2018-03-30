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
class YIT_Submenu_Tabs_Theme_option_General_Settings extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_general_settings
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

        global $wp_version;

        $wp_logo = function_exists( 'has_custom_logo' ) && has_custom_logo() ;

        return array(
        	/* === START LOGO === */                   
            20 => $wp_logo ? false : array(
                'id'   => 'custom-logo',
                'type' => 'onoff',
                'name' => __( 'Custom logo', 'yit' ),
                'desc' => __( 'Want to use a custom image as logo?', 'yit' ),
                'std'  => 0,
            ),
            30 =>$wp_logo ? false : array(
                'id'   => 'logo-url',
                'type' => 'upload',
                'name' => __( 'Logo URL', 'yit' ),
                'desc' => __( 'Enter the URL to your logo image.', 'yit' ),
                'validate' => 'esc_url',
                'deps' => array(
                	'ids' => 'custom-logo',
                	'values' => 1
				)
            ),
            40 => array(
                'id'   => 'logo-tagline',
                'type' => 'onoff',
                'name' => __( 'Logo tagline', 'yit' ),
                'desc' => __( 'Specify if you want the tagline to show below the logo.', 'yit' ),
                'std'  => 1,
            ),            
            /* === END LOGO === */
            /* === START FAVICON === */
            50 => version_compare( $wp_version, '4.3', '>=' ) ? false : array(
                'id'   => 'favicon',
                'type' => 'upload',
                'name' => __( 'Favicon', 'yit' ),
                'desc' => __( 'A favicon is a 16x16 pixel icon that represents your site; paste the URL to a icon image that you want to use as the image.', 'yit' ),
                'validate' => 'esc_url',
                'std'  => get_template_directory_uri() . '/favicon.ico',
            ),
            version_compare( $wp_version, '4.3', '>=' ) ? false : array(
                'id' => 'general-favicon-touch',
                'type' => 'upload',
                'name' => __( 'Favicon Touch', 'yit' ),
                'desc' => __( 'The favicon for mobile devices, the image size must be at least 144x144 px', 'yit' ),
                'validate' => 'esc_url',
                'std' => get_template_directory_uri().'/apple-touch-icon-144x.png'
            ),
            /* === END FAVICON === */
            /* === START BREADCRUMB === */
            60 => array(
                'id'   => 'breadcrumb',
                'type' => 'onoff',
                'name' => __( 'Show Breadcrumb', 'yit' ),
                'desc' => __( 'Choose if you want to show or not breadcrumbs on your website.', 'yit' ),
                'std'  => 1,
            ),      
            /* === END BREADCRUMB === */
            /* === START LAYOUT === */
            80 => array(
                'id'      => 'layout-type',
                'type'    => 'select',
                'name'    => __( 'Layout type', 'yit' ),
                'desc'    => __( 'Choose the layout type.', 'yit' ),
                'options' => array(
                    'boxed'     => __( 'Boxed', 'yit' ),
                    'stretched' => __( 'Stretched', 'yit' ),
                ),
                'std'     => 'stretched'
            ),
            /* === END LAYOUT === */
            /* === START RESPONSIVE === */            
            90 => array(
                'id'   => 'responsive-enabled',
                'type' => 'onoff',
                'name' => __( 'Activate responsive', 'yit' ),
                'desc' => __( 'Choose if you want to enable or not the responsive behavior.', 'yit' ),
                'std'  => 1,
            )
        );
    }
}